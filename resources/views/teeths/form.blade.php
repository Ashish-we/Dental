<div class="form-group">
    <label> Patient Name</label>
    <select name="patient_id" id="" class="form-control">
        <option value=""> --Select Patient-- </option>
        @foreach ($patients as $patient)
            <option value="{{ $patient->id }}"{{ old('patient_id') == $patient->id ? 'selected' : '' }}>
                {{ $patient->name }}
            </option>

            {{-- <option value=" {{old('user_id',$user->id) == $user->id ? 'selected' : ''}}">{{$user->name}}</option> --}}
        @endforeach

    </select>

    <span class="text-danger">
        @error('patient_id')
            {{ $message }}
        @enderror

    </span>
</div>


{{-- 
<div class="form-group">
    <label>Types</label>
   
    <select multiple class="form-control" name="type_id" id="">
        <option value="">--Select Type--</option>
      
        @foreach ($types as $type)

        <option @if (in_array($type->id, $teeth_types))selected @endif value="{{$type->id}}">{{"$type->name"}}</option>
            
        @endforeach
        
    </select>

</div> --}}

{{-- <div class="form-group">
    <label>Types</label>
   
    <select multiple class="form-control" name="type_ids[]" id="">
       
        @foreach ($types as $type)

        <option @if (isset($teeth_types) && in_array($type->id, $teeth_types))selected @endif value="{{old('type_ids',$type->id)}}">{{"$type->name"}}</option>
  
        @endforeach
    </select>

    <span class="text-danger">
        @error('type_ids')
        {{$message}}
            
        @enderror

    </span>

</div>  --}}

<div class="form-group">
    <label> Teeth-Type</label>
    <select name="type_id" id="" class="form-control">
        <option value="">--Select Type--</option>
        @foreach ($types as $type)
            <option @if ($type->id === $item->type_id) selected @endif
                value="{{ $type->id }}"{{ old('type_id') == $patient->id ? 'selected' : '' }}> {{ $type->name }}
            </option>

            {{-- <option value=" {{old('user_id',$user->id) == $user->id ? 'selected' : ''}}">{{$user->name}}</option> --}}
        @endforeach

    </select>

    <span class="text-danger">
        @error('type_id')
            {{ $message }}
        @enderror

    </span>
</div>



<div class="form-group">
    <label>Tooth Number</label>

    <input type="number" name="tooth_number" class="form-control"
        value="{{ old('tooth_number', $item->tooth_number) }}">

    <span class="text-danger">
        @error('tooth_number')
            {{ $message = 'the tooth number should be above 1 or less than 32' }}
        @enderror

    </span>


</div>



<div class="form-group">
    <label>X-ray</label>

    <input type="file" name="image" class="form-control" value="{{ old('image', $item->image) }}"
        accept="png/jpeg/jpg">


    @if ($item->image_url)
        <img src="{{ $item->image_url }}" alt="" height="150" width="150">
    @endif

    <span class="text-danger">
        @error('image')
            {{ $message }}
        @enderror

    </span>

</div>

<div class="form-group">
    <label>Condition</label>
    <input type="text" name="condition" class="form-control" placeholder="Enter condition"
        value="{{ old('condition', $item->condition) }}">

    <span class="text-danger">
        @error('condition')
            {{ $message }}
        @enderror

    </span>
</div>

<div class="form-group">
    <label>Notes</label>
    <input type="text" name="notes" class="form-control" placeholder="Enter Notes"
        value="{{ old('notes', $item->notes) }}">

    <span class="text-danger">
        @error('notes')
            {{ $message }}
        @enderror

    </span>
</div>
