@extends('layouts.main')

@section('title', trans('watchlist.watchlist'))

@section('content')
    <div id="watchlist-categories">
        {!! Form::open(['route' => 'clearWatchlist', 'method' => 'delete']) !!}
        {!! Form::submit(trans('watchlist.clear_watchlist'), ['class' => 'small-button']) !!}
        {!! Form::close() !!}
        {!! Form::open(['route' => 'deleteSelectedWatchlistAuctions', 'method' => 'delete']) !!}
        {!! Form::submit(trans('watchlist.delete_selected'), ['class' => 'small-button']) !!}
        <h1>@lang('watchlist.watchlist')</h1>
        <div>
            <div class="categories">
                @for($i = 0; $i < count($watchlistAuctions); $i++)
                    <li><a href="#" v-on:click.prevent="showCategory('{{ $watchlistCategories[$i] }}')"
                    v-bind:class="{ active: shownCategory == '{{ $watchlistCategories[$i] }}'   }">@lang("watchlist.{$watchlistCategories[$i]}")({{ count($watchlistAuctions[$i])     }})</a></li>
                @endfor
            </div>
        <div class="box">
            @for($i = 0; $i < count($watchlistAuctions); $i++)
            <div v-if="shownCategory == '{{ $watchlistCategories[$i] }}'">
            @include('partials.auction_table', ['auctions' => $watchlistAuctions[$i]])
            </div>
            @endfor
            {!! Form::close() !!}
            </div>
        </div>
    </div>

    @include('partials.scripts.remaining_time')
@endsection
