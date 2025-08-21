<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function __construct()
    {
        $this->ViewData = [];
        $this->ModuleView  = 'front.';
        //$this->middleware('guest')->except('logout');
    }
    
    public function home()
    {
        $this->ModuleTitle              = __('Home');
        $this->ViewData['moduleAction'] = $this->ModuleTitle; 
        return view($this->ModuleView . 'home', $this->ViewData);
    }
    public function privacyPolicy()
    {
        $this->ModuleTitle              = __('Privacy Policy');
        $this->ViewData['moduleAction'] = $this->ModuleTitle; 
        return view($this->ModuleView . 'privacy-policy', $this->ViewData);
    }
    public function termsConditions()
    {
        $this->ModuleTitle              = __('Terms & Conditions');
        $this->ViewData['moduleAction'] = $this->ModuleTitle; 
        return view($this->ModuleView . 'terms-conditions', $this->ViewData);
    }
}
