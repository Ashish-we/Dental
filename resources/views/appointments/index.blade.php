@extends('templates.index')

@section('index_content')
<table class="table table-bordered data-table">
    <thead class="table">
        <tr>
            <th>S.N.</th>
            <!-- <th>Title</th> -->
            <th>Patient Name</th>
            <th>Dentist Name</th>
            <th>Date/Time</th>
            <!-- <th>Purpose To Visit</th> -->
            <th>Services</th>
            <th>Status</th>
            <!-- <th>Notes</th> -->
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

            ajax: "{{ route('appointments.index') }}",

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
                    data: 'dentist_id',
                    name: 'dentist_id'
                },

                {
                    data: 'date',
                    name: 'date'
                },

                {
                    data: 'service_id',
                    name: 'service_id'
                },

                {
                    data: 'status',
                    name: 'status'
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