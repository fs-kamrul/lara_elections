<a href="#" class="add-courses-intended-schema-items @if ($hasValue) hidden @endif">{{ trans('faq::faq.add_item') }}</a>

<div class="courses-intended-schema-items @if (!$hasValue) hidden @endif">
    {!! Form::repeater('courses_intended_schema_config', $value, [
        [
            'type'       => 'textarea',
            'label'      => trans('faq::faq.title'),
            'label_attr' => ['class' => 'control-label required'],
            'attributes' => [
                'name'    => 'title',
                'value'   => null,
                'options' => [
                    'class'        => 'form-control',
                    'data-counter' => 1000,
                    'rows'         => 1,
                ],
            ],
        ],
    ]) !!}
</div>
