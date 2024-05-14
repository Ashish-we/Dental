<?php

namespace App\Http\Controllers;

use App\Models\TeethType;
use App\Models\Type;
use App\Models\Procedure;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class TypeController extends BaseController
{
    /**
     * Display a listing of the resource.
     */



     public function __construct(){
        parent::__construct();
        $this->title="Types";
        $this->types=TeethType::all();
        $this->resources="types.";
        $this->route="types.";
     }
    public function index(Request $request)
    {
        if ($request->ajax()) {

            $data = TeethType::select('*');

            return DataTables::of($data)

                    ->addIndexColumn()

                   
                    ->addColumn('procedure_id',function($row){

                        return $row->procedure_id ? $row->procedure->name : "--";

                    })

                    ->addColumn('action', function($row){

                        return view('types.indexaction',['id'=>$row->id]);

                    })
                    ->rawColumns(['action'])
          

                    ->make(true);
        }

        $data=$this->crudInfo();
        return view("types.index",$data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $data['title']="Add type";
        $data['procedures']=Procedure::all();
        $data=$this->crudInfo();
        return view($this->createResource(),$data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data=$request->all();
        $type=new TeethType($data);
      
        $type->save();
        return redirect()->route($this->indexRoute());
    }

    /**
     * Display the specified resource.
     */
    public function show(TeethType $type)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(TeethType $type)
    {
        $data=$this->crudInfo();
        $data['item']=$type;
        $data['title']="Edit Type Details";
        $data['procedures']=Procedure::all();

        return view($this->editResource(), $data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, TeethType $type)
    {

        $data=$request->all();
        $type->update($data);

        return redirect()->route($this->indexRoute());
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(TeethType $type)
    {
        $type->delete();
        return redirect()->route($this->indexRoute());

    }
}
