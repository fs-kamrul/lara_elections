<div {!! $options !!}>
    @foreach ($menu_nodes as $key => $row)
        <a class="@if( ! $row->has_child) {{ $status }} @else mobile-dropdown-button flex w-full items-center justify-between py-2 text-gray-600 hover:text-blue-600 transition-colors duration-200 font-medium @endif
            @if ($row->css_class == 'border-button') {{ $row->css_class }} @else  @endif" href="{{ url($row->url) }}"
            @if ($row->target !== '_self') target="{{ $row->target }}" @endif>

            @if ($row->icon_font) <i class="{{ trim($row->icon_font) }}"></i> @endif
                {{ $row->title }}
                @if ($row->has_child) <i class="ri-arrow-down-s-line"></i> @endif
        </a>
        @if ($row->has_child)
            <div class="mobile-dropdown">
            {!! Menus::generateMenu([
                'menu'       => $menu,
                'menu_nodes' => $row->child,
                'view'       => 'menu_mobile',
               'status'    => 'block py-2 text-gray-600 hover:text-blue-600 transition-colors duration-200',
               'options' => ['class' => 'dropdown-content py-2'],
            ]) !!}
            </div>
        @endif
    @endforeach
</div>
