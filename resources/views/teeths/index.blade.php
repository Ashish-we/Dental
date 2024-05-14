@extends('templates.index')

@section('index_content')
    <table class="table table-bordered data-table">
        <thead class="table table-dark">
            <tr>
                <th>S.N.</th>
                <th>Patient Name</th>
                <th>Types</th>
                <th>Tooth Number</th>
                <th>X-Ray</th>
                <th>Condition</th>
                <th>Notes</th>
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

                // ajax: "{{ route('teeths.index') }}",

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
                        data: 'type_id',
                        name: 'type_id'
                    },

                    {
                        data: 'tooth_number',
                        name: 'tooth_number'
                    },


                    {
                        data: 'image',
                        name: 'image',
                        render: function(data, type, row) {
                            if (data) {
                                return '<img src="' + data +
                                    '" alt="Image" width="50" height="50">';
                            }
                        },
                    },

                    // {data: 'x_ray', name: 'x_ray'},

                    {
                        data: 'condition', name: 'condition'
                    },

                    
                    {
                        data: 'notes', name: 'notes'
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
