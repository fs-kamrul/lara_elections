<?php

namespace Modules\Post\Repositories\Eloquent;

use Modules\KamrulDashboard\Repositories\Eloquent\RepositoriesAbstract;
use Modules\Post\Repositories\Interfaces\PosttypeInterface;

class PosttypeRepository extends RepositoriesAbstract implements PosttypeInterface
{

    public function getType($filters = [], $params = [])
    {
        $filters = array_merge([
            'keyword' => null,
            'min_floor' => null,
            'max_floor' => null,
            'blocks' => null,
            'min_flat' => null,
            'max_flat' => null,
            'category_id' => null,
            'location' => null,
            'sort_by' => null,
        ], $filters);

        $sortBy = isset($filters['sort_by']) ? $filters['sort_by'] : null;

        switch ($sortBy) {
            case 'date_asc':
                $orderBy = [
                    'created_at' => 'ASC',
                ];
                break;
            case 'order_asc':
                $orderBy = [
                    'order' => 'ASC',
                ];
                break;
            case 'order_desc':
                $orderBy = [
                    'order' => 'DESC',
                ];
                break;
            default:
                $orderBy = [
                    'created_at' => 'DESC',
                ];
                break;
        }
        $params = array_merge([
            'condition' => [],
            'order_by' => [
                'created_at' => 'DESC',
            ],
            'take' => null,
            'paginate' => [
                'per_page' => 10,
                'current_paged' => 1,
            ],
            'select' => [
                '*',
            ],
            'with' => [],
        ], $params);

        $params['order_by'] = $orderBy;

        $this->model = $this->originalModel;

        $this->model = $this->model->active();


        $this->model = apply_filters('Type_filter_query', $this->model, $filters, $params);

        return $this->advancedGet($params);
    }
}
