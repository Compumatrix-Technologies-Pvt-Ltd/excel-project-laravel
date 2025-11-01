<?php

namespace App\Http\Controllers;

use App\Models\Faq;
use App\Models\Plans;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function __construct()
    {
        $this->ViewData = [];
        $this->ModuleView = 'front.';
        //$this->middleware('guest')->except('logout');
    }

    public function home()
    {
        $this->ModuleTitle = __('Home');
        $this->ViewData['moduleAction'] = $this->ModuleTitle;
        $this->ViewData['faqs'] = Faq::all();
        $plans = Plans::with('features')->orderBy('id')->get();
        $this->ViewData['plans'] = $plans;
        return view($this->ModuleView . 'home', $this->ViewData);
    }

    public function privacyPolicy()
    {
        $this->ModuleTitle = __('Privacy Policy');
        $this->ViewData['moduleAction'] = $this->ModuleTitle;
        return view($this->ModuleView . 'privacy-policy', $this->ViewData);
    }
    public function termsConditions()
    {
        $this->ModuleTitle = __('Terms & Conditions');
        $this->ViewData['moduleAction'] = $this->ModuleTitle;
        return view($this->ModuleView . 'terms-conditions', $this->ViewData);
    }
}
