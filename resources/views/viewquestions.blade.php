@if (auth()->user()->is_admin == 1)
    @extends('layouts.app')

    @section('content')
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-10">
                    <div class="card">
                        <div class="card-header">
                            <div class="row">
                                <div class="col col-md-8"><b>Question List</b></div>
                                <div class="col col-md-4">
                                    <a href="{{ route('admin.home') }}" class="btn btn-success btn-sm float-end">Home</a>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-12 table-responsive">
                                    <table class="display table table-bordered data-table">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>Topics</th>
                                                <th>Question</th>
                                                <th>Option A</th>
                                                <th>Option B</th>
                                                <th>Option C</th>
                                                <th>Option D</th>
                                                <th>Correct Ans</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @if (!empty($data) && $data->count())
                                                @foreach ($data as $row)
                                                    <tr>
                                                        <td>{{ $row->id }}</td>
                                                        <td>{{ $row->topic_name }}</td>
                                                        @if($row->is_img == 0)
                                                        <td>{{ $row->question }}</td>
                                                        <td>{{ $row->optionA }}</td>
                                                        <td>{{ $row->optionB }}</td>
                                                        <td>{{ $row->optionC }}</td>
                                                        <td>{{ $row->optionD }}</td>
                                                        @else
                                                        <td>{{ $row->question }}
                                                            @if(isset($row->quesimg))
                                                            <img src="{{ url('assets/CRTimage/'.$row->quesimg ) }}"
                                                            style="height: 100px; width: 150px;">
                                                            @endif
                                                        </td>
                                                        <td>{{ $row->optionA }}
                                                            @if(isset($row->optAimg))
                                                            <img src="{{ url('assets/CRTimage/'.$row->optAimg ) }}"
                                                            style="height: 100px; width: 150px;">
                                                            @endif
                                                        </td>
                                                        <td>{{ $row->optionB }}
                                                            @if(isset($row->optBimg))
                                                            <img src="{{ url('assets/CRTimage/'.$row->optBimg ) }}"
                                                            style="height: 100px; width: 150px;">
                                                            @endif
                                                        </td>
                                                        <td>{{ $row->optionC }}
                                                            @if(isset($row->optCimg))
                                                            <img src="{{ url('assets/CRTimage/'.$row->optCimg ) }}"
                                                            style="height: 100px; width: 150px;">
                                                            @endif
                                                        </td>
                                                        <td>{{ $row->optionD }}
                                                            @if(isset($row->optDimg))
                                                            <img src="{{ url('assets/CRTimage/'.$row->optDimg ) }}"
                                                            style="height: 100px; width: 150px;">
                                                            @endif
                                                        </td>
                                                        @endif
                                                        <td>{{ $row->correctAns }}</td>
                                                        <td>
                                                            <a href="/editquestions/{{ $row->id }}"
                                                                class="btn btn-primary btn-sm">Edit</a>
                                                            <a href="javascript:void(0)" data-toggle="tooltip"  data-id="{{ $row->id }}" class="btn btn-danger btn-sm delete">Delete</a>
                                                            {{-- <form method="POST"
                                                                action="{{ route('questions.destroy', $row->id) }}">
                                                                @method('DELETE')
                                                                @csrf
                                                                <a href="/editquestions/{{ $row->id }}"
                                                                    class="btn btn-primary btn-sm">Edit</a>
                                                                <input name="_method" type="hidden" value="DELETE">
                                                                <button type="submit" class="btn btn-danger btn-sm"
                                                                    id="delete" value="{{ $row->id }}"
                                                                    title='Delete'>Delete</button>
                                                            </form> --}}
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            @endif
                                        </tbody>
                                    </table>
                                    {{-- {!! $data->links() !!} --}}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <script type="text/javascript">

        $(document).ready(function() {
            $('.data-table').DataTable();
        });
            // $(function() {

            //     var table = $('.data-table').DataTable({
            //         processing: true,
            //         serverSide: true,
            //         ajax: "{{ route('questions.index') }}",
            //         columns: [{ data: 'DT_RowIndex', name: 'DT_RowIndex' },
            //             { data: 'topic_name', name: 'topic_name' },
            //             { data: 'question', name: 'question'},
            //             { data: 'optionA', name: 'optionA' },
            //             { data: 'optionB', name: 'optionB' },
            //             { data: 'optionC', name: 'optionC' },
            //             { data: 'optionD', name: 'optionD' },
            //             { data: 'correctAns', name: 'correctAns' },
            //             { data: 'action', name: 'action', orderable: false, searchable: false  },
            //         ]
            //     });
            // });

            $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });

                $('body').on('click', '.delete', function(e) {
                    e.preventDefault();
                    var id = $(this).data("id");
                    var result = confirm("Are You sure want to delete !");

                    if (result) {
                        $.ajax({
                            type: "DELETE",
                            url: "{{ url('viewquestions') }}" + '/' + id,
                            success: function(data) {
                                // window.location.href=window.location.href;
                                setInterval('location.reload()', 1500);
                            },
                            error: function(data) {
                                console.log('Error:', data);
                            }
                        });
                    } else {
                        return false;
                    }
                });
        </script>
    @endsection
@endif
