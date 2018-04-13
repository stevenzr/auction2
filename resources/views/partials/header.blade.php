<header>
    <div class="wrapper">
        <div class="header-personal">
            <nav>
                <ul>
                    @guest
                        <li>
                            <a class="{{ Route::is('register') ? 'active' : '' }}"  href="{{ route('register') }}">
                                @lang('header.register')
                            </a>
                        </li>
                        <li id="login" v-bind:style="{ borderLeft: borderLeft, paddingLeft: paddingLeft }">
                            <a href="#" v-on:click.prevent="showLoginForm" v-if="!loginFormIsShown">
                                @lang('header.login')
                            </a>
                            {!! Form::open(['route' => 'login', 'v-if' => 'loginFormIsShown']) !!}
                            {!! Form::email('email', '', ['placeholder' => trans('header.email')]) !!}
                            {!! Form::password('password', ['placeholder' => trans('header.password')]) !!}
                            {!! Form::submit('&gt;') !!}
                            <a href="{{ route('password.request') }}">@lang('header.forgot_password')</a>
                            {!! Form::close() !!}
                        </li>
                    @endguest
                    @auth
                        <li>
                            <span class="icons-hamburger"></span>
                            <a class="{{ Route::is('watchlist') ? 'active' : '' }}" href="{{ route('watchlist') }}">
                                @lang('header.watchlist')
                            </a>
                        </li>
                        <li>
                            <span class="icons-person"></span>
                            <a class="{{ Route::is('profile') ? 'active' : '' }}" href="{{ route('profile') }}">
                                @lang('header.profile')
                            </a>
                        </li>
                        <li class="logout">
                            <a href="#">
                                {!! Form::open(['route' => 'logout']) !!}
                                {!! Form::submit(trans('header.logout')) !!}
                                {!! Form::close() !!}
                            </a>
                        </li>
                    @endauth
                </ul>
            </nav>
            @include('partials.search')
        </div>
    </div>
    @include('partials.header_nav')
</header>
