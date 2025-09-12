<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Http\Requests\Admin\UpdatePasswordRequest;
use App\Http\Requests\Admin\UserProfileRequest;

//Models
use App\Models\User;
use App\Models\CompanyInfoModel;

//pulgins
use Auth;
use Storage;
use Image;
use DB;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    private $BaseModel;
    private $ViewData;
    private $JsonData;
    private $ModuleTitle;
    private $ModuleView;
    private $ModulePath;

    public function __construct(
        User $User,
        CompanyInfoModel $CompanyInfoModel,
    ) {
        $this->BaseModel = $User;
        $this->CompanyInfoModel = $CompanyInfoModel;
        $this->ViewData = [];
        $this->JsonData = [];

        $this->ModuleTitle = __('Update Profile');
        $this->ModuleView  = 'admin.profile.';
        $this->ModulePath = 'profile.';
    }
    public function editProfile(Request $request){

        $this->ViewData['Data']=[];
        $this->ModuleTitle              = __('Manage Profile');
        $this->ViewData['moduleAction'] = $this->ModuleTitle;
        $id = Auth::user()->id;
        $this->ViewData['profile'] = $this->BaseModel->where('id',$id)->with('company')->first();
        $this->ViewData['modulePath']   = $this->ModulePath;
        return view('admin.profile.update-profile', $this->ViewData);
    }

    // Update login user details
    public function update(UserProfileRequest $request,$encid){

        try{
            $id = Auth::user()->id;
            $collection             = $this->BaseModel->find($id);
            $collection->name = trim($request->name);
            $collection->mobile_number = trim($request->mobile_number);
        
            $collection->save();

            $this->JsonData['status'] = __('success');
            $this->JsonData['url']    =  route('admin.dashboard');
            $this->JsonData['msg']    = __('Profile has been updated successfully');

        }catch(\Exception $e){
            $this->JsonData['msg'] = __('Something went wrong on server.Please contact to Server.');
                $this->JsonData['error_msg'] = $e->getMessage();
        }
        return response()->json($this->JsonData);
    }
    public function updatePassword(Request $request){

        $this->ModuleTitle              = __('Update Password');
        $this->ViewData['modulePath']   = $this->ModulePath;
        $this->ViewData['moduleAction'] = $this->ModuleTitle;
        $id = Auth::user()->id;
        $this->ViewData['id']   = $id;
        return view('admin.profile.update-password', $this->ViewData);
    }
  
    public function storeUpdatedPassword(UpdatePasswordRequest $request,$encid){
        try{
            $id = base64_decode(base64_decode($encid));
            $collection  = $this->BaseModel->find($id);
            $collection->password = Hash::make($request->new_password);
            $collection->save();

            $this->JsonData['status'] = __('success');
            $this->JsonData['url']    =  route('admin.dashboard');
            $this->JsonData['msg']    = __('Password has been changed successfully');
            
        }catch(\Exception $e){
            $this->JsonData['msg'] = __('Something went wrong on server.Please contact to Server.');
            $this->JsonData['error_msg'] = $e->getMessage();
        }
        return response()->json($this->JsonData);
    }
    public function companyUpdate(Request $request,$encid){

        try{
            $id = Auth::user()->id;
            $collection             = $this->CompanyInfoModel->find($id);
            if(!$collection){
                $collection = new CompanyInfoModel;
            }
            $collection->name = trim($request->name);
            $collection->address = trim($request->address);
            $collection->code = trim($request->code);
            $collection->email = trim($request->email);
            $collection->phone = trim($request->phone);
            $collection->registration_no = trim($request->registration_no);
            if ($request->hasFile('logo')) {
                $allowedFileExtension = ['jpg', 'png', 'jpeg'];
                $file = $request->file('logo');
                $strPath = 'company-logos/';
                $images_path = storage_path() . '/app/' . $strPath;
                if (!file_exists($images_path)) {
                    mkdir($images_path, 0777, true);
                }
                $extension = $file->getClientOriginalExtension();
                $strFileName = time() . '_' . uniqid() . '.' . $extension;
                if ($collection->logo) {
                    $oldImagePath = $strPath . $collection->logo;
                    if (Storage::disk('local')->exists($oldImagePath)) {
                        Storage::delete($oldImagePath);
                    }
                }
                $fileStorePath = Storage::putFileAs($strPath, $file, $strFileName);
                if ($fileStorePath) {
                    $collection->logo = $strFileName;
                }
            }
            $collection->save();
            if($collection->wasRecentlyCreated){
                $user = $this->BaseModel->find($id);
                $user->company_id = $collection->id;
                $user->save();
            }

            $this->JsonData['status'] = __('success');
            $this->JsonData['url']    =  route('admin.dashboard');
            $this->JsonData['msg']    = __('Company details has been updated successfully');

        }catch(\Exception $e){
            $this->JsonData['msg'] = __('Something went wrong on server.Please contact to Server.');
                $this->JsonData['error_msg'] = $e->getMessage();
        }
        return response()->json($this->JsonData);
    }

}
