@component('mail::message')
# Dear {{ $userName }}

{{ $auctionTitle }} has ended.
No one is biding in your acution, and your auction has been moved to Expired status,
Please check in the website..

@component('mail::button', ['url' => config('app.url')])
Visit the site
@endcomponent

Thank you,<br>
{{ config('app.name') }}
@endcomponent
