<?php

return [
    'color_main' => ['required', new \Azuriom\Rules\Color()],
    'color_seconde' => ['required', new \Azuriom\Rules\Color()],
    'legal_links' => 'nullable|array',
    'cta_title' => 'required|string',
    'cta_description' => 'required|string',
    'cta_button_type' => 'required|string|in:server,custom',
    'cta_button_text' => 'nullable|string',
    'cta_button_link' => 'nullable|string|url',
    'about_image' => 'nullable|string',
    'about_image2' => 'nullable|string',
    'main_title' => 'required|string',
    'about_button1' => 'required|string',
    'about_button1_link' => 'required|string',
    'main_description' => 'required|string',
    'about_title' => 'required|string',
    'about_description' => 'required|string',
    'about_title_2' => 'required|string',
    'about_description_2' => 'required|string',
    'about_button2' => 'required|string',
    'about_button2_link' => 'required|string',
    'color_about_button_1' => ['required', new \Azuriom\Rules\Color()],
    'color_about_button_2' => ['required', new \Azuriom\Rules\Color()],

];

