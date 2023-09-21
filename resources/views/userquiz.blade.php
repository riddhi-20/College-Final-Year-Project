@if (auth()->user()->is_admin == 0)
    @extends('layouts.app')

    @section('content')
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <script>
            var seconds = 300;
            function secondPassed() {
                var minutes = Math.round((seconds - 30)/60),
                    remainingSeconds = seconds % 60;

                if (remainingSeconds < 10) {
                    remainingSeconds = "0" + remainingSeconds;
                }

                document.getElementById('countdown').innerHTML = minutes + ":" + remainingSeconds;
                if (seconds == 0) {
                    clearInterval(countdownTimer);
                    //form1 is your form name
                    document.form1.submit();
                } else {
                    seconds--;
                }
            }
            var countdownTimer = setInterval('secondPassed()', 1000);
        </script>

        <div class="container">
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

                            <div class="timer">
                                <time id="countdown">5:00</time>
                            </div>


                            {{ $id }}

                            <div class="row">

                                @if (!empty($data_new) && $data_new->count())
                                    <div class="col-12 mt-2">

                                        <form action="{{ url()->current() }}" method="post">
                                            @csrf

                                            @foreach ($data_new as $count => $topics)
                                                <div class="row">


                                                    <h4>{{ $topics->question }}</h4>

                                                    <div class="form-check form-check-inline">
                                                        <input class="form-check-input" type="radio" name="category_id"
                                                            id="inlineRadio1" value="{{ $topics->optionA }}">
                                                        <label class="form-check-label"
                                                            for="inlineRadio2">{{ $topics->optionA }}
                                                        </label>
                                                    </div>

                                                    <div class="form-check form-check-inline">
                                                        <input class="form-check-input" type="radio" name="category_id"
                                                            id="inlineRadio1" value="{{ $topics->optionA }}">
                                                        <label class="form-check-label"
                                                            for="inlineRadio2">{{ $topics->optionB }}
                                                        </label>
                                                    </div>

                                                    <div class="form-check form-check-inline">
                                                        <input class="form-check-input" type="radio" name="category_id"
                                                            id="inlineRadio1" value="{{ $topics->optionA }}">
                                                        <label class="form-check-label"
                                                            for="inlineRadio2">{{ $topics->optionC }}
                                                        </label>
                                                    </div>

                                                    <div class="form-check form-check-inline">
                                                        <input class="form-check-input" type="radio" name="category_id"
                                                            id="inlineRadio1" value="{{ $topics->optionA }}">
                                                        <label class="form-check-label"
                                                            for="inlineRadio2">{{ $topics->optionD }}
                                                        </label>
                                                    </div>

                                                </div>
                                            @endforeach


                                            <div class="row justify-text-content">
                                                <div class="form-group col-md-2">

                                                    <button type="submit" class="btn btn-primary btn-sm">Submit
                                                    </button>

                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>


    @endsection
@endif
