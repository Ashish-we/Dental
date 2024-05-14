<?php

namespace App\Http\Controllers;

use App\Models\ServiceCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Redis;
use Yajra\DataTables\DataTables;

class ServiceCategoryController extends BaseController
{

    public function __construct()
    {
        parent::__construct();
        $this->title = 'serviceCategories';
        // $this->services = Service::all();
        $this->resources = 'serviceCategories.';
        $this->route = 'serviceCategories.';
        $this->generateAllMiddlewareByPermission();
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $isEdit = False;
        $isDelete = False;
        $isShow = False;
        $isAdd = False;

        if ($this->checkPermission('servicecategories.add')) {
            $isAdd = True;
        }
        if ($this->checkPermission('servicecategories.edit')) {
            $isEdit = True;
        }
        if ($this->checkPermission('servicecategories.delete')) {
            $isDelete = True;
        }
        // if ($this->checkPermission('servicecategories')) {
        //     $isShow = True;
        // }

        if ($request->ajax()) {

            $data = ServiceCategory::latest();

            return DataTables::of($data)

                ->addIndexColumn()

                ->addColumn('action', function ($row) use ($isShow, $isEdit, $isDelete) {

                    return view('templates.index_actions', [
                        'id' => $row->id,
                        'route' => $this->route,
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

    /**
     * Show the form for creating a new resource.
     */
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
        $data = $request->validate([
            'title' => 'required|string|max:255',
        ]);

        ServiceCategory::create($data);

        return Redirect()->route($this->indexResource())->with('success', 'Successfully Added!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $data = $this->crudInfo();
        $data['item'] = ServiceCategory::findOrFail($id);
        return view($this->createResource(), $data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $data = $request->validate([
            'title' => 'required|string|max:255',
        ]);

        $serviceCategory = ServiceCategory::findOrFail($id);

        $serviceCategory->update($data);

        return Redirect()->route($this->indexResource())->with('success', 'Successfully Updated!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $serviceCategory = ServiceCategory::findOrFail($id);
        $serviceCategory->delete();

        return Redirect()->route($this->indexResource())->with('success', 'Successfully Deleted!');
    }
}
