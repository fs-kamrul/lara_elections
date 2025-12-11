
<section class="bg-white">
    <div
        class="mx-auto xl:max-w-container lg:max-w-lg-container xs:max-w-305 sm:max-w-sm-container md:max-w-md-container px-4 lg:px-0">
        <div class="items-center py-44 md:flex">
            <div class="w-full lg:w-1/2 xl:w-3/5">
                <h3 class="mb-10 text-center font-pop text-23 font-bold text-black md:mb-0 lg:text-left lg:text-3xl">
                    {{ $shortcode->title }}
                </h3>
            </div>
            <div class="w-full sm:w-4/5 lg:w-1/2 xl:w-2/5 sm:mx-auto lg:ml-auto lg:mr-0">
                <form action="{{ route('public.newsletter.subscribe') }}" method="POST">
                    @csrf
                    <div
                        class="w-full sm:w-435 justify-between lg:flex lg:h-54 sm:rounded-full sm:border sm:border-black sm:mx-auto lg:ml-auto lg:mr-0">
                        <input type="email" name="email" id=""
                               class="mb-5 h-54 w-full sm:w-285 rounded-full border border-black px-5 focus:outline-none sm:mb-0 sm:h-full sm:border-none email_input"
                               placeholder="@lang('newsletter::lang.email_address')" />
                        @if (setting('enable_captcha') && is_module_active('Captcha'))
                            {!! Captcha::display() !!}
                        @endif
                        <button type="submit" data-url="{{ route('public.newsletter.subscribe') }}"
                                class="sub_wrap before:btn_clip before:content[''] hover:before:btn_clip_hover relative h-54 w-full overflow-hidden rounded-full bg-black font-pop text-lg uppercase text-white before:absolute before:inset-0 before:duration-500 before:ease-in-out hover:before:bg-btn-blue sm:w-36 sm:rounded-bl-none sm:rounded-br-full sm:rounded-tl-none sm:rounded-tr-full">
                            <span class="subscribe relative z-10">@lang('Subscribe')</span>
                        </button>

{{--                        <div class="form_group mt_30">--}}
{{--                            <input type="checkbox" id="newsletter_agree" name="newsletter_agree" value="">--}}
{{--                            <label for="newsletter_agree"> @lang('I agree to the') <a href="{{ url('terms-and-condition') }}" target="_blank">@lang('Users Terms')</a> & <a href="{{ url('privacy-policy') }}" target="_blank">@lang('Privacy Policy')</a></label>--}}
{{--                        </div>--}}
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>
