@extends('templates.index')

@section('index_content')

<table class="table table-bordered data-table">
  <thead class="table">
    <tr>
      <th>S.N.</th>
      <th>Name</th>
      <th>Contact</th>
      <th>Address</th>
      <th>Email</th>
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

      ajax: "{{ route('dentists.index') }}",

      columns: [

        {
          data: 'DT_RowIndex',
          name: 'id'
        },

        {
          data: 'name',
          name: 'name'
        },

        {
          data: 'mobile',
          name: 'mobile'
        },

        {
          data: 'address',
          name: 'address'
        },

        {
          data: 'email',
          name: 'email'
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