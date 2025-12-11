@php
    $wow = 0;
    $increment = 0.2;
@endphp
@foreach($admin_ftp_servers as $key=>$admin_ftp_server)
    @php
        $wow = ($key == 6) ? 0 : $wow+$increment;
    @endphp
    {!! Theme::partial('admin_board.admin_ftp_servers.item', ['admin_ftp_server' => $admin_ftp_server, 'img_slider' => true, 'wow' => $wow]) !!}
@endforeach
