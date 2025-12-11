<div class="faq">
    <div class="container">
        <div class="row justify-content-center">
            @php
                $wow = 0;
                $increment = 0.2;
            @endphp
            @foreach($admin_packages as $key=>$admin_package)
                @php
                    $wow = ($key == 6) ? 0 : $wow+$increment;
                @endphp
                {!! Theme::partial('admin_board.admin_package.item', ['admin_package' => $admin_package, 'img_slider' => true, 'wow' => $wow]) !!}
            @endforeach
        </div>
        @if ($admin_packages->total() > 0)
            <div class="justify-content-center" style="text-align: center !important;">
                {!! $admin_packages->links(Theme::getThemeNamespace() . '::partials.admin_board.pagination') !!}
            </div>
        @endif
    </div>
</div>
