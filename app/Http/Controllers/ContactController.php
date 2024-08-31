<?php

namespace App\Http\Controllers;

use App\Mail\ContactFormMail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class ContactController extends Controller
{

    public function form_response()
    {
        return redirect()->back()->with('success', 'Your Message Has Been Sent !');
    }


    public function contact_form(Request $request)
    {
        $request->validate([
            'section' => ['required', 'string', 'max:55'],
            'name' => ['required', 'string', 'max:30'],
            'email' => ['required', 'string', 'email', 'max:55'],
            'phone' => ['required', 'numeric', 'digits_between:11,16'],
            'content' => ['required', 'string',]
        ]);

        $data = [
            'section' => $request->section,
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'content' => $request->content,

        ];

        if ($request->reply) {
            return $this->form_response();
        }

        Mail::to(config('website.email'))->send(new ContactFormMail($data));
        return $this->form_response();
    }
}
