<?php

namespace Modules\Election\Forms;

use Modules\Election\Enums\ElectionStatusEnum;
use Modules\Election\Http\Models\Election;
use Modules\Election\Http\Requests\ElectionRequest;
use Modules\KamrulDashboard\Forms\FieldOptions\ContentFieldOption;
use Modules\KamrulDashboard\Forms\FieldOptions\DatePickerFieldOption;
use Modules\KamrulDashboard\Forms\FieldOptions\DescriptionFieldOption;
use Modules\KamrulDashboard\Forms\FieldOptions\NameFieldOption;
use Modules\KamrulDashboard\Forms\FieldOptions\StatusFieldOption;
use Modules\KamrulDashboard\Forms\Fields\DateField;
use Modules\KamrulDashboard\Forms\Fields\EditorField;
use Modules\KamrulDashboard\Forms\Fields\SelectField;
use Modules\KamrulDashboard\Forms\Fields\TextareaField;
use Modules\KamrulDashboard\Forms\Fields\TextField;
use Modules\KamrulDashboard\Forms\FormAbstract;

class ElectionForm extends FormAbstract
{
    public function setup(): void
    {
        $this
            ->setupModel(new Election())
            ->setValidatorClass(ElectionRequest::class)
            ->add('name', TextField::class, NameFieldOption::make()->required()->toArray())
//            ->add('photo', 'file', [
//                'label' => trans('adminboard::lang.photo'),
//                'wrapper' => [
//                    'class' => 'form-group mb-3 col-md-12 col-xl-12',
//                ],
//            ])
//            ->add('election_date', DateField::class, DatePickerFieldOption::make()->toArray())

            ->add('election_date', 'date', [
                'label' => trans('election::lang.election_date'),
                'wrapper' => [
                    'class' => 'form-group mb-3 col-md-6 col-xl-6',
                ],
            ])
            ->add('type', 'text', [
                'label' => trans('election::lang.type'),
                'wrapper' => [
                    'class' => 'form-group mb-3 col-md-6 col-xl-6',
                ],
            ])
            ->add('notes', TextareaField::class, [
                'label' => trans('election::lang.notes'),
                'wrapper' => [
                    'class' => 'form-group mb-3 col-md-12 col-xl-12',
                ],
            ])
//            ->add('notes', TextareaField::class, DescriptionFieldOption::make()->toArray())
//            ->add('short_description', TextareaField::class, DescriptionFieldOption::make()->toArray())
//            ->add('description', EditorField::class, ContentFieldOption::make()->allowedShortcodes()->toArray())

            ->add('status', SelectField::class, StatusFieldOption::make()->choices(ElectionStatusEnum::labels())->toArray())
            ->add('order', 'text', [
                'label' => trans('adminboard::lang.order'),
//                'wrapper' => [
//                    'class' => 'form-group col-md-6 col-xl-6',
//                ],
                'attr' => [
                    'placeholder' => trans('adminboard::lang.order'),
//                    'data-counter' => 25,educations
                ],
                'value' => $this->getModel()->order ?? 0,
            ])
            ->setBreakFieldPoint('status');
    }
}
