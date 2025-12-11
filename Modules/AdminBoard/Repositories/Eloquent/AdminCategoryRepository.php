<?php

namespace Modules\AdminBoard\Repositories\Eloquent;

use Modules\AdminBoard\Repositories\Interfaces\AdminCategoryInterface;
use Modules\KamrulDashboard\Repositories\Eloquent\RepositoriesAbstract;
use Illuminate\Support\Str;

class AdminCategoryRepository extends RepositoriesAbstract implements AdminCategoryInterface
{
    public function getCategoryAdminFtpserverGroup($filters = [], $params = [])
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


        $this->model = apply_filters('AdminFtpServer_filter_query', $this->model, $filters, $params);

        return $this->advancedGet($params);
    }
    public function getCategoryAdminBoardGroup($filters = [], $params = [])
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
                'order' => 'DESC',
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


        $this->model = apply_filters('AdminFtpServer_filter_query', $this->model, $filters, $params);

        return $this->advancedGet($params);
    }
     public function getAdminCategory(array $select, array $orderBy, array $conditions = [])
     {

         $data = $this->model->where($conditions);
         if ($conditions) {
             $data = $data->where($conditions);
         }
//         dd($select);
//         foreach ($orderBy as $by => $direction) {
//             $data = $data->orderBy($by, $direction);
//         }

         return $this->applyBeforeExecuteQuery($data)->get();
     }

    /**
     * {@inheritDoc}
     */
    public function createSlug($name)
    {
        $slug = Str::slug($name);
        $index = 1;
        $baseSlug = $slug;
        while ($this->model->where('slug', $slug)->count() > 0) {
            $slug = $baseSlug . '-' . $index++;
        }

        if (empty($slug)) {
            $slug = time();
        }

        $this->resetModel();

        return $slug;
    }
    public function getCategoriesByBoard($board)
    {
        return $this->model->where('adminboard', $board)->pluck('name', 'id')->toArray();
    }
}
