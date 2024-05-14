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
        <input type="text" name="phone" class="form-control" placeholder="Enter Contact (10 digits)" value="{{old('phone', $item->phone)}}" required pattern="[0-9]{10}" inputmode="numeric">

        <span class="text-danger">
            @error('phone')
            {{$message}}
            @enderror

        </span>

    </div>
</div>
<div class="row">
    <div class="col-4 form-group">
        <label>Alternate Contact</label>
        <input type="text" name="alternate_phone" class="form-control" placeholder="Enter Contact (10 digits)" value="{{old('alternate_phone', $item->alternate_phone)}}" pattern="[0-9]{10}" inputmode="numeric">

        <span class="text-danger">
            @error('alternate_phone')
            {{$message}}
            @enderror

        </span>

    </div>

    <div class="col-4 form-group">
        <label>Age *</label>
        <input type="number" name="age" class="form-control" placeholder="Enter Age" value="{{old('age', $item->age)}}" required>

        <span class="text-danger">
            @error('age')
            {{$message}}
            @enderror

        </span>

    </div>
</div>
<div class="row">
    <div class="col-4 form-group">
        <label>Gender *</label>
        <select class="form-control" name="gender" aria-label="Default select example" required>
            <option value="">Select Gender</option>
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
        <label>Title</label>
        <input type="text" name="title" class="form-control" placeholder="Mr, Mrs ....." value="{{old('title', $item->title)}}">

        <span class="text-danger">
            @error('title')
            {{$message}}
            @enderror

        </span>

    </div>
</div>
<div class="row">
    <div class="col-4 form-group">
        <label>Occupation</label>

        <input type="text" name="occupation" class="form-control" placeholder="Enter occupation" value="{{old('occupation', $item->occupation)}}">

        <span class="text-danger">
            @error('name')
            {{$message}}
            @enderror

        </span>



    </div>

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
        <label>Email</label>
        <input type="email" name="email" class="form-control" placeholder="Enter Email" value="{{old('email',$item->email)}}">

        <span class="text-danger">
            @error('email')
            {{$message}}
            @enderror

        </span>
    </div>
</div>