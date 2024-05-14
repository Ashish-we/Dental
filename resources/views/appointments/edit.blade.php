@extends('templates.edit')

@section('form_content')

@include('appointments.form')

@if($isFollowUp)
<a href="{{route('followUps.edit', $item->id)}}" class="btn btn-primary">Edit FollowUP</a>
@else
<a href="{{route('followUps.create', $item->id)}}" class="btn btn-primary">Add FollowUP</a>
@endif

<a href="{{route('procedures.create', $item->id)}}" class="btn btn-primary">Add Procedure</a>

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