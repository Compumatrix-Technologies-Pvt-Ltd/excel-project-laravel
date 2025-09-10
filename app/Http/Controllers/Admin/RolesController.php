<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Controllers\Controller;
use Spatie\Permission\Models\Role;
use App\Models\RoleHasPermissionsModel;
use App\Models\User;
use App\Http\Requests\Admin\RolesRequest;
use DB;

class RolesController extends Controller
{
    private $BaseModel;
    private $ViewData;
    private $JsonData;
    private $ModuleTitle;
    private $ModuleView;
    private $ModulePath;
    private $UserModel;

    public function __construct(
        Role $RoleModel,
        RoleHasPermissionsModel $RoleHasPermissionsModel,
        User $UserModel

    ) {
        $this->BaseModel = $RoleModel;
        $this->RoleHasPermissionsModel = $RoleHasPermissionsModel;
        $this->UserModel = $UserModel;

        $this->ViewData = [];
        $this->JsonData = [];

        $this->ModuleTitle = 'Manage Roles';
        $this->ModuleView  = 'admin.roles.';
        $this->ModulePath = 'admin.roles.';

      
    }
    // public static function middleware(): array
    // {
    //     return [
    //         new Middleware('permission:manage-roles', only: ['index', 'getRecords']),
    //         new Middleware('permission:prole-add', only: ['create']),
    //         new Middleware('permission:role-delete', only: ['destroy']),
    //     ];
    // }
    public function index(Request $request)
    {
        // Default site settings
        $this->ViewData['moduleAction'] = 'Manage Roles';
        $this->ViewData['modulePath'] = $this->ModulePath;
        return view($this->ModuleView . 'index', $this->ViewData);
    }


    
    public function edit($endID)
    {
       // dd('g');
        $id = base64_decode(base64_decode($endID));
        $rolesCollection = $this->BaseModel->find($id);
        if ($rolesCollection) {
            $this->JsonData['status'] = 'success';
            $this->JsonData['data'] = $rolesCollection;
        }
        return response()->json($this->JsonData);
    }
    public function updateRole(RolesRequest $request)
    {
        DB::beginTransaction();
        $encID = $request->hidden_id;
        $intID = base64_decode(base64_decode($encID));
        $this->JsonData['status'] = 'error';
        $this->JsonData['msg'] = 'Failed to update role';
        try {
            $objStroreRoleData = $this->BaseModel->find($intID);
            $objStroreRoleData = self::_storeOrUpdate($objStroreRoleData, $request);
            if ($objStroreRoleData) {
                try {
                    $this->JsonData['status'] = 'success';
                    $this->JsonData['url']  = route($this->ModulePath . 'index');
                    $this->JsonData['msg']  = 'Role updated successfully';
                    DB::commit();
                } catch (\Exception $e) {
                    $this->JsonData['msg'] = 'Failed to update role';
                    $this->JsonData['error_msg'] = $e->getMessage();
                    DB::rollback();
                }
            } else {
                DB::rollback();
                $this->JsonData['msg'] = 'Failed to update role';
            }
            // flush permission cache
            app()->make(\Spatie\Permission\PermissionRegistrar::class)->forgetCachedPermissions();
        } catch (\Exception $e) {
            $this->JsonData['msg'] = 'Failed to update role';
            $this->JsonData['error_msg'] = $e->getMessage();
        }
        return response()->json($this->JsonData);
    }
    public function store(RolesRequest $request)
    {
        DB::beginTransaction();
        $this->JsonData['status'] = 'error';
        $this->JsonData['msg'] =  'Failed to create role';

        $alreadyExist = $this->BaseModel
            ->where('name', $request->name)
            ->get();

        if (count($alreadyExist) == 0) {
            $data = [
                'name' => $request->name,
                'guard_name' => 'web'
            ];
            
            if ($this->BaseModel->create($data)) {
                DB::commit();
                $this->JsonData['status']   = 'success';
                $this->JsonData['msg']      =  'Role created successfully';
                $this->JsonData['url']      =  route($this->ModulePath . 'index');
            }

            // flush permission cache
            app()->make(\Spatie\Permission\PermissionRegistrar::class)->forgetCachedPermissions();
        } else {
            $this->JsonData['msg']          = 'Role already exists';
            $this->JsonData['error_msg']    =  'Role already exists';
            DB::rollback();
        }
        return response()->json($this->JsonData);
    }

    public function _storeOrUpdate($objStroreRoleData, $request)
    {
        $objStroreRoleData->name =  strtolower(trim($request->name));
        $objStroreRoleData->save();
        return $objStroreRoleData;
    }
    public function destroy($encID)
    {
        $this->JsonData['status'] = 'error';
        $this->JsonData['msg'] = 'Failed to delete role';
        $id = base64_decode(base64_decode($encID));
        try {
            $BaseModel = \App\Models\Role::find($id); // Correct way
            if (!$BaseModel) {
                $this->JsonData['msg'] = 'Role not found';
                return response()->json($this->JsonData);
            }
            $BaseModel->delete();

            $this->JsonData['status'] = 'success';
            $this->JsonData['msg'] = 'Role deleted successfully';
        } catch (QueryException $e) {
            if ($e->errorInfo[1] == 1451) { 
                $this->JsonData['msg'] = 'Role is in use, you can not delete this role.';
            } else {
                $this->JsonData['msg'] = 'Failed to delete role' . ' (' . $e->getMessage() . ')'; 
            }
        }
        return response()->json($this->JsonData);
    }
    
    public function getRecords(Request $request)
    {
        $start = $request->start ? $request->start : 0;
        $length = $request->length ? $request->length : 10;
        $search = $request->search ? $request->search['value'] : "";
        $column = $request->order ? $request->order[0]['column'] : "0";
        $dir = $request->order ? $request->order[0]['dir'] : "DESC";
        $filter = array(
            0 => 'roles.id',
            1 => 'roles.name',
        );
        $modelQuery = $this->BaseModel;
        $countQuery = clone ($modelQuery);
        $totalData = $countQuery->count();
        if (!empty($request->search)) {
            if (!empty($request->search['value'])) {
                $search = $request->search['value'];
                $modelQuery = $modelQuery->where(function ($query) use ($search) {
                    $query->orWhere('roles.name', 'LIKE', "%" . $search . "%");
                    $query->orwhere('roles.id', 'LIKE', '%' . $search . '%');
                });
            }
        }
        $filteredQuery = clone ($modelQuery);
        $totalFiltered = $filteredQuery->count();
        if (empty($column)) {
            $columns = explode(',', $filter[$column]);
            foreach ($columns as $key => $tmpcolumn) {
                $object = $modelQuery->orderBy($tmpcolumn, $dir);
            }
        } else {
            $object = $modelQuery->orderBy($filter[$column], $dir);
        }
        $object = $modelQuery
            ->skip($start)
            ->take($length)
            ->get();
          //  dd($object);
        $data = [];

        $defaultRolesArray = array('super-admin');
        if (!empty($object) && sizeof($object) > 0) {
            $count = $start + 1;
            foreach ($object as $key => $row) {
                $data[$key]['id']  = $count++;
                $data[$key]['name'] = isset($row->name) ? $row->name : '';
                $btnDelete = "";
                $btnEdit = "";
                //if (auth()->user()->can('manage-role-add')) {
                    if (!in_array($row->name, $defaultRolesArray)) {
                       $btnEdit = '<div class="dropdown d-inline-block">
                                <button class="btn btn-soft-secondary btn-sm dropdown" type="button"
                                    data-bs-toggle="dropdown"><i
                                        class="ri-more-fill align-middle"></i></button>
                                <ul class="dropdown-menu dropdown-menu-end">
                                    <li><a class="dropdown-item edit-role-btn" href="javascript:void(0);"
                                            data-id="'.base64_encode(base64_encode($row->id)).'"
                                            id="edit-mill-btn">
                                            <i class="ri-pencil-fill align-bottom me-2 text-muted"></i>
                                            Edit
                                        </a>
                                    </li>
                                    <li><a href="javascript:void(0)" onclick="return deleteCollection(this)"
                                            data-href="'.route('admin.roles.destroy', [base64_encode(base64_encode($row->id))]).'"
                                            class="dropdown-item remove-item-btn"><i
                                                class="ri-delete-bin-fill align-bottom me-2 text-muted"></i>Delete</a>
                                    </li>
                                </ul>
                        </div>';          
                    }      
                $data[$key]['actions'] = '<div class="text-center">' . $btnEdit . '</div>';
            }
        }
        // wrapping up
        $this->JsonData['draw']             = intval($request->draw);
        $this->JsonData['recordsTotal']     = intval($totalData);
        $this->JsonData['recordsFiltered']  = intval($totalFiltered);
        $this->JsonData['data']             = $data;
        return response()->json($this->JsonData);
   
    }
}
