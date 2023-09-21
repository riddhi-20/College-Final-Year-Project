@if (auth()->user()->is_admin == 1)
    @extends('layouts.app')

    @section('content')

        <meta name="csrf-token" content="{{ csrf_token() }}">


        <link href="https://cdn.datatables.net/buttons/1.6.2/css/buttons.dataTables.min.css" />
        <script src="https://cdn.datatables.net/buttons/1.6.2/js/dataTables.buttons.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
        <script src="https://cdn.datatables.net/buttons/1.6.2/js/buttons.html5.min.js"></script>

        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-10">
                    <div class="card">
                        <div class="card-header">
                            <div class="row">
                                <div class="col col-md-8"><b>Registered Students</b></div>
                                <div class="col col-md-4">
                                    <a href="{{ route('admin.home') }}" class="btn btn-success btn-sm float-end">Home</a>
                                </div>
                            </div>
                        </div>

                        <div class="card-body">
                            <div class="row">
                                <div class="col-12 table-responsive">
                                    <table id="example" class="display table table-bordered data-table">
                                        <thead>
                                            <tr>
                                                {{-- <th>#</th> --}}
                                                <th>Name</th>
                                                <th>Reg Date</th>
                                                <th>Email Id</th>
                                                <th>College Name</th>
                                                <th>Branch Name</th>
                                                @foreach ($topic_all as $titles)
                                                    <th>{{ $titles->topic_name }}</th>
                                                @endforeach
                                            </tr>
                                            {{-- <tr>
                                                @foreach ($topic_all as $titles)
                                                    <th>Total Questions</th>
                                                    <th>Correct Answers</th>
                                                @endforeach
                                            </tr> --}}
                                        </thead>
                                        <tbody>

                                            @if (!empty($users_all) && $users_all->count())
                                                @foreach ($users_all as $row)
                                                    <tr>
                                                        <td>{{ $row->name }}</td>
                                                        <td>{{ date('d/M/Y', strtotime($row->created_at)) }}</td>
                                                        <td>{{ $row->email }}</td>
                                                        <td>{{ $row->collegename }}</td>
                                                        <td>{{ $row->branchname }}</td>
                                                        {{-- <td>
                                                            <form method="POST"
                                                                action="{{ route('results.details', ['id' => $row->id]) }}">
                                                                @csrf
                                                                <button type="submit" class="btn btn-danger btn-sm"
                                                                    id="delete" value="{{ $row->id }}"
                                                                    title='Delete'>Details</button>
                                                            </form>
                                                        </td> --}}

                                                        {{-- @dd($result_data); --}}
                                                        @foreach ($result_data[$row->id] as $result)
                                                            @if (!empty($result->topics_id))
                                                                <td>Total : <span
                                                                        style="color:red;font-weight:bold;">{{ $result->total_ques }}</span> &nbsp;
                                                                Correct : <span
                                                                        style="color:green;font-weight:bold;">{{ $result->total_corr_ans }}</span>
                                                                </td>
                                                            @else
                                                                <td> NA </td>
                                                            @endif
                                                        @endforeach

                                                    </tr>
                                                @endforeach
                                            @endif
                                        </tbody>
                                    </table>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <script>
            $(document).ready(function() {
                var to_replace = "";
                $('#example').DataTable({
                    dom: "Blfrtip",
                    buttons: [{
                        text: 'pdf',
                        extend: 'pdfHtml5',
                        orientation: 'landscape',
                        exportOptions: {
                            columns: ':visible'
                        }
                    },
                    {
                        text: 'excel',
                        extend: 'excelHtml5',

                    }, ],
                });
            });
        </script>
        {{-- <script type="text/javascript">
            $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
            });

            $(function() {

                var table = $('.data-table').DataTable({
                    dom: "Blfrtip",
                    buttons: [{ text: 'excel', extend: 'excelHtml5', },
                        { text: 'pdf', extend: 'pdfHtml5', },],
                    processing: true,
                    serverSide: true,
                    ajax: "{{ route('results.students') }}",
                    columns: [{ data: 'DT_RowIndex', name: 'DT_RowIndex' },
                        { data: 'name', name: 'name' },
                        { data: 'created_at', name: 'created_at'},
                        { data: 'email', name: 'email' },
                        { data: 'collegename', name: 'collegename' },
                        { data: 'branchname', name: 'branchname' },
                        { data: 'total_test', name: 'total_test' },
                        { data: 'total_topics', name: 'total_topics' },
                        { data: 'action', name: 'action', orderable: false, searchable: false  },
                    ]
                });


            });
        </script> --}}
    @endsection
@endif
