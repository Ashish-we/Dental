@extends('templates.show')
@section('form_content')

<!-- <div class="card-title"></div>
    <div class="card-body">

        <div class="d-flex justify-content-end">
            <button type="button" class="btn btn-secondary m-2" id="addForm">+Add</button>
        </div>


        <form id="form">
            <div class="d-flex justify-content-between">
                <div>
                    <label>Name</label>
                    <input type="text" class="form-control">
                </div>
                <div class="align-self-end">
                    <button type="button" class="btn btn-danger m-2 removeFormBtn">Remove</button>
                </div>
            </div>
        </form>


        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>

        <script>
            $(document).ready(function () {
                $('#addForm').click(function () {
                    $('#form').append(
                        `
            <div class="d-flex justify-content-between">
                <div>
                    <label>Name</label>
                    <input type="text" class="form-control">
                </div>
                <div class="align-self-end">
                    <button type="button" class="btn btn-danger removeFormBtn m-2">Remove</button>
                </div>
            </div>
                        `
                    );
                });


                // $('.removeFormBtn').click(function () {
                //     console.log($(this));
                //     $(this).parent().parent().remove();
                // });

                $(document).on('click', '.removeFormBtn', function(){
                        $(this).parent().parent().remove();
                })
            });
        </script>

    </div> -->

<div class="row">
    <div class="col-8">
        <h1>Patient : {{$patient->name}}</h1>
        <br>
        <h2>Chief complaint : {{$item->chief_complaint}}</h2>
        <br>
        <h3>Service : {{$service->title}} ({{$service->serviceCategory->title}})</h3>
        <br>
        <h4>Condition : {{$item->condition}}</h4>
        <br>
        <h5>Status : {{$item->status}}</h5>
        <br>
        <h5>Dentist : {{$dentist->name}}</h5>
        <br>
        @if($item->notes)
        <h5>{{$item->notes}}</h5>
        <br>
        @endif

        <h5>Date : {{$item->date}}</h5>
    </div>
    @if($item->followUp)
    <div class="col-4">
        <h1>FollowUp</h1>
        <br>
        <h2>Date : {{$item->followUp->date}}</h2>
        <br>
        <h3>Dentist : {{$item->followUp->dentist->name}}</h3>
    </div>
    @endif
</div>
@endsection