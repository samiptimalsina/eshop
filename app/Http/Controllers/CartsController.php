<?php

namespace App\Http\Controllers;

use App\Product;
use Cart;
use Illuminate\Http\Request;

class CartsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('frontend.pages.view_cart');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @param $slug
     * @return array
     */
    public function store(Request $request, $slug)
    {
        $request->validate([
            'qty' => 'required|numeric|min:1',
        ]);

        $product = Product::where('slug', $slug)->first();

        $data = [];
        $data['id'] = $product->id;
        $data['name'] = $product->name;
        $data['qty'] = $request->qty;
        $data['price'] = $product->price;
        $data['options']['image'] = $product->image;

        $addToCart = Cart::instance('cart')->add($data);

        if($addToCart){
            return array('title' => 'Success', 'type' => 'success', 'message' => 'Product add to cart successfully.');
        }else{
            return array('title' => 'Error', 'type' => 'error', 'message' => 'Product could not be add to cart.');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param $rowId
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $rowId)
    {
        $request->validate([
            'qty' => 'required|numeric|min:1',
        ]);

        $update = Cart::instance('cart')->update($rowId, $request->qty);

        if ($update){
            return back()->with(['success' => 'Cart update successfully']);
        }else{
            return back()->with(['warning' => 'Cart could not be update']);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param $rowId
     * @return array
     */
    public function destroy($rowId)
    {
        $remove = Cart::instance('cart')->remove($rowId);

        if ($remove == null){
            return array('title' => 'Success', 'type' => 'success', 'message' => 'Product remove from cart successfully.');
        }else{
            return array('title' => 'Error', 'type' => 'error', 'message' => 'There is a problem, Please try again.');
        }
    }

    /**
     * Count wishlist product
     *
     * @return int
     */
    function count(){
        return Count(Cart::instance('cart')->content());
    }

    /**
     * Return all cart product
     *
     * @return array
     */
    public function getCartProduct(){

        $cart_items = Cart::instance('cart')->content();

        $cart_products = [];
        foreach ($cart_items as $item){
            $cart_products[] = $item->toArray();
        }
        return $cart_products;
    }

    /**
     * Calculate final price
     *
     * @return array|\Gloudemans\Shoppingcart\Cart
     */
    public function finalCalculate(){

        $cart = Cart::instance('cart');

        $cart = ['subTotal' => $cart->subtotal(), 'total' => $cart->total()];

        return $cart;
    }
}
