<?php

namespace App\Http\Controllers;

use App\Events\PageViewedEvent;
use App\Mail\ContactFormMail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class PagesController extends Controller
{
    public function index(Request $request)
    {
        $page_identifier = 'beta-home';
        event(new PageViewedEvent($request, $page_identifier));
        return view('pages.index')->with('page_title', 'BETA TECHNICIANS - HOME');
    }


    public function solar(Request $request)
    {
        // abort(503);
        // echo asset('/uploads/product_images/');
        // echo public_path('/uploads/product_images/');
        // exit;
        $page_identifier = 'solar-home';
        event(new PageViewedEvent($request, $page_identifier));
        return view('pages.solar')->with('page_title', 'BETA TECHNICIANS - SOLAR INSTALLATIONS');
    }


    public function networking(Request $request)
    {
        $page_identifier = 'networking-home';
        event(new PageViewedEvent($request, $page_identifier));
        return view('pages.networking')->with('page_title', 'BETA TECHNICIANS - COMPUTER NETWORKING & INSTALLATIONS');
    }


    public function surveillance(Request $request)
    {
        $page_identifier = 'surveillance-home';
        event(new PageViewedEvent($request, $page_identifier));
        return view('pages.surveillance')->with('page_title', 'BETA TECHNICIANS - CCTV INSTALLATIONS');
    }


    public function contact_us(Request $request)
    {
        $page_identifier = 'contact-us';
        event(new PageViewedEvent($request, $page_identifier));
        return view('pages.contact_us')->with('page_title', 'BETA TECHNICIANS - CONTACT US');
    }


    
}
