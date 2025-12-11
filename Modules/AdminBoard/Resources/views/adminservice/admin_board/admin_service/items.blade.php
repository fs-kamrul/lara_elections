@php
    $wow = 0;
    $increment = 0.2;
@endphp
@foreach($admin_services as $key=>$admin_service)
    @php
        $wow = ($key == 6) ? 0 : $wow+$increment;
    @endphp
    {!! Theme::partial('admin_board.admin_services.item', ['admin_service' => $admin_service, 'img_slider' => true, 'wow' => $wow]) !!}
@endforeach
