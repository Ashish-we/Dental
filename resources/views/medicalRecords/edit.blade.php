@extends('templates.edit')

@section('form_content')

@include('medicalRecords.form')


@endsection

@push('scripts')
    <script>
        $(document).ready(function() {
            $('#patient').select2();
        });
    </script>
@endpush
