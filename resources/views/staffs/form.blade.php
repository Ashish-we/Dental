<div class="row">

    <div class="col-4 form-group">
        <label>Name *</label>

        <input type="text" name="name" class="form-control" placeholder="Enter Name" value="{{old('name', $item->name)}}" required>

        <span class="text-danger">
            @error('name')
            {{$message}}
            @enderror

        </span>



    </div>

    <div class="col-4 form-group">
        <label>Contact *</label>
        <input type="number" name="mobile" class="form-control" placeholder="Enter Contact (10 digits)" value="{{old('mobile', $item->mobile)}}" required pattern="[0-9]{10}" inputmode="numeric">

        <span class="text-danger">
            @error('mobile')
            {{$message}}
            @enderror

        </span>

    </div>


</div>
<div class="row">
    <div class="col-4 form-group">
        <label>Address *</label>
        <input type="text" name="address" class="form-control" placeholder="Enter Address" value="{{old('address',$item->address)}}" required>

        <span class="text-danger">
            @error('address')
            {{$message}}
            @enderror
        </span>

    </div>
    <div class="col-4 form-group">
        <label>Date of Birth</label>
        <input type="date" name="dob" class="form-control" placeholder="Enter Age" value="{{old('dob', $item->dob)}}">

        <span class="text-danger">
            @error('dob')
            {{$message}}
            @enderror

        </span>

    </div>

</div>
<div class="row">
    <div class="col-4 form-group">
        <label>Gender *</label>
        <select class="form-control" name="gender" aria-label="Default select example" required>
            <option selected>Select Gender</option>
            @foreach(['Male', 'Female'] as $gender)
            <option value="{{ $gender }}" {{ @$item->gender == $gender ? 'selected' : '' }}>
                {{ $gender }}
            </option>
            @endforeach
        </select>
        <span class="text-danger">
            @error('gender')
            {{$message}}
            @enderror

        </span>
    </div>
    <div class="col-4 form-group">
        <label>Email *</label>
        <input type="email" name="email" class="form-control" placeholder="Enter Email" value="{{old('email',$item->email)}}" required>

        <span class="text-danger">
            @error('email')
            {{$message}}
            @enderror

        </span>
    </div>

</div>
<div class="row">
    <div class="col-4 form-group">
        <label>Alternative Email</label>
        <input type="email" name="alternative_email" class="form-control" placeholder="Enter alternative email" value="{{old('alternative_email',$item->alternative_email)}}">

        <span class="text-danger">
            @error('alternative_email')
            {{$message}}
            @enderror

        </span>
    </div>

    <div class="col-4 form-group">
        <label>Alternate Contact</label>
        <input type="number" name="alternative_mobile" class="form-control" placeholder="Enter Contact (10 digits)" value="{{old('alternate_mobile', $item->alternate_mobile)}}" pattern="[0-9]{10}" inputmode="numeric">

        <span class="text-danger">
            @error('alternate_mobile')
            {{$message}}
            @enderror

        </span>

    </div>



</div>