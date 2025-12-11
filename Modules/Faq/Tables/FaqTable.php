<?php

namespace Modules\Faq\Tables;

use DboardHelper;
use Html;
use Illuminate\Contracts\Routing\UrlGenerator;
use Illuminate\Support\Facades\Auth;
use Modules\Faq\Repositories\Interfaces\FaqCategoryInterface;
use Modules\Faq\Repositories\Interfaces\FaqInterface;
use Modules\Table\Abstracts\TableAbstract;
use Yajra\DataTables\DataTables;

class FaqTable extends TableAbstract
{
    /**
     * @var bool
     */
    protected $hasActions = true;

    /**
     * @var bool
     */
    protected $hasFilter = true;

    /**
     * @var FaqCategoryInterface
     */
    protected $faqCategoryRepository;

    /**
     * FaqTable constructor.
     * @param DataTables $table
     * @param UrlGenerator $urlGenerator
     * @param FaqInterface $faqRepository
     * @param FaqCategoryInterface $faqCategoryRepository
     */
    public function __construct(DataTables $table, UrlGenerator $urlGenerator, FaqInterface $faqRepository, FaqCategoryInterface $faqCategoryRepository)
    {
        parent::__construct($table, $urlGenerator);

        $this->repository = $faqRepository;
        $this->faqCategoryRepository = $faqCategoryRepository;

        if (!Auth::user()->can(['faq_edit', 'faq_destroy'])) {
            $this->hasOperations = false;
            $this->hasActions = false;
        }
    }

    /**
     * {@inheritDoc}
     */
    public function ajax()
    {

        $data = $this->table
            ->eloquent($this->query())
            ->editColumn('question', function ($item) {
                if (! Auth::user()->can('faq_edit')) {
                    $name = DboardHelper::clean($item->name);
                } else {
                    $name = Html::link(route('faq.edit', $item->id), $item->question);
                }

                return $name;
            })
            ->editColumn('category_id', function ($item) {
                return $item->category->name;
            })
            ->editColumn('checkbox', function ($item) {
                return $this->getCheckbox($item->id);
            })
            ->editColumn('created_at', function ($item) {
                return DboardHelper::formatDate($item->created_at);
            })
            ->editColumn('status', function ($item) {
                return $item->status->toHtml();
            })
            ->addColumn('operations', function ($item) {
                return $this->getOperations('faq.edit', 'faq.destroy', $item);
            });

        return $this->toJson($data);
    }

    /**
     * {@inheritDoc}
     */
    public function query()
    {
        $query = $this->repository->getModel()->select([
            'id',
            'question',
            'created_at',
            'answer',
            'category_id',
            'status',
        ]);

        return $this->applyScopes($query);
    }

    public function columns()
    {
        return [
            'id' => [
                'title' => trans('table::lang.id'),
                'width' => '20px',
            ],
            'question' => [
                'title' => trans('faq::faq.question'),
                'class' => 'text-start',
            ],
            'category_id' => [
                'title' => trans('faq::faq.category'),
                'class' => 'text-start',
            ],
            'created_at' => [
                'title' => trans('table::lang.created_at'),
                'width' => '100px',
                'class' => 'text-center',
            ],
            'status' => [
                'title' => trans('table::lang.status'),
                'width' => '100px',
                'class' => 'text-center',
            ],
        ];
    }

    public function buttons()
    {
        return $this->addCreateButton(route('faq.create'), 'faq_create');
    }

    public function bulkActions(): array
    {
        return $this->addDeleteAction(route('faq.deletes'), 'faq_destroy', parent::bulkActions());
    }

    public function getBulkChanges(): array
    {
        return [
            'question' => [
                'title' => trans('faq::faq.question'),
                'type' => 'text',
                'validate' => 'required|max:120',
            ],
            'category_id'         => [
                'title'    => trans('table::lang.category'),
//                'type'     => 'select-search',
                'type' => 'customSelect',
                'validate' => 'required',
                'callback' => 'getCategories',
            ],
            'status' => [
                'title' => trans('table::lang.status'),
                'type' => 'customSelect',
                'choices' => array_status(),
                'validate' => 'required',
            ],
            'created_at' => [
                'title' => trans('table::lang.created_at'),
                'type' => 'date',
            ],
        ];
    }
    /**
     * @return array
     */
    public function getCategories(): array
    {
        return $this->faqCategoryRepository->pluck('name', 'id');
    }
    /**
     * {@inheritDoc}
     */
//    public function applyFilterCondition($query, string $key, string $operator, ?string $value)
//    {
//        switch ($key) {
//            case 'created_at':
//                if (!$value) {
//                    break;
//                }
//
//                $value = DboardHelper::formatDate($value);
//
//                return $query->whereDate($key, $operator, $value);
//            case 'category':
//                if (!$value) {
//                    break;
//                }
//
//                if (!DboardHelper::isJoined($query, 'faq_categories')) {
//                    $query = $query
//                        ->join('faq_categories', 'faq_categories.post_id', '=', 'posts.id')
//                        ->join('categories', 'faq_categories.category_id', '=', 'categories.id')
//                        ->select($query->getModel()->getTable() . '.*');
//                }
//
//                return $query->where('faq_categories.category_id', $value);
//        }
//
//        return parent::applyFilterCondition($query, $key, $operator, $value);
//    }
//    /**
//     * {@inheritDoc}
//     */
//    public function saveBulkChangeItem($item, string $inputKey, ?string $inputValue)
//    {
//        if ($inputKey === 'category') {
//            $item->category()->sync([$inputValue]);
//
//            return $item;
//        }
//
//        return parent::saveBulkChangeItem($item, $inputKey, $inputValue);
//    }
}
