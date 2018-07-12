@extends('layouts.main')

@section('title', trans('new_auction.new_auction'))

@section('content')
    <div class="new-auction">
        <h1>@lang('new_auction.add_new_auction')</h1>
        @include('partials.errors')
        {!! Form::open(['route' => 'addAuction', 'files' => true]) !!}
        <div class="row1">
            <div class="row-item two-third">
                {!! Form::select('category', trans('footer.categories'), null, ['placeholder' => trans('new_auction.category'), 'class' => $errors->has('category') ? 'has-error' : '']) !!}
            </div>
        </div>
        <div class="row1">
            <div class="row-item two-third">
                {!! Form::label('title', trans('new_auction.title')) !!}
                {!! Form::text('title', '', ['placeholder' => trans('new_auction.title'), 'class' => $errors->has('title') ? 'has-error' : '', 'maxlength' => 255]) !!}
            </div>
        </div>
        <div class="row1">
            <div class="row-item full">
                {!! Form::label('description', trans('new_auction.description')) !!}
                {!! Form::textarea('description', '', ['placeholder' => trans('new_auction.description_placeholder'), 'class' => $errors->has('description') ? 'has-error' : '', 'maxlength' => 10000]) !!}
            </div>
        </div>

        <div class="row1">
            <div class="row-item full">
                {!! Form::label('photos', trans('new_auction.photos')) !!}
                @foreach(trans('new_auction.photos_texts') as $photos_text)
                    <p>{{ $photos_text }}</p>
                @endforeach
            </div>
        </div>
        <div class="row1">
            @foreach(trans('new_auction.upload_texts') as $key => $upload_text)
                <div class="row-item third {{ $errors->has("{$key}_image") ? 'has-error' : '' }}">
                    {!! Form::label("{$key}_image", $upload_text, ['class' => 'upload']) !!}
                    {!! Form::file("{$key}_image") !!}
                </div>
            @endforeach
        </div>
        <div class="row1">
            <div class="row-item">
                <h2>@lang('new_auction.pricing')</h2>
            </div>
        </div>
        <div class="row cash">
            <div class="row-item third">
                {!! Form::label('min_price', trans('new_auction.min_price')) !!}
                <span>Rp</span>
                {!! Form::number('min_price', '', ['class' => $errors->has('min_price') ? 'has-error' : '', 'min' => 0, 'max' => 99999999]) !!}
            </div>
            <div class="row-item third">
                {!! Form::label('max_price', trans('new_auction.max_price')) !!}
                <span>Rp</span>
                {!! Form::number('max_price', '', ['class' => $errors->has('max_price') ? 'has-error' : '', 'min' => 0, 'max' => 99999999]) !!}
            </div>
            <div class="row-item third optional">
                {!! Form::label('buyout_price', trans('new_auction.buyout_price')) !!}
                {!! Form::label('buyout_price', trans('new_auction.optional')) !!}
                <span>Rp</span>
                {!! Form::number('buyout_price', '', ['class' => $errors->has('buyout_price') ? 'has-error' : '', 'min' => 0, 'max' => 99999999]) !!}
            </div>
        </div>
        <div class="row1">
            <div class="row-item third">
                {!! Form::label('end_date', trans('new_auction.end_date')) !!}
                {!! Form::text('end_date', '', ['placeholder' => trans('new_auction.end_date_placeholder'), 'class' => $errors->has('end_date') ? 'has-error' : '', 'maxlength' => 8]) !!}
            </div>

        </div>
        @include('partials.agree_tac')
        <div class="row1">
            <div class="row-item">
                {!! Form::submit(trans('new_auction.add_auction'), ['class' => 'big-button']) !!}
            </div>
        </div>
        {!! Form::close() !!}
    </div>
@endsection
