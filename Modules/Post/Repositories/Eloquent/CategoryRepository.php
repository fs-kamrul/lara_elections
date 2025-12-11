<?php

namespace Modules\Post\Repositories\Eloquent;

use Eloquent;
use Modules\KamrulDashboard\Packages\Supports\DboardStatus;
use Modules\KamrulDashboard\Repositories\Eloquent\RepositoriesAbstract;
use Modules\Post\Repositories\Interfaces\CategoryInterface;
//use DboardStatus;

class CategoryRepository extends RepositoriesAbstract implements CategoryInterface
{

    public function getCategory($filters = [], $params = [])
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


        $this->model = apply_filters('Post_filter_query', $this->model, $filters, $params);

        return $this->advancedGet($params);
    }

    /**
     * {@inheritDoc}
     */
    public function getDataSiteMap()
    {
        $data = $this->model
//            ->with('slugable')
            ->where('status', DboardStatus::PUBLISHED)
            ->orderBy('created_at', 'desc');

        return $this->applyBeforeExecuteQuery($data)->get();
    }

    /**
     * {@inheritDoc}
     */
    public function getFeaturedCategories($limit, array $with = [])
    {
        $data = $this->model
            ->with(array_merge(['slugable'], $with))
            ->where([
                'status'      => DboardStatus::PUBLISHED,
                'is_featured' => 1,
            ])
            ->select([
                'id',
                'name',
                'description',
                'icon',
            ])
            ->orderBy('order')
            ->limit($limit);

        return $this->applyBeforeExecuteQuery($data)->get();
    }

    /**
     * {@inheritDoc}
     */
    public function getAllCategories(array $condition = [], array $with = [])
    {
        $data = $this->model->with('slug');
        if (!empty($condition)) {
            $data = $data->where($condition);
        }

        $data = $data
            ->where('status', DboardStatus::PUBLISHED)
            ->orderBy('order', 'DESC')
            ->orderBy('created_at', 'DESC');

        if ($with) {
            $data = $data->with($with);
        }

        return $this->applyBeforeExecuteQuery($data)->get();
    }

    /**
     * {@inheritDoc}
     */
    public function getCategoryById($id)
    {
        $data = $this->model->with('slug')->where([
            'id'     => $id,
            'status' => DboardStatus::PUBLISHED,
        ]);

        return $this->applyBeforeExecuteQuery($data, true)->first();
    }

    /**
     * {@inheritDoc}
     */
    public function getCategories(array $select, array $orderBy)
    {
        $data = $this->model->with('slugable')->select($select);
        foreach ($orderBy as $by => $direction) {
            $data = $data->orderBy($by, $direction);
        }

        return $this->applyBeforeExecuteQuery($data)->get();
    }

    /**
     * {@inheritDoc}
     */
    public function getAllRelatedChildrenIds($id)
    {
        if ($id instanceof Eloquent) {
            $model = $id;
        } else {
            $model = $this->getFirstBy(['id' => $id]);
        }
        if (!$model) {
            return null;
        }

        $result = [];

        $children = $model->children()->select('id')->get();

        foreach ($children as $child) {
            $result[] = $child->id;
            $result = array_merge($this->getAllRelatedChildrenIds($child), $result);
        }
        $this->resetModel();

        return array_unique($result);
    }

    /**
     * {@inheritDoc}
     */
    public function getAllCategoriesWithChildren(array $condition = [], array $with = [], array $select = ['*'])
    {
        $data = $this->model
            ->where($condition)
            ->with($with)
            ->select($select);

        return $this->applyBeforeExecuteQuery($data)->get();
    }

    /**
     * {@inheritDoc}
     */
    public function getFilters($filters)
    {
        $this->model = $this->originalModel;

        $orderBy = isset($filters['order_by']) ? $filters['order_by'] : 'created_at';
        $order = isset($filters['order']) ? $filters['order'] : 'desc';
        $this->model = $this->model->where('status', DboardStatus::PUBLISHED)->orderBy($orderBy, $order);

        return $this->applyBeforeExecuteQuery($this->model)->paginate((int)$filters['per_page']);
    }

    /**
     * {@inheritDoc}
     */
    public function getPopularCategories(int $limit, array $with = ['slugable'], array $withCount = ['posts'])
    {
        $data = $this->model
            ->with($with)
            ->withCount($withCount)
            ->orderBy('posts_count', 'desc')
            ->where('status', DboardStatus::PUBLISHED)
            ->limit($limit);

        return $this->applyBeforeExecuteQuery($data)->get();
    }
}
