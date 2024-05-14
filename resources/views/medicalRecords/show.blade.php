@extends('templates.show')

@section('form_content')
<div>
    <h1>Patient Name : {{$item->patient->name}}</h1>
    <br>
    <h2>Mediacl Condition : {{$item->medical_condition}}</h2>
    <br>
    <h3>Allergies : {{$item->allergies}}</h3>
</div>
@endsection