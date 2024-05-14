@extends('templates.show')

@section('form_content')
<div>
    <h1>Title : {{$item->title}}</h1>
    <br>
    <h2>Category : {{$item->serviceCategory->title}}</h2>
    <br>
    <h3>Treatment Type: {{$item->treatment_type}}</h3>
    <br>
    <h4>Cost : {{$item->price}}</h4>
</div>
@endsection