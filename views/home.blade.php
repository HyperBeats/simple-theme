@extends('layouts.base')

@section('title', trans('messages.home'))

@section('app')
    <section class="about-section @if ($posts->isEmpty()) pt-5 mt-4 @endif">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-5">
                    <img src="{{ theme_config('about_image') ? image_url(theme_config('about_image')) : theme_asset('img/54335565.png') }}"
                        alt="About Image" class="about-image">
                </div>
                <div class="col-lg-7">
                    <div class="about-content">
                        <h1 class="section-title">
                            {{ theme_config('about_title') }}
                        </h1>
                        <p class="description">
                            {!! theme_config('about_description') !!}
                        </p>
                        <div class="text-center mt-4">
                            <a href="{{ theme_config('about_button1_link') }}" class="btn btn-primary btn-primary-custom btn-primary-custom-section-1">{{ theme_config('about_button1') }}</a>
                        </div>
                    </div>
                </div>
        </div>
    </section>
    <section class="about-section @if ($posts->isEmpty()) pt-5 mt-4 @endif">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6">
                    <div class="about-content">
                        <h1 class="section-title align-items-center">
                            {{ theme_config('about_title_2') }}
                        </h1>
                        <p class="description ">
                            {!! theme_config('about_description_2') !!}
                        </p>
                        <div class="text-center mt-4">
                            <a href="{{ theme_config('about_button2_link') }}" class="btn btn-primary btn-primary-custom btn-primary-custom-section-2">{{ theme_config('about_button2') }}</a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-5">
                    <img src="{{ theme_config('about_image2') ? image_url(theme_config('about_image2')) : theme_asset('img/54335565.png') }}"
                        alt="About Image" class="about-image">
                </div>
            </div>
        </div>
    </section>
    <section class="cta-section">
        <div class="container">
            <div class="cta-wrapper">
                <div class="row justify-content-center">
                    <div class="col-lg-8 text-center">
                        <h2 class="cta-title">{{ theme_config('cta_title') }}</h2>
                        <p class="cta-description">{{ theme_config('cta_description') }}</p>
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
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
