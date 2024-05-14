<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
use App\Models\Dentist;
use App\Models\FollowUp;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\DataTables;

class FollowUpController extends BaseController
{
    public function __construct()
    {

        parent::__construct();
        $this->resources = 'followUps.';
        $this->title = 'followUps';
        $this->followUps = FollowUp::all();
        $this->route = 'followUps.';
        $this->generateAllMiddlewareByPermission();
    }

    public function show()
    {
    }
    public function create($id)
    {
        // dd($id);
        $data = $this->crudInfo();
        $data['dentists'] = User::role('dentist')->get();
        $data['appointment'] = Appointment::findOrFail($id);
        $data['dentist_id'] = $data['appointment']->dentists->first();
        return view('followUps.create', $data);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'date' => 'required|date',
            'dentist_id' => 'required|exists:users,id',
            'appointment_id' => 'required|numeric',
        ]);

        $followUp = FollowUp::create($data);

        return redirect()->route('appointments.edit', $data['appointment_id']);
    }

    public function edit($id)
    {
        $data = $this->crudInfo();
        $appointment = Appointment::find($id);
        $followUp = $appointment->followUp;
        $data['dentists'] = User::role('dentist')->get();
        $data['appointment'] = $appointment;
        $data['dentist_id'] = $data['appointment']->dentists->first();
        $data['item'] = $followUp;

        return view('followUps.edit', $data);
    }

    public function update(Request $request, $id)
    {

        $data = $request->validate([
            'date' => 'required|date',
            'dentist_id' => 'required|exists:users,id',
            'appointment_id' => 'required|numeric',
        ]);
        $followUp = FollowUp::findOrFail($id);
        $followUp->update($data);

        return redirect()->route('appointments.edit', $data['appointment_id']);
    }

    public function index(Request $request)
    {
        $isEdit = False;
        $isDelete = False;
        $isShow = False;
        $isAdd = False;

        if ($this->checkPermission('followups.add')) {
            $isAdd = True;
        }
        if ($this->checkPermission('followups.edit')) {
            $isEdit = True;
        }
        if ($this->checkPermission('followups.delete')) {
            $isDelete = True;
        }
        // if ($this->checkPermission('followups')) {
        //     $isShow = True;
        // }


        if (Auth::user()->hasRole('dentist')) {
            if ($request->ajax()) {

                // dd("hello");
                $data = FollowUp::where('dentist_id', Auth::user()->id)->orderBy('date', 'desc');
                // dd($data);
                return DataTables::of($data)


                    ->addIndexColumn()

                    ->editColumn('date', function ($row) {
                        return $row->date ? $row->date : '--';
                    })

                    ->addColumn('dentist_id', function ($row) {
                        $abc = User::findOrFail($row->dentist_id);
                        if ($abc) {
                            return $abc->id ? $abc?->name : "--";
                        }
                        return '--';
                    })

                    ->addColumn('appointment_id', function ($row) {
                        $appointment = Appointment::findOrFail($row->appointment_id);
                        return $row->appointment_id ? $appointment?->chief_complaint : "--";
                    })


                    ->addColumn('action', function ($row) use ($isShow, $isEdit, $isDelete) {
                        $appointment = Appointment::findOrFail($row->appointment_id);
                        return view('templates.index_actions', [
                            'id' => $appointment->id,
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

                // dd("hello");
                $data = FollowUp::orderBy('date', 'desc');
                // dd($data);
                return DataTables::of($data)


                    ->addIndexColumn()

                    ->editColumn('date', function ($row) {
                        return $row->date ? $row->date : '--';
                    })

                    ->addColumn('dentist_id', function ($row) {
                        $abc = User::findOrFail($row->dentist_id);
                        if ($abc) {
                            return $abc->id ? $abc?->name : "--";
                        }
                        return '--';
                    })

                    ->addColumn('appointment_id', function ($row) {
                        $appointment = Appointment::findOrFail($row->appointment_id);
                        return $row->appointment_id ? $appointment?->chief_complaint : "--";
                    })


                    ->addColumn('action', function ($row) use ($isShow, $isEdit, $isDelete) {
                        $appointment = Appointment::findOrFail($row->appointment_id);
                        return view('templates.index_actions', [
                            'id' => $appointment->id,
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
        $data['isAdd'] = false;
        return view('followUps.index', $data);
    }

    public function destroy($id)
    {
        $appointment = Appointment::find($id);
        $followUp = $appointment->followUp;
        $followUp->delete();
        return redirect()->route('followUps.index')->with('success', 'Successfully Deleted!');
    }
}
