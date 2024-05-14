<?php

namespace App\Http\Controllers;

use App\Models\Service;
use App\Models\ServiceCategory;
use App\Models\TreatmentCategory;
use App\Services\ServiceService;
use Database\Seeders\ServiceSeeder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use League\Glide\Server;
use Yajra\DataTables\DataTables;

class ServiceController extends BaseController
{

    // public function __construct(protected ServiceService $serviceService)
    // {
    // }

    // public function all()
    // {
    //     return $this->serviceService->all();
    // }

    // public function show($id)
    // {
    //     return $this->serviceService->find($id);
    // }

    // public function createForm()
    // {
    //     return view('services.create');
    // }

    // public function updateForm($id)
    // {
    //     $service = $this->serviceService->find($id);
    //     return view('services.edit', compact('service'));
    // }

    // //name,  address, emails and other values from the user to this class should be provided dynamically while submitting the form
    // public function create(Request $request)
    // {
    //     $data = $request->validate([
    //         'title' => 'required|string',
    //         'category_id' => 'required|exists:treatment_categories,id',
    //         'procedure_id' => 'required|exists:procedures,id',
    //         'price' => 'required|numeric|min:0',
    //         'treatment_type' => 'required|string',

    //     ]);

    //     $service = $this->serviceService->create($data);

    //     return response()->json([
    //         'service' => $service,
    //     ]);
    // }

    // public function update(Request $request, $id)
    // {
    //     $data = $request->validate([
    //         'title' => 'required|string',
    //         'category_id' => 'required|exists:treatment_categories,id',
    //         'procedure_id' => 'required|exists:procedures,id',
    //         'price' => 'required|numeric|min:0',
    //         'treatment_type' => 'required|string',
    //     ]);

    //     $service = $this->serviceService->update($data, $id);

    //     return response()->json([
    //         'service' => $service,
    //     ]);
    // }

    // public function delete($id)
    // {
    //     $this->serviceService->delete($id);

    //     return response()->json([
    //         'status' => 'Successfully Deleted!',
    //     ]);
    // }




    /**
     * Display a listing of the resource.
     */

    public function __construct()
    {

        parent::__construct();
        $this->title = 'Services';
        // $this->services = Service::all();
        $this->resources = 'services.';
        $this->route = 'services.';
        $this->generateAllMiddlewareByPermission();
    }
    public function index(Request $request)
    {
        $isEdit = False;
        $isDelete = False;
        $isShow = False;
        $isAdd = False;

        if ($this->checkPermission('services.add')) {
            $isAdd = True;
        }
        if ($this->checkPermission('services.edit')) {
            $isEdit = True;
        }
        if ($this->checkPermission('services.delete')) {
            $isDelete = True;
        }
        if ($this->checkPermission('services')) {
            $isShow = True;
        }

        if ($request->ajax()) {

            $data = Service::latest();

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
        return view("services.index", $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $data = $this->crudInfo();
        $data['service_type'] = ServiceCategory::all();
        return view($this->createResource(), $data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $data = $request->validate(
            [
                'title' => 'required|string|max:255',
                'category_id' => 'required|numeric',
                'price' => 'required|numeric',
                'treatment_type' => 'nullable|string',
            ]
        );
        // dd($data);
        $service = Service::create($data);
        return redirect()->route($this->indexRoute())->with('success', 'Successfully Added!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Service $service)
    {
        $data = $this->crudInfo();
        $data['item'] = $service;
        // dd($service->serviceCategory);
        return view($this->showResource(), $data);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Service $service)
    {
        $data = $this->crudInfo();
        $data['item'] = $service;
        $data['service_type'] = ServiceCategory::all();

        return view($this->editResource(), $data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Service $service)
    {

        $request->validate(
            [
                'name' => 'required',
                'description' => 'required|max:500',
                'cost' => 'required',

            ]
        );

        $data = $request->all();
        $service->update($data);

        return redirect()->route($this->indexRoute())->with('success', 'Successfully Updated!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Service $service)
    {
        $service->delete();
        return redirect()->route($this->indexRoute())->with('success', 'Successfully deleted!');
    }
}
