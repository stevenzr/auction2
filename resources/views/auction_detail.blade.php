@extends('layouts.main')

@section('title', $auction->title)

@section('content')
    <div class="auction-detail">
        <h1>{{ $auction->title }}</h1>
        @include('partials.errors')
        @if($auction->status == 'active')
            <div class="title-info">
                <span class="remaining-time" data-end-date="{{ $auction->end_date }}"></span>
                <span id="bids">
                    <a href="#" v-on:click.prevent="toggleBids">
                        ({{ trans_choice('auction_detail.bids', $amountOfBids, ['bids' => $amountOfBids]) }}@auth, {{ trans('auction_detail.yours', ['bids' => $amountOfBidsByCurrentUser]) }}@endauth)
                    </a>
                    <span class="icons-hamburger"></span>
                    <transition name="fade">
                        <div v-if="bidsAreShown">
                            @if(count($auction->bids))
                                <ol>
                                    @foreach($auction->bids as $bid)
                                        <li class="{{ $bid->user_id == Auth::id() ? 'you' : '' }}">
                                            Rp. {{ formatPrice($bid->price) }}, {{ $bid->user->name }}, {{ formatDate($bid->created_at , 'desc') }}
                                        </li>
                                    @endforeach
                                </ol>
                            @else
                                <p>@lang('auction_detail.no_bids')</p>
                            @endif
                        </div>
                    </transition>
                </span>
            </div>
        @endif
        <div class="top">
            <img src="{{ staticImage($auction->artwork_image_path) }}" alt="{{ $auction->title }}">
            <div class="side">
                <div class="border-bottom">
                    <h2>{{ $auction->title }}</h2>
                    <p>{{ $auction->year }}</p>
                </div>
                @if($auction->status == 'active')
                    <div class="border-bottom">
                        <p>
                            <span class="remaining-time" data-end-date="{{ $auction->end_date }}"></span>
                            <span> @lang('auction_detail.left')</span>
                        </p>
                        <p>{{ formatDate($auction->end_date) }}</p>
                    </div>
                @endif
                <div>
                    <p>{{ $auction->origin }}</p>
                </div>
                @auth
                    @if($auction->status == 'active'  && $auction->user_id != Auth::user()->id)
                        <div class="bid">
                            <div class="padding">
                                <div class ="current-bids">
                                    <h2>Current bid price</h2>
                                    @if ($amountOfBids >0)
                                        <p class="latestBids">
                                            Rp.{{formatPrice($latestBid)}}
                                        </p>
                                    @else
                                        {{$tes}}
                                    @endif
                                </div>
                                <p>@lang('auction_detail.estimated_price')</p>
                                <p class="estimated-price">
                                    Rp. {{ formatPrice($auction->min_price) }} - Rp. {{ formatPrice($auction->max_price) }}
                                </p>
                                @isset($auction->buyout_price)
                                    {!! Form::open(['route' => ['auctionBuyout', 'auction' => $auction, 'auctionTitle' => clean($auction->title)]]) !!}
                                    {!! Form::submit(trans('auction_detail.buy_now', ['buyout_price' => formatPrice($auction->buyout_price)]), ['class' => 'buyout']) !!}
                                    {!! Form::close() !!}
                                @endisset
                                <span>
                                    {{ trans_choice('auction_detail.bids', $amountOfBids, ['bids' => $amountOfBids]) }} ({{ trans('auction_detail.yours', ['bids' => $amountOfBidsByCurrentUser]) }})
                                </span>
                            </div>
                            {!! Form::open(['route' => ['addBid', 'auction' => $auction, 'auctionTitle' => clean($auction->title)], 'class' => 'bid-form']) !!}
                            {!! Form::number('bid_price', '', ['class' => 'price-input ' . ($errors->has('bid_price') ? 'has-error' : ''), 'min' => 0, 'max' => 99999999]) !!}
                            {!! Form::submit(trans('auction_detail.bid_now'), ['class' => 'price-submit']) !!}
                            {!! Form::close() !!}
                    @else
                        <div v-if="bidsAreShown">
                            @if(count($auction->bids))
                                <ol>
                                    <h3 class="currentbid">Current Bids</h3>
                                    @foreach($auction->bids as $bid)
                                        <li class="{{ $bid->user_id == Auth::id() ? 'you' : '' }}">
                                        Rp {{ formatPrice($bid->price) }}, {{ $bid->user->name }}, {{ formatDate($bid->created_at) }}
                                        </li>
                                    @endforeach
                                </ol>
                            @else
                                <p>@lang('auction_detail.no_bids')</p>
                            @endif
                        </div>
                         <form method="POST" action="{{ route('deleteAuction', [$auction->id]) }}">
                         {{ csrf_field() }}
                         {{ method_field('DELETE') }}
                          <button class="btn-delete" type="submit">Delete</button>
                         </form>
                    @endif
                                @if(!$isInWatchlist && $auction->user_id != Auth::user()->id)
                                 <span class="add-to-watchlist-container">
                                    {!! Form::open(['route' => ['addAuctionToWatchlist', 'auction' => $auction, 'auctionTitle' => clean($auction->title)]]) !!}
                                    <span class="icons-hamburger"></span>
                                    {!! Form::submit(trans('auction_detail.add_to_watchlist'), ['class' => 'add-to-watchlist']) !!}
                                    {!! Form::close() !!}
                                @elseif($auction->user_id == Auth::user()->id)
                                    <p> </p>
                                @else
                                    <p>@lang('auction_detail.in_watchlist')</p>
                                @endif
                            </span>


                        </div>

                    @if($auction->status == 'expired')
                        <p class="ended">@lang('auction_detail.expired')</p>
                    @endif
                    @if($auction->status == 'sold')
                        <p class="ended">@lang('auction_detail.sold')</p>
                    @endif
                    @if($auction->status == 'win')
                         <p class="ended">@lang('auction_detail.win')</p>
                     @endif
                     @if($auction->status == 'lose')
                     <p class="ended">@lang('auction_detail.lose')</p>
                     @endif
                @endauth
                @guest
                    <p>@lang('auction_detail.no_auth')</p>
                @endguest
            </div>
        </div>
        <div class="bottom">
            <div class="auction-texts">
                <h3>@lang('auction_detail.description')</h3>
                <p>{{ $auction->description }}</p>

            </div>

        </div>
    </div>
    @include('partials.scripts.remaining_time')
@endsection
