@extends('adminlte::page')

@section('content')
<div class="container">
    <div class="card">
        <div class="card-header">
            <h3>Change Password</h3>
        </div>
        <div class="card-body">
            @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
            @endif

            <form method="post" action="{{ route('password.update') }}" >
                @csrf
                @method('put')
                <div class="col-5 mb-3">
                    <label for="password" class="form-label">Old Password:</label>
                    <input type="password" class="form-control" name="old_password" required>
                    @error('old_password')
                    <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="col-5 mb-3">
                    <label for="password" class="form-label">New Password:</label>
                    <input type="password" class="form-control" name="password" required>
                    @error('password')
                    <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-5 mb-3">
                    <label for="password_confirmation" class="form-label">Confirm Password:</label>
                    <input type="password" class="form-control" name="password_confirmation" required>
                    @error('password_confirmation')
                    <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
                <button type="submit" class="btn btn-primary">Update Password</button>
            </form>
        </div>
    </div>
</div>
@endsection