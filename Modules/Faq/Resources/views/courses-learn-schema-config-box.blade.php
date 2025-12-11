<a href="#" class="add-courses-learn-schema-items @if ($hasValue) hidden @endif">{{ trans('faq::faq.add_item') }}</a>

<div class="courses-learn-schema-items @if (!$hasValue) hidden @endif">
    {!! Form::repeater('courses_learn_schema_config', $value, [
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
