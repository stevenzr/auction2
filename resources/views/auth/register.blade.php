@extends('layouts.main')

@section('title', trans('register.register'))

@section('content')
    @include('partials.errors')
    {!! Form::open(['route' => 'register']) !!}
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
        <div class="loginbox">
            <div class="registername">
            {!! Form::label('name', trans('register.name')) !!}
            </div>
            {!! Form::text('name', '', ['class' => $errors->has('name') ? 'has-error' : '', 'maxlength' => 255]) !!}
        </div>
        <div class="loginbox">
            <div class="registername">
            {!! Form::label('email', trans('register.email')) !!}
            </div>
            {!! Form::email('email', '', ['class' => $errors->has('email') ? 'has-error' : '', 'maxlength' => 255]) !!}
        </div>
        <div class="loginbox">
            <div class="registername">
            {!! Form::label('password', trans('register.password')) !!}
            </div>
            {!! Form::password('password', ['class' => $errors->has('password') ? 'has-error' : '', 'minlength' => 6]) !!}
        </div>
        <div class="loginbox">
            <div class="registername">
            {!! Form::label('password_confirmation', trans('register.password_confirmation')) !!}
            </div>
            {!! Form::password('password_confirmation', ['class' => $errors->has('password_confirmation') ? 'has-error' : '', 'minlength' => 6]) !!}
        </div>
            <div class="loginbox">
                <div class="registername">
                {!! Form::label('zip', trans('register.zip')) !!}
                </div>
                {!! Form::text('zip', '', ['class' => $errors->has('zip') ? 'has-error' : '', 'maxlength' => 255]) !!}
            </div>
            <div class="loginbox">
                <div class="registername">
                {!! Form::label('city', trans('register.city')) !!}
                </div>
                {!! Form::text('city', '', ['class' => $errors->has('city') ? 'has-error' : '', 'maxlength' => 255]) !!}
            </div>
        <div class="loginbox">
            <div class="registername">
            {!! Form::label('address', trans('register.address')) !!}
            </div>
            {!! Form::text('address', '', ['class' => $errors->has('address') ? 'has-error' : '', 'maxlength' => 255]) !!}
        </div>
        <div class="loginbox">
            <div class="registername">
                {!! Form::label('phone_number', trans('register.phone_number')) !!}
            </div>
                {!! Form::text('phone_number', '', ['class' => $errors->has('phone_number') ? 'has-error' : '', 'maxlength' => 255]) !!}
        </div>
       @include('partials.agree_tac')
       <div class="loginbox">
            {!! Form::submit(trans('register.register_submit'), ['class' => 'big-button']) !!}
        </div>
       {!! Form::close() !!}
    </div>


@endsection
