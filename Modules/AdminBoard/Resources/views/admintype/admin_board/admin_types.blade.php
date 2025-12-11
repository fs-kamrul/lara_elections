<div class="faq">
    <div class="container">
        <div class="row justify-content-center">
            @php
                $wow = 0;
                $increment = 0.2;
            @endphp
            @foreach($admin_types as $key=>$admin_type)
                @php
                    $wow = ($key == 6) ? 0 : $wow+$increment;
                @endphp
                {!! Theme::partial('admin_board.admin_type.item', ['admin_type' => $admin_type, 'img_slider' => true, 'wow' => $wow]) !!}
            @endforeach
        </div>
        @if ($admin_types->total() > 0)
            <div class="justify-content-center" style="text-align: center !important;">
                {!! $admin_types->links(Theme::getThemeNamespace() . '::partials.admin_board.pagination') !!}
            </div>
        @endif
    </div>
</div>
