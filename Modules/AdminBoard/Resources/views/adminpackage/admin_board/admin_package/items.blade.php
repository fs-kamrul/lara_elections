@php
    $wow = 0;
    $increment = 0.2;
@endphp
@foreach($admin_packages as $key=>$admin_package)
    @php
        $wow = ($key == 6) ? 0 : $wow+$increment;
    @endphp
    {!! Theme::partial('admin_board.admin_packages.item', ['admin_package' => $admin_package, 'img_slider' => true, 'wow' => $wow]) !!}
@endforeach
