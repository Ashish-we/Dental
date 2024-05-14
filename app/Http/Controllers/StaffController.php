<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Spatie\Permission\Models\Role;
use Yajra\DataTables\DataTables;

class StaffController extends BaseController
{


    public function __construct()
    {

        parent::__construct();
        $this->title = 'Staffs';
        $this->resources = 'staffs.';
        // $this->staffs = User::all();
        $this->route = 'staffs.';
        $this->generateAllMiddlewareByPermission();
    }
    public function index(Request $request)
    {
        $isEdit = False;
        $isDelete = False;
        $isShow = False;
        $isAdd = False;

        if ($this->checkPermission('staffs.add')) {
            $isAdd = True;
        }
        if ($this->checkPermission('staffs.edit')) {
            $isEdit = True;
        }
        if ($this->checkPermission('staffs.delete')) {
            $isDelete = True;
        }
        if ($this->checkPermission('staffs')) {
            $isShow = True;
        }

        if ($request->ajax()) {

            $data = User::role('receptionist')->latest();

            return DataTables::of($data)

                ->addIndexColumn()

                ->addColumn('action', function ($row) use ($isShow, $isEdit, $isDelete) {

                    return view('templates.index_actions', [
                        'id' => $row->id,
                        'route' => $this->route,
                        'hideShow' => false,
                        'isShow' => $isShow,
                        'isEdit' => $isEdit,
                        'isDelete' => $isDelete,
                    ]);
                })
                ->rawColumns(['action'])


                ->make(true);
        }

        $data = $this->crudInfo();
        $data['isAdd'] = $isAdd;
        return view("staffs.index", $data);
    }


    public function create()
    {
        $data = $this->crudInfo();
        return view($this->createResource(), $data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $data = $request->validate(
            [
                'name' => ['required', 'string', 'max:255'],
                'dob' => ['nullable', 'date'],
                'address' => ['required', 'string', 'max:255'],
                'mobile' => ['required', 'string', 'max:255'],
                'email' => ['required', 'email', 'unique:' . User::class],
                'alternative_mobile' => 'nullable|string',
                'alternative_email' => 'nullable|string',
                'gender' => 'nullable|string',
            ]
        );

        // $data = $request->all();
        $staff = new User($data);

        $staff->save();
        $staff->assignRole('receptionist');
        return redirect()->route($this->indexRoute())->with('success', 'Successfully Added!');
    }

    /**
     * Display the specified resource.
     */
    public function show(User $staff)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $staff)
    {
        $data = $this->crudInfo();
        $data['item'] = $staff;


        return view($this->editResource(), $data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $staff)
    {


        $data = $request->validate(
            [
                'name' => ['required', 'string', 'max:255'],
                'dob' => ['nullable', 'date'],
                'address' => ['required', 'string', 'max:255'],
                'mobile' => ['required', 'string', 'max:255'],
                'email' => ['required', 'email'],
                'alternative_mobile' => 'nullable|string',
                'alternative_email' => 'nullable|string',
                'gender' => 'required|string',
            ]
        );

        // $data = $request->all();
        $staff->update($data);
        return redirect()->route($this->indexRoute())->with('success', 'Successfully Updated!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $staff)
    {
        $staff->delete();
        return redirect()->route($this->indexRoute())->with('success', 'Successfully Deleted!');
    }
}
