<div class="faq">
    <div class="container">
        <div class="row justify-content-center">
            @php
                $wow = 0;
                $increment = 0.2;
            @endphp
            @foreach($admin_services as $key=>$admin_service)
                @php
                    $wow = ($key == 6) ? 0 : $wow+$increment;
                @endphp
                {!! Theme::partial('admin_board.admin_service.item', ['admin_service' => $admin_service, 'img_slider' => true, 'wow' => $wow]) !!}
            @endforeach
        </div>
        @if ($admin_services->total() > 0)
            <div class="justify-content-center" style="text-align: center !important;">
                {!! $admin_services->links(Theme::getThemeNamespace() . '::partials.admin_board.pagination') !!}
            </div>
        @endif
    </div>
</div>
