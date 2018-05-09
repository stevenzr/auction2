@extends('layouts.main')

@section('title', trans('register.register'))

@section('content')
    <h1>@lang('register.register')</h1>
    @include('partials.errors')
    {!! Form::open(['route' => 'register']) !!}
    <div class="row">
        <div class="row-item">
            {!! Form::label('name', trans('register.name')) !!}
            {!! Form::text('name', '', ['class' => $errors->has('name') ? 'has-error' : '', 'maxlength' => 255]) !!}
        </div>
        <div class="row-item">
            {!! Form::label('email', trans('register.email')) !!}
            {!! Form::email('email', '', ['class' => $errors->has('email') ? 'has-error' : '', 'maxlength' => 255]) !!}
        </div>
    </div>
    <div class="row">
        <div class="row-item">
            {!! Form::label('password', trans('register.password')) !!}
            {!! Form::password('password', ['class' => $errors->has('password') ? 'has-error' : '', 'minlength' => 6]) !!}
        </div>
        <div class="row-item">
            {!! Form::label('password_confirmation', trans('register.password_confirmation')) !!}
            {!! Form::password('password_confirmation', ['class' => $errors->has('password_confirmation') ? 'has-error' : '', 'minlength' => 6]) !!}
        </div>
    </div>
    <div class="row">
            <div class="row-item">
                {!! Form::label('zip', trans('register.zip')) !!}
                {!! Form::text('zip', '', ['class' => $errors->has('zip') ? 'has-error' : '', 'maxlength' => 255]) !!}
            </div>
            <div class="row-item">
                {!! Form::label('city', trans('register.city')) !!}
                {!! Form::text('city', '', ['class' => $errors->has('city') ? 'has-error' : '', 'maxlength' => 255]) !!}
            </div>
        
    </div>
    <div class="row">
        <div class="row-item">
            {!! Form::label('address', trans('register.address')) !!}
            {!! Form::text('address', '', ['class' => $errors->has('address') ? 'has-error' : '', 'maxlength' => 255]) !!}
        </div>
        <div class="row-item half">

            <div class="row-item two-third">
                {!! Form::label('phone_number', trans('register.phone_number')) !!}
                {!! Form::text('phone_number', '', ['class' => $errors->has('phone_number') ? 'has-error' : '', 'maxlength' => 255]) !!}
            </div>
        </div>
    </div>
    
    
    @include('partials.agree_tac')
    <div class="row">
        <div class="row-item">
            {!! Form::submit(trans('register.register_submit'), ['class' => 'big-button']) !!}
        </div>
    </div>
    {!! Form::close() !!}
@endsection
