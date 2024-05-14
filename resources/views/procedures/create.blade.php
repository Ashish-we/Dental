@extends('templates.create')

@section('css')
<style>
    .container_ {
        display: flex;
        justify-content: space-around;
    }

    .blue-bg {
        background-color: blue !important;
        color: white !important;
    }

    .container_ div {
        width: 20px;
        height: 20px;
        border: 2px solid black;
        border-radius: 50%;
        display: flex;
        justify-content: center;
        align-items: center;
        font-size: 7px;
        padding-left: 0;
        padding-right: 0;
        margin-left: 0;
        margin-right: 0;
    }

    #tooth_form {
        display: none;
        position: fixed;
        width: 400px;
        height: 450px !important;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        right: 0;
        /* padding-top: 100px; */
        background-color: #f1f1f1;
        padding: 20px;
        border: 1px solid #ccc;
        z-index: 9999;
        height: 100%;
        box-shadow: 2px 2px 4px #000000;

    }
</style>
@stop


@section('form_content')


@include('procedures.form')

@section('js')
<script>
    var service_cost = "{{$service_cost}}";
    // console.log(service_cost);
    $(document).ready(function() {
        // Show dropdown on checkbox click
        $('.custom-control-input').click(function() {
            $(this).siblings('.dropdown').toggle(this.checked);
        });
    });

    function clear_tooth(id) {
        event.preventDefault();
        // console.log(id)
        var objectList = JSON.parse(localStorage.getItem('objectList')) || [];

        // Filter out the object with the given tooth_number
        objectList = objectList.filter(function(item) {
            return item.tooth_number !== id;
        });

        // Save the updated object list back to local storage
        localStorage.setItem('objectList', JSON.stringify(objectList));
        console.log(objectList);
        $('#tooth_form').hide();
        // $('#circle').removeClass('blue-bg');
        $('#' + id).removeClass('blue-bg');
        $('#cost').val(service_cost * objectList.length);
    }
    $(document).ready(function() {

        localStorage.removeItem('objectList');

    });
    // Function to handle form submission
    function add_tooth() {
        // Prevent the default form submission behavior
        event.preventDefault();
        // console.log("hello");
        // Get values from the form
        var tooth_number = $('#tooth_number').val();
        var type_id = $('#type_id').val();
        var condition = $('#condition').val();
        var notes = $('#notes').val();
        var selectedValues = [];
        $('.custom-control-input:checked').each(function() {
            var checkboxId = $(this).attr('id');
            var dropdownValue = $('#' + checkboxId).siblings('.dropdown').val();
            selectedValues.push(checkboxId + ':' + dropdownValue);
        });
        var dataString = selectedValues.join(',');
        // Create an object with the form values
        var object = {
            tooth_number: tooth_number,
            type_id: type_id,
            condition: dataString,
            notes: notes
        };

        // Get the object list from local storage or create an empty array
        var objectList = JSON.parse(localStorage.getItem('objectList')) || [];

        // Check if an object with the same tooth_number already exists
        var existingObjectIndex = objectList.findIndex(function(item) {
            return item.tooth_number === tooth_number;
        });

        if (existingObjectIndex !== -1) {
            // If an object with the same tooth_number exists, update it
            objectList[existingObjectIndex] = object;
        } else {
            // If not, add the current object to the list
            objectList.push(object);
        }

        // Save the updated object list back to local storage
        localStorage.setItem('objectList', JSON.stringify(objectList));

        // Hide the form after submission
        $('#tooth_form').hide();
        $('#' + tooth_number).addClass('blue-bg');
        // Clear the form fields
        clearFormFields();
        console.log(objectList.length);

        $('#cost').val(service_cost * objectList.length);
        // console.log("Form submitted:", object);
        // console.log("Object list:", objectList);
    };

    // // Function to send the object list to the backend
    // function sendObjectListToBackend(objectList) {
    //     // Here, you would implement the code to send the objectList to the backend,
    //     // for example, using AJAX or fetch API
    //     // Replace this with your actual backend endpoint and data sending logic
    //     console.log("Sending object list to backend:", objectList);
    // }

    // Function to clear form fields
    function clearFormFields() {
        $('#tooth_number').val('');
        $('#type_id').val('');
        $('#condition').val('');
        $('#notes').val('');
        $('.custom-control-input').prop('checked', false).siblings('.dropdown').hide();
    }

    // Function to populate form fields based on stored data

    // });


    function popup(id) {
        // Clear the form fields before populating with new data
        clearFormFields();
        // Set the tooth number
        $('#tooth_number').val(id);
        console.log(id);
        // Get the object list from local storage
        var objectList = JSON.parse(localStorage.getItem('objectList')) || [];

        // Loop through the object list
        $.each(objectList, function(index, item) {
            // Check if the tooth number matches the provided ID
            if (item.tooth_number === id) {
                // Populate form fields with data from the matching object
                $('#type_id').val(item.type_id);
                $('#condition').val(item.condition);
                $('#notes').val(item.notes);
                var dataStringFromBackend = item.condition; // Sample data from backend
                var selectedData = dataStringFromBackend.split(',');
                selectedData.forEach(function(item) {
                    var pair = item.split(':');
                    var checkboxId = pair[0];
                    var dropdownValue = pair[1];
                    $('#' + checkboxId).prop('checked', true).siblings('.dropdown').show().val(dropdownValue);
                });
            }
        });

        // Show the form
        $('#tooth_form').show();


    }

    //main form handiling

    $('#form').submit(function(event) {
        // console.log("hello");
        var csrfToken = $('meta[name="csrf-token"]').attr('content');
        // Prevent the default form submission behavior
        event.preventDefault();
        var objectList = JSON.parse(localStorage.getItem('objectList')) || [];
        console.log(objectList);
        var fileInput = document.getElementById('documents');
        // Create a FormData object
        var formData = new FormData();
        formData.append('documents', fileInput.files[0]);
        // formData.append('name', $("#name").val());
        formData.append('appointment_id', $("#appointment_id").val());
        formData.append('patient_id', $("#patient_id").val());
        formData.append('service_id', $("#service_id").val());
        formData.append('condition', $("#condition_").val());
        formData.append('cost', $("#cost").val());
        objectList.forEach(function(item, index) {
            formData.append('tooth_list[' + index + ']', JSON.stringify(item));
        });


        var csrfToken = $('meta[name="csrf-token"]').attr('content');
        // var tests = [];
        // var items = $('#title');
        var route = "{{ route('procedures.store') }}"
        $.ajax({
            url: route,
            type: "POST",
            headers: {
                'X-CSRF-TOKEN': csrfToken,
            },
            data: formData,
            processData: false, // Prevent jQuery from processing data
            contentType: false, // Pr
            cache: false,
            success: function(data, status) {
                // Handle success
                window.location.replace("{{ route('procedures.index') }}");
                localStorage.removeItem('objectList');
                alert("Successfully Addded!");
                window.location.replace('/procedures');
            },
            error: function(xhr, status, error) {
                // Handle error
                console.error(xhr.responseText);
                alert("Error occurred. Please try again later.");
            }
        })
        // $.post(route, {
        //         name: $("#name").val(),
        //         appointment_id: $("#appointment_id").val(),
        //         patient_id: $("#patient_id").val(),
        //         service_id: $("#service_id").val(),
        //         condition: $("#condition_").val(),
        //         documents: formData,
        //         cost: $('#cost').val(),
        //         tooth_list: objectList,
        //         _token: "{{ csrf_token() }}",
        //         // tests: tests,

        //     },
        //     function(data, status) {
        //         localStorage.removeItem('objectList');
        //         alert("Successfully Addded!");
        //         location.reload();
        //     });
        // }

    });
</script>
@endsection


@endsection