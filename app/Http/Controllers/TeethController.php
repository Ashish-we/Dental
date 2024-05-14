<?php

namespace App\Http\Controllers;

use App\Models\Teeth;
use App\Models\TeethType;
use App\Models\Type;
use App\Models\User;
use Illuminate\Http\Request;
use PhpParser\Node\Stmt\Foreach_;
use Yajra\DataTables\DataTables;

class TeethController extends BaseController
{
    /**
     * Display a listing of the resource.
     */


    public function __construct()
    {

        parent::__construct();
        $this->title = "Teeths";
        $this->teeths = Teeth::all();
        $this->resources = "teeths.";
        $this->route = "teeths.";
        
    }
    public function index(Request $request)
    {

        if ($request->ajax()) {

            $data = Teeth::with('patient', 'type')->get();

            return DataTables::of($data)

                ->addIndexColumn()

                // ->editColumn('teeth_name', function($row){
                //     return $row->user_id->name ?? "--";
                // })

                ->addColumn('patient_id', function ($row) {
                    return $row->patient_id ? $row?->patient?->name : "--";
                })

                ->addColumn('type_id', function ($row) {
                    return $row->type->name ?: '---';
                })

                ->editColumn('tooth_number', function ($row) {
                    return $row->tooth_number ?? "--";
                })


                ->addColumn('image', function ($row) {
                    return $row->image_url ?? '---';
                    // return "--";
                    // return "<img src=". $row->getMedia('x_ray').">"?:'---';
                })

                ->editColumn('condition', function ($row) {

                    return $row->condition ?: "---";
                })

                ->addColumn('action', function ($row) {

                    return view('teeths.indexaction', ['id' => $row->id]);

                })

                ->rawColumns(['action', 'variation'])


                ->make(true);
        }

        $data = $this->crudInfo();

        return view("teeths.index", $data);

    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $data = $this->crudInfo();
        $data['patients'] = User::role('patient')->get();
        $data['types'] = TeethType::all();
        $data['title'] = "Add Teeth";

       


        return view($this->createResource(), $data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $request->validate([
            'patient_id' => 'required|exists:users,id',
            'type_id' => 'required',
            'tooth_number' => 'required',
            'condition' => 'nullable|string',
            'notes'=>'nullable',
            'image' => 'nullable|mimes:png,jpeg,jpg',
             // 'type_ids' => 'required|array',
            // 'type_ids.*' => 'required|string',
        ]);

       


        $data = $request->all();
        $teeth = new Teeth($data);
        $teeth->save();


        // $types=$request->type_ids;
        // $types = Type::whereIn('id', $request->type_ids)->pluck('id')->toArray();
        // $teeth->types()->attach($types);    //many-many relationship


        if ($request->image) {

            $teeth->addMediaFromRequest('image')->toMediaCollection('teeths');

        }

        

        

        return redirect()->route($this->indexRoute());


    }

    /**
     * Display the specified resource.
     */
    public function show(Teeth $teeth)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Teeth $teeth)
    {
        $data = $this->crudInfo();
        $data['patients'] = User::role('patient')->get();
        $data['types'] = TeethType::all();
        $data['item'] = $teeth;
        // $data['teeth_types'] = $teeth->type->pluck('id')->toArray();
        $data['title'] = "Edit Teeth Details";

        return view($this->editResource(), $data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Teeth $teeth)
    {
        $request->validate([
            'image' => 'nullable|mimes:png,jpeg,jpg',
            'type_id' => 'required',
            'tooth_number' => 'required',
            'condition' => 'nullable|string',
            'notes'=>'nullable',
            'patient_id' => 'required|exists:users,id',
            
        ]);

        $data = $request->all();
        $teeth->update($data);

      

        if ($request->image) {
            $teeth->clearMediaCollection('teeths');
            $teeth->addMediaFromRequest('image')->toMediaCollection('teeths');
        }



  

        return redirect()->route($this->indexRoute());



        // $types = Type::whereIn('id', $request->type_ids)->pluck('id')->toArray();
        // $teeth->types()->sync($types);
        // $teeth->user_id = $request['user_id'];
        // $teeth->name=$request['name'];
        // $teeth->condition=$request['condition'];
        // $teeth->update();

        // $type = new TeethType([
        //     'teeth_id' => $teeth->id,
        //     'type_id'=> $request->type_id
        // ]);
        // $type->save();




    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Teeth $teeth)
    {
        $teeth->delete();
        return redirect()->route($this->indexRoute());
    }
}
