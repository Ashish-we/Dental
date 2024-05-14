@extends('templates.index')

@section('index_content')

<table class="table table-bordered data-table">
    <thead class="table">
    <tr>
    <th>S.N.</th>
    <th>Patient Name</th>
    <th>Medical Condition</th>
    <th>Allergies</th>
    <th>Actions</th>
    </tr>
    </thead>
    <tbody>
    </tbody>
</table>
    
@endsection

@push('scripts')

<script type="text/javascript">

    $(function () {
      
      var table = $('.data-table').DataTable({

          processing: true,

          serverSide: true,

          ajax: "{{ route('medicalRecords.index') }}",

          columns: [

            {data: 'DT_RowIndex', name: 'id'},


              {data: 'patient_id', name: 'patient_id'},

              {data: 'medical_condition', name: 'mediacl_condition'},

              {data: 'allergies', name: 'allergies'},

              {data: 'action', name: 'action', orderable: false, searchable: false},
          ]
      });
      
    });
  </script>
    
@endpush