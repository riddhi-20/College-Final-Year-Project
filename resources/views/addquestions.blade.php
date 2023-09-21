@if (auth()->user()->is_admin == 1)
    @extends('layouts.app')

    @section('content')
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-10">
                    <div class="card">
                        <div class="card-header">
                            <div class="row">
                                <div class="col col-md-8"><b>Add Questions</b></div>
                                <div class="col col-md-4">
                                    <a href="{{ route('admin.home') }}" class="btn btn-success btn-sm float-end">Home</a>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <form id="contactForm" method="post" action="{{ route('questions.store') }}" enctype="multipart/form-data">
                                @csrf
                                <div class="row">
                                    <div class="form-group mb-3 col-md-6">
                                        <label for="category-dropdown">{{ trans('Category') }}</label>
                                        <select id="category-dropdown" class="form-control">
                                            <option value="" disabled selected>-- Select Category --</option>
                                            @foreach ($category as $data)
                                                <option value="{{ $data->id }}">
                                                    {{ $data->category_name }}
                                                </option>
                                            @endforeach
                                        </select>
                                        @if ($errors->has('category-dropdown'))
                                            <div class="invalid-feedback">
                                                {{ $errors->first('category-dropdown') }}
                                            </div>
                                        @endif
                                    </div>
                                    <div class="form-group mb-3 col-md-6">
                                        <label for="topics-dropdown">{{ trans('Topic') }}</label>
                                        <select id="topics-dropdown" name="topics_id" class="form-control">
                                        </select>
                                        @if ($errors->has('topics-dropdown'))
                                            <div class="invalid-feedback">
                                                {{ $errors->first('topics-dropdown') }}
                                            </div>
                                        @endif
                                    </div>
                                </div>

                                <div class="form-group" id="question">
                                    <label for="question">{{ trans('Question') }}</label>
                                    <input class="form-control  {{ $errors->has('question') ? 'is-invalid' : '' }}"
                                        type="text" name="question" id="question" value="{{ old('question') }}">
                                    @if ($errors->has('question'))
                                        <div class="invalid-feedback">
                                            {{ $errors->first('question') }}
                                        </div>
                                    @endif
                                </div>
                                <div class="form-group" id="quesimg">
                                    <label for="quesimg">{{ trans('Image Question') }}</label>
                                    <input type="file" class="form-control" id="quesimg" name="quesimg" accept = 'image/jpeg , image/jpg, image/bmp, image/png, image/svg, image/webp'/>

                                    @if ($errors->has('quesimg'))
                                        <div class="invalid-feedback">
                                            {{ $errors->first('quesimg') }}
                                        </div>
                                    @endif
                                </div>

                                <div class="row">
                                    <div class="form-group col-md-6">
                                        <label for="optionA">{{ trans('Option A') }}</label>
                                        <input class="form-control  {{ $errors->has('optionA') ? 'is-invalid' : '' }}"
                                            type="text" name="optionA" id="optionA" value="{{ old('optionA') }}">

                                        @if ($errors->has('optionA'))
                                            <div class="invalid-feedback">
                                                {{ $errors->first('optionA') }}
                                            </div>
                                        @endif
                                    </div>

                                    <div class="form-group  col-md-6">
                                        <label for="optionB">{{ trans('Option B') }}</label>
                                        <input class="form-control  {{ $errors->has('optionB') ? 'is-invalid' : '' }}"
                                            type="text" name="optionB" id="optionB" value="{{ old('optionB') }}">

                                        @if ($errors->has('optionB'))
                                            <div class="invalid-feedback">
                                                {{ $errors->first('optionB') }}
                                            </div>
                                        @endif
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="form-group col-md-6">
                                        <label for="optionC">{{ trans('Option C') }}</label>
                                        <input class="form-control  {{ $errors->has('optionC') ? 'is-invalid' : '' }}"
                                            type="text" name="optionC" id="optionC" value="{{ old('optionC') }}">

                                        @if ($errors->has('optionC'))
                                            <div class="invalid-feedback">
                                                {{ $errors->first('optionC') }}
                                            </div>
                                        @endif
                                    </div>

                                    <div class="form-group  col-md-6">
                                        <label for="optionD">{{ trans('Option D') }}</label>
                                        <input class="form-control {{ $errors->has('optionD') ? 'is-invalid' : '' }}"
                                            type="text" name="optionD" id="optionD" value="{{ old('optionD') }}">

                                        @if ($errors->has('optionD'))
                                            <div class="invalid-feedback">
                                                {{ $errors->first('optionD') }}
                                            </div>
                                        @endif
                                    </div>
                                </div>

                                <div class="row text-center">
                                    <span style="color:red; font-weight:bold;">{{ trans('OR') }}</span>
                                </div>

                                <div class="row">
                                    <div class="form-group col-md-6">
                                        <label for="optAimg">{{ trans('Option A Image') }}</label>
                                        <input type="file" class="form-control" id="optAimg" name="optAimg" accept = 'image/jpeg , image/jpg, image/bmp, image/png, image/svg, image/webp' />

                                        @if ($errors->has('optAimg'))
                                            <div class="invalid-feedback">
                                                {{ $errors->first('optAimg') }}
                                            </div>
                                        @endif
                                    </div>

                                    <div class="form-group  col-md-6">
                                        <label for="optBimg">{{ trans('Option B Image') }}</label>
                                        <input type="file" class="form-control" id="optBimg" name="optBimg" accept = 'image/jpeg , image/jpg, image/bmp, image/png, image/svg, image/webp' />

                                            @if ($errors->has('optBimg'))
                                            <div class="invalid-feedback">
                                                {{ $errors->first('optBimg') }}
                                            </div>
                                        @endif
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="form-group col-md-6">
                                        <label for="optCimg">{{ trans('Option C Image') }}</label>
                                        <input type="file" class="form-control" id="optCimg" name="optCimg" accept = 'image/jpeg , image/jpg, image/bmp, image/png, image/svg, image/webp'/>

                                            @if ($errors->has('optCimg'))
                                            <div class="invalid-feedback">
                                                {{ $errors->first('optCimg') }}
                                            </div>
                                        @endif
                                    </div>

                                    <div class="form-group  col-md-6">
                                        <label for="optDimg">{{ trans('Option D Image') }}</label>
                                        <input type="file" class="form-control" id="optDimg" name="optDimg" accept = 'image/jpeg , image/jpg, image/bmp, image/png, image/svg, image/webp'/>

                                            @if ($errors->has('optDimg'))
                                            <div class="invalid-feedback">
                                                {{ $errors->first('optDimg') }}
                                            </div>
                                        @endif
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="form-group col-md-10">
                                        <label for="name" class="col-sm-12">Correct Ans</label>
                                        <div class="col-sm-12">
                                            <label>
                                                <input type="radio" name="correctAns" id="correctAns" value="A">
                                                Option A
                                            </label>
                                            <label>
                                                <input type="radio" name="correctAns" id="correctAns" value="B">
                                                Option B
                                            </label>
                                            <label>
                                                <input type="radio" name="correctAns" id="correctAns" value="C">
                                                Option C
                                            </label>
                                            <label>
                                                <input type="radio" name="correctAns" id="correctAns" value="D">
                                                Option D
                                            </label>
                                        </div>
                                    </div>

                                    <div class="form-group col-md-2">
                                        <button type="submit" class="btn btn-primary" onclick="addTodo()">Save</button>
                                    </div>
                                </div>
                            </form>

                        </div>
                    </div>
                </div>
            </div>
        </div>

        <script>
            $(document).ready(function() {

                $('#category-dropdown').on('change', function() {
                    var idcategory = this.value;
                    $("#topics-dropdown").html('');
                    $.ajax({
                        url: "{{ url('api/fetch-topics') }}",
                        type: "POST",
                        data: {
                            category_id: idcategory,
                            _token: '{{ csrf_token() }}'
                        },
                        dataType: 'json',
                        success: function(result) {
                            $('#topics-dropdown').html(
                                '<option value="" disabled selected>-- Select Topics --</option>'
                                );
                            $.each(result.topics, function(key, value) {
                                $("#topics-dropdown").append('<option value="' + value.id +
                                    '">' + value.topic_name + '</option>');
                            });
                        }
                    });
                });

            });
        </script>
    @endsection
@endif
