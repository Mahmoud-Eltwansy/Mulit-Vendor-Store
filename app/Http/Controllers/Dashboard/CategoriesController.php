<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\CategoryRequest;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class CategoriesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): \Illuminate\Contracts\View\View|\Illuminate\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\Foundation\Application
    {
        // SELECT categories.* ,parents.name as parent_name
        // from categories
        // LEFT JOIN categories as parents ON parents.id = a.parent_id
        $categories = Category::with('parent')
            /*leftJoin('categories as parents','parents.id','=','categories.parent_id')
            ->select([
                'categories.*',
                'parents.name as parent_name'
            ])*/
            // ->select('categories.*')
            // ->selectRaw('(SELECT COUNT(*) FROM products WHERE category_id = categories.id AND status = 'active') as product_count')
            //->withCount('products')  >> return no of records in this relation as products_count
            ->withCount([
                'products' => function ($query) {
                    $query->where('status', '=', 'active');
                }
            ])
            ->filter($request->query())
            ->orderBy('categories.name', 'DESC')
            ->paginate();
        return view('dashboard.categories.index', [
            'categories' => $categories
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): \Illuminate\Contracts\View\View|\Illuminate\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\Foundation\Application
    {
        return view('dashboard.categories.create', [
            'parents' => Category::all(),
            'category' => new Category()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): \Illuminate\Http\RedirectResponse
    {
        // Validation
        $request->validate(Category::rules());

        // Request merge
        $request->merge([
            'slug' => Str::slug($request->post('name'))
        ]);

        $data = $request->except('image');
        $data['image'] = $this->uploadImage($request);

        Category::create($data);

        return redirect()->route('dashboard.categories.index')->with('success', 'Category Created !');
    }

    /**
     * Display the specified resource.
     */
    public function show(Category $category)
    {
        return view('dashboard.categories.show', compact('category'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id): \Illuminate\Contracts\View\View|\Illuminate\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\Foundation\Application
    {
        // SELECT * FROM categories WHERE id<>$id
        // AND (parent_id IS NULL OR parent_id <>$id);
        //Call the parents who are not the current category or the children of the current category
        $parents = Category::where('id', '<>', $id)
            ->where(function ($query) use ($id) {
                $query->whereNull('parent_id')
                    ->orWhere('parent_id', '<>', $id);
            })->get();

        return view('dashboard.categories.edit', [
            'category' => Category::findOrFail($id),
            'parents' => $parents,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    // The usage of CategoryRequest enabled me to validate the data inside the request
    public function update(CategoryRequest $request, string $id): \Illuminate\Http\RedirectResponse
    {
        // Validation is done inside the CategoryRequest

        $category = Category::findOrFail($id);
        $old_image = $category->image;
        $data = $request->except('image');

        // checking the image if it's existing or not
        $new_image = $this->uploadImage($request);
        if ($new_image) {
            $data['image'] = $new_image;
        }
        // update the data
        $category->update($data);

        //delete the old photo if it's exists and got updated
        if ($old_image && $new_image) {
            Storage::disk('public')->delete($old_image);
        }

        return redirect()
            ->route('dashboard.categories.index')
            ->with('success', 'Category Updated !');
    }

    /**
     * Remove the specified resource from storage.
     */
    // Here I used Route Model Binding
    public function destroy(Category $category): \Illuminate\Http\RedirectResponse
    {
        $category->delete();

        return redirect()
            ->route('dashboard.categories.index')
            ->with('success', 'Category Deleted !');
    }

    protected function uploadImage(Request $request)
    {
        if (!$request->hasFile('image')) {
            return;
        }
        $file = $request->file('image');  //uploadedFile object
        $path = $file->store('uploads', [
            'disk' => 'public'
        ]);
        return $path;
    }

    public function trash(): \Illuminate\Contracts\View\View|\Illuminate\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\Foundation\Application
    {
        $categories = Category::onlyTrashed()->paginate();
        return view('dashboard.categories.trash', compact('categories'));
    }

    public function restore(Request $request, $id): \Illuminate\Http\RedirectResponse
    {
        $category = Category::onlyTrashed()->findOrFail($id);
        $category->restore();

        return redirect()->route('dashboard.categories.trash')
            ->with('success', 'Restored Successfully');
    }

    public function forceDelete($id): \Illuminate\Http\RedirectResponse
    {
        $category = Category::onlyTrashed()->findOrFail($id);
        $category->forceDelete();
        if ($category->image) {
            Storage::disk('public')->delete($category->image);
        }
        return redirect()->route('dashboard.categories.trash')
            ->with('success', 'Deleted Forever!');
    }
}
