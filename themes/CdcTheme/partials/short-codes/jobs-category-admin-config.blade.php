@php
    $number = array();
    for ($i=0; $i<=10; $i++){
        $number[$i] = $i;
    }
@endphp
<div class="form-group" id="image_set_data">
    <label class="control-label">{{ __('Title') }}</label>
    <input name="title" type="text" id="title" value="{{ Arr::get($attributes, 'title') }}" class="form-control" />
</div>
<div class="form-group" id="image_set_data">
    <label class="control-label">{{ __('Tag Line') }}</label>
    <input name="tag_line" type="text" id="tag_line" value="{{ Arr::get($attributes, 'tag_line') }}" class="form-control" />
</div>
<div class="form-group" id="image_set_data">
    <label class="control-label">{{ __('Contain') }}</label>
    <input name="contain" type="text" id="contain" value="{{ Arr::get($attributes, 'contain') }}" class="form-control" />
</div>

{{--<div class="form-group">--}}
{{--    <label class="control-label"><?php echo __('Number of Scroll'); ?></label>--}}
{{--    <?php echo Form::Select('number_of_slide', $number, Arr::get($attributes, 'number_of_slide'), ['class' => 'form-control', 'id' => 'number_of_slide']); ?>--}}
{{--</div>--}}

<div class="form-group" id="image_set_data">
    <label class="control-label">{{ __('API') }}</label>
    <input name="api_data" type="text" id="api_data" value="{{ Arr::get($attributes, 'api_data') }}" class="form-control" />
</div>
{{--@for($i=1; $i<=1; $i++)--}}
{{--    <div class="form-group">--}}
{{--        <label class="control-label">{{ __('Button Label ' . $i) }}</label>--}}
{{--        <input name="button_label{{ $i }}" value="{{ Arr::get($attributes, 'button_label' . $i) }}" class="form-control" />--}}
{{--    </div>--}}
{{--    <div class="form-group">--}}
{{--        <label class="control-label">{{ __('Button Url ' . $i) }}</label>--}}
{{--        <input name="button_url{{ $i }}" value="{{ Arr::get($attributes, 'button_url' . $i) }}" class="form-control" />--}}
{{--    </div>--}}
{{--@endfor--}}
