@extends('adminlte::page')

@section('title', 'Dashboard')



@section('content_header')
<style>
    body {
        font-family: Arial, sans-serif;
    }

    .container {
        max-width: 800px;
        margin: 0 auto;
        padding: 20px;
    }

    canvas {
        width: 100%;
        height: 400px;
    }
</style>
@stop
@section('content')

<div class="row">
    <div class="col-lg-3 col-6">
        <!-- small box -->
        <div class="small-box bg-info">
            <div class="inner">
                <h3>{{$appointments}}</h3>

                <p>Appointments this Week!</p>
            </div>
            <div class="icon">
                <i class="ion ion-bag"></i>
            </div>
            <a href="{{ route('appointments.index')}}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
        </div>
    </div>
    @if(Auth()->user()->hasAnyRole(['admin', 'receptionist']))
    <!-- ./col -->
    <div class="col-lg-3 col-6">
        <!-- small box -->
        <div class="small-box bg-success">
            <div class="inner">
                <h3>{{$services}}</sup></h3>

                <p>Services</p>
            </div>
            <div class="icon">
                <i class="ion ion-stats-bars"></i>
            </div>
            <a href="{{route('services.index')}}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
        </div>
    </div>
    <!-- ./col -->
    @endif
    @if(Auth()->user()->hasAnyRole(['admin']))
    <div class="col-lg-3 col-6">
        <!-- small box -->
        <div class="small-box bg-warning">
            <div class="inner">
                <h3>{{$patients}}</h3>

                <p>New Patients Added this Week</p>
            </div>
            <div class="icon">
                <i class="ion ion-person-add"></i>
            </div>
            <a href="{{route('patients.index')}}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
        </div>
    </div>

    <!-- ./col -->
    <div class="col-lg-3 col-6">
        <!-- small box -->
        <div class="small-box bg-danger">
            <div class="inner">
                <h3>{{$dentists}}</h3>
                <p>Dentists</p>
            </div>
            <div class="icon">
                <i class="ion ion-pie-graph"></i>
            </div>
            <a href="{{route('dentists.index')}}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
        </div>
    </div>
    <!-- ./col -->
    @endif
    @if(Auth()->user()->hasAnyRole(['admin']))
    <div class="col-lg-3 col-6">
        <!-- small box -->
        <div class="small-box bg-danger">
            <div class="inner">
                <h3>{{$staffs}}</h3>
                <p>Staffs</p>
            </div>
            <div class="icon">
                <i class="ion ion-pie-graph"></i>
            </div>
            <a href="{{route('staffs.index')}}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
        </div>
    </div>
    @endif
    <!-- ./col -->
    <div class="col-lg-3 col-6">
        <!-- small box -->
        <div class="small-box bg-info">
            <div class="inner">
                <h3>{{$appointments_today}}</h3>

                <p>Appointments Todays!</p>
            </div>
            <div class="icon">
                <i class="ion ion-bag"></i>
            </div>
            <a href="{{ route('appointments.index')}}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
        </div>
    </div>
    <!-- ./col -->
    <div class="col-lg-3 col-6">
        <!-- small box -->
        <div class="small-box bg-success">
            <div class="inner">
                <h3>{{$followUps}}</sup></h3>

                <p>Follow Ups this week!</p>
            </div>
            <div class="icon">
                <i class="ion ion-stats-bars"></i>
            </div>
            <a href="{{route('followUps.index')}}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
        </div>
    </div>
    <!-- ./col -->
    <div class="col-lg-3 col-6">
        <!-- small box -->
        <div class="small-box bg-warning">
            <div class="inner">
                <h3>{{$followUps_today}}</h3>

                <p>FollowUps Today!</p>
            </div>
            <div class="icon">
                <i class="ion ion-person-add"></i>
            </div>
            <a href="{{route('followUps.index')}}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
        </div>
    </div>
</div>

<div class="row">
    @if(Auth()->user()->hasAnyRole(['admin', 'dentist']))
    <div class="col-6 container">
        <h1 style="text-align: center;">Appointments</h1>
        <canvas id="appointmentChart"></canvas>
    </div>
    @endif
    @if(Auth()->user()->hasRole('admin'))
    <div class="col-6 container">
        <h1 style="text-align: center;">New Patient</h1>
        <canvas id="patientChart"></canvas>
    </div>
    @endif
</div>
@if(Auth()->user()->hasRole('admin'))
<div class="container">
    <h1 style="text-align: center;">Procedure Costs</h1>
    <canvas id="procedureCostsChart"></canvas>
</div>
@endif
@endsection

@section('js')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Fetch appointment data from the server
        var appointmentCounts = @json($counts);
        appointmentCounts = appointmentCounts.split(',');
        // console.log(appointmentCounts);
        const appointmentData = {
            labels: ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'],
            datasets: [{
                label: 'Number of Appointments',
                backgroundColor: 'rgba(54, 162, 235, 0.2)',
                borderColor: 'rgba(54, 162, 235, 1)',
                borderWidth: 1,
                data: appointmentCounts // [10, 15, 20, 25, 30, 35, 40, 45, 50, 55, 60, 65] // Replace this with your actual data
            }]
        };

        // Get the canvas element
        const ctx = document.getElementById('appointmentChart').getContext('2d');

        // Create the chart
        const appointmentChart = new Chart(ctx, {
            type: 'bar',
            data: appointmentData,
            options: {
                scales: {
                    yAxes: [{
                        ticks: {
                            beginAtZero: true
                        }
                    }]
                }
            }
        });
    });
</script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Fetch appointment data from the server
        var patientcounts = @json($patient_counts);
        patientcounts = patientcounts.split(',');
        // console.log(patientcounts);
        const patientData = {
            labels: ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'],
            datasets: [{
                label: 'Number of Patients',
                backgroundColor: 'rgba(54, 162, 235, 0.2)',
                borderColor: 'rgba(54, 162, 235, 1)',
                borderWidth: 1,
                data: patientcounts // [10, 15, 20, 25, 30, 35, 40, 45, 50, 55, 60, 65] // Replace this with your actual data
            }]
        };

        // Get the canvas element
        const ctx = document.getElementById('patientChart').getContext('2d');

        // Create the chart
        const patientChart = new Chart(ctx, {
            type: 'bar',
            data: patientData,
            options: {
                scales: {
                    yAxes: [{
                        ticks: {
                            beginAtZero: true
                        }
                    }]
                }
            }
        });
    });
</script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Fetch appointment data from the server
        const procedureCostsCounts = @json($procedureCostsData);
        var selectedData = procedureCostsCounts.split(',');
        // const numericProcedureCostsCounts = [];
        // for (let i = 0; i < procedureCostsCounts.length; i++) {
        //     const numericValue = Number(procedureCostsCounts[i]);
        //     numericProcedureCostsCounts.push(numericValue);
        // }
        // const numericProcedureCostsCounts = procedureCostsCounts.map(Number);

        // console.log(selectedData);
        const procedureCostsData = {
            labels: ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'],
            datasets: [{
                label: 'Procedure Cost',
                backgroundColor: 'rgba(54, 162, 235, 0.2)',
                borderColor: 'rgba(54, 162, 235, 1)',
                borderWidth: 1,
                data: selectedData //[10, 15, 20, 25, 30, 35, 4000, 45, 50, 55, 60, 65] // Replace this with your actual data
            }]
        };

        // Get the canvas element
        const ctx = document.getElementById('procedureCostsChart').getContext('2d');

        // Create the chart
        const patientChart = new Chart(ctx, {
            type: 'bar',
            data: procedureCostsData,
            options: {
                scales: {
                    yAxes: [{
                        ticks: {
                            beginAtZero: true
                        }
                    }]
                }
            }
        });
    });
</script>
@stop