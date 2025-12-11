<div class="col-md-6 col-lg-6 wow fadeInUp" data-wow-delay="@isset($wow) {{ $wow . 's' }} @endisset">
    <div class="notice-item" data-department="SB">
        <img src="{{ url( 'themes/' . Theme::getPublicThemeName() . '/img/notice.png') }}" alt="SB">
        <div class="notice-content">
            <h2 class="notice-title"><a href="{{ $admin_service->url }}">{{ description_summary($admin_service->name, 60) }}</a></h2>
            <p class="notice-department">{{ description_summary($admin_service->short_description) }}</p>
            <div class="notice-meta">
                @if($admin_service->categories->count())<span class="notice-type">{{ getCategoryNames($admin_service) }}</span> @endif
                <span class="notice-date">{{ date('d F Y', strtotime($admin_service->created_at)) }}</span>
            </div>
        </div>
    </div>
</div>

