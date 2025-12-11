<?php

namespace Modules\Faq\Forms;


use Modules\Faq\Http\Models\Faq;
use Modules\Faq\Http\Requests\FaqRequest;
use Modules\Faq\Repositories\Interfaces\FaqCategoryInterface;
use Modules\KamrulDashboard\Forms\FormAbstract;
use Modules\KamrulDashboard\Packages\Supports\DboardStatus;

class FaqForm extends FormAbstract
{
    public function buildForm(): void
    {
        $this
            ->setupModel(new Faq())
            ->setValidatorClass(FaqRequest::class)
            ->withCustomFields()
            ->add('category_id', 'customSelect', [
                'label' => trans('faq::faq.category'),
                'label_attr' => ['class' => 'control-label required'],
                'choices' => ['' => trans('faq::faq.select_category')] + app(FaqCategoryInterface::class)->pluck('name', 'id'),
            ])
            ->add('question', 'text', [
                'label' => trans('faq::faq.question'),
                'label_attr' => ['class' => 'control-label required'],
                'attr' => [
                    'rows' => 4,
                ],
            ])
            ->add('answer', 'editor', [
                'label' => trans('faq::faq.answer'),
                'label_attr' => ['class' => 'control-label required'],
                'attr' => [
                    'rows' => 4,
                ],
            ])
            ->add('status', 'customSelect', [
                'label' => trans('kamruldashboard::tables.status'),
                'label_attr' => ['class' => 'control-label required'],
                'choices' => DboardStatus::labels(),
            ])
            ->setBreakFieldPoint('status');
    }
}
