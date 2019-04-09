<?php

namespace App\Http\Controllers;

use App\Http\Requests\Frontend\ContactRequest;
use Illuminate\Http\Request;
use Mail;

class ContactsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('frontend.pages.contact');
    }

    /**
     * Send mail to admin.
     *
     * @param ContactRequest $request
     * @return \Illuminate\Http\Response
     */
    public function submitContact(ContactRequest $request)
    {
        $data = array('msg' => $request->message);

        $sendEmail = Mail::send('partials.templates.email.contact', $data, function($message) use($request) {
            $message->to('aalmamun417@gmail.com')->subject($request->subject);
            $message->from($request->email, $request->name);
        });

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
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show()
    {

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
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
