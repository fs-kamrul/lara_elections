<div class="faq">
    <div class="container">
        <div class="row justify-content-center">
            @php
                $wow = 0;
                $increment = 0.2;
            @endphp
            @foreach($admin_ftp_servers as $key=>$admin_ftp_server)
                @php
                    $wow = ($key == 6) ? 0 : $wow+$increment;
                @endphp
                {!! Theme::partial('admin_board.admin_ftp_server.item', ['admin_ftp_server' => $admin_ftp_server, 'img_slider' => true, 'wow' => $wow]) !!}
            @endforeach
        </div>
        @if ($admin_ftp_servers->total() > 0)
            <div class="justify-content-center" style="text-align: center !important;">
                {!! $admin_ftp_servers->links(Theme::getThemeNamespace() . '::partials.admin_board.pagination') !!}
            </div>
        @endif
    </div>
</div>
