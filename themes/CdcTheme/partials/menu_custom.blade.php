@php
$i = 0;
@endphp
@foreach ($menu_nodes as $key => $row)

{{--        @if ($level == 0)--}}
<div class="{{ $status }}">
    <a {!! $options !!}
       href="{{ url($row->url) }}"
       @if ($row->target !== '_self')target="{{ $row->target }}" @endif>
        @if ($row->icon_font) <i class="{{ trim($row->icon_font) }}"></i> @endif
        {{ $row->title . ' ' . $row->css_class }}
        @if ($row->has_child) @if ($level == 0) <i class="ri-arrow-down-s-line ml-1"></i>@else <i class="ri-arrow-right-s-line"></i> @endif @endif
    </a>
    @if ($row->has_child)
        @php
            $i = $i + 1;
        @endphp
        <div class="dropdown-content mt-3">
            <div class="py-2">
                <div class="nested-dropdown relative">
                {!! Menus::generateMenu([
                    'menu'       => $menu,
                    'menu_nodes' => $row->child,
                    'view'       => 'menu_custom_sub',
                    'status'    => '',
                    'level'      => $i,
                    'options' => [
                        'class' => 'block flex items-center justify-between px-5 py-3 text-gray-700 hover:bg-blue-50 hover:text-blue-600 transition-colors duration-200',
                    ]
                ]) !!}
                </div>
            </div>
        </div>
    @endif
</div>
@endforeach
