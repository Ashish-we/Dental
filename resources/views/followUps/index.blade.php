@extends('templates.index')

@section('index_content')
<table class="table table-bordered data-table">
    <thead class="table">
        <tr>
            <th>S.N.</th>
            <th>Dentist Name</th>
            <th>Appointment</th>
            <th>Date</th>
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

            ajax: "{{ route('followUps.index') }}",

            columns: [

                {
                    data: 'DT_RowIndex',
                    name: 'id'
                },

                {
                    data: 'dentist_id',
                    name: 'dentist_id'
                },

                {
                    data: 'appointment_id',
                    name: 'appointment_id'
                },

                {
                    data: 'date',
                    name: 'date',
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