@extends('app')

@section('headscripts')
        <!-- Fonts -->
<link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">

<!-- Styles -->
<style>
    html, body {
        background-color: #fff;
        color: #636b6f;
        font-family: 'Raleway', sans-serif;
        font-weight: 100;
        height: 100vh;
        margin: 0;
    }

    .full-height {
        height: 100vh;
    }

    .flex-center {
        align-items: center;
        display: flex;
        justify-content: center;
    }

    .position-ref {
        position: relative;
    }

    .top-right {
        position: absolute;
        right: 10px;
        top: 18px;
    }

    .content {
        text-align: center;
    }

    .title {
        font-size: 84px;
    }

    .links > a {
        color: #636b6f;
        padding: 0 25px;
        font-size: 12px;
        font-weight: 600;
        letter-spacing: .1rem;
        text-decoration: none;
        text-transform: uppercase;
    }

    .m-b-md {
        margin-bottom: 30px;
    }
</style>
@endsection

@section('content')
    <div class="container">
        <div class="row">
            @include('global.partials._boot-flash-messages')
        </div>
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <form method="POST" action="{{url('/test')}}" id="test-form">
                    <div class="form-group" id="test-title">
                        <label for="title" class="control-label">Title:</label> <input type="text" name="title"
                                                                                       value="{{old('title')}}"
                                                                                       class="form-control">
                        <ajax-errors prefix="test-title"></ajax-errors>
                    </div>
                    <div class="form-group" id="test-body">
                        <label for="body" class="control-label">Body:</label> <input type="text" name="body"
                                                                                     value="{{old('title')}}"
                                                                                     class="form-control">
                        @include('global.partials.forms._ajax-errors', ['e_pre' => 'test-body'])
                    </div>
                    <div class="form-group">
                        @include('global.partials.buttons._ajax-form-feedback-button', [
                        'field_prefix' => 'test-',
                        'form_id' => 'test-form'
                        ])
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="flex-center position-ref full-height">
        @if (Route::has('login'))
            <div class="top-right links">
                <a href="{{ url('/login') }}">Login</a> <a href="{{ url('/register') }}">Register</a>
            </div>
        @endif

        <div class="content">
            <div class="title m-b-md">
                Laravel
            </div>

            <div class="links">
                <a href="https://laravel.com/docs">Documentation</a> <a href="https://laracasts.com">Laracasts</a> <a
                        href="https://laravel-news.com">News</a> <a href="https://forge.laravel.com">Forge</a> <a
                        href="https://github.com/laravel/laravel">GitHub</a>
            </div>
        </div>
    </div>
@endsection