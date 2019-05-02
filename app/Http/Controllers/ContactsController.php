<?php

namespace App\Http\Controllers;

use App\Http\Requests\Frontend\ContactRequest;
use App\Mail\ContactUs;
    use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Mail;

class ContactsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        return view('frontend.pages.contact');
    }

    /**
     * Send mail to admin.
     *
     * @param ContactRequest $request
     * @return Response
     */
    public function submitContact(ContactRequest $request)
    {
       Mail::to('aalmamun417@gmail.com')->send(new ContactUs($request->all()));

       return back()->with(['success' => 'Thank you ' .ucfirst($request->name). ', Your email has been submitted successfully. We contact with you as soon as possible.']);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return void
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
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show()
    {

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
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
     * @return Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        //
    }
}
