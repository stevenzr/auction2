@extends('layouts.main')

@section('title', trans('login'))

@section('content')
@include('partials.errors')
        <div class="loginpage">
            <div id="login" v-bind:style="{ borderLeft: borderLeft, paddingLeft: paddingLeft }">
                        <div class="loginname">
                            <div class="logintest">
                            <a class="{{ Route::is('login') ? 'active' : '' }}" href="{{route ('login')}}">
                                @lang('header.login')
                                    </a>
                            </div>
                            <div class="registertest">
                            <a class="{{ Route::is('register') ? 'active' : '' }}"  href="{{ route('register') }}">
                                @lang('header.register')
                            </a>
                            </div>
                        </div>

                            {!! Form::open(['route' => 'login', 'v-if' => 'loginFormIsShown']) !!}
                            <div class="loginbox">
                            {!! Form::email('email', '', ['placeholder' => trans('header.email')]) !!}
                            </div>
                            <div class="loginbox">
                            {!! Form::password('password', ['placeholder' => trans('header.password')]) !!}
                </div>
                <div class="loginsubmit">
                            {!! Form::submit('Log in') !!}
                </div>
                <div class="passwordrst">
                            <a href="{{ route('password.request') }}">@lang('header.forgot_password')</a>
                            {!! Form::close() !!}
                </div>
            </div>
</div>




@endsection
