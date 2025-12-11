@php
    $wow = 0;
    $increment = 0.2;
@endphp
@foreach($elections as $key=>$election)
    @php
        $wow = ($key == 6) ? 0 : $wow+$increment;
    @endphp
    {!! Theme::partial('election.elections.item', ['election' => $election, 'img_slider' => true, 'wow' => $wow]) !!}
@endforeach
