@extends('adminlte::page')

@section('title', $title)

@section('css')
@stack('styles')
@stop

@section('js')
@stack('scripts')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    $(document).on('click', '.trashBtn', function(e) {
        e.preventDefault();
        Swal.fire({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
            if (result.isConfirmed) {
                $(this).parent().submit();
            }
        });
    });

    $(document).on('click', '.offerTrashBtn', function(e) {
        e.preventDefault();
        Swal.fire({
            title: 'Are you sure?',
            text: "Offers for all the product of this Offer Schedules will be removed.",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
            if (result.isConfirmed) {
                $(this).parent().submit();
            }
        });
    });
</script>

<script>
    setTimeout(function() {
        document.getElementById('alertDiv').style.display = 'none';
    }, 3000);
</script>
@stop


@section('content')
@if (session('success'))
<div class="alert alert-success alert-block" id="alertDiv">
    <button type="button" class="close" data-dismiss="alert">×</button>
    {{ session('success') }}
</div>
@endif
<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">{{ $title }}</h3>
                        @if ($isAdd)
                        <a href="{{ route($route . 'create') }}" class="btn btn-primary float-right">
                            <i class="fa fa-plus"></i>
                            <span class="kt-hidden-mobile">Add new</span>
                        </a>
                        @elseif(isset($attendanceCreate))
                        <a href="{{ route($route . 'create') }}" class="btn btn-primary float-right">
                            <i class="fa fa-plus"></i>
                            <span class="kt-hidden-mobile">Mark Attendance</span>
                        </a>
                        @endif
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        @yield('index_content')
                    </div>
                    <!-- /.card-body -->
                </div>
                <!-- /.card -->
            </div>
        </div>
        <!-- /.row -->
    </div>
    <!-- /.container-fluid -->
</section>
@endsection