@if (auth()->user()->is_admin == 1)
    @extends('layouts.app')

    @section('content')
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-10">
                    <div class="card">
                        <div class="card-header">
                            <div class="row">
                                <div class="col col-md-8"><b>Topic List</b></div>
                                <div class="col col-md-4">
                                    <a href="{{ route('admin.home') }}" class="btn btn-success btn-sm float-end">Home</a>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-12 table-responsive">
                                    <table id="datatable-crud" class="display table table-bordered data-table">
                                        <thead>
                                            <tr>
                                                {{-- <th>#</th> --}}
                                                <th>Category</th>
                                                <th>Topics</th>
                                                <th>Action</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            {{-- @if (!empty($data) && $data->count())
                                        @foreach ($data as $row)
                                            <tr>
                                                <td>{{ $row->id }}</td>
                                                <td>{{ $row->category_name }}</td>
                                                <td>{{ $row->topic_name }}</td>
                                                <td>
                                                    <form method="POST" action="{{ route('course.destroy', $row->id) }}">
                                                        @method('DELETE')
                                                        @csrf
                                                        <a href="/edittopics/{{ $row->id }}"
                                                            class="btn btn-primary btn-sm">Edit</a>
                                                        <input name="_method" type="hidden" value="DELETE">
                                                        <button type="submit" class="btn btn-danger btn-sm deletebtn"
                                                            id="delete" value="{{ $row->id }}"
                                                            title='Delete'>Delete</button>
                                                    </form>
                                                </td>
                                            </tr>
                                        @endforeach
                                    @else
                                        <tr>
                                            <td colspan="5" class="text-center">No Data Found</td>
                                        </tr>
                                    @endif --}}
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
                fetchstudent();

                function fetchstudent() {

                    var table = $('.data-table').DataTable({
                        processing: true,
                        serverSide: true,
                        ajax: "{{ route('topics.index') }}",
                        columns: [
                            // { data: 'DT_RowIndex', name: 'DT_RowIndex' },
                            {
                                data: 'category_name',
                                name: 'category_name'
                            },
                            {
                                data: 'topic_name',
                                name: 'topic_name'
                            },
                            {
                                data: 'action',
                                name: 'action'
                            },
                            {
                                data: 'action1',
                                name: 'action1',
                                orderable: true,
                                searchable: true
                            },
                        ]
                    });
                }


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
                            url: "{{ url('deletetopics') }}" + '/' + id,
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

            });
        </script>
    @endsection
@endif
