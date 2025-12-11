<ul {!! $options !!}>
    @foreach ($menu_nodes as $key => $row)
        <li class="@if ($row->has_child) @endif @if ($row->active)  @endif">
            <div class="hoverable hover:text-white">
                <a class="py-5 inline-block after:content[''] after:trasitio relative text-white after:absolute after:-bottom-0 after:left-0 after:z-10 after:h-3 after:w-25 after:bg-white after:opacity-0 after:duration-200 after:ease-linear hover:after:opacity-100
                    @if ($row->css_class == 'border-button') {{ $row->css_class }} @else  @endif" href="{{ url($row->url) }}"
                    @if ($row->target !== '_self') target="{{ $row->target }}" @endif>
                    @if ($row->icon_font) <i class="{{ trim($row->icon_font) }}"></i> @endif
                        {{ $row->title }}
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
            </div>
        </li>
    @endforeach
</ul>
