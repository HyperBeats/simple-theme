
<nav class="navbar navbar-expand-lg navbar-dark fixed-top">
    <div class="container">
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
            aria-controls="navbarNav" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse justify-content-center" id="navbarNav">
            <!-- Menu de navigation -->
            <ul class="navbar-nav">
                @foreach ($navbar as $element)
                    @if (!$element->isDropdown())
                        <li class="nav-item">
                            <a class="nav-link @if ($element->isCurrent()) active @endif"
                                href="{{ $element->getLink() }}"
                                @if ($element->new_tab) target="_blank" rel="noopener noreferrer" @endif>
                                {{ $element->name }}
                            </a>
                        </li>
                    @else
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle @if ($element->isCurrent()) active @endif"
                                href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                {{ $element->name }} <i class="bi bi-chevron-down ms-1"></i>
                            </a>
                            <ul class="dropdown-menu">
                                @foreach ($element->elements as $childElement)
                                    <li>
                                        <a class="dropdown-item @if ($childElement->isCurrent()) active @endif"
                                            href="{{ $childElement->getLink() }}"
                                            @if ($childElement->new_tab) target="_blank" rel="noopener noreferrer" @endif>
                                            {{ $childElement->name }}
                                        </a>
                                    </li>
                                @endforeach
                            </ul>
                        </li>
                    @endif
                @endforeach
            </ul>

            <div class="ms-auto d-flex align-items-center">
                @auth
                    <div class="d-flex align-items-center">
                        <div class="dropdown">
                            <div class="d-flex align-items-center dropdown-toggle" role="button" data-bs-toggle="dropdown"
                                aria-expanded="false" data-bs-auto-close="outside">
                                <img src="{{ Auth::user()->getAvatar() }}" alt="Player Avatar"
                                    class="nav-avatar" width="32" height="32">
                                <span class="text-white ms-2 fw-bold">{{ Auth::user()->name }}</span>
                            </div>
                            <ul class="dropdown-menu dropdown-menu-end">
                                <a class="dropdown-item" href="{{ route('profile.index') }}">
                                    <i class="bi bi-person"></i> {{ trans('messages.nav.profile') }}
                                </a>
                                @foreach(plugins()->getUserNavItems() ?? [] as $navId => $navItem)
                                <a class="dropdown-item" href="{{ route($navItem['route']) }}">
                                    <i class="{{ $navItem['icon'] ?? 'bi bi-three-dots' }}"></i> {{ trans($navItem['name']) }}
                                </a>
                            @endforeach
                            @if(Auth::user()->hasAdminAccess())
                            <a class="dropdown-item" href="{{ route('admin.dashboard') }}">
                                <i class="bi bi-speedometer2"></i> {{ trans('messages.nav.admin') }}
                            </a>
                        @endif
                                <li>
                                    <hr class="dropdown-divider">
                                </li>
                                <li>
                                    <a class="dropdown-item text-danger" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                        <i class="bi bi-box-arrow-right"></i> {{ trans('auth.logout') }}
                                    </a>
                                </li>
                                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                    @csrf
                                </form>
                            </ul>
                        </div>
                        <div class="notification-bell ms-1">
                            @include('elements.notifications')
                        </div>
                    </div>
                    @else
                        @if (Route::has('register'))
                            <a href="{{ route('register') }}"
                                class="btn auth-button me-2">{{ trans('auth.register') }}</a>
                        @endif
                        <a href="{{ route('login') }}" class="btn auth-button me-3">{{ trans('auth.login') }}</a>
                    @endauth
                </div>
            </div>
        </div>
    </div>
</nav>
<section class="hero-section"
    <div class="hero-content">
        <div class="container text-center">
            <div style="display: flex; flex-direction: column; align-items: center;">
                <h1 class="hero-logo">{{ theme_config('main_title') }}</h1>
                <p class="description_main">
                    {!! theme_config('main_description') !!}
                </p>
                @if(theme_config('cta_button_type', 'server') === 'server')
                            @if (!$servers->isEmpty())
                                @foreach ($servers as $server)
                                    <button class="btn btn-primary cta-button server-ip "
                                        data-clipboard-text="{{ $server->fullAddress() }}"
                                        data-copy-message="{{ trans('theme::simple.home.ip') }}">
                                        {{ $server->fullAddress() }}
                                    </button>
                                @endforeach
                            @endif
                        @else
                            <a href="{{ theme_config('cta_button_link') }}" class="btn btn-primary cta-button ">
                                {{ theme_config('cta_button_text') }}
                            </a>
                        @endif
                        <div class="players-frame">
                            @if (!$servers->isEmpty())
                                {{ $server->getOnlinePlayers() }}
                            @else
                                0
                            @endif
                            {{ trans('theme::simple.home.online_server_text') }}
                        </div>
            </div>
        </div>
    </div>
</section>
