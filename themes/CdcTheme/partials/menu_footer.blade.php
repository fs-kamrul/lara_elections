
<ul {!! $options !!}>
    @foreach ($menu_nodes as $key => $row)
        <li class="@if ($row->has_child)  @endif @if ($row->css_class) {{ $row->css_class }} @endif @if ($row->active)  @endif mb-5">
            <a class="text-xs lg:text-sm font-normal text-white transition duration-200 hover:text-text-highlight"
               href="{{ url($row->url) }}" @if ($row->target !== '_self') target="{{ $row->target }}" @endif>
                <i class="ri-arrow-right-line mr-1.5"></i>
                @if ($row->icon_font) <i class="{{ trim($row->icon_font) }}"></i> @endif {{ $row->title }}
            </a>
            @if ($row->has_child)
                {!! Menus::generateMenu([
                    'menu'       => $menu,
                    'menu_nodes' => $row->child,
                    'view'       => 'menu_footer',
                    'options' => [
                        'class' => '',
                    ]
                ]) !!}
            @endif
        </li>
    @endforeach
</ul>
