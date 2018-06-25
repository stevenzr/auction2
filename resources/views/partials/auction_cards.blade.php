@if(Route::currentRouteName() == 'art') {!! $auctions->appends($request->except(['page']))->links() !!} @endif
<div class="auction-cards">
    @forelse($auctions as $auction)
        <div class="auction-card">
            <a href="{{ route('auctionDetail', ['auction' => $auction, 'auctionTitle' => clean($auction->title)]) }}">
                <img src="{{ staticImage($auction->artwork_image_path) }}" alt="{{ $auction->title }}">
            </a>
            <div class="auction-info">
                <div class="year">{{ $auction->year }}</div>
                <div class="title">
                    <a href="{{ route('auctionDetail', ['auction' => $auction, 'auctionTitle' => clean($auction->title)]) }}">{{ $auction->title }}</a>
                </div>
                <div class="price"> Minimum / Open price
                    <p>Rp. {{ formatPrice($auction->min_price) }}</p>
                </div>
                <div class="space">
                    <span class="remaining-time" data-end-date="{{ $auction->end_date }}"></span>
                    <a href="{{ route('auctionDetail', ['auction' => $auction, 'auctionTitle' => clean($auction->title)]) }}" class="small-button">@lang('art.visit_auction')</a>
                </div>
            </div>
        </div>
    @empty
        <p>@lang('auction_table.no_auctions')</p>
    @endforelse
</div>
@if(Route::currentRouteName() == 'art') {!! $auctions->appends($request->except(['page']))->links() !!} @endif
