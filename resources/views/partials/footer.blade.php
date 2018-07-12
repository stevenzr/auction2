<footer>
    <div class="wrapper">
        <div class="sitemap">
            <div class="col">
                @guest
                    <ul>
                        <li>@lang('footer.user')</li>
                        <li><a href="#">@lang('footer.login')</a></li>
                        <li><a href="{{ route('register') }}">@lang('footer.register')</a></li>
                    </ul>
                @endguest
                <ul>
                    <li>@lang('footer.help')</li>
                    @foreach(trans('footer.help_texts') as $help_text)
                        <li><a href="{{route('termsAndCondition')}}">{{ $help_text }}</a></li>
                    @endforeach
                </ul>

            </div>
            <div class="col">
                <ul>
                    <li>@lang('footer.category')</li>
                    <li><a href="{{ route('accessories') }}">Accessories</a></li>
                    <li><a href="{{ route('electronic') }}">Electronic</a></li>
                    <li><a href="{{ route('hobbies') }}">Hobbies</a></li>
                    <li><a href="{{ route('toys') }}">Toys</a></li>
                </ul>
            </div>
            <div class="col">
                <ul>
                   <li>@lang('footer.social')</li>
                   <div class="social">
                    <a class="icons-facebook" href="https://www.facebook.com"></a>
                    <a class="icons-twitter" href="https://www.twitter.com"></a>
                    <a class="icons-youtube" href="https://www.youtube.com"></a>
                    <a class="icons-plus" href="https://www.plus.google.com"></a>
                   </div>
                </ul>
            </div>
        </div>
        <div class="contact">
            <ul>
                <li>@lang('footer.find_what_you_need')</li>
                <li>@include('partials.search')</li>
            </ul>

            <div class="copyright">@lang('footer.copyright')</div>
        </div>
    </div>
</footer>
