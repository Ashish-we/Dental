<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
use App\Models\Dashboard;
use App\Models\Dentist;
use App\Models\FollowUp;
use App\Models\Patient;
use App\Models\Procedure;
use App\Models\Service;
use App\Models\Staff;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\DataTables;

class DashboardController extends BaseController
{
    /**
     * Display a listing of the resource.
     */
    // public function __construct(){

    //     parent::__construct();
    //     $this->title='Dashboard';
    //     $this->resources='dashboard.';
    //     $this->route='dashboard.';


    // }



    public function index(Request $request)
    {
        // $role = Auth::user()->roles()->first();
        // dd(count($role->permissions));
        $startOfWeek = Carbon::now()->startOfWeek();
        $endOfWeek = Carbon::now()->endOfWeek();
        $year = Carbon::now()->year;
        //to get the number of appointments for the logged in dentist this year per months
        if (Auth::user()->hasAnyRole('dentist')) {
            $counts = Auth::user()->dentist_appointment()->whereYear('date', $year)
                ->selectRaw('MONTH(date) as month, COUNT(*) as count')
                ->groupBy('month')
                ->pluck('count', 'month')
                ->toArray();
            // Fill in zero counts for months with no appointments
            for ($i = 1; $i <= 12; $i++) {
                if (!isset($counts[$i])) {
                    $counts[$i] = 0;
                }
            }
            ksort($counts);
            $counts = json_encode(array_values($counts));
        } else {
            //to get the number of all appointments per months for this year
            // Get the current year
            $counts = Appointment::whereYear('date', $year)
                ->selectRaw('MONTH(date) as month, COUNT(*) as count')
                ->groupBy('month')
                ->pluck('count', 'month')
                ->toArray();
            // Fill in zero counts for months with no appointments
            for ($i = 1; $i <= 12; $i++) {
                if (!isset($counts[$i])) {
                    $counts[$i] = 0;
                }
            }
            ksort($counts);
            $counts = json_encode(array_values($counts));
        }

        //to get the number of new patients added per months this year
        $patient_counts = Patient::whereYear('created_at', $year)
            ->selectRaw('MONTH(created_at) as month, COUNT(*) as count')
            ->groupBy('month')
            ->pluck('count', 'month')
            ->toArray();
        // Fill in zero patient_counts for months with no appointments
        for ($i = 1; $i <= 12; $i++) {
            if (!isset($patient_counts[$i])) {
                $patient_counts[$i] = 0;
            }
        }
        ksort($patient_counts);
        $patient_counts = json_encode(array_values($patient_counts));


        $procedureCosts = Procedure::whereYear('created_at', $year)
            ->selectRaw('MONTH(created_at) as month, SUM(cost) as total_cost')
            ->groupBy('month')
            ->pluck('total_cost', 'month')
            ->toArray();


        // Fill in zero costs for months with no procedures
        for ($i = 1; $i <= 12; $i++) {
            if (!isset($procedureCosts[$i])) {
                $procedureCosts[$i] = 0.0;
            }
        }

        // Sort the costs by month
        ksort($procedureCosts);
        $procedureCostsData = json_encode(array_values($procedureCosts)); // Convert associative array to indexed array
        // dd($procedureCostsData);

        $startOfDay = Carbon::now()->startOfDay();
        $endOfDay = Carbon::now()->endOfDay();
        $user = Auth::user();
        $user = User::findOrFail($user->id);
        $data = $this->crudInfo();

        if ($user->hasAnyRole('dentist')) {
            // dd("hello");
            $data['appointments'] = Auth::user()->dentist_appointment()->whereBetween('date', [$startOfWeek, $endOfWeek])->count();
            // dd($data);
        } else {
            $data['appointments'] = Appointment::whereBetween('date', [$startOfWeek, $endOfWeek])->count();
        }
        if ($user->hasRole('dentist')) {
            $data['appointments_today'] = Auth::user()->dentist_appointment()->whereBetween('date', [$startOfDay, $endOfDay])->count();
        } else {
            $data['appointments_today'] = Appointment::whereBetween('date', [$startOfDay, $endOfDay])->count();
        }
        if ($user->hasRole('dentist')) {

            $data['followUps'] = FollowUp::whereBetween('date', [$startOfWeek, $endOfWeek])->where('dentist_id', Auth::user()->id)->count();
        } else {
            $data['followUps'] = FollowUp::whereBetween('date', [$startOfWeek, $endOfWeek])->count();
        }
        if ($user->hasRole('dentist')) {
            $data['followUps_today'] = FollowUp::whereBetween('date', [$startOfDay, $endOfDay])->where('dentist_id', Auth::user()->id)->count();
        } else {
            $data['followUps_today'] = FollowUp::whereBetween('date', [$startOfDay, $endOfDay])->count();
        }


        $data['staffs'] = User::role('receptionist')->count();
        $data['patients'] = Patient::whereBetween('created_at', [$startOfWeek, $endOfWeek])->count();
        $data['services'] = Service::all()->count();
        $data['dentists'] = User::role('dentist')->count();
        $data['counts'] = $counts;
        $data['patient_counts'] = $patient_counts;
        $data['procedureCostsData'] = $procedureCostsData;
        return view('dashboard.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Dashboard $dashboard)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Dashboard $dashboard)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Dashboard $dashboard)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Dashboard $dashboard)
    {
        //
    }
}
