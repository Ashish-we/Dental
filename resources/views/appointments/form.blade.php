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
    <div class="col-4 m-2 form-group">

        <label> Patient Name *</label>

        @if (isset($patient))
        <input class="form-control" name="patient_id" value="{{$patient->id}}" type="text" hidden>
        <input type="text" class="form-control" name="patient_id" value="{{$patient->id}}" hidden readonly>
        <input type="text" class="form-control" name="patient_name" value="{{$patient->name}}" readonly>

        @else
        <select class="form-control" name="patient_id" id="patient" style="height: 100px!important;" required>
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


    <div class=" col-2 m-2 form-group">
        <label>Date *</label>
        <input type="datetime-local" name="date" class="form-control" value="{{ old('date', $item->date) }}" id="date" required>
    </div>

</div>


<div class="row">

    <div class="col-4 m-2 form-group">
        <label>Dentist Name *</label>

        <select class="form-control" name="dentist_id" id="dentist" required>
            <option value="">Select Dentist </option>

            @foreach ($dentists as $dentist)
            <option value="{{ $dentist->id }}" @selected(old('dentist_id', $dentist_id->id)==$dentist->id)>{{ $dentist->name }}</option>
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

                <!-- <option value="">Select Status</option> -->

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

</div>