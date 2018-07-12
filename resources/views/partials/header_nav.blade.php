<div class="stretch-bg">
    <div class="wrapper">
        <div class="header-nav">
            <nav>
                <ul>
                    <li>@include('partials.search')</li>
                    <li><a class="{{Route::is('home') ? 'active' : '' }}" href="{{ route('home') }}">@lang('header.home')</a></li>


            <li class="dropdown"><a href="#">CATEGORY</a>
                    <div class="dropdown-content">
                        <a href="{{ route('products')}}">All Products</a>
                        <a href="{{ route('accessories') }}">Accessories</a>
                        <a href="{{ route('electronic') }}">Electronic</a>
                        <a href="{{ route('hobbies') }}">Hobbies</a>
                        <a href="{{ route('toys') }}">Toys</a>
                    </div>
                </li>
                    @auth
                    <li>
                            <a class="{{ Route::is('watchlist') ? 'active' : '' }}" href="{{ route('watchlist') }}">
                                @lang('header.watchlist')
                            </a>
                        </li>
                    <li><a class="{{ Route::is('myAuctions') ? 'active' : '' }}" href="{{ route('myAuctions') }}">@lang('header.myauctions')</a></li>
                    @endauth
                </ul>
            </nav>

        </div>
    </div>
</div>
