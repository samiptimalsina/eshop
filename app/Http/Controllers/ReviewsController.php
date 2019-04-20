<?php

namespace App\Http\Controllers;

use App\Http\Requests\Frontend\ReviewRequest;
use App\Product;
use App\Review;
use App\Review_helpful;
use App\Review_vote;
use Illuminate\Http\RedirectResponse;
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
     * @param int $skip
     * @return Response
     */
    public function index($product_id, $skip = 0)
    {
        $reviews = Review::orderBy('id', 'desc')
            ->with('user')
            ->withCount('reviewVotes')
            ->withCount(['helpFullVotes' => function($query){
                $query->where('help_full', true);
            }])
            ->skip($skip)->where(['product_id' => $product_id])->limit(3)->get();

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
     * @param Request $request
     * @param $review_id
     * @param $vote_type 1 or 0
     * @return RedirectResponse
     */
    public function storeVote(Request $request, $vote_type, $review_id)
    {
        $user_id = Auth::user()->id;

        $already_give_vote = Review_vote::all()->where('user_id', $user_id)
                                ->where('review_id', $review_id)
                                ->first();

        if (empty($already_give_vote)){ //New voter

            $request['user_id'] = $user_id;
            $request['review_id'] = $review_id;
            $request['help_full'] = $vote_type;

            Review_vote::create($request->all());

        }else{ //Already has voted now only vote type change

            if ($already_give_vote->vote_type != $vote_type){ //give different vote type
                $request['help_full'] = $vote_type;
                $already_give_vote->update($request->all());
            }
        }

        return back();
    }
}
