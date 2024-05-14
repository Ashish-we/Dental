<?php

namespace App\Http\Controllers;

use App\Models\MedicalRecord;
use App\Models\Patient;
use App\Models\User;
use App\Repositories\MedicalRecordRepository\MedicalRecordRepositoryInterface;
use App\Services\MedicalRecordService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\DataTables;

class MedicalRecordController extends BaseController
{
    /**
     * Display a listing of the resource.
     */


    public function __construct(protected MedicalRecordService $medicalRecordService)
    {

        parent::__construct();
        $this->resources = 'medicalRecords.';
        $this->title = 'MedicalRecords';
        // $this->medicalRecords = MedicalRecord::all();
        $this->generateAllMiddlewareByPermission();
        $this->route = 'medicalRecords.';
    }

    public function index(Request $request)
    {
        $isEdit = False;
        $isDelete = False;
        $isShow = False;
        $isAdd = False;

        if ($this->checkPermission('medicalrecords.add')) {
            $isAdd = True;
        }
        if ($this->checkPermission('medicalrecords.edit')) {
            $isEdit = True;
        }
        if ($this->checkPermission('medicalrecords.delete')) {
            $isDelete = True;
        }
        if ($this->checkPermission('medicalrecords')) {
            $isShow = True;
        }

        if ($request->ajax()) {

            if (Auth::user()->hasRole('dentist')) {
                $data = Auth::user()->dentist_appointment()->get();
                $patient_id = [];
                foreach ($data as $item) {
                    $patient_id[] = $item->patient_id;
                }
                $data = MedicalRecord::whereIn('patient_id', $patient_id)->get();
            } else {
                $data = $this->medicalRecordService->all();
            }


            return DataTables::of($data)

                ->addIndexColumn()

                ->addColumn('patient_id', function ($row) {
                    return $row->patient_id ? $row->patient->name : "--";
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
        return view("medicalRecords.index", $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $data = $this->crudInfo();
        $data['patients'] = Patient::all();


        return view($this->createResource(), $data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'patient_id' => 'required|exists:patients,id',
            'medical_condition' => 'required',
            'allergies' => 'required|string',

        ]);

        $data = $request->all();
        $medicalRecord = $this->medicalRecordService->create($data);

        $medicalRecord->save();
        return redirect()->route($this->indexRoute())->with('success', 'Successfully Added!');
    }

    /**
     * Display the specified resource.
     */
    public function show(MedicalRecord $medicalRecord)
    {

        $data = $this->crudInfo();
        $data['item'] = $medicalRecord;

        return view($this->showResource(), $data);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(MedicalRecord $medicalRecord)
    {
        $data = $this->crudInfo();
        $data['patients'] = Patient::all();
        $data['item'] = $medicalRecord;


        return view('medicalRecords.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, MedicalRecord $medicalRecord)
    {
        $data = $request->validate([
            'patient_id' => 'required|numeric',
            'medical_condition' => 'required',
            'allergies' => 'required|string',


        ]);

        // $data = $request->all();
        $this->medicalRecordService->update($data, $medicalRecord->id);
        // $medicalRecord->update($data);

        return redirect()->route($this->indexRoute())->with('success', 'Successfully Updated!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(MedicalRecord $medicalRecord)
    {
        $this->medicalRecordService->delete($medicalRecord->id);
        $medicalRecord->delete();

        return redirect()->route($this->indexRoute())->with('success', 'Successfully Deleted!');
    }
}
