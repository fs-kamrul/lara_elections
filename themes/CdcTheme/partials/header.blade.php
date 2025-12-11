<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="UTF-8"/>
    <meta http-equiv="X-UA-Compatible" content="IE=edge"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>

    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&display=swap"
          rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/remixicon@3.5.0/fonts/remixicon.css" rel="stylesheet" />

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/tiny-slider/2.9.4/tiny-slider.css" />
    {!! Theme::header() !!}

    @php
        $slider_logo = theme_option('logo_color');
    @endphp
    <script>
        window.siteUrl = "{{ url('') }}";
        window.siteEditorLocale = "{{ apply_filters('cms_site_editor_locale', App::getLocale()) }}";
    </script>
    @php
        $headerStyle = theme_option('header_style') ?: '';
        $page = Theme::get('page');
        if ($page) {
            $headerStyle = $page->getMetaData('header_style', true) ?: $headerStyle;
        }
        $headerStyle = ($headerStyle && in_array($headerStyle, array_keys(get_layout_header_styles()))) ? $headerStyle : '';
//            dd($headerStyle);
    @endphp
</head>
<body>
@php
    $logo_image = theme_option('logo');
    $baseUrl = url('/');
@endphp

<section>
    <!-- Top Navbar (Hidden on Mobile) -->
    <nav class="bg-white shadow-lg lg:block hidden">
        <div class="max-w-6xl mx-auto px-4 py-5 lg:px-0">
            <div class="flex items-center justify-between">
                <!-- Logo -->
                <div class="flex items-center">
                    <a href="{{ url('/') }}" class="flex items-center">
                        <img src="{{ getImageUrlById($logo_image, 'shortcodes') }}" alt="{{ theme_option('site_title') }}"
                             class="h-10 transition-transform duration-300 hover:scale-105" />
                    </a>
                </div>
                <div class="hidden items-center space-x-8 lg:flex">
                    {!! Menus::renderMenuLocation('header-menu', [
                        'view'    => 'menu_header',
                        'status'    => 'nav-item nav-link',
                        'options' => ['class' => 'navbar-nav nav_right'],
                    ]) !!}
                </div>

                <div class="flex items-center gap-8">
                    {!! Menus::renderMenuLocation('right-menu', [
                        'view'    => 'menu_right',
                        'status'    => 'nav-item nav-link',
                        'options' => ['class' => 'navbar-nav nav_right'],
                    ]) !!}
                    <!--            <a href="#" class="hover:text-primary-blue text-4xl transition-colors duration-200">-->
                    <!--              <i class="ri-grid-fill"></i>-->
                    <!--            </a>-->
                    <!--              ri-apps-fill-->
                    <!--              relative inline-block overflow-hidden rounded-full bg-blue-50 px-6 py-3 text-sm font-medium uppercase text-blue-600 transition-all duration-300 hover:bg-blue-600 hover:text-white-->
                    <!-- Google-style App Menu with Red Circle -->
                    <div class="relative" id="appMenuContainer">
{{--                        <button id="appMenuButton"--}}
{{--                                class="relative flex h-14 w-14 items-center justify-center rounded-full border-4 border-red-500 text-gray-600 transition-all duration-200 hover:bg-gray-50">--}}
{{--                            <i class="ri-apps-fill text-3xl"></i>--}}
{{--                        </button>--}}
                        <button id="appMenuButton"
                                class="hover:text-primary-blue text-gray-500 text-3xl transition-colors duration-200">
                            <i class="ri-grid-fill "></i>
                        </button>

                        <!-- Dropdown Menu -->
                        <div id="appMenuDropdown"
                             class="absolute right-0 top-20 z-50 hidden w-96 rounded-2xl bg-white p-5 shadow-xl animate-in fade-in slide-in-from-top-2 duration-200"
                             style="border: 1px solid rgba(0,0,0,0.1);">

                            <!-- Grid of App Icons -->
                            <div class="grid grid-cols-3 gap-2">
                                {!! Menus::renderMenuLocation('apps-menu', [
                                    'view'    => 'menu_apps',
                                    'status'    => 'nav-item nav-link',
                                    'options' => ['class' => 'navbar-nav nav_right'],
                                ]) !!}

                            </div>

                            <!-- Divider -->
{{--                            <div class="my-3 border-t border-gray-200"></div>--}}

                            <!-- More Apps Link -->
                            <!--                      <a href="#" class="flex items-center justify-center gap-2 rounded-lg py-3 text-sm font-medium text-blue-600 transition-colors duration-200 hover:bg-blue-50">-->
                            <!--                          <span>More from CDC</span>-->
                            <!--                          <i class="ri-arrow-right-line"></i>-->
                            <!--                      </a>-->
                        </div>
                    </div>
                </div>
                <!-- Mobile menu button (not used since hidden on mobile) -->
                <div class="lg:hidden">
                    <button id="desktop-mobile-menu-button" class="text-gray-600 hover:text-blue-600 focus:outline-none">
                        <i class="ri-menu-line text-2xl"></i>
                    </button>
                </div>
            </div>
        </div>
    </nav>

    <nav class="bg-primary-blue text-white">
        <div class="max-w-6xl mx-auto px-4 py-3 lg:px-0">
            <div class="flex items-center justify-between lg:hidden">
                <!-- Logo for Mobile -->
                <div class="flex items-center">
                    <a href="{{ url('/') }}" class="flex items-center">
                        <img src="{{ getImageUrlById($logo_image, 'shortcodes') }}" alt="{{ theme_option('site_title') }}"
                             class="h-12 transition-transform duration-300 hover:scale-105" />
                    </a>
                </div>
                <!-- Mobile menu button -->
                <button id="mobile-menu-button" class="text-white hover:text-blue-200 focus:outline-none">
                    <i class="ri-menu-line text-2xl"></i>
                </button>
            </div>
            <div class="hidden lg:flex">
                <div class="flex space-x-10">
                    {!! Menus::renderMenuLocation('main-menu', [
                        'view'    => 'menu_custom',
                        'status'    => 'dropdown group relative py-4',
                        'level'      => 0,
                        'options' => ['class' => 'flex items-center text-white hover:text-blue-200 focus:outline-none transition-colors duration-200 cursor-pointe'],
                    ]) !!}
                </div>
            </div>
        </div>
    </nav>
    <div id="mobile-menu" class="mobile-menu fixed inset-y-0 right-0 w-80 bg-white shadow-2xl lg:hidden z-50">
        <div class="relative h-full overflow-y-auto">
            <div class="flex justify-end p-4">
                <button id="mobile-menu-close" class="text-gray-600 hover:text-blue-600 focus:outline-none">
                    <i class="ri-close-line text-2xl"></i>
                </button>
            </div>
            {!! Menus::renderMenuLocation('header-menu', [
                       'view'    => 'menu_mobile',
                       'status'    => 'block py-2 text-gray-600 hover:text-blue-600 transition-colors duration-200 font-medium',
                       'options' => ['class' => 'space-y-3 px-6 pb-6'],
                       ]) !!}
            {!! Menus::renderMenuLocation('right-menu', [
                       'view'    => 'menu_mobile',
                       'status'    => 'block py-2 text-gray-600 hover:text-blue-600 transition-colors duration-200 font-medium',
                       'options' => ['class' => 'space-y-3 px-6 pb-6'],
                       ]) !!}
            {!! Menus::renderMenuLocation('main-menu', [
               'view'    => 'menu_mobile',
               'status'    => 'block py-2 text-gray-600 hover:text-blue-600 transition-colors duration-200 font-medium',
               'options' => ['class' => 'space-y-3 px-6 pb-6'],
            ]) !!}
        </div>
    </div>
</section>
