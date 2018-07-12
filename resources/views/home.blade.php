@extends('layouts.app')

@section('title', trans('home.home'))

@section('main')

<div id="myCarousel" class="carousel slide" data-ride="carousel">
  <!-- Indicators -->
  <ol class="carousel-indicators">
    <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
    <li data-target="#myCarousel" data-slide-to="1"></li>
    <li data-target="#myCarousel" data-slide-to="2"></li>
  </ol>

  <!-- Wrapper for slides -->
  <div class="carousel-inner">
    <div class="item active">
      <img src="img/auction-3.jpg" style="width:100%;height:100%;" alt="Los Angeles">
    </div>

    <div class="item">
      <img src="img/test2.jpg" style="width:100%;height:100%;" alt="Chicago">
    </div>

    <div class="item">
      <img src="img/test1.jpg" style="width:100%;height:100%;" alt="New York">
    </div>
  </div>

  <!-- Left and right controls -->
  <a class="left carousel-control" href="#myCarousel" data-slide="prev">
    <span class="glyphicon glyphicon-chevron-left"></span>
    <span class="sr-only">Previous</span>
  </a>
  <a class="right carousel-control" href="#myCarousel" data-slide="next">
    <span class="glyphicon glyphicon-chevron-right"></span>
    <span class="sr-only">Next</span>
  </a>
</div>

    <div class="info">
        <h2>@lang('home.how_does_it_work')</h2>
        @foreach(trans('home.explanations') as $key => $explanation)
            <div>
                <img src="{{ staticImage("img/{$key}.png") }}" alt="{{ $explanation }}">
                <h3>{{ $explanation }}</h3>
            </div>
        @endforeach
    </div>
    <div class ="stretch-bg2">
        <div style="text-align:center" >
            <h2>@lang('home.new_auction')</h2>
            <br>
        </div>
           <div class= "new-auctionsec">
            <a href="#">@include('partials.auction_cards', ['auctions' => $new1])</a>
            @include('partials.scripts.remaining_time')
        </div>
    </div>
@endsection
