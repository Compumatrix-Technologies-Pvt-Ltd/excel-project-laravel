<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function __construct()
    {
        $this->ViewData = [];
        $this->ModuleView  = 'admin.';
        //$this->middleware('guest')->except('logout');
    }
    
    public function home()
    {
        $this->ModuleTitle              = __('Sign Up');
        $this->ViewData['moduleAction'] = $this->ModuleTitle; 
        return view($this->ModuleView . 'home', $this->ViewData);

    }
}
