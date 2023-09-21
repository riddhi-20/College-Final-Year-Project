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
                                <div class="col col-md-8"><b>Edit Question Details</b></div>
                                <div class="col col-md-4">
                                    <a href="{{ route('admin.home') }}" class="btn btn-success btn-sm float-end">Home</a>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            @foreach ($data as $row)
                                <form method="POST" action="{{ route('questions.update', $row->id) }}"  enctype="multipart/form-data">
                                    @csrf
                                    @method('PUT')

                                    <div class="row">
                                        <div class="form-group mb-3 col-md-6">
                                            <label for="topics-dropdown">{{ trans('Topic') }}</label>
                                            <select id="topics-dropdown" name="topicid" class="form-control">
                                                <option value="" disabled selected>-- Select Topics --</option>
                                                @foreach ($courses_all as $data_topic)
                                                    <option value="{{ $data_topic->id }}"
                                                        {{ $data_topic->id == $row->topics_id ? 'selected' : '' }}>
                                                        {{ $data_topic->topic_name }} </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>

                                    <div class="form-group" id="question">
                                        <label for="question">{{ trans('Question') }}</label>
                                        <input class="form-control  {{ $errors->has('question') ? 'is-invalid' : '' }}"
                                            type="text" name="question" id="question" value='<?php echo $row->question; ?>'>
                                            @if($row->is_img == 1)
                                            <br/>
                                        <img src="{{ url('assets/CRTimage/'.$row->quesimg ) }}"
                                            style="height: 200px; width: 250px;">
                                            @endif
                                            <br/>
                                            <input type="file" class="form-control" id="quesimg" name="quesimg" accept = 'image/jpeg , image/jpg, image/bmp, image/png, image/svg, image/webp'/>
                                        </div>

                                    <div class="row">
                                        <div class="form-group col-md-6">
                                            <label for="optionA">{{ trans('Option A') }}</label>
                                            <input class="form-control  {{ $errors->has('optionA') ? 'is-invalid' : '' }}"
                                                type="text" name="optionA" id="optionA" value='<?php echo $row->optionA; ?>'>
                                        </div>

                                        <div class="form-group  col-md-6">
                                            <label for="optionB">{{ trans('Option B') }}</label>
                                            <input class="form-control  {{ $errors->has('optionB') ? 'is-invalid' : '' }}"
                                                type="text" name="optionB" id="optionB" value='<?php echo $row->optionB; ?>'>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="form-group col-md-6">
                                            <label for="optionC">{{ trans('Option C') }}</label>
                                            <input class="form-control  {{ $errors->has('optionC') ? 'is-invalid' : '' }}"
                                                type="text" name="optionC" id="optionC" value='<?php echo $row->optionC; ?>'>
                                        </div>

                                        <div class="form-group  col-md-6">
                                            <label for="optionD">{{ trans('Option D') }}</label>
                                            <input class="form-control {{ $errors->has('optionD') ? 'is-invalid' : '' }}"
                                                type="text" name="optionD" id="optionD" value='<?php echo $row->optionD; ?>'>
                                        </div>
                                    </div>


                                    <div class="row text-center">
                                        <span style="color:red; font-weight:bold;">{{ trans('OR') }}</span>
                                    </div>

                                    <div class="row">
                                        <div class="form-group col-md-6">
                                            <label for="optAimg">{{ trans('Option A Image') }}</label>
                                            @if($row->is_img == 1)
                                            <img src="{{ url('assets/CRTimage/'.$row->optAimg ) }}"
                                            style="height: 100px; width: 150px;">
                                            @endif
                                            <input type="file" class="form-control" id="optAimg" name="optAimg" accept = 'image/jpeg , image/jpg, image/bmp, image/png, image/svg, image/webp' />

                                            @if ($errors->has('optAimg'))
                                                <div class="invalid-feedback">
                                                    {{ $errors->first('optAimg') }}
                                                </div>
                                            @endif
                                        </div>

                                        <div class="form-group  col-md-6">
                                            <label for="optBimg">{{ trans('Option B Image') }}</label>
                                            @if($row->is_img == 1)
                                            <img src="{{ url('assets/CRTimage/'.$row->optBimg ) }}"
                                            style="height: 100px; width: 150px;">
                                            @endif
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
                                            @if($row->is_img == 1)
                                            <img src="{{ url('assets/CRTimage/'.$row->optCimg ) }}"
                                            style="height: 100px; width: 150px;">
                                            @endif
                                            <input type="file" class="form-control" id="optCimg" name="optCimg" accept = 'image/jpeg , image/jpg, image/bmp, image/png, image/svg, image/webp'/>

                                                @if ($errors->has('optCimg'))
                                                <div class="invalid-feedback">
                                                    {{ $errors->first('optCimg') }}
                                                </div>
                                            @endif
                                        </div>

                                        <div class="form-group  col-md-6">
                                            <label for="optDimg">{{ trans('Option D Image') }}</label>
                                            @if($row->is_img == 1)
                                            <img src="{{ url('assets/CRTimage/'.$row->optDimg ) }}"
                                            style="height: 100px; width: 150px;">
                                            @endif
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
                                                    <input type="radio" name="CorrectAns" id="CorrectAns" value="A"
                                                        {{ $row->correctAns == 'A' ? 'checked' : '' }}> Option A
                                                </label>
                                                <label>
                                                    <input type="radio" name="CorrectAns" id="CorrectAns" value="B"
                                                        {{ $row->correctAns == 'B' ? 'checked' : '' }}> Option B
                                                </label>
                                                <label>
                                                    <input type="radio" name="CorrectAns" id="CorrectAns" value="C"
                                                        {{ $row->correctAns == 'C' ? 'checked' : '' }}> Option C
                                                </label>
                                                <label>
                                                    <input type="radio" name="CorrectAns" id="CorrectAns" value="D"
                                                        {{ $row->correctAns == 'D' ? 'checked' : '' }}> Option D
                                                </label>
                                            </div>
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
