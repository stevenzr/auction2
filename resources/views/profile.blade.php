@extends('layouts.main')

@section('title', trans('profile.profile'))

@section('content')
    <h1>@lang('profile.profile')</h1>
    <div class="profile-info">
        <p>Name: {{ $user->name }}</p>
        <div class="profile-info-col">

                <p>Address: {{ $user->address }}</p>
                <p>Zip code:{{ $user->zip }}</p>
                <p>City: {{ $user->city }}</p>
                <p>Email : {{$user->email}}</p>
                <p>Phone : {{$user->phone_number}}</p>
        </div>
    </div>
@endsection
