<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class AdminDashBoardController extends Controller
{
    public function index()
    {
        $page_title = 'HOME';
        //    Log::channel('slackNotify')->info('Beta DashHome Page', [
        //     'name' => Auth::user()->username??'guest',
        //     'email' => Auth::user()->email??'guest',
        // ]);
        return view('dashboard.admin')->with('page_title', $page_title);
    }


    public function artisan_migrate()
    {
        try {
            Artisan::call('migrate');
            echo 'Migration Successful';
        } catch (\Throwable $th) {
            dd($th);
        }
    }

    public function artisan_mgrtfrsh()
    {
        try {
            Artisan::call('migrate:fresh', [
                '--force' => true
             ]);
            echo 'Fresh Migration Successful';
        } catch (\Throwable $th) {
            dd($th);
        }
    }

    public function artisan_seed()
    {
        try {
            Artisan::call('db:seed', [
                '--force' => true
             ]);
            echo 'Seed Successful';
        } catch (\Throwable $th) {
            dd($th);
        }
    }

    public function artisan_chclr()
    {
        try {
            Artisan::call('cache:clear');
            echo 'Cache Clear Successful';
        } catch (\Throwable $th) {
            dd($th);
        }
    }

    public function artisan_cfgclr()
    {
        try {
            Artisan::call('config:clear');
            echo 'Config Clear Successful';
        } catch (\Throwable $th) {
            dd($th);
        }
    }

    public function artisan_vwcch()
    {
        try {
            Artisan::call('view:cache');
            echo 'View Cache Successful';
        } catch (\Throwable $th) {
            dd($th);
        }
    }


    public function artisan_vwclr()
    {
        try {
            Artisan::call('view:clear');
            echo 'View Clear Successful';
        } catch (\Throwable $th) {
            dd($th);
        }
    }
    

    public function artisan_stglnk()
    {
        try {
            Artisan::call('storage:link', []);
            echo 'Symlink Successful';
        } catch (\Throwable $th) {
            dd($th);
        }
    }
}
