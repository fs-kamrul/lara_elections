@foreach ($menu_nodes as $key => $row)
    <a class=" @if ($row->has_child)  @endif before:btn_clip before:content[''] hover:before:btn_clip_hover relative inline-block overflow-hidden rounded-full bg-background-sky-2 px-5 py-4 text-sm font-normal uppercase text-primary-blue before:absolute before:inset-0 before:duration-500 before:ease-in-out hover:text-white hover:before:bg-primary-blue"
       @if ($row->has_child)  @else  @endif
       href="{{ url($row->url) }}" @if ($row->target !== '_self') target="{{ $row->target }}" @endif>

        @if ($row->icon_font)
            <i class="{{ trim($row->icon_font) }}"></i>
        @endif
        <span class="relative z-10">{{ $row->title }}</span>
    </a>
    @if ($row->has_child)
        {!! Menus::generateMenu([
            'menu'       => $menu,
            'menu_nodes' => $row->child,
            'view'       => 'menu_right',
            'options' => [
                'class' => 'dropdown-menu dropdown-menu-end',
            ]
        ]) !!}
    @endif
@endforeach
