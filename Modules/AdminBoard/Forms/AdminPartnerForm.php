<?php

namespace Modules\AdminBoard\Forms;

use Modules\AdminBoard\Enums\AdminClubStatusEnum;
use Modules\AdminBoard\Forms\Fields\CategoryMultiField;
use Modules\AdminBoard\Http\Models\AdminPartner;
use Modules\AdminBoard\Http\Requests\AdminPartnerRequest;
use Modules\KamrulDashboard\Forms\FieldOptions\ContentFieldOption;
use Modules\KamrulDashboard\Forms\FieldOptions\DescriptionFieldOption;
use Modules\KamrulDashboard\Forms\FieldOptions\NameFieldOption;
use Modules\KamrulDashboard\Forms\FieldOptions\StatusFieldOption;
use Modules\KamrulDashboard\Forms\Fields\EditorField;
use Modules\KamrulDashboard\Forms\Fields\SelectField;
use Modules\KamrulDashboard\Forms\Fields\TextareaField;
use Modules\KamrulDashboard\Forms\Fields\TextField;
use Modules\KamrulDashboard\Forms\FormAbstract;

class AdminPartnerForm extends FormAbstract
{
    public function setup(): void
    {
        $selectedCategories = [];
        if ($this->getModel()) {
            $selectedCategories = $this->getModel()->categories()->pluck('category_id')->all();
        }


        if (! $this->formHelper->hasCustomField('categoryMulti')) {
            $this->formHelper->addCustomField('categoryMulti', CategoryMultiField::class);
        }

        $this
            ->setupModel(new AdminPartner())
            ->setValidatorClass(AdminPartnerRequest::class)
            ->add('name', TextField::class, NameFieldOption::make()->required()->toArray())
            ->add('tag_line', 'text', [
                'label' => trans('adminboard::lang.tag_line'),
                'wrapper' => [
                    'class' => 'form-group col-md-6 col-xl-6',
                ],
                'attr' => [
                    'placeholder' => trans('adminboard::lang.tag_line'),
//                    'data-counter' => 25,educations
                ],
            ])
            ->add('photo', 'file', [
                'label' => trans('adminboard::lang.photo'),
                'wrapper' => [
                    'class' => 'form-group mb-3 col-md-6 col-xl-6',
                ],
            ])
            ->add('coupon_code', 'text', [
                'label' => trans('adminboard::lang.coupon_code'),
                'wrapper' => [
                    'class' => 'form-group col-md-6 col-xl-6',
                ],
                'attr' => [
                    'placeholder' => trans('adminboard::lang.coupon_code'),
//                    'data-counter' => 25,educations
                ],
            ])
            ->add('set_url', 'text', [
                'label' => trans('adminboard::lang.set_url'),
                'wrapper' => [
                    'class' => 'form-group col-md-6 col-xl-6',
                ],
                'attr' => [
                    'placeholder' => trans('adminboard::lang.set_url'),
//                    'data-counter' => 25,educations
                ],
            ])
            ->add('short_description', TextareaField::class, DescriptionFieldOption::make()->toArray())
            ->add('description', EditorField::class, ContentFieldOption::make()->allowedShortcodes()->toArray())

            ->add('status', SelectField::class, StatusFieldOption::make()->choices(AdminClubStatusEnum::labels())->toArray())

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
            ->add('categories[]', 'categoryMulti', [
                'label' => trans('adminboard::lang.categories'),
                'required' => true,
                'choices' => get_teams_with_children('partner'),
                'value' => old('categories', $selectedCategories),
            ])
            ->setBreakFieldPoint('status');
    }
}
