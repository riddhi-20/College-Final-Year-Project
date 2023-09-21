@if (auth()->user()->is_admin == 0)
    @extends('layouts.app')

    @section('content')
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <div class="container" onload="GFG_Fun()">
            <div class="row justify-content-center">
                <div class="col-md-10">
                    <div class="card">
                        <div class="card-header">
                            <div class="row">
                                <div class="col col-md-8"><b>Question Details</b></div>
                                <div class="col col-md-4">
                                    <a href="{{ route('userhome') }}" class="btn btn-success btn-sm float-end">Home</a>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="tabpanel">

                                <div class="row">
                                    <div class="col col-md-4"></div>
                                    <div class="col col-md-4">
                                        <span>Total Time : <div id="totaltime">

                                        </div></span>
                                    </div>
                                    <div class="col col-md-4">
                                        <span>Time Left : <div id="demo"></div></span>
                                    </div>
                                </div>


                                {{-- {{ $user->id }} --}}

                                @if (!empty($data_new) && $data_new->count())
                                    <form action="{{ url('/updatetest') }}" method="post">
                                        @csrf
                                        @method('PUT')
                                        <div class="mt-2">
                                            @foreach ($data_new as $count => $topics)
                                                <div class="col-md-12 mt-2 mb-2">
                                                    <h5>{{ $count + 1 }}) {{ $topics->question }}</h5>

                                                    <input type="hidden" name="quiz_id[]" value="{{ $topics->id }}">

                                                    <div class="form-check form-check-inline">
                                                        <input class="form-check-input" type="radio"
                                                            name="option[{{ $topics->id }}]" id="inlineRadio1"
                                                            value="A">
                                                        <label class="form-check-label"
                                                            for="inlineRadio2">{{ $topics->optionA }}
                                                        </label>
                                                    </div>

                                                    <div class="form-check form-check-inline">
                                                        <input class="form-check-input" type="radio"
                                                            name="option[{{ $topics->id }}]" id="inlineRadio1"
                                                            value="B">
                                                        <label class="form-check-label"
                                                            for="inlineRadio2">{{ $topics->optionB }}
                                                        </label>
                                                    </div>

                                                    <div class="form-check form-check-inline">
                                                        <input class="form-check-input" type="radio"
                                                            name="option[{{ $topics->id }}]" id="inlineRadio1"
                                                            value="C">
                                                        <label class="form-check-label"
                                                            for="inlineRadio2">{{ $topics->optionC }}
                                                        </label>
                                                    </div>

                                                    <div class="form-check form-check-inline">
                                                        <input class="form-check-input" type="radio"
                                                            name="option[{{ $topics->id }}]" id="inlineRadio1"
                                                            value="D">
                                                        <label class="form-check-label"
                                                            for="inlineRadio2">{{ $topics->optionD }}
                                                        </label>
                                                    </div>
                                                </div>
                                            @endforeach

                                            <div class="row justify-text-content">
                                                <div class="form-group col-md-2">
                                                    <button type="submit" class="btn btn-primary btn-sm">Submit </button>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        {{-- @dd($time, $is_timerset); --}}
        <script>
            var total = "30 mins";
            var countdown = 30 * 60 * 1000;
            var timerId = setInterval(function(){
            countdown -= 1000;
            var min = Math.floor(countdown / (60 * 1000));
            var sec = Math.floor((countdown - (min * 60 * 1000)) / 1000);  //correct

            if (countdown <= 0) {
                alert("30 min!");
                clearInterval(timerId);
                //doSomething();
            } else {
                $("#demo").html(min + " : " + sec);
                $("#totaltime").html(total);
            }

            }, 1000); //1000ms. = 1sec.
        </script>
    @endsection
@endif
