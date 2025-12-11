@php
    $wow = 0;
    $increment = 0.2;
@endphp
@foreach($election_parties as $key=>$election_party)
    @php
        $wow = ($key == 6) ? 0 : $wow+$increment;
    @endphp
    {!! Theme::partial('election.election_parties.item', ['election_party' => $election_party, 'img_slider' => true, 'wow' => $wow]) !!}
@endforeach
