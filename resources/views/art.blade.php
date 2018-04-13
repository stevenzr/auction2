@extends('layouts.main')

@section('title', trans('art.art'))

@section('content')
    <div id="art-filter">
        <div class="filter">
            <div class="filter-menu">
                <p class="categories">
                    <span>@lang('art.order_by')</span>
                    @for($i = 0; $i < count($orderedAuctions); $i++)
                        <a href="#" v-on:click.prevent="order('{{ $orderedAuctionTypes[$i] }}')"
                        v-bind:class="{ active: orderBy == '{{ $orderedAuctionTypes[$i] }}' }">@lang("art.{$orderedAuctionTypes[$i]}")</a>
                    @endfor
                </p>
                <a href="#" v-on:click.prevent="toggleFilterPane" class="advanced">@lang('art.advanced_options')<span v-bind:style="{ transform: transform}" class="icons-arrow_down"></span></a>
            </div>
            <transition name="fade">
                <div v-if="filterPaneIsShown" class="filter-pane">
                    <div class="sitemap">
                        <div class="col">
                            <ul>
                                @foreach(trans('footer.prices') as $price)
                                    @if($loop->first)
                                        <li>{{ $price }}</li>
                                    @else
                                        <li><a href="#">{{ $price }}</a></li>
                                    @endif
                                @endforeach
                            </ul>
                            <ul>
                                @foreach(trans('footer.endings_texts') as $endings_text)
                                    @if($loop->first)
                                        <li>{{ $endings_text }}</li>
                                    @else
                                        <li><a href="#">{{ $endings_text }}</a></li>
                                    @endif
                                @endforeach
                            </ul>
                        </div>
                        <div class="col">
                            <ul>
                                @foreach(trans('footer.eras') as $era)
                                    @if($loop->first)
                                        <li>{{ $era }}</li>
                                    @else
                                        <li><a href="#">{{ $era }}</a></li>
                                    @endif
                                @endforeach
                            </ul>
                            <ul>
                                @foreach(trans('footer.media') as $media)
                                    @if($loop->first)
                                        <li>{{ $media }}</li>
                                    @else
                                        <li><a href="#">{{ $media }}</a></li>
                                    @endif
                                @endforeach
                            </ul>
                        </div>
                        <div class="col">
                            <ul>
                                <li>@lang('footer.style')</li>
                                @foreach(trans('footer.styles') as $style)
                                    <li><a href="#">{{ $style }}</a></li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
            </transition>
        </div>
        @for($i = 0; $i < count($orderedAuctions); $i++)
            <div v-if="orderBy == '{{ $orderedAuctionTypes[$i] }}'">
                @include('partials.auction_cards', ['auctions' => $orderedAuctions[$i]])
            </div>
        @endfor
    </div>
    @include('partials.scripts.remaining_time')
@endsection

