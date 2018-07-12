@extends('layouts.main')

@section('title', trans('mybids.mybids'))

@section('content')

@include('partials.auction_table', ['auctions' => $endedAuctions])

 @endsection
