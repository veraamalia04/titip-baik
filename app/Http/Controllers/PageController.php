<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PageController extends Controller
{
    //
    public function loginPage(){
        return view('public.login');
    }

    public function index(){
        return view('dashboard.index');
    }
}
