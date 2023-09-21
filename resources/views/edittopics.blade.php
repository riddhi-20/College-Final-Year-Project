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
                                <div class="col col-md-8"><b>Edit Topic Details</b></div>
                                <div class="col col-md-4">
                                    <a href="{{ route('admin.home') }}" class="btn btn-success btn-sm float-end">Home</a>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            @foreach ($data as $row)
                                <form method="POST" action="{{ route('topics.update', $row->id) }}">
                                    @csrf
                                    @method('PUT')
                                    <div class="form-group">
                                        <label for="email">Category Name:</label>

                                        @foreach ($category_all as $category)
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="radio" name="category_id"
                                                    id="inlineRadio1"
                                                    @if ($row->category_id == $category->id) checked value="{{ $category->id }}"
                                    @else value="{{ $category->id }}" @endif>
                                                <label class="form-check-label"
                                                    for="inlineRadio2">{{ $category->category_name }}
                                                </label>
                                            </div>
                                        @endforeach
                                    </div>
                                    <div class="form-group">
                                        <label for="topic">Topic:</label>
                                        <input type="text" class="form-control" id="topic_name" name="topic_name"
                                            value='<?php echo $row->topic_name; ?>' />
                                    </div>
                                    <button type="submit" class="btn btn-primary" id="butsave">Submit</button>
                                </form>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endsection
@endif
