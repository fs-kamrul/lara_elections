<div class="admission_form">
    {!!    Form::open(['route' => 'public.admission_store', 'method' => 'POST', 'class' => 'mt_45', 'enctype' => 'multipart/form-data']) !!}
    <div class="row">
        @csrf
        <div class="col-xxl-6 col-xl-6 col-lg-6 col-md-12 col-sm-12">
            <label for="name">@lang('Student Name') <span class="red">*</span></label>
            <input type="text" name="name" value="{{ old('name') }}" id="name" placeholder="{{ __('Student Name') }}">
        </div>
        <div class="col-xxl-6 col-xl-6 col-lg-6 col-md-12 col-sm-12">
            <label for="phone">@lang('Phone Number') <span class="red">*</span></label>
            <input type="text" name="phone" value="{{ old('phone') }}" id="phone" placeholder="{{ __('Phone Number') }}">
        </div>
        <div class="col-xxl-6 col-xl-6 col-lg-6 col-md-12 col-sm-12">
            <label for="father_name">@lang('Father Name') <span class="red">*</span></label>
            <input type="text" name="father_name" value="{{ old('father_name') }}" id="father_name" placeholder="{{ __('Father Name') }}">
        </div>
        <div class="col-xxl-6 col-xl-6 col-lg-6 col-md-12 col-sm-12">
            <label for="mother_nane">@lang('Mother Name') <span class="red">*</span></label>
            <input type="text" name="mother_nane" value="{{ old('mother_nane') }}" id="mother_nane" placeholder="{{ __('Mother Name') }}">
        </div>
        <div class="col-xxl-6 col-xl-6 col-lg-6 col-md-12 col-sm-12">
            <label for="dob">@lang('Date of Birth') <span class="red">*</span></label>
            <input type="date" name="dob" value="{{ old('dob') }}" id="dob" placeholder="{{ __('Date of Birth') }}">
        </div>
        <div class="col-xxl-6 col-xl-6 col-lg-6 col-md-12 col-sm-12">
            <label for="religion">@lang('Religion') </label>
            {!! Form::select('religion', Option::getReligion(), old('religion'), [ 'id' => "religion" ]) !!}
        </div>
        <div class="col-xxl-6 col-xl-6 col-lg-6 col-md-12 col-sm-12">
            <label for="gender">@lang('Gender') </label>
            {!! Form::select('gender', Option::getGender(), old('gender'), [ 'id' => "gender" ]) !!}
        </div>
        @if (is_module_active('Location'))
            <div class="col-xxl-6 col-xl-6 col-lg-6 col-md-12 col-sm-12">
                <label for="pre_country">@lang('Nationality') </label>
                {!! Form::select('nationality',
                    Location::getNationality(),
                    old('nationality'),
                    []
                    )
                !!}
            </div>
        @endif
        <div class="col-xxl-6 col-xl-6 col-lg-6 col-md-12 col-sm-12">
            <label for="birth_registration">@lang('Birth Registration Number') <span class="red">*</span></label>
            <input type="text" name="birth_registration" value="{{ old('birth_registration') }}" id="dob" placeholder="{{ __('Birth Registration Number') }}">
        </div>

        <div class="col-xxl-12 col-xl-12 col-lg-12 col-md-12 col-sm-12">
            <h3>@lang('Important Information') ***</h3>
        </div>

        <div class="col-xxl-6 col-xl-6 col-lg-6 col-md-12 col-sm-12">
            <label for="class">@lang('Admission Class') </label>
            {!! Form::select('class', Option::getClass(), old('class'), [ 'id' => "class" ]) !!}
        </div>
        <div class="col-xxl-6 col-xl-6 col-lg-6 col-md-12 col-sm-12">
            <label for="year">@lang('Admission Year') </label>
            {!! Form::select('year', Option::getYear(), old('year'), [ 'id' => "year" ]) !!}
        </div>

        <div class="col-xxl-6 col-xl-6 col-lg-6 col-md-12 col-sm-12">
            <label for="pre_institution">@lang('Previous Institution Name') <span class="red">*</span></label>
            <input type="text" name="pre_institution" value="{{ old('pre_institution') }}" id="pre_institution" placeholder="{{ __('Previous Institution Name') }}">
        </div>
        <div class="col-xxl-6 col-xl-6 col-lg-6 col-md-12 col-sm-12">
            <label for="pre_class">@lang('Previous Class') </label>
            {!! Form::select('pre_class', Option::getClass(), old('pre_class'), [ 'id' => "class" ]) !!}
        </div>
        <div class="col-xxl-6 col-xl-6 col-lg-6 col-md-12 col-sm-12">
            <label for="pre_gpa">@lang('Previous GPA') <span class="red">*</span></label>
            <input type="text" name="pre_gpa" value="{{ old('pre_gpa') }}" id="pre_gpa" placeholder="{{ __('Previous GPA') }}">
        </div>
        <div class="col-xxl-12 col-xl-12 col-lg-12 col-md-12 col-sm-12">
            <h3>@lang('Present Address')</h3>
        </div>
        <div class="col-xxl-6 col-xl-6 col-lg-6 col-md-12 col-sm-12">
            <label for="pre_address">@lang('Address') <span class="red">*</span></label>
            <input type="text" name="pre_address" value="{{ old('pre_address') }}" id="pre_address" placeholder="{{ __('Address') }}">
        </div>
        <div class="col-xxl-6 col-xl-6 col-lg-6 col-md-12 col-sm-12">
            <label for="pre_postcode">@lang('Post Code') <span class="red">*</span></label>
            <input type="text" name="pre_postcode" value="{{ old('pre_postcode') }}" id="pre_postcode" placeholder="{{ __('Post Code') }}">
        </div>
{{--        <div class="col-xxl-6 col-xl-6 col-lg-6 col-md-12 col-sm-12">--}}
{{--            <label for="name">@lang('Name') <span class="red">*</span></label>--}}
{{--            <input type="text" name="name" value="{{ old('name') }}" id="name" placeholder="{{ __('Name') }}">--}}
{{--        </div>--}}

        @if (is_module_active('Location'))
            <div class="col-xxl-6 col-xl-6 col-lg-6 col-md-12 col-sm-12">
                <label for="pre_country">@lang('Country') </label>
                {!! Form::select('pre_country',
                    Location::getCountry(),
                    old('pre_country'),
                    [
                        'data-type' => "country",
                        'id' => "pre_country"
                    ]) !!}
            </div>
            <div class="col-xxl-6 col-xl-6 col-lg-6 col-md-12 col-sm-12">
                <label for="pre_states">@lang('States') </label>
                {!! Form::select('pre_states',
                    Location::getStates(),
                    old('pre_states'),
                    [
                        'data-type' => "state",
                        'data-url' => route('ajax.states-by-country'),
                        'id' => "pre_states"
                    ]) !!}
            </div>
            <div class="col-xxl-6 col-xl-6 col-lg-6 col-md-12 col-sm-12">
                <label for="pre_city">@lang('City') </label>
                {!! Form::select('pre_city',
                    Location::getCitiesByState(1),
                    old('pre_city'),
                    [
                        'data-type' => "city",
                        'data-url' => route('ajax.cities-by-state'),
                        'id' => "pre_city"
                    ],
                ) !!}
            </div>
        @endif

        <div class="col-xxl-12 col-xl-12 col-lg-12 col-md-12 col-sm-12">
            <h3>@lang('Permanent Address')</h3>
        </div>
        <div class="col-xxl-6 col-xl-6 col-lg-6 col-md-12 col-sm-12">
            <label for="per_address">@lang('Address') <span class="red">*</span></label>
            <input type="text" name="per_address" value="{{ old('per_address') }}" id="per_address" placeholder="{{ __('Address') }}">
        </div>
        <div class="col-xxl-6 col-xl-6 col-lg-6 col-md-12 col-sm-12">
            <label for="per_postcode">@lang('Post Code') <span class="red">*</span></label>
            <input type="text" name="per_postcode" value="{{ old('per_postcode') }}" id="per_postcode" placeholder="{{ __('Post Code') }}">
        </div>

        @if (is_module_active('Location'))
            <div class="col-xxl-6 col-xl-6 col-lg-6 col-md-12 col-sm-12">
                <label for="per_country">@lang('Country') </label>
                {!! Form::select('per_country',
                    Location::getCountry(),
                    old('per_country'),
                    [
                        'data-type' => "per_country",
                        'id' => "per_country"
                    ]) !!}
            </div>
            <div class="col-xxl-6 col-xl-6 col-lg-6 col-md-12 col-sm-12">
                <label for="per_states">@lang('States') </label>
                {!! Form::select('per_states',
                    Location::getStates(),
                    old('per_states'),
                    [
                        'data-type' => "per_state",
                        'data-url' => route('ajax.states-by-country'),
                        'id' => "per_states"
                    ]) !!}
            </div>
            <div class="col-xxl-6 col-xl-6 col-lg-6 col-md-12 col-sm-12">
                <label for="per_city">@lang('City') </label>
                {!! Form::select('per_city',
                    Location::getCitiesByState(1),
                    old('per_city'),
                    [
                        'data-type' => "per_city",
                        'data-url' => route('ajax.cities-by-state'),
                        'id' => "per_city"
                    ],
                ) !!}
            </div>
        @endif

        <div class="col-xxl-12 col-xl-12 col-lg-12 col-md-12 col-sm-12">
            <h3>@lang('Local Guardian Information')</h3>
        </div>
        <div class="col-xxl-6 col-xl-6 col-lg-6 col-md-12 col-sm-12">
            <label for="loc_name">@lang('Name') <span class="red">*</span></label>
            <input type="text" name="loc_name" value="{{ old('loc_name') }}" id="loc_name" placeholder="{{ __('Name') }}">
        </div>
        <div class="col-xxl-6 col-xl-6 col-lg-6 col-md-12 col-sm-12">
            <label for="loc_phone">@lang('Phone') <span class="red">*</span></label>
            <input type="text" name="loc_phone" value="{{ old('loc_phone') }}" id="loc_phone" placeholder="{{ __('Phone') }}">
        </div>
        <div class="col-xxl-6 col-xl-6 col-lg-6 col-md-12 col-sm-12">
            <label for="loc_relation">@lang('Relation with Student') <span class="red">*</span></label>
            <input type="text" name="loc_relation" value="{{ old('loc_relation') }}" id="loc_relation" placeholder="{{ __('Relation with Student') }}">
        </div>
        <div class="col-xxl-6 col-xl-6 col-lg-6 col-md-12 col-sm-12">
            <label for="loc_address">@lang('Address') <span class="red">*</span></label>
            <input type="text" name="loc_address" value="{{ old('loc_address') }}" id="loc_address" placeholder="{{ __('Address') }}">
        </div>
        <div class="col-xxl-6 col-xl-6 col-lg-6 col-md-12 col-sm-12">
            <label for="loc_postcode">@lang('Post Code') <span class="red">*</span></label>
            <input type="text" name="loc_postcode" value="{{ old('loc_postcode') }}" id="loc_postcode" placeholder="{{ __('Post Code') }}">
        </div>
        <div class="col-xxl-12 col-xl-12 col-lg-12 col-md-12 col-sm-12">
            <h3>@lang('Student Photo')</h3>
        </div>
        <div class="col-xxl-12 col-xl-12 col-lg-12 col-md-12 col-sm-12">
            <label for="photo">@lang('Student Photo') <span class="red">*</span></label><br/>
            <input type="file" name="photo" value="{{ old('photo') }}" id="photo" placeholder="{{ __('Student Photo') }}"><br/>
            <span class="red">* @lang('Select Your Image:(Color Photo, JPEG, JPG, PNG Format, 300 x 300 pixel)')<br> @lang('Picture Size 150 kb only').</span>
        </div>
        @if (setting('enable_captcha') && is_module_active('Captcha'))
            <div class="col-xxl-6 col-xl-6 col-lg-6 col-md-12 col-sm-12">
                <div class="contact-column-12">
                    <div class="contact-form-group">
                        {!! Captcha::display() !!}
                    </div>
                </div>
            </div>
        @endif
        {{--                        <div class="col-12">--}}
        {{--                            <p>{!! clean(__('The field with (<span style="color:#FF0000;">*</span>) is required.')) !!}</p>--}}
        {{--                        </div>--}}
    </div>
    <button class="outline_btn">@lang('Send Message')</button>
    {!! Form::close() !!}
</div>
