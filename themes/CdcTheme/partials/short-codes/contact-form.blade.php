<section class="mt-100 mb-142 px-4 lg:px-0">
    <div class="xl:max-w-container mx-auto">
        <div class="lg:flex justify-between">
            <div class="lg:w-5/12">
                <h1 class="text-23 font-bold capitalize text-primary-dark lg:text-43">
                        <span
                            class="after:content[''] relative z-20 after:absolute after:bottom-3 after:left-0 after:top-1.5 after:-z-10 after:h-22 after:w-full after:bg-text-highlight lg:after:top-5">@lang('Contact')</span>
                </h1>

                <div class="mt-10">
                    <h1 class="font-semibold mb-2">{{ theme_option('site_title') }}</h1>
{{--                    <h2>Daffodil International University (DIU)</h2>--}}

                    <div class="mt-5">
                        <p class="mb-3"><span class="text-2xl text-primary-blue mr-3"><i class="ri-pin-distance-fill"></i></span>{{ theme_option('address') }}</p>
                        <p class="mb-3"><span class="text-2xl text-primary-blue mr-3"><i class="ri-phone-fill"></i></span>{{ theme_option('site_phone') }}</p>
                        <p class="mb-3"><span class="text-2xl text-primary-blue mr-3"><i class="ri-mail-send-line"></i></span>{{ theme_option('site_email') }}</p>
                    </div>

                </div>
            </div>

            <div class="lg:w-6/12 mt-10">
                <div class="w-444 h-full">
                    <iframe src="https://maps.google.com/maps?q={{ theme_option('address') }}&output=embed"
                            style="border:0; width: 100%; height: 330px; border-radius: 20px;" allowfullscreen=""
                            loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                </div>
            </div>
        </div>
    </div>
</section>


{{--<div class="mt-95 items-center pb-0 lg:flex xs:pb-20 lg:pb-142">--}}
{{--    <div class="w-full lg:w-3/5">--}}
{{--        <div class="contact_form">--}}
{{--            <h6 class="section_heading">@lang('Write Us A Message')</h6>--}}
{{--            {!!    Form::open(['route' => 'public.send.contact', 'method' => 'POST', 'class' => 'mt_45']) !!}--}}
{{--            <div class="max-w-md mx-auto bg-white rounded p-6">--}}
{{--                <label for="username" class="block text-sm font-medium text-gray-600">Username</label>--}}
{{--                <input--}}
{{--                    type="text"--}}
{{--                    id="username"--}}
{{--                    name="username"--}}
{{--                    class="mt-1 p-2 border rounded-md w-full focus:outline-none focus:ring focus:border-blue-300"--}}
{{--                    placeholder="Enter your username"--}}
{{--                >--}}
{{--            </div>--}}
{{--            <div class="form_group">--}}
{{--                <label for="name">@lang('Name')</label>--}}
{{--                <input type="text" name="name" value="{{ old('name') }}" id="contact_name"--}}
{{--                       placeholder="{{ __('Name') }}">--}}
{{--            </div>--}}

{{--            <div class="form_group">--}}
{{--                <label for="email">@lang('Email Address')</label>--}}
{{--                <input type="email" name="email" value="{{ old('email') }}" id="contact_email"--}}
{{--                       placeholder="{{ __('Your Email Address') }}">--}}
{{--            </div>--}}

{{--            <div class="form_group">--}}
{{--                <label for="contact">@lang('Contact')</label>--}}
{{--                <input type="number" name="phone" value="{{ old('phone') }}" id="contact_phone"--}}
{{--                       placeholder="{{ __('Your Contact') }}">--}}
{{--            </div>--}}
{{--            <div class="form_group">--}}
{{--                <label for="contact">@lang('Subject')</label>--}}
{{--                <input type="text" name="subject" value="{{ old('subject') }}" id="contact_subject"--}}
{{--                       placeholder="{{ __('Subject') }}">--}}
{{--            </div>--}}

{{--            <div class="form_group">--}}
{{--                <label for="message">@lang('Message')</label>--}}

{{--                <textarea name="content" id="contact_content" cols="30" rows="10"--}}
{{--                          placeholder="{{ __('Write Here') }}">{{ old('content') }}</textarea>--}}
{{--            </div>--}}
{{--            @if (setting('enable_captcha') && is_module_active('Captcha'))--}}
{{--                <div class="contact-form-row">--}}
{{--                    <div class="contact-column-12">--}}
{{--                        <div class="contact-form-group">--}}
{{--                            {!! Captcha::display() !!}--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            @endif--}}
{{--            --}}{{--                        <div class="col-12">--}}
{{--            --}}{{--                            <p>{!! clean(__('The field with (<span style="color:#FF0000;">*</span>) is required.')) !!}</p>--}}
{{--            --}}{{--                        </div>--}}
{{--            <button class="outline_btn">@lang('Send Message')</button>--}}
{{--            {!! Form::close() !!}--}}
{{--        </div>--}}
{{--    </div>--}}

{{--    <div class="mt-100 flex w-285 justify-left mx-auto xs:hidden lg:flex lg:mt-0 lg:w-2/5">--}}
{{--        [our-offices][/our-offices]--}}
{{--    </div>--}}
{{--</div>--}}
