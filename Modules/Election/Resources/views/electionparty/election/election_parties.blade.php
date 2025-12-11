<div class="faq">
    <div class="container">
        <div class="row justify-content-center">
            @php
                $wow = 0;
                $increment = 0.2;
            @endphp
            @foreach($election_parties as $key=>$election_party)
                @php
                    $wow = ($key == 6) ? 0 : $wow+$increment;
                @endphp
                {!! Theme::partial('admin_board.election_party.item', ['election_party' => $election_party, 'img_slider' => true, 'wow' => $wow]) !!}
            @endforeach
        </div>
        @if ($election_parties->total() > 0)
            <div class="justify-content-center" style="text-align: center !important;">
                {!! $election_parties->links(Theme::getThemeNamespace() . '::partials.election.pagination') !!}
            </div>
        @endif
    </div>
</div>
