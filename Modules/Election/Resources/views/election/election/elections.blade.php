<div class="faq">
    <div class="container">
        <div class="row justify-content-center">
            @php
                $wow = 0;
                $increment = 0.2;
            @endphp
            @foreach($elections as $key=>$election)
                @php
                    $wow = ($key == 6) ? 0 : $wow+$increment;
                @endphp
                {!! Theme::partial('admin_board.election.item', ['election' => $election, 'img_slider' => true, 'wow' => $wow]) !!}
            @endforeach
        </div>
        @if ($elections->total() > 0)
            <div class="justify-content-center" style="text-align: center !important;">
                {!! $elections->links(Theme::getThemeNamespace() . '::partials.election.pagination') !!}
            </div>
        @endif
    </div>
</div>
