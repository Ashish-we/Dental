@extends('templates.index')

@section('index_content')

<table class="table table-bordered data-table">
  <thead class="table">
    <tr>
      <th>S.N.</th>
      <th>Title</th>
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

      ajax: "{{ route('serviceCategories.index') }}",

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