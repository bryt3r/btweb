<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserDashBoardController extends Controller
{
    public function index(Request $request)
    {
        if (Auth::user()->is_banned) {
            Auth::logout();
 
            $request->session()->invalidate();
         
            $request->session()->regenerateToken();
         
            return redirect('/');
        }
        $page_title = 'HOME';
        return view('dashboard.user')->with('page_title', $page_title);
    }
}
