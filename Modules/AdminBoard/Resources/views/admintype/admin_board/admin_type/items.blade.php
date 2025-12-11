@php
    $wow = 0;
    $increment = 0.2;
@endphp
@foreach($admin_types as $key=>$admin_type)
    @php
        $wow = ($key == 6) ? 0 : $wow+$increment;
    @endphp
    {!! Theme::partial('admin_board.admin_types.item', ['admin_type' => $admin_type, 'img_slider' => true, 'wow' => $wow]) !!}
@endforeach
