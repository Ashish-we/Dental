<style>
    .select2-container--default .select2-selection--single .select2-selection__rendered {
        color: #444;
        line-height: 15px!important;

    }
</style>
<div class="form-group">

    <label> Patient Name</label>

    {{-- @php
        if (old('user_id') !== null) {
            $option = old('user_id');
        } else {
            $option = $user->id;
        }
    @endphp --}}

    <select name="patient_id" class="custom-select" id="patient">

        <option value="">Select Patients</option>

        @foreach ($patients as $patient)
            <option  @if($patient->id === $item->patient_id)selected @endif value="{{ $patient->id}} " {{old('patient_id') == $patient->id ? 'selected' : ''}}>{{ $patient->name }} </option>


                {{-- @selected(old('user_id') == $user->id) laravel 10 --}}

        @endforeach

    </select>
    <span class="text-danger">
        @error('patient_id')
            {{ $message }}
        @enderror

    </span>

</div>

<div class="form-group">
    <label>Medical Condition</label>
    <input type="text" name="medical_condition" class="form-control" placeholder="Enter Medical Condition"
        value="{{ old('medical_condition', $item->medical_condition) }}">

    <span class="text-danger">
        @error('medical_condition')
            {{ $message }}
        @enderror

    </span>
</div>

<div class="form-group">
    <label>Allegries</label>
    <input type="text" name="allergies" class="form-control" placeholder="Enter Allegries"
        value="{{ old('allergies', $item->allergies) }}">

    <span class="text-danger">
        @error('allergries')
            {{ $message }}
        @enderror

    </span>
</div>
