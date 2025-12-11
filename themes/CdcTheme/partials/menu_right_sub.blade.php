{{--<ul {!! $options !!}>--}}
    @foreach ($menu_nodes as $key => $row)
        @if($row->css_class == 'all_menu')
            <div class="inline-block text-left">
                <!--Hoverable Link-->
                <div class="hoverable hover:text-white">
        @endif
{{--        <li class="@if ($row->has_child) dropdown @endif @if ($row->active) current-menu-item @endif">--}}
        <a class=" @if ($row->has_child)  @endif
        @if($row->css_class == 'menu_btn') before:btn_clip before:content[''] hover:before:btn_clip_hover relative inline-block overflow-hidden rounded-full bg-background-sky-2 px-5 py-4   text-sm font-normal uppercase text-primary-blue before:absolute before:inset-0 before:duration-500 before:ease-in-out hover:text-white hover:before:bg-primary-blue
           @else block py-6 px-4 lg:px-6 lg:py-8 text-sm lg:text-base font-bold group hover:text-white @endif"
           @if ($row->has_child)  @endif
           href="{{ url($row->url) }}" @if ($row->target !== '_self') target="{{ $row->target }}" @endif>
            @if ($row->icon_font) <i class="{{ trim($row->icon_font) }}"></i> @endif
                @if($row->css_class == 'menu_btn')
                    <span class="relative z-10">{{ $row->title }}</span>
                @elseif($row->css_class == 'all_menu')
                    <svg xmlns="http://www.w3.org/2000/svg" width="28" height="28" viewBox="0 0 28 28"
                         class="transition duration-200 hover:fill-primary-blue">
                        <g id="Group_191" data-name="Group 191" transform="translate(-1217 -41)">
                            <rect id="Rectangle_130" data-name="Rectangle 130" width="8" height="8"
                                  transform="translate(1217 41)" />
                            <rect id="Rectangle_130-2" data-name="Rectangle 130" width="8" height="8"
                                  transform="translate(1227 41)" />
                            <rect id="Rectangle_130-3" data-name="Rectangle 130" width="8" height="8"
                                  transform="translate(1237 41)" />
                            <rect id="Rectangle_130-4" data-name="Rectangle 130" width="8" height="8"
                                  transform="translate(1217 51)" />
                            <rect id="Rectangle_130-5" data-name="Rectangle 130" width="8" height="8"
                                  transform="translate(1227 51)" />
                            <rect id="Rectangle_130-6" data-name="Rectangle 130" width="8" height="8"
                                  transform="translate(1237 51)" />
                            <rect id="Rectangle_130-7" data-name="Rectangle 130" width="8" height="8"
                                  transform="translate(1217 61)" />
                            <rect id="Rectangle_130-8" data-name="Rectangle 130" width="8" height="8"
                                  transform="translate(1227 61)" />
                            <rect id="Rectangle_130-9" data-name="Rectangle 130" width="8" height="8"
                                  transform="translate(1237 61)" />
                        </g>
                    </svg>
                @else
                    {{ $row->title }}
                @endif
        </a>
        @if ($row->has_child)

            <div class="py-6 mega-menu mb-16 sm:mb-0 shadow-xl bg-background-footer">
                <div class="container mx-auto w-full flex flex-wrap justify-between">
                    {!! Menus::generateMenu([
                        'menu'       => $menu,
                        'menu_nodes' => $row->child,
                        'view'       => 'menu_custom_sub',
        //                                'options' => [
        //                                    'class' => $css_add,
        //                                ]
                    ]) !!}
                </div>
            </div>
        @endif
        @if($row->css_class == 'all_menu')
                </div>
            </div>
        @endif
    @endforeach
{{--</ul>--}}
{{--@if ($row->css_class == 'border-button') {{ $row->css_class }} @else nav-link @endif--}}
