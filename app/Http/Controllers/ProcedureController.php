<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
use App\Models\Patient;
use App\Models\Procedure;
use App\Models\Service;
use App\Models\TeethType;
use App\Models\Teeth;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\DataTables;

class ProcedureController extends BaseController
{
    /**
     * Display a listing of the resource.
     */



    public function __construct()
    {
        parent::__construct();
        $this->title = 'Procedures';
        // $this->procedures = Procedure::all();
        $this->resources = 'procedures.';
        $this->route = 'procedures.';
        $this->generateAllMiddlewareByPermission();
    }
    public function index(Request $request)
    {
        $isEdit = False;
        $isDelete = False;
        $isShow = False;
        $isAdd = False;

        // if ($this->checkPermission('procedures.add')) {
        //     $isAdd = True;
        // }
        if ($this->checkPermission('procedures.edit')) {
            $isEdit = True;
        }
        if ($this->checkPermission('procedures.delete')) {
            $isDelete = True;
        }
        if ($this->checkPermission('procedures')) {
            $isShow = True;
        }
        if ($request->ajax()) {

            if ($patient_id = $request->patient_id) {
                $data = Procedure::where('patient_id', $patient_id)->latest();
            } else {
                $data = Procedure::latest();
            }
            return DataTables::of($data)

                ->addIndexColumn()

                ->editColumn('name', function ($row) {
                    return $row->name ?? "--";
                })

                ->editColumn('condition', function ($row) {
                    return $row->condition ?? "--";
                })

                ->editColumn('cost', function ($row) {
                    return $row->cost ?? "--";
                })

                ->addColumn('patient_id', function ($row) {
                    // dd($row->patient_id);
                    $patient = Patient::findOrFail($row->patient_id);
                    return $row->patient_id ? $patient?->name : "--";
                })

                ->addColumn('appointment_id', function ($row) {

                    return $row->appointment_id ? $row?->appointment?->title : "--";
                })

                ->addColumn('teeth_id', function ($row) {
                    $tooths = $row->teeth;
                    $teeths = [];
                    foreach ($tooths as $tooth) {
                        $teeths[] = $tooth['tooth_number'];
                    }
                    // dd($teeths);
                    return $row ? $teeths : "--";
                })
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
        return view("procedures.index", $data);
    }





    /**
     * Show the form for creating a new resource.
     */
    public function create($id)
    {
        $data = $this->crudInfo();
        $data['patients'] = Patient::all();
        $data['teeths'] = Teeth::all();
        $data['appointments'] = Appointment::all();
        $data['appointment'] = Appointment::findOrFail($id);
        $data['services'] = Service::all();
        $data['service_cost'] = Service::findOrFail($data['appointment']->service_id)->price;

        return view($this->createResource(), $data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate(
            [
                'cost' => 'required|numeric',
                'patient_id' => 'required|numeric',
                'appointment_id' => 'required|numeric',
                'service_id' => 'required|numeric',
                'condition' => 'required|string',
                'documents' => 'required|max:2048',
            ]
        );
        // dd($data);
        $doc = $request->documents;
        $doc_name = $doc->getClientOriginalName();
        $doc->storeAs('public/docs', $doc_name);
        $doc->move(public_path('storage/docs'), $doc_name);
        $procedure = new Procedure;
        $procedure->cost = $request->cost;
        $procedure->patient_id = $request->patient_id;
        $procedure->appointment_id = $request->appointment_id;
        $procedure->service_id = $request->service_id;
        $procedure->condition = $request->condition;
        $procedure->documents = $doc_name;
        $procedure->save();
        // $procedure = Procedure::create($data);
        if ($request->tooth_list) {
            foreach ($request->tooth_list as $tooth) {
                $tooth = json_decode($tooth, true);
                // dd($tooth);
                Teeth::create([
                    'patient_id' => $request->patient_id,
                    'type_id' => 1,
                    'tooth_number' => $tooth['tooth_number'],
                    'condition' => $tooth['condition'],
                    'notes' => $tooth['notes'],
                    'procedure_id' => $procedure->id,
                ]);
            }
        }
        return redirect()->route($this->indexRoute())->with('success', 'Successfully Added!');
        // $toothNo = $request->input('tooth_number');

        // $array = [
        //     ['8', '9', '24', '25'], //Central Incisors
        //     ['7', '10', '23', '26'], //Lateral Incisors
        //     ['6', '11', '22', '27'], //Canines
        //     ['5', '12', '4', '13', '21', '28', '20', '29'], //Premolars
        //     ['3', '14', '15', '19', '30', '18', '31'], //Molars
        //     ['1', '16', '17', '32'] //Wisdom teeth
        // ];
        // if (in_array($toothNo, $array)) {
        //     $type_id = 1;
        // } elseif (in_array($toothNo, $array)) {

        //     $type_id = 2;
        // } elseif (in_array($toothNo, $array)) {

        //     $type_id = 3;
        // }
        // $tooth = Teeth::firstOrCreate(
        //     [
        //         'patient_id' => $request->input('patient_id'),

        //         'tooth_number' => $toothNo
        //     ],
        //     [
        //         'type_id' => $type_id,
        //     ]
        // );
        // //check if the tooth number of the patient already exists in tooth table.
        // //if exixts take that teeth id if not then create new tooth and take that id.
        // //Create new procedure with fields appointment_id, teeth_id, patient_id, dentist_id, procedure and cost.

        // //  dd($request->all());
        // $data = $request->all();
        // $data['teeth_id'] = $tooth->id;
        // $procedure = new Procedure($data);

        // $procedure->save();

    }

    /**
     * Display the specified resource.
     */
    public function show(Procedure $procedure)
    {
        $data = $this->crudInfo();
        $data['item']  = $procedure;

        return view($this->showResource(), $data);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Procedure $procedure)
    {

        $data = $this->crudInfo();
        $data['patients'] = Patient::all();
        $data['teeths'] = Teeth::all();
        $data['appointments'] = Appointment::all();
        $data['services'] = Service::all();
        $data['item'] = $procedure;
        $toothList = $procedure->teeth;
        $data['toothList'] = json_encode($toothList);
        $data['appointment'] = $procedure->appointment;
        $data['service_cost'] = Service::findOrFail($procedure->service_id)->price;
        return view($this->editResource(), $data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        // dd($request);
        $data = $request->validate(
            [
                'cost' => 'required|numeric',
                'patient_id' => 'required|numeric',
                'appointment_id' => 'required|numeric',
                'service_id' => 'required|numeric',
                'condition' => 'required|string',
                'documents' => 'required|file|max:2048',
                // 'cost' => 'required',
            ]
        );
        // dd($data);
        $procedure = Procedure::findOrFail($id);
        $doc_names = $procedure->documents;
        // dd($procedure);
        $doc_path = public_path() . '/storage/docs/';
        $doc_pat = storage_path() . '/app/public/docs/';
        // dd($doc_pat);
        $file = $doc_path . $doc_names;
        $file1 = $doc_pat . $doc_names;
        if (file_exists($file)) {
            unlink($file);
        }
        if (file_exists($file1)) {
            unlink($file1);
        }
        $procedure->delete();
        $doc = $request->documents;
        $doc_name = $doc->getClientOriginalName();
        $doc->storeAs('public/docs', $doc_name);
        $doc->move(public_path('storage/docs'), $doc_name);
        $procedure = new Procedure;
        $procedure->cost = $request->cost;
        $procedure->patient_id = $request->patient_id;
        $procedure->appointment_id = $request->appointment_id;
        $procedure->service_id = $request->service_id;
        $procedure->condition = $request->condition;
        $procedure->documents = $doc_name;
        $procedure->save();
        // $procedure->update($data);


        $tooths = $procedure->teeth;
        foreach ($tooths as $tooth) {
            $tooth->delete();
        }
        // dd($request->tooth_list);
        if ($request->tooth_list) {
            foreach ($request->tooth_list as $tooth) {
                $tooth = json_decode($tooth, true);
                // dd($tooth);
                Teeth::create([
                    'patient_id' => $request->patient_id,
                    'type_id' => 1,
                    'tooth_number' => $tooth['tooth_number'],
                    'condition' => $tooth['condition'],
                    'notes' => $tooth['notes'],
                    'procedure_id' => $procedure->id,
                ]);
            }
        }




        return redirect()->route($this->indexRoute())->with('success', 'Successfully Updated!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Procedure $procedure)
    {
        $teeths = $procedure->teeth;
        foreach ($teeths as $theet) {
            $theet->delete();
        }
        $doc_names = $procedure->documents;
        $doc_path = public_path() . '/storage/docs/';
        $doc_pat = storage_path() . '/app/public/docs/';
        // dd($doc_pat);
        $file = $doc_path . $doc_names;
        $file1 = $doc_pat . $doc_names;
        if (file_exists($file)) {
            unlink($file);
        }
        if (file_exists($file1)) {
            unlink($file1);
        }
        $procedure->delete();
        return redirect()->route($this->indexRoute())->with('success', 'Successfully Deleted!');
    }
}
