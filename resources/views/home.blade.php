@if (auth()->user()->is_admin == 0)
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

                            <h4>{{ __('Welcome') }} {{ Auth::user()->name }}</h4>


                            <div class="row">
                                <div class="col-12 text-center">
                                    <h5>{{ __('TEST TOPICS!') }}</h5>
                                </div>
                            </div>

                            <div role="tabpanel">
                                @if (!empty($topic_all) && $topic_all->count())
                                    <ul class="nav nav-tabs" role="tablist">
                                        @foreach ($category_all as $category)
                                        <div class="col-md-3 mt-2 mb-2">
                                            <li role="presentation" class="{{ $category->id == 1 ? 'active' : '' }}">
                                                <a href="#home{{ $category->id }}" aria-controls="home" role="tab" data-toggle="tab">
                                                    <button type="submit" class="btn btn-primary btn-sm">{{ $category->category_name }}</button></a>
                                            </li>
                                        </div>
                                        @endforeach

                                        @if (!empty($user_quiz_topic_all) && $user_quiz_topic_all->count())
                                        <div class="col-md-3 mt-2 mb-2">
                                            <li role="presentation">
                                                <form method="POST" action="{{ route('check.score') }}">
                                                    @csrf
                                                    <button type="submit" class="btn btn-warning btn-sm">Check CRT
                                                        Score</button>
                                                </form>
                                            </li>
                                        </div>
                                        @endif
                                    </ul>
                                    <div class="tab-content">
                                        @foreach ($category_all as $category)
                                            <div role="tabpanel" class="tab-pane {{ $category->id == 1 ? 'active' : '' }}" id="home{{ $category->id }}" class="active">

                                                <div class="row justify-text-content">

                                                    @foreach ($topic_all as $topic)
                                                        @if ($topic['category_id'] == $category['id'])

                                                        
                                                            <div class="col-md-3 mt-2 mb-2">
                                                                <form method="POST"
                                                                    action="{{ route('test.index', ['id' => $topic->id]) }}">
                                                                    @csrf
                                                                    {{-- <button type="submit" class="btn btn-primary btn-sm"  value="{{ $category->id }}">{{ $category->topic_name }}</button> --}}

                                                                    <button type="submit" class="btn btn-primary btn-sm"
                                                                        @if ($user_quiz_topic_all->contains('topics_id', $topic->id)) @disabled(true) @endif
                                                                        value="{{ $topic->id }}">{{ $topic->topic_name }}</button>
                                                                </form>
                                                            </div>
                                                            
                                                        @endif
                                                    @endforeach
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                @else
                                    {{ __('No Test Given') }}
                                @endif
                            </div>


                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endsection
@endif
