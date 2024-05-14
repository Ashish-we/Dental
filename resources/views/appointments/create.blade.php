@extends('templates.create')

@section('form_content')
    @include('appointments.form')
@endsection


@push('scripts')
    <script>
        $(document).ready(function() {
            $('#dentist').select2();
            $('#patient').select2();
            $('#service').select2();
            $('#status').select2();



        });


    </script>
@endpush
