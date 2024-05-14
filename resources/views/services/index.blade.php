@extends('templates.index')

@section('index_content')

<table class="table table-bordered data-table">
  <thead class="table">
    <tr>
      <th>S.N.</th>
      <th>Title</th>
      <th>Category id</th>
      <th>Price (NRS)</th>
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

      ajax: "{{ route('services.index') }}",

      columns: [

        {
          data: 'DT_RowIndex',
          name: 'id'
        },

        {
          data: 'title',
          name: 'title'
        },

        {
          data: 'category_id',
          name: 'category_id'
        },

        {
          data: 'price',
          name: 'price'
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