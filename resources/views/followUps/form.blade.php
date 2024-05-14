<div class="row">
    <div class=" col-4 m-2 form-group">
        <label>Date</label>
        <input type="datetime-local" name="date" class="form-control" value="{{ old('date', $item->date) }}" id="date">
    </div>

    <div class="col-4 m-2 form-group">
        <label>Dentist Name</label>

        <select class="custom-select" name="dentist_id" id="dentist">
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
</div>

<input type="numeric" value="{{$appointment->id}}" name="appointment_id" hidden>