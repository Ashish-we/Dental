<?php

namespace App\Http\Controllers;

use App\Http\Controllers\BaseController;
use App\Models\Patient;
use App\Models\User;
use App\Models\Teeth;
use App\Models\MedicalRecord;
use App\Models\Procedure;
use App\Models\Service;
use App\Models\Appointment;
use App\Models\Dentist;
use App\Services\PatientService;
use Database\Seeders\PatientSeeder;
use PhpParser\Node\Stmt\Foreach_;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\DataTables;

class PatientController extends BaseController
{

    public function __construct(protected PatientService $patientService)
    {
        $this->title = 'Patients';
        $this->resources = 'patients.';
        parent::__construct();
        $this->route = 'patients.';
        $this->generateAllMiddlewareByPermission('patients');
    }



    // //name,  address, emails and other values from the user to this class should be provided dynamically while submitting the form
    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'age' => 'required|integer|min:1|max:100',
            'gender' => 'required|in:Male,Female,Other',
            'occupation' => 'nullable|string|max:255',
            'email' => 'nullable|email|unique:users,email',
            'phone' => 'required|string|regex:/^[0-9]{10}$/',
            'alternate_phone' => 'nullable|string|regex:/^[0-9]{10}$/',
            'title' => 'nullable|string|max:255',
            'address' => 'required|string|max:255',
        ]);

        $patient = $this->patientService->create($data);


        return redirect()->route($this->indexRoute())->with('success', 'Successfully Added!');
    }

    // public function update(Request $request, $id)
    // {
    //     $data = $request->validate([
    //         'name' => 'required|string',
    //         'age' => 'required|integer|min:0',
    //         'gender' => 'required|in:Male,Female,Other',
    //         'occupation' => 'required|string',
    //         'email' => 'required|email|unique:users,email',
    //         'phone' => 'required|string|regex:/^[0-9]{10}$/',
    //         'alternate_phone' => 'nullable|string|regex:/^[0-9]{10}$/',
    //         'title' => 'required|string',
    //         'user_id' => 'required|exists:users,id',
    //         'registration_no' => 'required|string|unique:users,registration_no',
    //     ]);

    //     $patient = $this->patientService->update($data, $id);

    //     return response()->json([
    //         'patient' => $patient,
    //     ]);
    // }

    // public function delete($id)
    // {
    //     $this->patientService->delete($id);

    //     return response()->json([
    //         'status' => 'Successfully Deleted!',
    //     ]);
    // }





    public function index(Request $request)
    {
        $isEdit = False;
        $isDelete = False;
        $isShow = False;
        $isAdd = False;



        if ($this->checkPermission('patients.add')) {
            $isAdd = True;
        }
        if ($this->checkPermission('patients.edit')) {
            $isEdit = True;
        }
        if ($this->checkPermission('patients.delete')) {
            $isDelete = True;
        }
        if ($this->checkPermission('patients')) {
            $isShow = True;
        }

        if (Auth::user()->hasRole('dentist')) {
            $data = Auth::user()->dentist_appointment()->get();
            $patient = [];
            foreach ($data as $item) {
                $patient[] =  $item->patient;
            }
            $data = $patient;
        } else {
            $data = $this->patientService->all();
        }

        if ($request->ajax()) {

            // $data = User::role('patient')->get();

            return DataTables::of($data)

                ->addIndexColumn()

                ->addColumn('action', function ($row) use ($isShow, $isEdit, $isDelete) {

                    return view('templates.index_actions', [
                        'id' => $row->id,
                        'route' => $this->route,
                        'item' => $row,
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
        return view($this->indexResource(), $data);
    }


    public function create()
    {

        $data = $this->crudInfo();
        return view($this->createResource(), $data);
    }

    /**
     * Store a newly created resource in storage.
     */
    // public function store(Request $request)
    // {

    //     $request->validate(
    //         [
    //             'name' => 'required|alpha',
    //             'contact' => 'required|numeric|min:10|max:10',
    //             'address' => 'required',
    //             'email' => 'required|email'

    //         ]
    //     );


    //     $data = $request->all();
    //     $patient = new User($data);

    //     $patient->save();
    //     $patient->assignRole('patient');

    //     return redirect()->route($this->indexRoute());
    // }

    /**
     * Display the specified resource.
     */
    public function show(Patient $patient)
    {
        $data = $this->crudInfo();
        if (Auth::user()->hasRole('dentist')) {
            $data['appointments'] = Auth::user()->dentist_appointment()->orderBy('id', 'desc')->get();
        } else {
            $data['appointments'] = Appointment::with(['patient', 'service', 'dentists'])->where('patient_id', $patient->id)->orderBY('id', 'desc')->get();
        }
        // $data['item'] = Patient::with([
        //     'teeths',
        //     'medicalRecord',
        //     // 'procedures' => ['appointment', 'patient'],

        //     // 'patient_appointments' => ['dentist'],

        // ])->findOrFail($patient->id);
        // $patient = $this->patientService->find($patient->id);
        // dd($patient);
        $data['item'] = Patient::findOrFail($patient->id);
        // $data['medicalRecord'] = $patient->medicalRecord;
        $data['patient_procedures'] = $patient->procedures;
        $data['patient_appointments'] =  $patient->appointments;
        $data['patients'] = $this->patientService->find($patient);
        $data['hideEdit'] = true;
        $data['dentists'] = user::role('dentist')->get();
        $data['dentist_id'] = new Dentist;
        $data['services'] = Service::all();
        // $data['patients'] = User::role('patient')->get();
        $is_procedure = True;
        if (Auth::user()->hasRole('dentist')) {
            $is_procedure = False;
        }
        if (Auth::user()->hasRole('admin')) {
            $is_procedure = False;
        }
        $data['is_procedure'] = $is_procedure;
        return view($this->showResource(), $data);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Patient $patient)
    {

        $data = $this->crudInfo();
        $data['item'] = $patient;
        return view($this->editResource(), $data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Patient $patient)
    {

        $data = $request->validate([
            'name' => 'required|string',
            'age' => 'required|integer|min:0',
            'gender' => 'required|in:Male,Female,Other',
            'occupation' => 'nullable|string',
            'email' => 'nullable|email|unique:users,email',
            'phone' => 'required|string|regex:/^[0-9]{10}$/',
            'alternate_phone' => 'nullable|string|regex:/^[0-9]{10}$/',
            'title' => 'nullable|string',
            'registration_no' => 'nullable|string|unique:users,registration_no',
            'address' => 'nullable|string',
        ]);

        $patient = $this->patientService->update($data, $patient->id);


        return redirect()->route($this->indexRoute())->with('success', 'Successfully Updated!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Patient $patient)
    {
        $this->patientService->delete($patient->id);
        return redirect()->route($this->indexRoute())->with('success', 'Successfully Deleted!');
    }

    // public function create_appointment()
    // {
    //     // $data=$this->crudinfo();
    //     // return view($this->createResource(), $data);

    //     dd("hello");
    //     return view("patients.appointment");
    // }
}
