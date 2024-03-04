<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class ProductsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(){
        // Where Condition is implemented inside product modelas a global scope

        //SELECT * FR0M products;
        //SELECT * FROM stores WHERE id IN (..);
        //SELECT * FROM categories WHERE id IN (..);
        // With >> Eager Loading
        $products=Product::with(['store','category'])->paginate();

        return view("dashboard.products.index",compact("products"));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $product=Product::findOrFail($id);
        $tags= implode(' , ',$product->tags()-> pluck('name')->toArray());
        return view('dashboard.products.edit',compact('product','tags'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Product $product)
    {
        $product->update($request->except('tags'));
        $tags= json_decode($request->post('tags'));
        $tag_ids=[];
        $saved_tags=Tag::all();
        foreach($tags as $t_name){
            $slug=Str::slug($t_name->value);
            $tag=$saved_tags->where('slug',$slug)->first();
            if(!$tag){
                $tag=Tag::create([
                    'slug'=>$slug,
                    'name'=>$t_name->value,
                ]);
            }
            $tag_ids[]=$tag->id;
        }
        $product->tags()->sync($tag_ids);
        return redirect()->route('dashboard.products.index')
            ->with('success','Product Updated Successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
