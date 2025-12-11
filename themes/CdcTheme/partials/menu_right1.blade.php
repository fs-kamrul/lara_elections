{{--<ul {!! $options !!}>--}}
<div class="hidden items-center space-x-8 lg:flex">
@foreach ($menu_nodes as $key => $row)
    {{--        <li class="nav-item @if ($row->has_child) dropdown @endif @if ($row->active) current-menu-item @endif">--}}
    @if($row->css_class != 'right_option')
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
                'view'       => 'menu_right',
                'options' => [
                    'class' => 'dropdown-menu dropdown-menu-end',
                ]
            ]) !!}
        @endif
    @else
</div>
        @if ($row->has_child)
            <div class="hidden items-center gap-30 lg:flex">
                {!! Menus::generateMenu([
                    'menu'       => $menu,
                    'menu_nodes' => $row->child,
                    'view'       => 'menu_right_sub',
                    'options' => [
                        'class' => 'dropdown-menu dropdown-menu-end',
                    ]
                ]) !!}
            </div>
        @endif
    @endif
    {{--        </li>--}}
@endforeach
{{--</ul>--}}
{{--@if ($row->css_class == 'border-button') {{ $row->css_class }} @else nav-link @endif--}}
