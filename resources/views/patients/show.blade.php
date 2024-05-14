@extends('templates.show')

@section('form_content')
<div class="row">
    <div class="col-md-3">
        <div class="card">
            <div class="card-body">
                <div>
                    <img src="/image/images.jpg" alt="hello" class="img-thumbnail">
                </div>
                <div>
                    <h3>{{ $item->name }}</h3>
                    {{-- <input type="hidden" value='@json($item->id)' id="patient_id"> --}}

                </div>
                <div>
                    <h6>Gender: {{ $item->gender }}</h6>
                </div>
                <div>
                    <h6>Address: {{ $item->address }}</h6>
                </div>
                <div>
                    <h6>Phone: {{ $item->phone }}</h6>
                </div>
                <div>
                    <h6>Age: {{ $item->age }}</h6>
                </div>

            </div>
        </div>
    </div>

    <div class="col-md-9">
        <div class="card m-2 p-2">

            {{-- @dd($item) --}}
            <div class="card-header">
                @if(!auth()->user()->hasRole('dentist'))
                <h3 class="card-title">
                    <button class="btn btn-info text-white"> <a href="#" class="text-white" style="text-decoration:none">New Appointment</a></button> <!-- herf="{{ route('appointments.create', ['patient_id' => $item->id]) }}" -->
                </h3>
                @endif
            </div>
            <div class="card-body">
                <div style="display: none;" id="appoint_form">

                    <h6>Add New Appointment</h6>

                    <form action="{{ route( 'appointments.store') }}" method="post">
                        @csrf
                        <div class="row">
                            <style>
                                .select2-container--default .select2-selection--single .select2-selection__rendered {
                                    color: #444;
                                    line-height: 15px !important;
                                    width: 75% !important;

                                }
                            </style>
                            <div class="col-4 m-2 form-group">


                                <label>Chief Complaint *</label>
                                <input type="text" name="chief_complaint" class="form-control" placeholder="Enter chief complaint" value="{{ old('title', $item->chief_complaint) }}" required>

                                <span class="text-danger">
                                    @error('chief_complaint')
                                    {{ $message }}
                                    @enderror

                                </span>

                            </div>
                            <div class="col-4 m-2 form-group" style="display:none;">

                                <label> Patient Name</label>

                                @if (isset($item))
                                <input class="form-control" name="patient_id" value="{{$item->id}}" type="text" hidden>
                                <input type="text" class="form-control" name="patient_id" value="{{$item->id}}" hidden readonly>
                                <input type="text" class="form-control" name="patient_name" value="{{$item->name}}" readonly>

                                @else
                                <select class="custom-select" name="patient_id" id="patient">
                                    <option value="">Select Patient </option>
                                    @foreach ($patients as $patient)
                                    <option value="{{ $patient->id }}" @selected(old('patient_id', $item->patient_id) == $patient->id)>
                                        {{ $patient->name }}
                                    </option>
                                    @endforeach
                                </select>
                                @endif

                                <span class="text-danger">
                                    @error('patient_id')
                                    {{ $message }}
                                    @enderror
                                </span>
                            </div>


                            <div class=" col-4 m-2 form-group">
                                <label>Date *</label>
                                <input type="datetime-local" name="date" class="form-control" value="{{ old('date', $item->date) }}" id="date" required>
                            </div>

                        </div>


                        <div class="row">

                            <div class="col-4 m-2 form-group">
                                <label>Dentist Name *</label>

                                <select class="custom-select" name="dentist_id" id="dentist" required>
                                    <option value="">Select Dentist </option>

                                    @foreach ($dentists as $dentist)
                                    <option value="{{ $dentist->id }}" @selected(old('dentist_id', $dentist_id->id)==$dentist->id) >{{ $dentist->name }}</option>
                                    @endforeach
                                </select>

                                <span class="text-danger">
                                    @error('dentist_id')
                                    {{ $message }}
                                    @enderror
                                </span>

                            </div>

                            <div class="col-6  m-2 form-group">

                                <label> Conditon</label>
                                <input type="text" name="condition" class="form-control" placeholder="Enter Condition" value="{{ old('condition', $item->condition) }}">

                                <span class="text-danger">
                                    @error('condition')
                                    {{ $message }}
                                    @enderror

                                </span>
                                {{--
        <select class="form-select purpose_to_visit" name="visit" multiple="multiple">
            <option value="" disabled>-- Select POV --</option>
            <option value="toothache">Toothache</option>
            <option value="bleeding_gum"> Bleeding Gums</option>
            <option value="tooth_sensitivity">Tooth Sensitivity</option>
            <option value="gum_recession">Gum Recession</option>
            <option value="oral_infection"> Oral Infections</option>
            <option value="plaque_bulidup"> Plaque Build-up</option>
            <option value="wisdom_teeth">Impacted Wisdom Teeth</option>
            <option value="tojaw_pain">Jaw Pain</option>
            <option value="tooth_fracture">Tooth Fracture</option>
            <option value="loose_tooth">Loose Tooth</option>
        </select>--}}
                            </div>
                            <div class="row">


                                <div class=" col-5 m-2 form-group">
                                    <label> Service Name *</label>

                                    <select class="custom-select" name="service_id" id="service" required>

                                        <option value="">Select Service </option>

                                        @foreach ($services as $service)
                                        <option value="{{ $service->id }}" @selected(old('service_id', $item->service_id) == $service->id)>
                                            {{ $service->title }}
                                        </option>
                                        @endforeach
                                    </select>
                                    {{-- small change --}}
                                    <span class="text-danger">
                                        @error('service_id')
                                        {{ $message }}
                                        @enderror

                                    </span>
                                </div>

                                <div class="col-5 m-2 form-group">

                                    <label> Status *</label>

                                    <select name="status" class="custom-select" id="status" required>

                                        <option value="scheduled" @selected(old('status', $item->status) == 'scheduled')> Scheduled </option>
                                        <option value="confirmed" @selected(old('status', $item->status) == 'confirmed')> Confirmed </option>
                                        <option value="cancelled" @selected(old('status', $item->status) == 'cancelled')> Cancelled </option>
                                        <option value="completed" @selected(old('status', $item->status) == 'completed')> Completed </option>
                                        <option value="noshow" @selected(old('status', $item->status) == 'noshow')> No-Show </option>

                                    </select>

                                    <span class="text-danger">
                                        @error('status')
                                        {{ $message }}
                                        @enderror

                                    </span>

                                </div>

                            </div>

                            <div class="form-group">
                                <label>Notes</label>
                                <input type="text" name="notes" class="form-control" placeholder="Enter Notes" value="{{ old('notes', $item->notes) }}">

                                <span class="text-danger">
                                    @error('notes')
                                    {{ $message }}
                                    @enderror

                                </span>
                            </div>
                            <div class="form-group">
                                <input type="submit" class="btn btn-success " value="Add">
                            </div>
                        </div>
                    </form>
                </div>
                <ul class="nav nav-tabs" id="myTab" role="tablist">

                    <li class="nav-item" role="presentation">
                        <button class="nav-link active" id="appointment-tab" data-bs-toggle="tab" data-bs-target="#appointment-tab-pane" type="button" role="tab" aria-controls="appointment-tab-pane" aria-selected="false">Appointment</button>
                    </li>

                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="medical-record-tab" data-bs-toggle="tab" data-bs-target="#medical-record-tab-pane" type="button" role="tab" aria-controls="medical-record-tab-pane" aria-selected="false">Medical Records</button>
                    </li>
                    @if($is_procedure)
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="procedure-tab" data-bs-toggle="tab" data-bs-target="#procedure-tab-pane" type="button" role="tab" aria-controls="procedure-tab-pane" aria-selected="false">procedure</button>
                    </li>
                    @endif

                </ul>



                <div class="tab-content" id="myTabContent">
                    {{-- Appointment --}}
                    <div class="tab-pane fade show active" id="appointment-tab-pane" role="tabpanel" aria-labelledby="appointment-tab" tabindex="0">
                        <div style="overflow: scroll; height:400px;">
                            @foreach($appointments as $appointment)
                            <div>
                                <div>
                                    Dentist : {{$appointment->dentists->first()->name}}
                                </div>
                                <div>
                                    <h5 class="card-title">{{$appointment->date}}</h5>
                                    <p class="card-text">{{$appointment->chief_complaint}}</p>
                                    <a href="{{route('appointments.show', $appointment->id)}}" class="btn btn-primary">Show</a>
                                    <a href="{{route('appointments.edit', $appointment->id)}}" class="btn btn-success">Edit</a>
                                    @if(!auth()->user()->hasRole('dentist'))
                                    <div style="float: right; padding-right:50%;">
                                        <form action="{{route('appointments.destroy', $appointment->id)}}">
                                            @csrf
                                            @method('DELETE')
                                            <a type="submit" href="{{route('appointments.show', $appointment->id)}}" class="btn btn-danger">Delete</a>
                                        </form>

                                    </div>
                                    @endif
                                </div>
                                <p>--------------------------------------------------------------------------</p>
                            </div>
                            @endforeach

                        </div>
                    </div>
                    {{-- Medical Records --}}
                    <div class="tab-pane fade" id="medical-record-tab-pane" role="tabpanel" aria-labelledby="medical-record-tab" tabindex="0">


                        <form action="">
                            @csrf
                            <div class="form-group  m-2">
                                <label> Medical Condition</label>
                                <input type="text" name="medical_condition" class="form-control" placeholder="No  Medical Condition" value="{{ $item?->medicalRecord?->medical_condition }}" disabled>
                            </div>

                            <div class="form-group  m-2">
                                <label> Allergies</label>
                                <input type="text" name="allergies" class="form-control" placeholder="No Allergies" value="{{ $item?->medicalRecord?->allergies }}" disabled>
                            </div>



                        </form>
                    </div>
                    @if($is_procedure)
                    {{-- Procedure --}}
                    <div class="tab-pane fade" id="procedure-tab-pane" role="tabpanel" aria-labelledby="procedure-tab" tabindex="0">
                        <table class="table table-bordered data-table">
                            <thead class="table">
                                <tr>
                                    <th>S.N.</th>
                                    <th>Tooth Number</th>
                                    <th>Cost</th>
                                    <!-- <th>Notes / Description</th> -->
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>


                        @push('scripts')
                        <script type="text/javascript">
                            $(function() {
                                var patientId = "{{$item->id}}";
                                var table = $('.data-table').DataTable({

                                    processing: true,

                                    serverSide: true,

                                    ajax: {
                                        'url': "{{ route('procedures.index') }}",

                                        'data': {

                                            'patient_id': patientId,

                                        }
                                    },

                                    columns: [

                                        {
                                            data: 'DT_RowIndex',
                                            name: 'id'
                                        },


                                        {
                                            data: 'teeth_id',
                                            name: 'teeth_id'
                                        },

                                        {
                                            data: 'cost',
                                            name: 'cost'
                                        },

                                        // {
                                        //     data: 'condition',
                                        //     name: 'condition'
                                        // },

                                        {
                                            data: 'action',
                                            name: 'action',
                                            orderable: false,
                                            searchable: false
                                        },
                                    ]
                                });

                            });
                        </script>
                        @endpush

                    </div>

                    @endif
                </div>
            </div>
        </div>


    </div>
    @push('scripts')
    <script>
        $(".btn-info").click(function() {
            $("#appoint_form").slideToggle("slow");
        });
    </script>
    @endpush
    @endsection