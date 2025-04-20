@extends('layouts.app')

@section('title', 'Launcher')

@section('content')
    <p class="text-center description-launcher">{{ empty($description) ? trans('launcher::messages.description') : $description }}</p>

    <div class="row text-center">
        @if($type)
            <div class="offset-md-4 col-md-4">
                <div class="card">
                    <div class="card-body">
                        <a href="{{ $link }}" target="_blank">
                            <span class="display-1 mb-2"><i class="{{ $icon }}"></i></span>

                            <p class="card-text">
                                {{ $ressourceName }}
                            </p>
                        </a>
                    </div>
                </div>
            </div>
        @else
        @if(!$linuxEnabled)
            <div class="col-md-4">
                <div class="card">
                    <div class="card-body">
                        <a href="{{ $linux }}" target="_blank" class="text-reset d-block">
                            <span class="display-1 mb-2">
                                <img src="https://upload.wikimedia.org/wikipedia/commons/3/35/Tux.svg" alt="Linux" class="os-icon">
                                </svg>
                            </span>

                            <p class="card-text">
                            </p>
                        </a>
                    </div>
                </div>
            </div>
        @endif
        @if(!$windowsEnabled)
            <div class="col-md-4">
    <div class="card">
        <div class="card-body">
            <a href="{{ $windows }}" target="_blank" class="text-reset d-block">
                <span class="display-1 mb-2">
                    <img src="https://upload.wikimedia.org/wikipedia/commons/5/5f/Windows_logo_-_2012.svg" alt="Windows" class="os-icon">
                </span>
                <p class="card-text">
                </p>
            </a>
        </div>
    </div>
</div>
        @endif
        @if(!$macEnabled)
            <div class="col-md-4">
                <div class="card">
                    <div class="card-body">
                        <a href="{{ $mac }}" target="_blank" class="text-reset d-block">
                            <span class="display-1 mb-2">
                                <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/f/fa/Apple_logo_black.svg/488px-Apple_logo_black.svg.png" alt="Mac" class="os-icon">
                            </span>

                            <p class="card-text">
                            </p>
                        </a>
                    </div>
                </div>
            </div>
        @endif
    @endif
</div>
@endsection