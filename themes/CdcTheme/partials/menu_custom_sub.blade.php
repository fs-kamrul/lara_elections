
    @foreach ($menu_nodes as $key => $row)
        <a {!! $options !!}
           href="{{ url($row->url) }}"
           @if ($row->target !== '_self')target="{{ $row->target }}" @endif>
            @if ($row->icon_font) <i class="{{ trim($row->icon_font) }}"></i> @endif
            {{ $row->title . ' ' . $row->css_class }}
            @if ($row->has_child) @if ($level == 0) <i class="ri-arrow-down-s-line ml-1"></i>@else <i class="ri-arrow-right-s-line"></i> @endif @endif
        </a>
        @if ($row->has_child)
            {!! Menus::generateMenu([
                'menu'       => $menu,
                'menu_nodes' => $row->child,
                'view'       => 'menu_custom_sub',
                'options' => [
                    'class' => 'mb-3 group',
                ]
            ]) !!}
        @endif
    @endforeach
