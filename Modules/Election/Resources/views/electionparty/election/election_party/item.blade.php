<div class="col-md-6 col-lg-6 wow fadeInUp" data-wow-delay="@isset($wow) {{ $wow . 's' }} @endisset">
    <div class="notice-item" data-department="SB">
        <img src="{{ url( 'themes/' . Theme::getPublicThemeName() . '/img/notice.png') }}" alt="SB">
        <div class="notice-content">
            <h2 class="notice-title"><a href="{{ $election_party->url }}">{{ description_summary($election_party->name, 60) }}</a></h2>
            <p class="notice-department">{{ description_summary($election_party->short_description) }}</p>
            <div class="notice-meta">
                @if($election_party->categories->count())<span class="notice-type">{{ getCategoryNames($election_party) }}</span> @endif
                <span class="notice-date">{{ date('d F Y', strtotime($election_party->created_at)) }}</span>
            </div>
        </div>
    </div>
</div>

