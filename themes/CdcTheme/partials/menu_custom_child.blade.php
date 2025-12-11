@foreach ($menu_nodes as $key => $row)
    <li {!! $options !!}  @if ($row->has_child) @endif @if ($row->active)  @endif>

{{--                <i class="ri-arrow-right-double-fill mr-2"></i>--}}
        @if ($row->icon_font) <i class="{{ trim($row->icon_font) }}"></i> @endif
        <a class="group-hover:text-text-highlight group-hover:ml-3 transition-all text-white
        @if ($row->css_class) {{ $row->css_class }} @else  @endif" href="{{ url($row->url) }}"
           @if ($row->target !== '_self') target="{{ $row->target }}" @endif>
            {{ $row->title }}
        </a>
    </li>
    @if ($row->has_child)
        {!! Menus::generateMenu([
            'menu'       => $menu,
            'menu_nodes' => $row->child,
            'view'       => 'menu_custom_child',
            'options' => [
                'class' => 'mb-3 group',
            ]
        ]) !!}
    @endif
@endforeach
