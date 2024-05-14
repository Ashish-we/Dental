@extends('templates.index')

@section('index_content')

<table class="table table-bordered data-table">
  <thead class="table">
    <tr>
      <th>S.N.</th>
      <th>Patient Name</th>
      <th>Tooth Number</th>
      <th>Cost</th>
      <th>Notes / Description</th>
      <th>Actions</th>
    </tr>
  </thead>
  <tbody>
  </tbody>
</table>

@endsection

@push('scripts')

<script type="text/javascript">
  $(function() {

    var table = $('.data-table').DataTable({

      processing: true,

      serverSide: true,

      ajax: "{{ route('procedures.index') }}",

      columns: [

        {
          data: 'DT_RowIndex',
          name: 'id'
        },

        {
          data: 'patient_id',
          name: 'patient_id'
        },

        {
          data: 'teeth_id',
          name: 'teeth_id'
        },

        {
          data: 'cost',
          name: 'cost'
        },

        {
          data: 'condition',
          name: 'condition'
        },

        {
          data: 'action',
          name: 'action',
          orderable: false,
          searchable: false
        },
      ]
    });

  });
</script>

@endpush