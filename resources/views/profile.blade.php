@extends('layouts.main')

@section('title', trans('profile.profile'))

@section('content')
    <h1>@lang('profile.profile')</h1>
    <div class="profile-info">
        <h2>User Name: {{ $user->name }}</h2>
        <div class="profile-info-col">
            <div class="item">
                <p>
                    <span class="icons-mail"></span>
                    <a href="mailto:{{ $user->email }}">{{ $user->email }}</a>
                </p>
                <p>
                    <span class="icons-phone"></span>
                    <span>{{ $user->phone_number }}</span>
                </p>
            </div>

        </div>
        <div class="profile-info-col">
            <div class="item">
                <p>Address: {{ $user->address }}</p>
                <p>Zip code:{{ $user->zip }}</p>
                <p>City: {{ $user->city }}</p>
            </div>
        </div>
    </div>
    <div class="active-auctions">
        <h2>@lang('profile.active_auctions')</h2>
        @include('partials.auction_cards', ['auctions' => $activeAuctions])
    </div>
    @include('partials.scripts.remaining_time')
@endsection
