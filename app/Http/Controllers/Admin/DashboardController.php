<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

//models
use App\Models\User;
use App\Models\ProductsOrderModel;
use App\Models\ProductsModel;
use App\Models\ClientCompaniesModel;

//requests
use DB;
use Carbon\Carbon;
use Auth;

class DashboardController extends Controller
{
    private $BaseModel;
    private $ViewData;
    private $JsonData;
    private $ModuleTitle;
    private $ModuleView;
    private $ModulePath;


    public function __construct(
        User $UserModel,

    ) {
        // $this->middleware('auth');
        $this->BaseModel = $UserModel;

        $this->ViewData = [];
        $this->JsonData = [];

        $this->ModuleView  = 'admin.dashboard.';
        $this->ModulePath = 'dashboard.';


    }
    
    public function index(Request $request)
    {
        $this->ViewData['moduleAction'] = "Dashboard";
        return view('admin.dashboard', $this->ViewData);
    }
   
    
    
}