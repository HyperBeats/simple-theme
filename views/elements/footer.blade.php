<footer class="footer">
    <div class="container">
        <div class="footer-content d-flex justify-content-between align-items-center">
            <!-- Left Section: Logo and Text -->
            <div class="footer-left d-flex align-items-center">
                <img src="{{ site_logo() }}" alt="Logo" class="footer-logo" style="height: 50px; margin-right: 15px;">
                <div>
                    <h5 class="footer-title mb-0">{{ site_name(0) }}</h5>
                    @foreach (theme_config('legal_links') ?? [] as $link)
                    <p class="footer-copyright mt-1 mb-0 "> <a href="{{ $link['value'] }}">{{ $link['name'] }}</a></p>
                    @endforeach

                </div>
            </div>
            <!-- Right Section: Icons -->
            <div class="footer-right">
                <div class="social-links d-flex flex-wrap" style="gap: 0.55rem; max-width: 140px;">
                    @foreach (social_links() as $link)
                        <a href="{{ $link->value }}" target="_blank" rel="noopener noreferrer">
                            <i class="{{ $link->icon }}"></i>
                        </a>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
    <div class="footer-bottom">
        <div class="container">
            <div class="footer-middle d-flex justify-content-center align-items-center">
                <p class="copyright-main">{{ setting('copyright') }}</p>
                <p class="copyright-sub">@lang('messages.copyright') {{ trans('theme::simple.footer.developed_by') }} <a href="https://github.com/HyperBeats" class="footer-author">HyperBeats</a></p>
                </div>
            </div>
        </div>
    </div>
</footer>