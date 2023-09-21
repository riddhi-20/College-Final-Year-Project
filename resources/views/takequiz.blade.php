@if (auth()->user()->is_admin == 0)
@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">

                <div class="card-header">
                    <div class="row">
                        <div class="col col-md-8"><b>Quiz</b></div>
                        <div class="col col-md-4">
                            <a href="{{ route('userhome') }}" class="btn btn-success btn-sm float-end">Home</a>
                        </div>
                    </div>
                </div>

                <div class="card-body">

                    @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                    @endif

                    <div class="row">
                        <div class="col col-md-2"></div>
                        <div class="col col-md-5">
                            <span>
                                <div id="totaltime">
                                </div>
                            </span>
                        </div>
                        <div class="col col-md-5">
                            <span>
                                <div id="demo"></div>
                            </span>
                        </div>
                    </div>



                    <div role="tabpanel">

                        <form action="{{ url('/updatetest') }}" method="post">
                            @csrf
                            @method('PUT')

                            @if (!empty($data_new) && $data_new->count())
                            <ul class="nav nav-tabs">
                                @foreach ($data_new as $count => $topics)
                                {{-- @dd($count) --}}
                                <div class=" mt-1 mr-1 mb-2">
                                    <li role="presentation" class="{{ $count + 1 == 1 ? 'active' : '' }}">
                                        <a href="#home{{ $count + 1 }}" aria-controls="{{ $count + 1 }}" role="tab"
                                            data-toggle="tab">
                                            <button type="button" class="btn btn-primary btn-sm">{{ $count + 1
                                                }}</button></a>
                                    </li>
                                </div>
                                @endforeach

                            </ul>
                            <div class="tab-content">
                                @foreach ($data_new as $count => $topics)
                                <div role="tabpanel" class="tab-pane {{ $count + 1 == 1 ? 'active' : '' }}"
                                    id="home{{ $count + 1 }}">

                                    <div class="row justify-text-content">
                                        <div class="col-md-10 mt-2 mb-2">

                                            <h5>{{ $count + 1 }}) {{ $topics->question }}</h5>

                                            <input type="hidden" name="quiz_id[]" value="{{ $topics->id }}">

                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="radio"
                                                    name="option[{{ $topics->id }}]" id="inlineRadio1" value="A">
                                                <label class="form-check-label" for="inlineRadio2">{{ $topics->optionA
                                                    }}
                                                </label>
                                            </div>

                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="radio"
                                                    name="option[{{ $topics->id }}]" id="inlineRadio1" value="B">
                                                <label class="form-check-label" for="inlineRadio2">{{ $topics->optionB
                                                    }}
                                                </label>
                                            </div>

                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="radio"
                                                    name="option[{{ $topics->id }}]" id="inlineRadio1" value="C">
                                                <label class="form-check-label" for="inlineRadio2">{{ $topics->optionC
                                                    }}
                                                </label>
                                            </div>

                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="radio"
                                                    name="option[{{ $topics->id }}]" id="inlineRadio1" value="D">
                                                <label class="form-check-label" for="inlineRadio2">{{ $topics->optionD
                                                    }}
                                                </label>
                                            </div>

                                        </div>
                                    </div>

                                    @php
                                    $qcount = $count + 1;
                                    $totalcount = $data_new->count();
                                    @endphp

                                    <div class="row justify-text-content">
                                        @if ($qcount != 1)
                                        <div class="form-group col-md-2">
                                            <a href="#home{{ $qcount - 1 }}" aria-controls="{{ $qcount + 1 }}"
                                                role="tab" data-toggle="tab">
                                                <button type="button"
                                                    class="btn btn-primary btn-sm">PREVIOUS</button></a>
                                        </div>
                                        @endif


                                        @if ($qcount != $totalcount)
                                        <div class="form-group col-md-2">
                                            <a href="#home{{ $qcount + 1 }}" aria-controls="{{ $qcount + 1 }}"
                                                role="tab" data-toggle="tab">
                                                <button type="button" class="btn btn-primary btn-sm">NEXT</button></a>
                                        </div>
                                        @endif

                                        @if ($qcount == $totalcount)
                                        <div class="form-group col-md-2">
                                            <button type="submit" class="btn btn-warning btn-sm">Submit
                                            </button>
                                        </div>
                                        @endif
                                    </div>
                                </div>
                                @endforeach

                            </div>

                        </form>
                        @else
                        {{ __('No Test Given') }}
                        @endif
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>



<script>


        var total = "Total Time : 15 mins";
        var countdown = 15 * 60 * 1000;
        var timerId = setInterval(function() {
            countdown -= 1000;
            var min = Math.floor(countdown / (60 * 1000));
            var sec = Math.floor((countdown - (min * 60 * 1000)) / 1000); //correct

            if (countdown <= 0) {
                alert("15 min!");
                clearInterval(timerId);
                //doSomething();
            } else {
                $("#demo").html("Time Left : " + min + " : " + sec);
                $("#totaltime").html(total);
            }

        }, 1000); //1000ms. = 1sec.
</script>
@endsection
@endif
