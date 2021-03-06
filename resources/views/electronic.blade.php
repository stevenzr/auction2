@extends('layouts.main')

@section('title', trans('products.electronics'))

@section('content')
    <div id="art-filter">
            <div class="filter-menu">
                <div class="categories">
                    <span>@lang('products.order_by')</span>
                    @for($i = 0; $i < count($orderedAuctions); $i++)
                       <li> <a href="#" v-on:click.prevent="order('{{ $orderedAuctionTypes[$i] }}')"
                        v-bind:class="{ active: orderBy == '{{ $orderedAuctionTypes[$i] }}' }">@lang("products.{$orderedAuctionTypes[$i]}")</a>
                        </li>
                    @endfor
                </div>
            </div>
        <div class="box">
            <div v-if="orderBy == '{{ $electronic }}' ">
                @include('partials.auction_cards', ['auctions' => $electronic])
            </div>
            @for($i = 0; $i < count($orderedAuctions); $i++)
            <div v-if="orderBy == '{{ $orderedAuctionTypes[$i] }}' ">
                @include('partials.auction_cards', ['auctions' => $orderedAuctions[$i]])
            </div>
            @endfor
        </div>
    </div>
    @include('partials.scripts.remaining_time')

@endsection
