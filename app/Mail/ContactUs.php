<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Http\Request;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class ContactUs extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * @var array
     */
    private $request_data;

    /**
     * Create a new message instance.
     *
     * @param Request $request
     */
    public function __construct($request)
    {
        $this->request_data = $request;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $request_data = $this->request_data;

        return $this->view('partials.templates.email.contact', compact('request_data'));
    }
}
