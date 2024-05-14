<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
use App\Models\Dentist;
use App\Models\Patient;
use App\Models\Procedure;
use App\Models\Service;
use App\Models\User;
use App\Notifications\NewAppointmentNotification;
use App\Notifications\UpdateAppointmentNotification;
use App\Services\AppointmentService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\DataTables;

class AppointmentController extends BaseController
{

    // public function __construct(protected AppointmentService $appointmentService)
    // {
    // }

    // public function all()
    // {
    //     return $this->appointmentService->all();
    // }

    // public function show($id)
    // {
    //     return $this->appointmentService->find($id);
    // }

    // public function createForm()
    // {
    //     return view('appointments.create');
    // }

    // public function updateForm($id)
    // {
    //     $appointment = $this->appointmentService->find($id);
    //     return view('appointments.edit', compact('appointment'));
    // }

    // //name,  address, emails and other values from the user to this class should be provided dynamically while submitting the form
    // public function create(Request $request)
    // {
    //     $data = $request->validate([
    //         'title' => 'required|string',
    //         'chief_complaint' => 'required|string',
    //         'date' => 'required|date',
    //         'service_id' => 'required|exists:services,id',
    //         'condition' => 'nullable|string',
    //         'status' => 'required|string',
    //         'patient_id' => 'required|exists:users,id',
    //         'dentist_id' => 'required|exists:users,id',
    //         'notes' => 'nullable|string',
    //     ]);

    //     $appointment = $this->appointmentService->create($data);

    //     $doctor = Dentist::findOrFail($appointment->dentist_id);
    //     $doctor->notify(new NewAppointmentNotification($appointment));

    //     //also we can identify the the user id from the dentist and send the notification to the user

    //     return response()->json([
    //         'appointment' => $appointment,
    //     ]);
    // }

    // public function update(Request $request, $id)
    // {
    //     $data = $request->validate([
    //         'title' => 'required|string',
    //         'chief_complaint' => 'required|string',
    //         'date' => 'required|date',
    //         'service_id' => 'required|exists:services,id',
    //         'condition' => 'nullable|string',
    //         'status' => 'required|string',
    //         'patient_id' => 'required|exists:users,id',
    //         'dentist_id' => 'required|exists:users,id',
    //         'notes' => 'nullable|string',
    //     ]);

    //     $appointment = $this->appointmentService->update($data, $id);
    //     $patient = Patient::findOrFail($appointment->patient_id);
    //     $patient->notify(new UpdateAppointmentNotification($appointment));



    //     return response()->json([
    //         'appointment' => $appointment,
    //     ]);
    // }

    // public function delete($id)
    // {
    //     $this->appointmentService->delete($id);

    //     return response()->json([
    //         'status' => 'Successfully Deleted!',
    //     ]);
    // }


    /**
     * Display a listing of the resource.
     */

    public function __construct(protected AppointmentService $appointmentService)
    {

        parent::__construct();
        $this->resources = 'appointments.';
        $this->title = 'Appointments';
        // $this->appointments = Appointment::all();
        $this->route = 'appointments.';
        $this->generateAllMiddlewareByPermission();
    }

    public function index(Request $request)
    {
        $isEdit = False;
        $isDelete = False;
        $isShow = False;
        $isAdd = False;

        if ($this->checkPermission('appointments.add')) {
            $isAdd = True;
        }
        if ($this->checkPermission('appointments.edit')) {
            $isEdit = True;
        }
        if ($this->checkPermission('appointments.delete')) {
            $isDelete = True;
        }
        if ($this->checkPermission('appointments')) {
            $isShow = True;
        }
        // dd($isDelete);
        if (Auth::user()->hasRole('dentist')) {
            if ($request->ajax()) {

                // dd($request->patient_id);


                // $data = Appointment::with(['patient', 'service', 'dentists'])->get();
                $data = Auth::user()->dentist_appointment()->latest()->get();
                // dd($data);

                return DataTables::of($data)


                    ->addIndexColumn()

                    // ->editColumn('title', function ($row) {

                    //     return $row->chief_complaint ? $row->chief_complaint : '--';
                    // })

                    ->addColumn('patient_id', function ($row) {
                        // dd($row->patient->name);
                        return $row->patient_id ? $row?->patient?->name : "--";
                    })

                    ->editColumn('date', function ($row) {
                        return $row->date ? $row->date : '--';
                    })

                    ->addColumn('dentist_id', function ($row) {
                        $abc = $row->dentists->first();
                        if ($abc) {
                            return $abc->id ? $abc?->name : "--";
                        }
                        return '--';
                    })

                    ->addColumn('service_id', function ($row) {
                        // dd($row->service_id);
                        return $row->service_id ? $row?->service?->title : "--";
                    })

                    // ->editColumn('visit', function ($row) {

                    //     return $row->visit ? $row->visit : '--';
                    // })

                    ->editColumn('status', function ($row) {

                        return $row->status ? $row->status : '--';
                    })

                    // ->editColumn('notes', function ($row) {

                    //     return $row->notes ? $row->notes : '--';
                    // })

                    ->addColumn('action', function ($row) use ($isShow, $isEdit, $isDelete) {

                        return view('appointments.index_actions', [
                            'id' => $row->id,
                            'item' => $row,
                            'route' => $this->route,
                            'hideDelete' => true,
                            'followUp' => true,
                            'isShow' => $isShow,
                            'isEdit' => $isEdit,
                            'isDelete' => $isDelete,
                        ]);
                    })


                    ->rawColumns(['action'])

                    ->make(true);
            }
        } else {
            if ($request->ajax()) {

                // dd($request->patient_id);

                if ($patient_id = $request->patient_id) {
                    $data = Appointment::with(['patient', 'service', 'dentists'])->where('patient_id', $patient_id)->latest();
                } else {
                    $data = Appointment::with(['patient', 'service', 'dentists'])->latest();
                }
                // dd($data);

                return DataTables::of($data)


                    ->addIndexColumn()

                    // ->editColumn('title', function ($row) {

                    //     return $row->chief_complaint ? $row->chief_complaint : '--';
                    // })

                    ->addColumn('patient_id', function ($row) {
                        // dd($row->patient->name);
                        return $row->patient_id ? $row?->patient?->name : "--";
                    })

                    ->editColumn('date', function ($row) {
                        return $row->date ? $row->date : '--';
                    })

                    ->addColumn('dentist_id', function ($row) {
                        $abc = $row->dentists->first();
                        if ($abc) {
                            return $abc->id ? $abc?->name : "--";
                        }
                        return '--';
                    })

                    ->addColumn('service_id', function ($row) {
                        // dd($row->service_id);
                        return $row->service_id ? $row?->service?->title : "--";
                    })

                    // ->editColumn('visit', function ($row) {

                    //     return $row->visit ? $row->visit : '--';
                    // })

                    ->editColumn('status', function ($row) {

                        return $row->status ? $row->status : '--';
                    })

                    // ->editColumn('notes', function ($row) {

                    //     return $row->notes ? $row->notes : '--';
                    // })

                    ->addColumn('action', function ($row) use ($isShow, $isEdit, $isDelete) {

                        return view('appointments.index_actions', [
                            'id' => $row->id,
                            'item' => $row,
                            'route' => $this->route,
                            'hideDelete' => true,
                            'followUp' => true,
                            'isShow' => $isShow,
                            'isEdit' => $isEdit,
                            'isDelete' => $isDelete,
                        ]);
                    })


                    ->rawColumns(['action'])

                    ->make(true);
            }
        }
        $data = $this->crudInfo();
        $data['isAdd'] = $isAdd;
        return view("appointments.index", $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    //    public function create(Request $request)
    public function create($patient_id = null)
    {

        $data = $this->crudInfo();
        $data['patients'] = Patient::all();
        $data['dentists'] = user::role('dentist')->get();
        $data['services'] = Service::all();
        $data['dentist_id'] = new Dentist;
        //        if($request->patient_id)
        if ($patient_id) {
            //            $data['patient_name'] = User::role('patient')->whereId($request->patient_id)->first();
            $data['patient'] = User::role('patient')->whereId($patient_id)->first();
        }


        return view($this->createResource(), $data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate(
            [
                'chief_complaint' => 'required|string',
                'patient_id' => 'required|exists:patients,id',
                'date' => 'required|date|after_or_equal:today',
                'service_id' => 'required|exists:services,id',
                'condition' => 'nullable',
                'status' => 'required',
                'notes' => 'nullable'
            ]
        );
        $request->validate([
            'dentist_id' => 'required|exists:users,id',
        ]);

        $appointment = $this->appointmentService->create($data);
        $appointment->dentists()->attach($request->dentist_id);
        $user = User::findOrFail($request->dentist_id);
        $user->notify(new NewAppointmentNotification($appointment));
        if (Auth::user()->hasRole('admin')) {
            return redirect()->route('appointments.index', $appointment->patient_id)->with('success', 'Successfully Added!');
        }
        return redirect()->route('patients.show', $appointment->patient_id);
    }

    /**
     * Display the specified resource.
     */
    public function show(Appointment $appointment)
    {
        //commented part done by other previous one
        // dd($appointment->dentists()->select('name')->first()->name  == Auth::user()->name);
        // if (Auth::user()->hasRole('dentist')) {
        //     if ($appointment->dentists()->select('name')->first()->name  == Auth::user()->name) {
        //         $data = $this->crudInfo();
        //         $data['patients'] = Patient::all();
        //         $data['appointments'] = Appointment::all();
        //         return view($this->showResource(), $data);
        //     } else {
        //         return redirect()->back();
        //     }
        // }

        //done by Ashish
        if (Auth::user()->hasRole('dentist')) {
            if ($appointment->dentists()->select('name')->first()->name  == Auth::user()->name) {
                $data = $this->crudInfo();
                $data['item'] = $appointment;
                $data['service'] = $appointment->service;
                $data['patient'] = $appointment->patient;
                $data['dentist'] = $appointment->dentists()->first();
                return view($this->showResource(), $data);
            } else {
                return redirect()->back();
            }
        } else {
            $data = $this->crudInfo();
            $data['item'] = $appointment;
            $data['service'] = $appointment->service;
            $data['patient'] = $appointment->patient;
            $data['dentist'] = $appointment->dentists()->first();
            return view($this->showResource(), $data);
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Appointment $appointment)
    {
        if (Auth::user()->hasRole('dentist')) {
            if ($appointment->dentists()->select('name')->first()->name  == Auth::user()->name) {
                $data = $this->crudInfo();
                // $data['patients'] = User::role('patient')->get();
                // $data['dentists'] = User::role('dentist')->get();
                $data['services'] = Service::all();
                $data['patients'] = Patient::all();
                $data['dentists'] = user::role('dentist')->get();
                $data['item'] = $appointment;
                $data['dentist_id'] = $appointment->dentists->first();

                if ($appointment->followUp != null) {
                    $data['isFollowUp'] = true;
                } else {
                    $data['isFollowUp'] = False;
                }
                // if ($appointment->procedures()->first() != null) {
                //     $data['isProcedure'] = true;
                //     // $app_procedure = $appointment->procedures()->orderBy('id', 'desc')->get();
                // } else {
                //     $data['isProcedure'] = False;
                // }
                // dd($data['dentist_id']->id);


                return view($this->editResource(), $data);
            } else {
                return redirect()->back();
            }
        }
        $data = $this->crudInfo();
        // $data['patients'] = User::role('patient')->get();
        // $data['dentists'] = User::role('dentist')->get();
        $data['services'] = Service::all();
        $data['patients'] = Patient::all();
        $data['dentists'] = user::role('dentist')->get();
        $data['item'] = $appointment;
        $data['dentist_id'] = $appointment->dentists->first();

        if ($appointment->followUp != null) {
            $data['isFollowUp'] = true;
        } else {
            $data['isFollowUp'] = False;
        }
        // if ($appointment->procedures()->first() != null) {
        //     $data['isProcedure'] = true;
        //     // $app_procedure = $appointment->procedures()->orderBy('id', 'desc')->get();
        // } else {
        //     $data['isProcedure'] = False;
        // }
        // dd($data['dentist_id']->id);


        return view($this->editResource(), $data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Appointment $appointment)
    {

        //    $data = $request->except(['_method', '_token']);
        //    $appointment->update($data);


        $data = $request->validate(
            [
                'chief_complaint' => 'nullable|string',
                'patient_id' => 'required|exists:patients,id',
                'date' => 'required|date',
                'service_id' => 'required|exists:services,id',
                'condition' => 'nullable',
                'status' => 'required',
                'notes' => 'nullable'
            ]
        );
        $request->validate([
            'dentist_id' => 'required|exists:users,id',
        ]);
        $dentist = $appointment->dentists()->first();
        $appointment->dentists()->detach($dentist->id);
        $appointment = $this->appointmentService->update($data, $appointment->id);

        $appointment->dentists()->attach($request->dentist_id);
        $patient = Patient::findOrFail($request->patient_id);
        if ($patient->email) {
            $patient->notify(new UpdateAppointmentNotification($appointment));
        }

        return redirect()->route('patients.show', $appointment->patient_id)->with('success', 'Successfully Updated!');

        // $appointment->update($data);

        // return redirect()->route('patients.show', $appointment->patient_id);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Appointment $appointment)
    {
        $appointment->delete();
        return redirect()->route($this->indexRoute())->with('success', 'Successfully Deleted!');
    }
}
