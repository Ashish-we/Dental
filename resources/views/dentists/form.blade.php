<div class="row">
    <div class="col-5 form-group">
        <label>Name *</label>

        <input type="text" name="name" class="form-control" placeholder="Enter Name" value="{{old('name', $user->name)}}" required>

        <span class="text-danger">
            @error('name')
            {{$message}}
            @enderror

        </span>

    </div>

    <div class="col-5 form-group">
        <label>Doctor Type *</label>
        <select class="form-control" name="type_id" aria-label="Default select example" required>
            <option value="">Doctor Type</option>
            @foreach($doctor_type as $doctor)
            <option value="{{ $doctor->id }}" {{ @$item->type_id == $doctor->id ? 'selected' : '' }}>
                {{ $doctor->title }}
            </option>
            @endforeach
            <!-- @foreach($doctor_type as $doctor)
    <option value="{{$doctor->id}}">{{$doctor->title}}</option>
    @endforeach -->
        </select>

    </div>
</div>
<div class="row">
    <div class="col-5 form-group">
        <label>Contact *</label>
        <input type="text" name="mobile" class="form-control" placeholder="Enter Contact (10 digits)" value="{{old('mobile', $user->mobile)}}" required pattern="[0-9]{10}" inputmode="numeric">

        <span class="text-danger">
            @error('mobile')
            {{$message}}
            @enderror

        </span>

    </div>

    <div class="col-5 form-group">
        <label>Alternate Contact</label>
        <input type="text" name="alternative_mobile" class="form-control" placeholder="Enter Contact (10 digits)" value="{{old('alternate_mobile', $user->alternate_mobile)}}" pattern="[0-9]{10}" inputmode="numeric">

        <span class="text-danger">
            @error('alternate_mobile')
            {{$message}}
            @enderror

        </span>

    </div>
</div>
<!-- <div class="form-group">
    <label>Age</label>
    <input type="number" name="age" class="form-control" placeholder="Enter Age" value="{{old('age', $item->age)}}">

    <span class="text-danger">
        @error('age')
        {{$message}}
        @enderror

    </span>

</div> -->
<div class="row">
    <div class="col-5 form-group">
        <label>Date of Birth</label>
        <input type="date" name="dob" class="form-control" placeholder="Enter Age" value="{{old('dob', $user->dob)}}">

        <span class="text-danger">
            @error('dob')
            {{$message}}
            @enderror

        </span>

    </div>


    <div class="col-5 form-group">
        <label>Qualification *</label>

        <input type="text" name="qualification" class="form-control" placeholder="Enter qualification" value="{{old('qualification', $item->qualification)}}" required>

        <span class="text-danger">
            @error('qualification')
            {{$message}}
            @enderror

        </span>



    </div>
</div>
<div class="col-4 form-group">
    <label>Gender *</label>
    <select class="form-control" name="gender" aria-label="Default select example" required>
        <option value="">Select Gender</option>
        @foreach(['Male', 'Female'] as $gender)
        <option value="{{ $gender }}" {{ @$user->gender == $gender ? 'selected' : '' }}>
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

<div class="row">
    <div class="col-5 form-group">
        <label>Speciality *</label>

        <input type="text" name="speciality" class="form-control" placeholder="Enter speciality" value="{{old('speciality', $item->speciality)}}" required>

        <span class="text-danger">
            @error('speciality')
            {{$message}}
            @enderror

        </span>



    </div>

    <div class="col-5 form-group">
        <label>Address *</label>
        <input type="text" name="address" class="form-control" placeholder="Enter Address" value="{{old('address',$user->address)}}" required>

        <span class="text-danger">
            @error('address')
            {{$message}}
            @enderror
        </span>

    </div>
</div>
<div class="row">
    <div class="col-5 form-group">
        <label>Email *</label>
        <input type="email" name="email" class="form-control" placeholder="Enter Email" value="{{old('email',$user->email)}}" required>

        <span class="text-danger">
            @error('email')
            {{$message}}
            @enderror

        </span>
    </div>

    <div class="col-5 form-group">
        <label>Alternate Email</label>
        <input type="email" name="alternative_email" class="form-control" placeholder="Enter alternative email" value="{{old('alternative_email',$user->alternative_email)}}">

        <span class="text-danger">
            @error('alternative_email')
            {{$message}}
            @enderror

        </span>
    </div>
</div>