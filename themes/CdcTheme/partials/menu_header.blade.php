@foreach ($menu_nodes as $key => $row)
        <a class=" @if ($row->has_child)  @endif text-sm font-normal text-p-color transition duration-150 hover:text-primary-blue"
           @if ($row->has_child)  @else  @endif
           href="{{ url($row->url) }}" @if ($row->target !== '_self') target="{{ $row->target }}" @endif>

            @if ($row->icon_font)
                <i class="{{ trim($row->icon_font) }}"></i>
            @endif
            {{ $row->title }}
        </a>
        @if ($row->has_child)
            {!! Menus::generateMenu([
                'menu'       => $menu,
                'menu_nodes' => $row->child,
                'view'       => 'menu_header',
                'options' => [
                    'class' => 'dropdown-menu dropdown-menu-end',
                ]
            ]) !!}
        @endif
@endforeach
