<?php

namespace App\Http\Controllers;

use App\Http\Requests\Frontend\ReviewRequest;
use App\Review;
use Illuminate\Http\Request;
use Auth;
use Illuminate\Http\Response;

class ReviewController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        //
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
     * @param  \Illuminate\Http\Request  $request
     * @return Response
     */
    public function store(ReviewRequest $request)
    {

        dd($request->all());

        $request['user_id'] = Auth::user()->id;

        $save = Review::create($request->all());

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
}
