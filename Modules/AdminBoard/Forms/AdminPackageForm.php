<?php

namespace Modules\AdminBoard\Forms;

use Modules\AdminBoard\Enums\AdminPackageStatusEnum;
use Modules\AdminBoard\Http\Models\AdminFacility;
use Modules\AdminBoard\Http\Models\AdminPackage;
use Modules\AdminBoard\Http\Requests\AdminPackageRequest;
use Modules\KamrulDashboard\Forms\FieldOptions\ContentFieldOption;
use Modules\KamrulDashboard\Forms\FieldOptions\DescriptionFieldOption;
use Modules\KamrulDashboard\Forms\FieldOptions\NameFieldOption;
use Modules\KamrulDashboard\Forms\FieldOptions\StatusFieldOption;
use Modules\KamrulDashboard\Forms\Fields\EditorField;
use Modules\KamrulDashboard\Forms\Fields\SelectField;
use Modules\KamrulDashboard\Forms\Fields\TextareaField;
use Modules\KamrulDashboard\Forms\Fields\TextField;
use Modules\KamrulDashboard\Forms\FormAbstract;

class AdminPackageForm extends FormAbstract
{
    public function setup(): void
    {

        $facilities = AdminFacility::query()->select(['id', 'name'])->get();
//        dd($facilities);
        $selectedFacilities = [];
        if ($this->getModel()) {
            $selectedFacilities = $this->getModel()->admin_facilities()->select('admin_facilities.id', 'name_title')->get();
        }

        $this
            ->setupModel(new AdminPackage())
            ->setValidatorClass(AdminPackageRequest::class)
            ->add('name', TextField::class, NameFieldOption::make()->required()->toArray())
//            ->add('photo', 'file', [
//                'label' => trans('adminboard::lang.photo'),
////                'wrapper' => [
////                    'class' => 'form-group mb-3 col-md-12 col-xl-12',
////                ],
//            ])
            ->add('name_limit', 'text', [
                'label' => trans('adminboard::lang.name_limit'),
                'wrapper' => [
                    'class' => 'form-group col-md-6 col-xl-6',
                ],
                'attr' => [
                    'placeholder' => trans('adminboard::lang.name_limit'),
//                    'data-counter' => 25,
                ],
            ])
            ->add('name_size', 'text', [
                'label' => trans('adminboard::lang.name_size'),
                'wrapper' => [
                    'class' => 'form-group col-md-6 col-xl-6',
                ],
                'attr' => [
                    'placeholder' => trans('adminboard::lang.name_size'),
//                    'data-counter' => 25,
                ],
                'value' => $this->getModel()->name_size ?? 'Mbps',
            ])
            ->add('tag_line', 'text', [
                'label' => trans('adminboard::lang.tag_line'),
                'wrapper' => [
                    'class' => 'form-group col-md-4 col-xl-4',
                ],
                'attr' => [
                    'placeholder' => trans('adminboard::lang.tag_line'),
//                    'data-counter' => 25,
                ],
            ])
            ->add('price', 'text', [
                'label' => trans('adminboard::lang.price'),
                'wrapper' => [
                    'class' => 'form-group col-md-4 col-xl-4',
                ],
                'attr' => [
                    'placeholder' => trans('adminboard::lang.price'),
//                    'data-counter' => 25,
                ],
            ])
            ->add('price_map', 'text', [
                'label' => trans('adminboard::lang.price_map'),
                'wrapper' => [
                    'class' => 'form-group col-md-4 col-xl-4',
                ],
                'attr' => [
                    'placeholder' => trans('adminboard::lang.price_map'),
//                    'data-counter' => 25,
                ],
                'value' => $this->getModel()->price_map ?? 'Month',
            ])
            ->add('short_description', TextareaField::class, DescriptionFieldOption::make()->toArray())
            ->add('description', EditorField::class, ContentFieldOption::make()->allowedShortcodes()->toArray())

            ->addMetaBoxes([
                'educations' => [
                    'title' => trans('adminboard::lang.admineducation'),
                    'content' => view(
                        'adminboard::partials.form-facilities',
                        compact('facilities', 'selectedFacilities')
                    ),
                    'priority' => 0,
                ],
            ])

            ->add('status', SelectField::class, StatusFieldOption::make()->choices(AdminPackageStatusEnum::labels())->toArray())
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
