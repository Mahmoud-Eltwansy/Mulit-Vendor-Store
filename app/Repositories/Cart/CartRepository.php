<?php

namespace App\Repositories\Cart;

use App\Models\Product;
use Illuminate\Support\Collection;

interface CartRepository
{
    public function get() : Collection; // get all the products in the cart
    public function add(Product $product,$quantity=1); // add a product to the cart
    public function update($id,$quantity); // update the quantity of an item in the cart
    public function delete(string $id); // delete an item from the cart
    public function empty(); // empty the cart
    public function total() : float ; // get the total price of the cart
}

