<header>
    <div class="wrapper">
        <div class="header-personal">
            <div class="headergua">
            <nav>
                <ul>
                    @guest
                        <li>
                            <a class="{{ Route::is('register') ? 'active' : '' }}"  href="{{ route('register') }}">
                                @lang('header.register')
                            </a>
                        </li>
                        <li id="login" v-bind:style="{ borderLeft: borderLeft, paddingLeft: paddingLeft }">
                            <a href="{{route ('login')}}">
                                @lang('header.login')
                            </a>
                        </li>
                    @endguest
                    @auth
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
            </div>
        </div>
    </div>
    @include('partials.header_nav')
</header>
