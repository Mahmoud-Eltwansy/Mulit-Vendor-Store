<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Repositories\Cart\CartRepository;
use Illuminate\Http\Request;

class CartController extends Controller
{
    private $cartRepository;
    public function __construct(CartRepository $cartRepository)
    {
        $this->cartRepository=$cartRepository;
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('front.cart',[
            'cart'=>$this->cartRepository
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'product_id'=>['required','int','exists:products,id'],
            'quantity'=>['nullable','int','min:1'],
        ]);
        $product=Product::findOrFail($request->post('product_id'));
        $this->cartRepository->add($product,$request->post('quantity'));

        return redirect()->route('cart.index');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'quantity'=>['required','int','min:1'],
        ]);
        $this->cartRepository->update($id,$request->post('quantity'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $this->cartRepository->delete($id);

        return [
            'message' => 'success'
        ];
    }
}
