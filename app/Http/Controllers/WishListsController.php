<?php

namespace App\Http\Controllers;

use App\Product;
use Cart;
use DB;
use Illuminate\Http\Request;
use Log;

class WishListsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('frontend.pages.view_wishlist');
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
     * @param $slug
     * @return array
     */
    public function store($slug)
    {
        $product = Product::where('slug', $slug)->first();

        $duplicates = Cart::instance('wishlist')->search(function ($wishListItem) use ($product) {
                        return $wishListItem->id == $product->id;
                     });

        if ($duplicates->isNotEmpty()) {
            return array('title' => 'Warning', 'type' => 'warning', 'message' => 'Product has already in your wishlist.');
        }

        $data = [];
        $data['id'] = $product->id;
        $data['name'] = $product->name;
        $data['qty'] = 1;
        $data['price'] = $product->price;
        $data['options']['image'] = $product->image;

        $add_to_wishList = Cart::instance('wishlist')->add($data);

        if ($add_to_wishList){
            return array('title' => 'Success', 'type' => 'success', 'message' => 'Product add to wishlist successfully.');
        }else{
            return array('title' => 'Error', 'type' => 'error', 'message' => 'There is a problem, Please try again.');
            //return redirect()->back()->with(['warning' => 'Product add to wishlist Failed']);
        }

       /* if($add_to_wishList){
            return redirect()->back()->with(['success' => 'Product add to wishlist successfully']);
        }else{
            return redirect()->back()->with(['warning' => 'Product add to wishlist Failed']);
        }*/
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
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param $row_id
     * @return array
     */
    public function destroy($row_id)
    {
        $remove = Cart::instance('wishlist')->remove($row_id);

        if ($remove == null){
            return array('title' => 'Success', 'type' => 'success', 'message' => 'Product remove from wishlist successfully.');
        }else{
            return array('title' => 'Error', 'type' => 'error', 'message' => 'There is a problem, Please try again.');
        }

        /*if ($remove == null){
            return back()->with(['success' => 'Product remove from wishlist successfully']);
        }else{
            return back()->with(['warning' => 'Product could not be remove from wishlist']);
        }*/
    }

    /**
     * Product move to cart
     *
     * @param $rowId
     * @return array
     */
    function moveToCart($rowId){

        $item = Cart::instance('wishlist')->get($rowId);

        $duplicates = Cart::instance('cart')->search(function ($cartItem) use ($item) {
            return $cartItem->id == $item->id;
        });

        if ($duplicates->isNotEmpty()) {
            return array('title' => 'Warning', 'type' => 'warning', 'message' => 'Product has already in your cart.');
        }

        Cart::instance('wishlist')->remove($rowId);

        $data = [];
        $data['id'] = $item->id;
        $data['name'] = $item->name;
        $data['qty'] = 1;
        $data['price'] = $item->price;
        $data['options']['image'] = $item->options->image;

        $addToCart = Cart::instance('cart')->add($data);

        if($addToCart){
            return array('title' => 'Success', 'type' => 'success', 'message' => 'Product move to cart successfully.');
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
        return Count(Cart::instance('wishlist')->content());
    }

    /**
     * Return all wishlist product
     *
     * @return array
     */
    public function getWishlistProduct(){

        $wishlist_items = Cart::instance('wishlist')->content();

        $wishlist_products = [];
        foreach ($wishlist_items as $item){
            $wishlist_products[] = $item->toArray();
        }
        return $wishlist_products;
    }
}
