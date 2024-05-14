<?php

namespace App\Http\Controllers;

use App\Models\BaseModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BaseController extends Controller
{
    protected $title = "";
    protected $subTitle = "";
    protected $route = "";
    protected $icon = "flaticon2-user";
    protected $resources = "admin::users.";
    protected $success = ['status' => true];
    protected $error = ['status' => false];



    public function __construct()
    {
        if ($this->title) {
            $this->route = strtolower($this->title) . ".";
        }
    }
    public function checkPermission($permission)
    {
        if (Auth::user()->getAllPermissions()->where('name', $permission)->first() != null) {
            return True;
        } else {
            return False;
        }
    }


    function createResource()
    {
        return $this->resources . 'create';
    }

    function indexResource()
    {
        return $this->resources . 'index';
    }

    function editResource()
    {
        return $this->resources . 'edit';
    }

    function showResource()
    {
        return $this->resources . 'show';
    }

    function indexRoute()
    {
        return $this->route . 'index';
    }

    function gotoCrudIndex()
    {
        return redirect()->route($this->route . 'index');
    }

    function crudInfo()
    {
        $data['title'] = $this->title;
        $data['subTitle'] = $this->subTitle;
        $data['route'] = $this->route;
        $data['icon'] = $this->icon;
        $data['item'] = new BaseModel();
        return $data;
    }
    function returnSuccess($params = null)
    {
        $data = $this->success;
        if ($data) $data['data'] = $params;
        return response()->json($data);
    }

    function returnError($params = null)
    {
        $data = $this->error;
        if ($data) $data['data'] = $params;
        return response()->json($data);
    }

    function authenticatedUserId()
    {
        return auth()?->user()?->id;
    }

    function generateAllMiddlewareByPermission($permissionName = null)
    {
        //Take permission name automatically from title
        if (!$permissionName)
            $permissionName = strtolower($this->title);
        // dd($permissionName);
        // dd('permission:' . $permissionName . '.add');
        $this->middleware('permission:' . $permissionName)->only('index', 'show');
        $this->middleware('permission:' . $permissionName . '.add')->only('create', 'store');
        $this->middleware('permission:' . $permissionName . '.edit')->only('edit', 'update');
        $this->middleware('permission:' . $permissionName . '.delete')->only('destroy');
        // $this->middleware('permission:' . $permissionName . '.all')->only('index', 'show', 'create', 'store', 'edit', 'update', 'destroy');
    }
}
