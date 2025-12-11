@if (theme_option('contact_info_boxes'))

        @foreach(json_decode(theme_option('contact_info_boxes'), true) as $key=>$item)
            <div class="contact_person">
                <h1 class="section_heading">{!! DboardHelper::clean($item[0]['value']) !!}</h1>
                <div class="contact_person_info mt_45">
                    <h6 class="font_pop">{!! DboardHelper::clean($item[1]['value']) !!}</h6>
                    <div class="contact_person_details">
                        <p>{!! DboardHelper::clean($item[2]['value']) !!}</p>
                        <p>{!! DboardHelper::clean($item[3]['value']) !!}</p>
                        <p>@lang('Cell'): <a href="tel:{!! DboardHelper::clean($item[4]['value']) !!}">{!! DboardHelper::clean($item[4]['value']) !!}</a></p>
                        <p>@lang('Email'): <a href="mailto:{!! DboardHelper::clean($item[5]['value']) !!}">{!! DboardHelper::clean($item[5]['value']) !!}</a></p>
                        <a target="_blank" class="btn btn-outline btn-sm btn-brand-outline font-weight-bold text-brand bg-white text-hover-white mt-20 border-radius-5 btn-shadow-brand hover-up" href="https://maps.google.com/?q={{ urlencode(clean($item[3]['value'])) }}"><i class="ri-map-2-line text-muted mr-15"></i>{{ __('View map') }}</a>

                    </div>
                </div>
            </div>
        @endforeach
{{--    <hr>--}}
@endif
