@component('mail::message')
# Dear {{ $userName }}

{{ $auctionTitle }} has ended.

No one is biding in your acution, and your auction has been moved to Expired status,
Please check in the website..
The price of your latest bid was Rp. {{ formatPrice($latestBidPrice)  }}.
@if($hasHighestBid)
You got the highest bid, congratulations on your purchase!
@else
You didn't get the highest bid, better luck next time.
@endif


@component('mail::button', ['url' => config('app.url')])
Visit the site
@endcomponent

Thank you,<br>
{{ config('app.name') }}
@endcomponent
