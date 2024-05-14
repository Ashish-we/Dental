<!-- <div class="row">

    <div class=" col-4 form-group">
        <label>Title</label>
        <input type="text" name="title" class="form-control" placeholder="Enter Title" value="{{ old('title', $item->title) }}">

        <span class="text-danger">
            @error('title')
            {{ $message }}
            @enderror

        </span>
    </div>


</div>

<div class="row">

    <div class=" col-3 m-2  form-group">
        <label>Tooth number</label>
        <input type="text" name="teeth_id" class="form-control" placeholder="Enter Tooth Number">

        {{-- <select name="teeth_id" class="form-control" placeholder="Enter Teeth">


            <option value=""> --Select Teeth-- </option>

            @foreach ($teeths as $teeth)
                <option @if ($teeth->id === $item->teeth_id) selected @endif value="{{ $teeth->id }}"
        {{ old('teeth_id') == $teeth->id ? 'selected' : '' }}>{{ $teeth->name }} </option>
        @endforeach
        </select> --}}

        <span class="text-danger">
            @error('teeth_id')
            {{ $message }}
            @enderror

        </span>

    </div>


    <div class=" col-4 m-2 form-group">
        <label>Cost (NRS)</label>
        <input type="text" name="cost" class="form-control" placeholder="Enter Cost" value="{{ old('cost', $item->cost) }}">

        <span class="text-danger">
            @error('cost')
            {{ $message }}
            @enderror

        </span>
    </div>
</div>

<div class="form-group">
    <label>Description</label>
    <input type="text" name="description" class="form-control" placeholder="Enter Description" value="{{ old('description', $item->description) }}">


</div> -->

<h5>Select Tooth</h5>
<br>
<div class="row">
    <div class="col-4">
        <div class="container_">
            <div id="8a" onclick="popup('8a')">8</div>
            <div id="7a" onclick="popup('7a')">7</div>
            <div id="6a" onclick="popup('6a')">6</div>
            <div id="5a" onclick="popup('5a')">5</div>
            <div id="4a" onclick="popup('4a')">4</div>
            <div id="3a" onclick="popup('3a')">3</div>
            <div id="2a" onclick="popup('2a')">2</div>
            <div id="1a" onclick="popup('1a')">1</div>
        </div>
    </div>
    <div class="col-4">
        <div class="container_">
            <div id="1b" onclick="popup('1b')">1</div>
            <div id="2b" onclick="popup('2b')">2</div>
            <div id="3b" onclick="popup('3b')">3</div>
            <div id="4b" onclick="popup('4b')">4</div>
            <div id="5b" onclick="popup('5b')">5</div>
            <div id="6b" onclick="popup('6b')">6</div>
            <div id="7b" onclick="popup('7b')">7</div>
            <div id="8b" onclick="popup('8b')">8</div>
        </div>
    </div>
</div>
<br>

<div class="row">
    <div class="col-4">
        <div class="container_">
            <div id="8c" onclick="popup('8c')">8</div>
            <div id="7c" onclick="popup('7c')">7</div>
            <div id="6c" onclick="popup('6c')">6</div>
            <div id="5c" onclick="popup('5c')">5</div>
            <div id="4c" onclick="popup('4c')">4</div>
            <div id="3c" onclick="popup('3c')">3</div>
            <div id="2c" onclick="popup('2c')">2</div>
            <div id="1c" onclick="popup('1c')">1</div>
        </div>
    </div>
    <div class="col-4">
        <div class="container_">
            <div id="1d" onclick="popup('1d')">1</div>
            <div id="2d" onclick="popup('2d')">2</div>
            <div id="3d" onclick="popup('3d')">3</div>
            <div id="4d" onclick="popup('4d')">4</div>
            <div id="5d" onclick="popup('5d')">5</div>
            <div id="6d" onclick="popup('6d')">6</div>
            <div id="7d" onclick="popup('7d')">7</div>
            <div id="8d" onclick="popup('8d')">8</div>
        </div>
    </div>
</div>
<br>
<div class="row">
    <div class="col-4 form-group" style="display: none;">
        <label for="patient_id">Patient</label>
        <select name="patient_id" class="custom-select" id="patient_id" disabled required>

            <option value="">Select Patients</option>

            @foreach ($patients as $patient)
            <option @if($patient->id === $appointment->patient_id)selected @endif value="{{ $patient->id}} " {{old('patient_id') == $patient->id ? 'selected' : ''}}>{{ $patient->name }} </option>


            {{-- @selected(old('user_id') == $user->id) laravel 10 --}}

            @endforeach

        </select>
        <span class="text-danger">
            @error('patient_id')
            {{ $message }}
            @enderror

        </span>
    </div>
    <div class="col-4 form-group"> <!--  style="display: none;" -->
        <label> Service Name</label>

        <select class="custom-select" name="service_id" id="service_id" disabled>

            <option value="">Select Service </option>

            @foreach ($services as $service)
            <option value="{{ $service->id }}" @selected($appointment->service_id == $service->id)> <!--  old('service_id', $item->service_id) -->
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
    @if(@$appointment)
    <div class="col-4 form-group">
        <label for="appointment_id">Appointment</label>
        <select name="appointment_id" class="custom-select" id="appointment_id" disabled required>

            <option value="">Select Patients</option>

            @foreach ($appointments as $appointment_)
            <option @if($appointment_->id === $appointment->id)selected @endif value="{{ $appointment_->id}} " {{old('appointment_id') == $appointment_->id ? 'selected' : ''}}>{{ $appointment_->chief_complaint }} </option>


            {{-- @selected(old('user_id') == $user->id) laravel 10 --}}

            @endforeach

        </select>
        <span class="text-danger">
            @error('patient_id')
            {{ $message }}
            @enderror

        </span>
    </div>
    @else
    <div class="col-4 form-group">
        <label for="appointment_id">Appointment</label>
        <select name="appointment_id" class="custom-select" id="appointment_id" required>

            <option value="">Select Patients</option>

            @foreach ($appointments as $appointment)
            <option @if($appointment->id === $item->appointment_id)selected @endif value="{{ $appointment->id}} " {{old('appointment_id') == $appointment->id ? 'selected' : ''}}>{{ $appointment->chief_complaint }} </option>


            {{-- @selected(old('user_id') == $user->id) laravel 10 --}}

            @endforeach

        </select>
        <span class="text-danger">
            @error('patient_id')
            {{ $message }}
            @enderror

        </span>
    </div>
    @endif
</div>
<div class="row">
    <div class="col-8 form-group">
        <label for="condition">Condition</label>
        <textarea class="form-control" id="condition_" name="condition" rows="3">{{ old('condition', $item->condition) }}</textarea>
    </div>
    <div class="col-4 form-group">
        <label for="cost">Cost</label>
        <input type="number" class="form-control" id="cost" value="{{ old('cost', $item->cost) }}" name="cost" required>
    </div>
</div>
<div class="form-group">
    <label for="documents">Documents *</label>
    <input type="file" class="form-control" id="documents" name="documents" required>
</div>

<!-- for the popup -->
<div id="tooth_form">
    <!-- <form action="#" id="myForm"> -->
    <div class="row">
        <div class="col-5 form-group">
            <label for="tooth_number">Tooth Number</label>
            <input disabled type="text" class="form-control" id="tooth_number" name="tooth_number">
        </div>
    </div>
    <div class="container">
        <div class="form-group">
            <div class="custom-control custom-checkbox">
                <input type="checkbox" class="custom-control-input" id="checkbox1">
                <label class="custom-control-label" for="checkbox1">Checkbox 1</label>
                <select class="col-4 form-control dropdown" style="display:none;">
                    <option value="value1">Value 1</option>
                    <option value="value2">Value 2</option>
                    <option value="value3">Value 3</option>
                </select>
            </div>
            <div class="custom-control custom-checkbox">
                <input type="checkbox" class="custom-control-input" id="checkbox2">
                <label class="custom-control-label" for="checkbox2">Checkbox 2</label>
                <select class="col-4 form-control dropdown" style="display:none;">
                    <option value="value1">Value 1</option>
                    <option value="value2">Value 2</option>
                    <option value="value3">Value 3</option>
                </select>
            </div>
        </div>
    </div>

    <div class="form-group">
        <label for="notes">Notes</label>
        <textarea class="form-control" id="notes" name="notes" rows="3"></textarea>
    </div>
    <button class="btn btn-primary" onclick="add_tooth()">OK</button>
    <button class="btn btn-primary" onclick="clear_tooth($('#tooth_number').val())">Clear</button>
    <!-- </form> -->
</div>

@if($item->documents)
<a href="{{asset('storage/docs/' . $item->documents) }}" download>
    <p>{{ $item->documents }}</p>
    @endif