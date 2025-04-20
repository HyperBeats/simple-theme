@extends('admin.layouts.admin')

@section('title', 'simple config')

@include('admin.elements.color-picker')
@include('admin.elements.editor')

@push('footer-scripts')
    <script>
        function handleCtaButtonTypeVisibility() {
            const serverType = document.getElementById('buttonTypeServer');
            const customFields = document.getElementById('customButtonFields');
            
            if (customFields) {
                customFields.style.display = serverType.checked ? 'none' : 'block';
            }
        }

        document.addEventListener('DOMContentLoaded', function() {
            const serverType = document.getElementById('buttonTypeServer');
            const customType = document.getElementById('buttonTypeCustom');

            if (serverType && customType) {
                serverType.addEventListener('change', handleCtaButtonTypeVisibility);
                customType.addEventListener('change', handleCtaButtonTypeVisibility);
                
                handleCtaButtonTypeVisibility();
            }
        });

        function addLinkListener(el) {
            el.addEventListener('click', function () {
                const element = el.closest('.row');
                if (element) {
                    element.remove();
                }
            });
        }

        document.querySelectorAll('.link-remove').forEach(function (el) {
            addLinkListener(el);
        });

        document.getElementById('addLinkButton').addEventListener('click', function () {
            let input = '<div class="row g-3"><div class="mb-3 col-md-6">';
            input += '<input type="text" class="form-control" name="footer_links[{index}][name]" placeholder="{{ trans('messages.fields.name') }}"></div>';
            input += '<div class="mb-3 col-md-6"><div class="input-group">';
            input += '<input type="url" class="form-control" name="footer_links[{index}][value]" placeholder="{{ trans('messages.fields.link') }}">';
            input += '<button class="btn btn-outline-danger link-remove" type="button">';
            input += '<i class="bi bi-x-lg"></i></button></div></div></div>';

            const newElement = document.createElement('div');
            newElement.innerHTML = input;

            addLinkListener(newElement.querySelector('.link-remove'));

            document.getElementById('links').appendChild(newElement);
        });

        document.getElementById('addLegalLinkButton').addEventListener('click', function () {
            let input = '<div class="row g-3"><div class="mb-3 col-md-6">';
            input += '<input type="text" class="form-control" name="legal_links[{index}][name]" placeholder="{{ trans('messages.fields.name') }}"></div>';
            input += '<div class="mb-3 col-md-6"><div class="input-group">';
            input += '<input type="url" class="form-control" name="legal_links[{index}][value]" placeholder="{{ trans('messages.fields.link') }}">';
            input += '<button class="btn btn-outline-danger link-remove" type="button">';
            input += '<i class="bi bi-x-lg"></i></button></div></div></div>';

            const newElement = document.createElement('div');
            newElement.innerHTML = input;

            addLinkListener(newElement.querySelector('.link-remove'));

            document.getElementById('legal-links').appendChild(newElement);
        });

        document.getElementById('configForm').addEventListener('submit', function () {
            let i = 0;
            let j = 0;

            document.getElementById('links').querySelectorAll('.row').forEach(function (el) {
                el.querySelectorAll('input').forEach(function (input) {
                    input.name = input.name.replace('{index}', i.toString());
                });
                i++;
            });

            document.getElementById('legal-links').querySelectorAll('.row').forEach(function (el) {
                el.querySelectorAll('input').forEach(function (input) {
                    input.name = input.name.replace('{index}', j.toString());
                });
                j++;
            });
        });
    </script>
@endpush

@section('content')
    <div class="card shadow">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h4 class="mb-0">{{ trans('theme::simple.config.general') }}</h4>
            <a href="https://discord.com/invite/pu2XxCT6VR" class="btn btn-primary" target="_blank" rel="noopener noreferrer">
                <i class="bi bi-discord"></i> Support
            </a>
        </div>
        <div class="card-body">
            <form action="{{ route('admin.themes.config', $theme) }}" method="POST" id="configForm">
                @csrf

                <div class="card bg-light mb-4">
                    <div class="card-body">
                        <div class="mb-3">
                            <label class="form-label" for="color_mainInput">{{ trans('theme::simple.config.color_main') }}</label>
                            <input type="color" class="form-control form-control-color color-picker @error('color_main') is-invalid @enderror" id="colorInput" name="color_main" value="{{ old('color_main', theme_config('color_main', '#c0392b')) }}" required>
                            @error('color_main')
                            <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label class="form-label" for="color_secondeInput">{{ trans('theme::simple.config.color_seconde') }}</label>
                            <input type="color" class="form-control form-control-color color-picker @error('color_seconde') is-invalid @enderror" id="colorInput" name="color_seconde" value="{{ old('color_seconde', theme_config('color_seconde', '#c0392b')) }}" required>
                            @error('color_seconde')
                            <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                            @enderror
                        </div>
                    </div>
                </div>
                <h4 class="mb-3">{{ trans('theme::simple.config.main_section') }}</h4>
                <div class="card bg-light mb-4">
                    <div class="card-body">
                        <div class="mb-3">
                            <label class="form-label" for="mainTitleInput">{{ trans('theme::simple.config.title_main') }}</label>
                            <input type="text" class="form-control @error('main_title') is-invalid @enderror" id="mainTitleInput" name="main_title" value="{{ old('main_title', theme_config('main_title')) }}">

                            @error('main_title')
                            <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label class="form-label" for="main_description">{{ trans('theme::simple.config.main_description') }}</label>
                            <input type="text" class="form-control @error('main_description') is-invalid @enderror" id="mainTitleInput" name="main_description" value="{{ old('main_description', theme_config('main_description')) }}">

                            @error('main_description')
                            <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                            @enderror
                        </div>
                </div>

                <h4 class="mb-3">{{ trans('theme::simple.config.about_section1') }}</h4>
                <div class="card bg-light mb-4">
                    <div class="card-body">
                        <div class="mb-3">
                            <label class="form-label" for="aboutTitleInput">{{ trans('theme::simple.config.about_title') }}</label>
                            <input type="text" class="form-control @error('about_title') is-invalid @enderror" id="aboutTitleInput" name="about_title" value="{{ old('about_title', theme_config('about_title')) }}">

                            @error('about_title')
                            <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label class="form-label" for="aboutDescriptionInput">{{ trans('theme::simple.config.about_description') }}</label>
                            <textarea class="form-control html-editor @error('about_description') is-invalid @enderror" id="aboutDescriptionInput" name="about_description" rows="3">{{ old('about_description', theme_config('about_description')) }}</textarea>

                            @error('about_description')
                            <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label class="form-label" for="aboutButtonInput">{{ trans('theme::simple.config.about_button1') }}</label>
                            <input type="text" class="form-control @error('about_button1') is-invalid @enderror" id="aboutButtonInput" name="about_button1" value="{{ old('about_button1', theme_config('about_button1')) }}">

                            @error('about_button1')
                            <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label class="form-label" for="aboutButtonLinkInput">{{ trans('theme::simple.config.about_button1_link') }}</label>
                            <input type="text" class="form-control @error('about_button1') is-invalid @enderror" id="aboutButtonLinkInput" name="about_button1_link" value="{{ old('about_button1_link', theme_config('about_button1_link')) }}">

                            @error('about_button1_link')
                            <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label class="form-label" for="color_about_button_1">{{ trans('theme::simple.config.color_about_button_1') }}</label>
                            <input type="color" class="form-control form-control-color color-picker @error('color_about_button_1') is-invalid @enderror" id="colorInput" name="color_about_button_1" value="{{ old('color_about_button_1', theme_config('color_about_button_1', '#3cbf42')) }}" required>
                            @error('color_about_button_1')
                            <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                            @enderror
                        </div>

                        <div class="mb-3" v-scope="{ about_image: '{{ old('about_image', theme_config('about_image')) ?? '' }}' }">
                            <label class="form-label" for="aboutImageSelect">{{ trans('theme::simple.config.about_image') }}</label>
                            <div class="input-group mb-3">
                                <a class="btn btn-outline-success" href="{{ route('admin.images.create') }}" target="_blank" rel="noopener noreferrer">
                                    <i class="bi bi-upload"></i>
                                </a>
                                <select class="form-select @error('about_image') is-invalid @enderror" id="aboutImageSelect" v-model="about_image" name="about_image">
                                    <option value="" @selected(!theme_config('about_image'))>
                                        {{ trans('messages.none') }}
                                    </option>
                                    @foreach($images as $image)
                                        <option value="{{ $image->file }}" @selected($image->file === theme_config('about_image'))>
                                            {{ $image->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <img v-if="about_image" :src="about_image ? '{{ image_url() }}/' + about_image : '#'" class="img-fluid rounded img-preview-sm" alt="About Image">

                            @error('about_image')
                            <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                            @enderror
                        </div>
                    </div>
                </div>
                <h4 class="mb-3">{{ trans('theme::simple.config.about_section_2') }}</h4>
                <div class="card bg-light mb-4">
                    <div class="card-body">
                        <div class="mb-3">
                            <label class="form-label" for="aboutTitleInput_2">{{ trans('theme::simple.config.about_title_2') }}</label>
                            <input type="text" class="form-control @error('about_title_2') is-invalid @enderror" id="aboutTitleInput_2" name="about_title_2" value="{{ old('about_title_2', theme_config('about_title_2')) }}">

                            @error('about_title_2')
                            <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label class="form-label" for="aboutDescriptionInput_2">{{ trans('theme::simple.config.about_description_2') }}</label>
                            <textarea class="form-control html-editor @error('about_description_2') is-invalid @enderror" id="aboutDescriptionInput_2" name="about_description_2" rows="3">{{ old('about_description_2', theme_config('about_description_2')) }}</textarea>

                            @error('about_description_2')
                            <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label class="form-label" for="aboutButtonInput">{{ trans('theme::simple.config.about_button2') }}</label>
                            <input type="text" class="form-control @error('about_button2') is-invalid @enderror" id="aboutButtonInput" name="about_button2" value="{{ old('about_button2', theme_config('about_button2')) }}">

                            @error('about_button2')
                            <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label class="form-label" for="aboutButtonLinkInput">{{ trans('theme::simple.config.about_button2_link') }}</label>
                            <input type="text" class="form-control @error('about_button2') is-invalid @enderror" id="aboutButtonLinkInput" name="about_button2_link" value="{{ old('about_button2_link', theme_config('about_button2_link')) }}">

                            @error('about_button2_link')
                            <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label class="form-label" for="color_about_button_2">{{ trans('theme::simple.config.color_about_button_2') }}</label>
                            <input type="color" class="form-control form-control-color color-picker @error('color_about_button_2') is-invalid @enderror" id="colorInput" name="color_about_button_2" value="{{ old('color_about_button_2', theme_config('color_about_button_2', '#4630D0')) }}" required>
                            @error('color_about_button_2')
                            <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                            @enderror
                        </div>

                        <div class="mb-3" v-scope="{ about_image2: '{{ old('about_image2', theme_config('about_image2')) ?? '' }}' }">
                            <label class="form-label" for="aboutImageSelect">{{ trans('theme::simple.config.about_image2') }}</label>
                            <div class="input-group mb-3">
                                <a class="btn btn-outline-success" href="{{ route('admin.images.create') }}" target="_blank" rel="noopener noreferrer">
                                    <i class="bi bi-upload"></i>
                                </a>
                                <select class="form-select @error('about_image2') is-invalid @enderror" id="aboutImageSelect" v-model="about_image2" name="about_image2">
                                    <option value="" @selected(!theme_config('about_image2'))>
                                        {{ trans('messages.none') }}
                                    </option>
                                    @foreach($images as $image)
                                        <option value="{{ $image->file }}" @selected($image->file === theme_config('about_image2'))>
                                            {{ $image->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <img v-if="about_image2" :src="about_image2 ? '{{ image_url() }}/' + about_image2 : '#'" class="img-fluid rounded img-preview-sm" alt="About Image">

                            @error('about_image2')
                            <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                            @enderror
                        </div>
                    </div>
                </div>

                <h4 class="mb-3">{{ trans('theme::simple.config.cta_section') }}</h4>
                <div class="card bg-light mb-4">
                    <div class="card-body">
                        <div class="mb-3">
                            <label class="form-label" for="ctaTitleInput">{{ trans('theme::simple.config.cta_title') }}</label>
                            <input type="text" class="form-control @error('cta_title') is-invalid @enderror" id="ctaTitleInput" name="cta_title" value="{{ old('cta_title', theme_config('cta_title')) }}">

                            @error('cta_title')
                            <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label class="form-label" for="ctaDescriptionInput">{{ trans('theme::simple.config.cta_description') }}</label>
                            <textarea class="form-control @error('cta_description') is-invalid @enderror" id="ctaDescriptionInput" name="cta_description" rows="2">{{ old('cta_description', theme_config('cta_description')) }}</textarea>

                            @error('cta_description')
                            <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label class="form-label">{{ trans('theme::simple.config.cta_button_type') }}</label>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="cta_button_type" id="buttonTypeServer" value="server" @checked(old('cta_button_type', theme_config('cta_button_type', 'server')) === 'server')>
                                <label class="form-check-label" for="buttonTypeServer">
                                    {{ trans('theme::simple.config.cta_button_type_server') }}
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="cta_button_type" id="buttonTypeCustom" value="custom" @checked(old('cta_button_type', theme_config('cta_button_type')) === 'custom')>
                                <label class="form-check-label" for="buttonTypeCustom">
                                    {{ trans('theme::simple.config.cta_button_type_custom') }}
                                </label>
                            </div>
                        </div>

                        <div id="customButtonFields" style="display: {{ old('cta_button_type', theme_config('cta_button_type', 'server')) === 'custom' ? 'block' : 'none' }}">
                            <div class="mb-3">
                                <label class="form-label" for="ctaButtonTextInput">{{ trans('theme::simple.config.cta_button_text') }}</label>
                                <input type="text" class="form-control @error('cta_button_text') is-invalid @enderror" id="ctaButtonTextInput" name="cta_button_text" value="{{ old('cta_button_text', theme_config('cta_button_text')) }}">

                                @error('cta_button_text')
                                <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label class="form-label" for="ctaButtonLinkInput">{{ trans('theme::simple.config.cta_button_link') }}</label>
                                <input type="url" class="form-control @error('cta_button_link') is-invalid @enderror" id="ctaButtonLinkInput" name="cta_button_link" value="{{ old('cta_button_link', theme_config('cta_button_link')) }}">

                                @error('cta_button_link')
                                <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                @enderror
                            </div>
                        </div>
                    </div>
                </div>
                <h4 class="mb-3">{{ trans('theme::simple.config.footer_section') }}</h4>
                <div class="card bg-light mb-4">
                    <div class="card-body">
                        <div class="mb-3">
                        <label class="form-label">{{ trans('theme::simple.config.legal_links') }}</label>

                        <div id="legal-links">
                            @foreach(theme_config('legal_links') ?? [] as $link)
                                <div class="row g-3">
                                    <div class="mb-3 col-md-6">
                                        <input type="text" class="form-control" name="legal_links[{index}][name]" placeholder="{{ trans('messages.fields.name') }}" value="{{ $link['name'] }}">
                                    </div>

                                    <div class="mb-3 col-md-6">
                                        <div class="input-group">
                                            <input type="url" class="form-control" name="legal_links[{index}][value]" placeholder="{{ trans('messages.fields.link') }}" value="{{ $link['value'] }}">
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>

                        <button type="submit" class="btn btn-primary">
                            <i class="bi bi-save"></i> {{ trans('messages.actions.save') }}
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
