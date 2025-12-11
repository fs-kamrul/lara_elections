<a href="#" class="add-courses-stories-schema-items @if ($hasValue) hidden @endif">{{ trans('faq::faq.add_item') }}</a>

<div class="courses-stories-schema-items @if (!$hasValue) hidden @endif">
    {!! Form::repeater('courses_stories_schema_config', $value, [
        [
            'type'       => 'select',
            'label'      => trans('faq::faq.title'),
            'label_attr' => ['class' => 'control-label required'],
            'attributes' => [
                'name'    => 'title',
                'list' => app(\Modules\AdminBoard\Repositories\Interfaces\AdminTestimonialInterface::class)->advancedGet([
                                'condition' => ['status' => \Modules\AdminBoard\Enums\AdminTestimonialStatusEnum::COURSES,'is_video' => 1],
//                                'take'      => 1,
                            ])->pluck('name', 'id'),
                'value'   => 'blog-full-width',
                'options' => [
                    'class' => 'form-control',
                ],
            ],
        ],
    ]) !!}
</div>
