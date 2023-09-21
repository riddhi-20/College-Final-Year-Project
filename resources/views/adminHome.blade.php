@if (auth()->user()->is_admin == 1)
    @extends('layouts.app')

    @section('content')
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-10">
                    <div class="card">
                        <div class="card-header">{{ __('Dashboard') }}</div>

                        <div class="card-body">

                            @if (session('status'))
                                <div class="alert alert-success" role="alert">
                                    {{ session('status') }}
                                </div>
                            @endif

                            {{ __('Welcome Admin!') }}
                            <div class="row">
                                <div class="col-12 text-center">
                                    <div class="row justify-text-content">
                                        <div class="col-md-3 mt-2 mb-2">
                                            <button type="button" class="btn btn-warning" data-toggle="modal"
                                                data-target="#addTodoModal">Add Topic</button>
                                        </div>
                                        <div class="col-md-3 mt-2 mb-2">
                                            <a href="{{ route('questions.create') }}" class="btn btn-warning">Add
                                                Questions</a>

                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-12 text-center">
                                    <div class="row justify-text-content">
                                        <div class="col-md-3 mt-2 mb-2">
                                            <a href="{{ route('topics.index') }}" class="btn btn-primary">View All Topic</a>
                                        </div>
                                        <div class="col-md-3 mt-2 mb-2">
                                            <a href="{{ route('questions.index') }}" class="btn btn-primary">View All
                                                Questions</a>
                                        </div>
                                        <div class="col-md-3 mt-2 mb-2">
                                            <a href="{{ route('results.students') }}" class="btn btn-primary">View All
                                                Students</a>
                                        </div>
                                        <div class="col-md-3 mt-2 mb-2">                                            
                                            <a href="{{ url('http://localhost:8888/notebooks/big-five-traits-with-personality-labels.ipynb.ipynb') }}" target="_blank"> 
                                                <button type="button" class="btn btn-primary">
                                                    {{ __('Psychometric Assessment') }}
                                                </button></a>
                                        </div>
                                    </div>
                                </div>

                            </div>

                            <div class="row">
                                <iframe src="{{ url('../../pydata/personality.html') }}"  width="100%" height="600">Your browser isn't compatible</iframe>
                            </div>
                        </div>
                    </div>
                </div>
            </div>


            <div class="modal fade" id="addTodoModal" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">

                        <form name="add-blog-post-form" id="contactForm">
                            <div class="modal-header">
                                <h4 class="modal-title">Add Topics</h4>
                            </div>
                            <div class="modal-body">
                                <div class="form-group">
                                    <label for="name" class="col-sm-2">Category</label>
                                    <div class="col-sm-12">
                                        {{-- <label>
                                        <input type="radio" name="Category" id="Category" value="1"> Aptitude
                                    </label>
                                    <label>
                                        <input type="radio" name="Category" id="Category" value="2"> Technical
                                    </label> --}}

                                        @foreach ($category as $category)
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="radio" name="Category"
                                                    id="Category" value="{{ $category->id }}">
                                                <label class="form-check-label"
                                                    for="Category">{{ $category->category_name }}
                                                </label>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="name" class="col-sm-2">Topic</label>
                                    <div class="col-sm-12">
                                        <input type="text" class="form-control" id="Topic" name="Topic"
                                            placeholder="Enter Topic">
                                        <span id="TopicError" class="alert-message"></span>
                                    </div>
                                </div>

                            </div>
                            <div class="modal-footer">
                                <button type="submit" class="btn btn-primary" onclick="addTodo()">Save</button>
                            </div>

                        </form>
                    </div>
                </div>

            </div>

            <script>
                function addTodo() {
                    var Category = $("input[name='Category']:checked").val();
                    var Topic = $('#Topic').val();
                    let _url = `/addtopic`;
                    let _token = $('meta[name="csrf-token"]').attr('content');

                    $.ajax({
                        url: _url,
                        type: "POST",
                        data: {
                            Category: Category,
                            Topic: Topic,
                            _token: _token
                        },
                        success: function(data) {
                            $('#success-message').text(response.success);
                            $("#contactForm")[0].reset();
                            $('#addTodoModal').modal('hide');
                        },
                        error: function(response) {
                            $('CategoryError').text(response.responseJSON.errors.Category);
                            $('#TopicError').text(response.responseJSON.errors.Topic);
                        }
                    });
                }
            </script>

        </div>
    @endsection
@endif
