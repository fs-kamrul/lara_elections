<a href="#" class="add-lessons-video-schema-items @if ($hasValue) hidden @endif">{{ trans('faq::faq.add_item') }}</a>

<div class="lessons-video-schema-items @if (!$hasValue) hidden @endif">
    {!! Form::repeater('lessons_video_schema_config', $value, [
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
        [
            'type'       => 'textarea',
            'label'      => trans('faq::faq.youtube_url'),
            'label_attr' => ['class' => 'control-label required'],
            'attributes' => [
                'name'    => 'url',
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
