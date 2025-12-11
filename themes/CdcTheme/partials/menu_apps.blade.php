@php
$color = array(
    'bg-blue-500 text-white',
    'bg-green-500 text-white',
    'bg-purple-500 text-white',
    'bg-red-500 text-white',
    'bg-yellow-500 text-white',
    'bg-indigo-500 text-white',
    'bg-pink-500 text-white',
    'bg-teal-500 text-white',
    'bg-orange-500 text-white',
    'bg-blue-500 text-white',
    'bg-green-500 text-white',
    'bg-purple-500 text-white',
    'bg-red-500 text-white',
    'bg-yellow-500 text-white',
    'bg-indigo-500 text-white',
    'bg-pink-500 text-white',
    'bg-teal-500 text-white',
    'bg-orange-500 text-white',
);
@endphp
@foreach ($menu_nodes as $key => $row)
    <a class=" @if ($row->has_child)  @endif group flex flex-col items-center gap-3 rounded-xl p-4 transition-all duration-200 hover:bg-gray-100"
       @if ($row->has_child)  @else  @endif
       href="{{ url($row->url) }}" @if ($row->target !== '_self') target="{{ $row->target }}" @endif>
        <div class="flex h-14 w-14 items-center justify-center rounded-full {{ $color[$key] }} transition-transform duration-200 group-hover:scale-110">
            @if ($row->icon_font)
                <i class="{{ trim($row->icon_font) }}"></i>
            @endif
        </div>
        <span class="text-sm font-medium text-gray-800">{{ $row->title }}</span>
    </a>
    @if ($row->has_child)
        {!! Menus::generateMenu([
            'menu'       => $menu,
            'menu_nodes' => $row->child,
            'view'       => 'menu_apps',
            'options' => [
                'class' => 'dropdown-menu dropdown-menu-end',
            ]
        ]) !!}
    @endif
@endforeach

