<?php

namespace App\Http\Controllers;

use App\Http\Requests\Frontend\ReviewRequest;
use App\Product;
use App\Review;
use Illuminate\Http\Request;
use Auth;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Log;

class ReviewsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param $product_id
     * @return Response
     */
    public function index($product_id)
    {
        $reviews = Review::orderBy('id', 'desc')->with('user')->where('product_id', $product_id)->get();

        return $reviews;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param ReviewRequest $request
     * @param Product $product
     * @param $product_id
     * @return Response
     */
    public function store(ReviewRequest $request, Product $product, $product_id)
    {
        $request['user_id'] = Auth::user()->id;

        $review = new Review($request->all());
        $save = $product->find($product_id)->reviews()->save($review);

        return Review::with('user')->where('id', $save->id)->first();

        if ($save){
            return back()->with('success', 'Your review has been submitted successfully');
        }else{
            return back()->with('error', 'Your review could not be submit');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Review  $review
     * @return Response
     */
    public function show(Review $review)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Review  $review
     * @return Response
     */
    public function edit(Review $review)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Review  $review
     * @return Response
     */
    public function update(Request $request, Review $review)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Review  $review
     * @return Response
     */
    public function destroy(Review $review)
    {
        //
    }

    /**
     * Get product rating
     *
     * @param $product_id
     * @return float
     */
    function getRating($product_id){
        $reviews = $this->index($product_id);
        $rating = round($reviews->sum('rating')/$reviews->count(),2);

        return $rating;
    }
}
