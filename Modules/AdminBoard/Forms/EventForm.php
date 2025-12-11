<?php

namespace Modules\AdminBoard\Forms;


use Assets;
use Modules\AdminBoard\Enums\AdminTeamStatusEnum;
use Modules\AdminBoard\Forms\Fields\CategoryMultiField;
use Modules\AdminBoard\Http\Models\AdminEducation;
use Modules\AdminBoard\Http\Models\AdminTeam;
use Modules\AdminBoard\Http\Models\AdminType;
use Modules\AdminBoard\Http\Requests\TeamRequest;
use Modules\KamrulDashboard\Forms\FieldOptions\ContentFieldOption;
use Modules\KamrulDashboard\Forms\FieldOptions\DescriptionFieldOption;
use Modules\KamrulDashboard\Forms\FieldOptions\NameFieldOption;
use Modules\KamrulDashboard\Forms\FieldOptions\StatusFieldOption;
use Modules\KamrulDashboard\Forms\Fields\EditorField;
use Modules\KamrulDashboard\Forms\Fields\SelectField;
use Modules\KamrulDashboard\Forms\Fields\TextareaField;
use Modules\KamrulDashboard\Forms\Fields\TextField;
use Modules\KamrulDashboard\Forms\FormAbstract;

class EventForm extends FormAbstract
{
    public function setup(): void
    {
//        dd($this->getModel()->name);
        Assets::addStyles(['datetimepicker'])
            ->addScripts([
                'moment',
                'datetimepicker',
                'jquery-ui',
                'input-mask',
                'blockui',
            ]);
//            ->addStylesDirectly(['vendor/Modules/KamrulDashboard/css/ecommerce.css'])
//            ->addScriptsDirectly([
//                'vendor/Modules/KamrulDashboard/js/edit-product.js',
//            ]);
        //'vendor/Modules/Ecommerce/js/edit-product.js',

        $admin_types = AdminType::query()->pluck('name', 'id')->all();

        $selectedCategories = [];
        if ($this->getModel()) {
            $selectedCategories = $this->getModel()->categories()->pluck('category_id')->all();
        }
        $selectedRelatedProduct = $this->getModel();
//        dd($selectedRelatedProduct);
        $selectedTeams = [];
        if ($this->getModel()) {
            $selectedTeams = $this->getModel()->teams()->pluck('team_id')->all();
        }


        if (! $this->formHelper->hasCustomField('categoryMulti')) {
            $this->formHelper->addCustomField('categoryMulti', CategoryMultiField::class);
        }

        $videoStories = [];
        if ($this->getModel()) {
            $videoStories = $this->getModel()->videoStories;
        }

        $this
            ->setupModel(new AdminTeam())
            ->setValidatorClass(TeamRequest::class)
            ->add('name', TextField::class, NameFieldOption::make()->required()->toArray())
            ->add('photo', 'file', [
                'label' => trans('adminboard::lang.photo'),
                'wrapper' => [
                    'class' => 'form-group mb-3 col-md-6 col-xl-6',
                ],
            ])
            ->add('start_date', 'date', [
                'label' => trans('adminboard::lang.start_date'),
                'wrapper' => [
                    'class' => 'form-group mb-3 col-md-6 col-xl-6',
                ],
            ])
            ->add('set_time', 'text', [
                'label' => trans('adminboard::lang.set_time'),
                'wrapper' => [
                    'class' => 'form-group mb-3 col-md-6 col-xl-6',
                ],
            ])
            ->add('location', 'text', [
                'label' => trans('adminboard::lang.location'),
                'wrapper' => [
                    'class' => 'form-group mb-3 col-md-6 col-xl-6',
                ],
            ])
            ->add('youtube_link', 'text', [
                'label' => trans('adminboard::lang.youtube_link'),
                'wrapper' => [
                    'class' => 'form-group mb-3 col-md-12 col-xl-12',
                ],
            ])
            ->add('content', 'hidden', [
                'label' => trans('adminboard::lang.content'),
                'wrapper' => [
                    'class' => 'form-group mb-3 col-md-6 col-xl-6',
                ],
            ])
            ->add('short_description', TextareaField::class, DescriptionFieldOption::make()->toArray())
            ->add('description', EditorField::class, ContentFieldOption::make()->allowedShortcodes()->toArray())
            ->addMetaBoxes([
                'video_Success_Stories' => [
                    'title' => trans('kamruldashboard::video-success-stories.title'),
                    'content' => view('kamruldashboard::partials.event-success-stories-form', [
//                        'title'=> trans('ecommerce::video-success-stories.title'),
                        'videos' => $videoStories ?? [],
                        'routes' => [
                            'ajax_video_info' => '',
                        ],
//                        'priority' => 3,
                    ]),
                    'priority' => 4,
                ],
            ])
//
//            ->addMetaBoxes([
//                'with_related' => [
//                    'title' => null,
//                    'content' => \Html::tag('div', '', [
//                        'class' => 'wrap-relation-product',
//                        'data-target' => route('products.get-relations-boxes', 2),
//                    ]),
//                    'wrap' => false,
//                    'priority' => 9999,
//                ],
//            ])
//            ->addMetaBoxes([
//                'productsRelated' => [
//                    'title'=> trans('kamruldashboard::products.related_products'),
//                    'content' => view('kamruldashboard::partials.extras-event', [
//                        'title'=> trans('kamruldashboard::products.related_products'),
//                        'product' => $selectedRelatedProduct ?? [],
//                        'dataUrl' => route('products.get-list-product-for-search', ['product_id' => 0]),
////                        'priority' => 3,
//                    ]),
//                    'priority' => 4,
//                ],
//            ])
            ->add('status', SelectField::class, StatusFieldOption::make()->choices(AdminTeamStatusEnum::labels())->toArray())
//            ->add('admin_types_id', SelectField::class, StatusFieldOption::make()->choices(AdminTeamStatusEnum::labels())->toArray())

            ->add('admin_types_id', SelectField::class, [
                'label' => trans('adminboard::lang.admintype'),
                'attr' => [
                    'class' => 'form-control select-search-full',
                ],
                'choices' => [0 => trans('adminboard::lang.select_admintypes')] + $admin_types,
            ])
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
                'choices' => get_teams_with_children('event'),
                'value' => old('categories', $selectedCategories),
            ])
            ->add('teams[]', 'categoryMulti', [
                'label' => trans('adminboard::lang.facilitators'),
                'required' => true,
                'choices' => get_event_teams_with_children(),
                'value' => old('teams', $selectedTeams),
            ])
            ->setBreakFieldPoint('status');
    }
}
