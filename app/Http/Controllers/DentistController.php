<?php

namespace App\Http\Controllers;

use App\Models\Dentist;
use App\Models\DoctorType;
use App\Models\User;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use App\Services\DentistService;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use PHPUnit\Metadata\Uses;

class DentistController extends BaseController
{
    // public function __construct(protected DentistService $dentistService)
    // {
    // }

    // public function all()
    // {
    //     return $this->dentistService->all();
    // }

    // public function show($id)
    // {
    //     return $this->dentistService->find($id);
    // }

    // public function createForm()
    // {
    //     return view('dentists.create');
    // }

    // public function updateForm($id)
    // {
    //     $dentist = $this->dentistService->find($id);
    //     return view('dentists.edit', compact('dentist'));
    // }



    // public function update(Request $request, $id)
    // {
    //     $data = $request->validate([
    //         'name' => ['required', 'string', 'max:255'],
    //         'age' => ['required', 'numeric'],
    //         'type_id' => ['required', 'numeric'],
    //         'user_id' => ['required', 'numeric'],
    //         'qualification' => ['required', 'string', 'max:500'],
    //         'speciality' => ['required', 'string', 'max:255'],
    //         'dob' => ['required', 'date'],
    //         'address' => ['required', 'string', 'max:255'],
    //         'mobile' => ['required', 'string', 'max:255'],
    //         'emial' => ['required', 'string', 'max:255'],
    //     ]);

    //     $dentist = $this->dentistService->update($data, $id);

    //     return response()->json([
    //         'dentist' => $dentist,
    //     ]);
    // }

    // public function delete($id)
    // {
    //     $this->dentistService->delete($id);

    //     return response()->json([
    //         'status' => 'Successfully Deleted!',
    //     ]);
    // }

    public function __construct(protected DentistService $dentistService)
    {

        // $info['route']= $this->route;
        $this->title = 'Dentists';
        $this->resources = 'dentists.';
        parent::__construct();
        // $this->dentists = Dentist::all();
        $this->route = 'dentists.';

        $this->generateAllMiddlewareByPermission();
    }
    public function index(Request $request)
    {
        $isEdit = False;
        $isDelete = False;
        $isShow = False;
        $isAdd = False;

        if ($this->checkPermission('dentists.add')) {
            $isAdd = True;
        }
        if ($this->checkPermission('dentists.edit')) {
            $isEdit = True;
        }
        if ($this->checkPermission('dentists.delete')) {
            $isDelete = True;
        }
        if ($this->checkPermission('dentists')) {
            $isShow = True;
        }
        if ($request->ajax()) {

            // $data = $this->dentistService->all();
            $data = user::role('dentist')->latest();

            return DataTables::of($data)

                ->addIndexColumn()

                ->addColumn('action', function ($row) use ($isShow, $isEdit, $isDelete) {
                    // dd($row->id);
                    $dentist = Dentist::where('user_id', $row->id)->first();
                    // dd($dentist);
                    return view('templates.index_actions', [
                        'id' => $dentist->id,
                        'route' => $this->route,
                        'item' => $row,
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
        return view("dentists.index", $data);
    }


    public function create()
    {

        $data = $this->crudInfo();
        $data['user'] = new User;
        $data['doctor_type'] = DoctorType::all();
        return view($this->createResource(), $data);
    }

    //name,  address, emails and other values from the user to this class should be provided dynamically while submitting the form
    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'type_id' => 'required|exists:doctor_types,id',
            'gender' => 'nullable|string',
            'qualification' => ['required', 'string', 'max:500'],
            'speciality' => ['required', 'string', 'max:255'],
            'dob' => ['nullable', 'date'],
            'address' => ['required', 'string', 'max:255'],
            'mobile' => 'required|string|regex:/^[0-9]{10}$/',
            'email' => ['required', 'email', 'unique:' . User::class],
            'alternative_mobile' => 'nullable|string|regex:/^[0-9]{10}$/',
            'alternative_email' => 'nullable|string',

        ]);

        $dentist = $this->dentistService->create($data);

        return redirect()->route($this->indexRoute())->with('success', 'Successfully Added!');
    }

    /**
     * Store a newly created resource in storage.
     */
    // public function store(Request $request)
    // {
    //     $request->validate(
    //         [
    //             'name' => 'required|max:255',
    //             'contact' => 'required|min:10|max:10',
    //             'address' => 'required|max:255',
    //             'email' => 'required|email'

    //         ]
    //     );

    //     $data = $request->all();
    //     $dentist = new User($data);

    //     $dentist->save();

    //     $dentist->assignRole('dentist');
    //     return redirect()->route($this->indexRoute());
    // }

    /**
     * Display the specified resource.
     */
    public function show(User $dentist)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Dentist $dentist)
    {


        $data = $this->crudInfo();
        $data['item'] = $dentist;
        $data['user'] = $dentist->user;
        $data['item']['dob'] = Carbon::parse($dentist->dob)->format('Y-m-d');
        $data['doctor_type'] = DoctorType::all();
        return view($this->editResource(), $data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Dentist $dentist)
    {
        $data = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'type_id' => 'required|exists:doctor_types,id',
            'gender' => 'nullable|string',
            'qualification' => ['required', 'string', 'max:500'],
            'speciality' => ['required', 'string', 'max:255'],
            'dob' => ['nullable', 'date'],
            'address' => ['required', 'string', 'max:255'],
            'mobile' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email'],
            'alternative_mobile' => 'nullable|string',
            'alternative_email' => 'nullable|string',

        ]);
        $user_id = $dentist->user_id;
        $data = $request->all();
        $this->dentistService->update($data, $dentist->id, $user_id);

        return redirect()->route($this->indexRoute())->with('success', 'Successfully Updated!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Dentist $dentist)
    {
        $id = $dentist->user_id;
        $delete = $this->dentistService->delete($id);
        return redirect()->route($this->indexRoute())->with('success', 'Successfully Deleted!');
    }
}
