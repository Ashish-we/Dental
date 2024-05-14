@extends('adminlte::page')

@section('content')
<div class="container">
    <div class="card">
        <div class="card-header">
            <h3>Edit Profile</h3>
        </div>
        <div class="card-body">
            @if(session('success'))
            <div class="alert alert-success" id="successAlert">
                {{ session('success') }}
            </div>
            @endif

            <script>
                // Set timeout to hide the alert after 5 seconds
                setTimeout(function() {
                    var successAlert = document.getElementById('successAlert');
                    if (successAlert) {
                        successAlert.style.display = 'none';
                    }
                }, 5000); // 5000 milliseconds = 5 seconds
            </script>

            <form method="post" action="{{ route('profile.update') }}" enctype="multipart/form-data">
                @csrf
                @method('put')
                <div class="row">
                    <div class="col-5 mb-3">
                        <label for="name" class="form-label">Name *</label>
                        <input type="text" class="form-control" name="name" value="{{ old('name', $user->name) }}" required>
                        @error('name')
                        <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-5 mb-3">
                        <label for="email" class="form-label">Email *</label>
                        <input type="email" class="form-control" name="email" value="{{ old('email', $user->email) }}" required>
                        @error('email')
                        <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="row">
                    <div class="col-4 form-group">
                        <label>Address *</label>
                        <input type="text" name="address" class="form-control" placeholder="Enter Address" value="{{old('address',$user->address)}}" required>

                        <span class="text-danger">
                            @error('address')
                            {{$message}}
                            @enderror
                        </span>

                    </div>
                    <div class="col-4 form-group">
                        <label>Date of Birth</label>
                        <input type="date" name="dob" class="form-control" placeholder="Enter Age" value="{{old('dob', $user->dob)}}">

                        <span class="text-danger">
                            @error('dob')
                            {{$message}}
                            @enderror

                        </span>

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

                </div>
                <!-- <div class="row">
                    <div class="col-5 mb-3">
                        <label for="password" class="form-label">Password:</label>
                        <input type="password" class="form-control" name="password">
                        @error('password')
                        <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-5 mb-3">
                        <label for="password_confirmation" class="form-label">Confirm Password:</label>
                        <input type="password" class="form-control" name="password_confirmation">
                        @error('password_confirmation')
                        <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div> -->
                <div class="mb-3">
                    <label for="mobile" class="form-label">Phone *</label>
                    <input type="text" class="form-control" placeholder="Enter contact (10 digits)" name="mobile" value="{{ old('mobile', $user->mobile) }}" required pattern="[0-9]{10}" inputmode="numeric"> @error('mobile')
                    <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="row">
                    <div class="col-4 form-group">
                        <label>Alternative Email</label>
                        <input type="email" name="alternative_email" class="form-control" placeholder="Enter alternative email" value="{{old('alternative_email',$user->alternative_email)}}">

                        <span class="text-danger">
                            @error('alternative_email')
                            {{$message}}
                            @enderror

                        </span>
                    </div>

                    <div class="col-4 form-group">
                        <label>Alternate Contact</label>
                        <input type="string" name="alternative_mobile" class="form-control" placeholder="Enter Contact (10 digits)" value="{{old('alternate_mobile', $user->alternate_mobile)}}" pattern="[0-9]{10}" inputmode="numeric">

                        <span class="text-danger">
                            @error('alternate_mobile')
                            {{$message}}
                            @enderror

                        </span>

                    </div>



                </div>
                @if(auth()->user()->hasRole('dentist'))
                <div class="row">
                    <div class="col-5 form-group">
                        <label>Qualification *</label>

                        <input type="text" name="qualification" class="form-control" placeholder="Enter qualification" value="{{old('qualification', $data->qualification)}}" required>

                        <span class="text-danger">
                            @error('qualification')
                            {{$message}}
                            @enderror

                        </span>



                    </div>
                    <div class="col-5 form-group">
                        <label>Speciality *</label>

                        <input type="text" name="speciality" class="form-control" placeholder="Enter speciality" value="{{old('speciality', $data->speciality)}}" required>

                        <span class="text-danger">
                            @error('speciality')
                            {{$message}}
                            @enderror

                        </span>



                    </div>
                </div>
                @endif

                <button type="submit" class="btn btn-primary">Update Profile</button>
            </form>
        </div>
    </div>
</div>
@endsection