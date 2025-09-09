<?php

namespace App\Http\Controllers\Admin;

use App\Helpers\Helper;
use App\Http\Controllers\Controller;
use App\Models\Mill;
use Exception;
use Illuminate\Auth\GuardHelpers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class MasterController extends Controller
{

    public function __construct(Mill $millModel)
    {

        $this->BaseModel = $millModel;

        $this->ViewData = [];
        $this->JsonData = [];
        $this->ModuleView = 'admin.master.';
    }

    public function index()
    {
        $this->ViewData['moduleAction'] = "Master Management";
    }

}
