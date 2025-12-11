<?php

namespace Modules\Election\Forms;

use Modules\Election\Enums\ElectionPartyStatusEnum;
use Modules\Election\Http\Models\ElectionParty;
use Modules\Election\Http\Requests\ElectionPartyRequest;
use Modules\KamrulDashboard\Forms\FieldOptions\ContentFieldOption;
use Modules\KamrulDashboard\Forms\FieldOptions\DescriptionFieldOption;
use Modules\KamrulDashboard\Forms\FieldOptions\NameFieldOption;
use Modules\KamrulDashboard\Forms\FieldOptions\StatusFieldOption;
use Modules\KamrulDashboard\Forms\Fields\EditorField;
use Modules\KamrulDashboard\Forms\Fields\SelectField;
use Modules\KamrulDashboard\Forms\Fields\TextareaField;
use Modules\KamrulDashboard\Forms\Fields\TextField;
use Modules\KamrulDashboard\Forms\FormAbstract;

class ElectionPartyForm extends FormAbstract
{
    public function setup(): void
    {
        $this
            ->setupModel(new ElectionParty())
            ->setValidatorClass(ElectionPartyRequest::class)
            ->add('name', TextField::class, NameFieldOption::make()->required()->toArray())
            ->add('photo', 'file', [
                'label' => trans('adminboard::lang.photo'),
//                'wrapper' => [
//                    'class' => 'form-group mb-3 col-md-12 col-xl-12',
//                ],
            ])
            ->add('short_description', TextareaField::class, DescriptionFieldOption::make()->toArray())
            ->add('description', EditorField::class, ContentFieldOption::make()->allowedShortcodes()->toArray())

            ->add('status', SelectField::class, StatusFieldOption::make()->choices(ElectionPartyStatusEnum::labels())->toArray())
            ->setBreakFieldPoint('status');
    }
}
