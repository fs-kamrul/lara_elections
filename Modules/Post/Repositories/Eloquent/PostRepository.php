<?php

namespace Modules\Post\Repositories\Eloquent;

use Eloquent;
use Exception;
use Illuminate\Database\Query\Builder;
use Illuminate\Support\Arr;
use Illuminate\Support\Str;
use Modules\KamrulDashboard\Http\Models\DboardQueryBuilder;
use Modules\KamrulDashboard\Packages\Supports\DboardStatus;
use Modules\KamrulDashboard\Repositories\Eloquent\RepositoriesAbstract;
use Modules\Post\Repositories\Interfaces\PostInterface;
//use DboardStatus;

class PostRepository extends RepositoriesAbstract implements PostInterface
{
    public function getPost($filters = [], $params = [])
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
            'type' => null,
            'category' => null,
            'date' => null,
        ], $filters);

//        dd($filters);
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
        if ($filters['keyword'] !== null) {
            $keyword = $filters['keyword'];

            $this->model = $this->model
                ->where(function (DboardQueryBuilder $query) use ($keyword) {
                    return $query
                        ->addSearch('name', $keyword, false, false)
                        ->addSearch('short_description', $keyword, false)
                        ->addSearch('description', $keyword, false);
                });
        }
        if (!empty($filters['date']) && $filters['date'] !== 'All') {
            $startDate = \Carbon\Carbon::parse($filters['date'] . '-01')->startOfMonth();
            $endDate = \Carbon\Carbon::parse($filters['date'] . '-01')->endOfMonth();

            $this->model = $this->model->whereBetween('created_at', [$startDate, $endDate]);
        }
//        dd($this->model);
//        if (count($filters['category'] ?? [])) {
        if ($filters['category'] != 'All' && $filters['category'] != null) {
            $categoryIds = $filters['category'];
            $this->model = $this->model
                ->whereHas('categories', function ($query) use ($categoryIds) {
                    $query->where('category_id', $categoryIds);
//                    $query->whereIn('category_id', $categoryIds);
                });
        }
        if ($filters['type'] != 'All' && $filters['type'] != null) {
            $admin_types = $filters['type'];
            $this->model = $this->model->where('post_types_id', $admin_types);
        }

        $this->model = apply_filters('Post_filter_query', $this->model, $filters, $params);

        return $this->advancedGet($params);
    }
    /**
     * {@inheritDoc}
     */
    public function getFeatured(int $limit = 5, array $with = [])
    {
        $data = $this->model
            ->where([
                'status'      => DboardStatus::PUBLISHED,
                'is_featured' => 1,
            ])
            ->limit($limit)
            ->with(array_merge(['slugable'], $with))
            ->orderBy('created_at', 'desc');

        return $this->applyBeforeExecuteQuery($data)->get();
    }

    /**
     * {@inheritDoc}
     */
    public function getListPostNonInList(array $selected = [], $limit = 7, array $with = [])
    {
        $data = $this->model
            ->where('status', DboardStatus::PUBLISHED)
            ->whereNotIn('id', $selected)
            ->limit($limit)
            ->with($with)
            ->orderBy('created_at', 'desc');

        return $this->applyBeforeExecuteQuery($data)->get();
    }

    /**
     * {@inheritDoc}
     */
    public function getRelated($id, $limit = 3)
    {
        $data = $this->model
            ->where('status', DboardStatus::PUBLISHED)
            ->where('id', '!=', $id)
            ->limit($limit)
//            ->with('slugable')
            ->orderBy('created_at', 'desc')
            ->whereHas('categories', function ($query) use ($id) {
                $query->whereIn('categories.id', $this->getRelatedCategoryIds($id));
            });

        return $this->applyBeforeExecuteQuery($data)->get();
    }

    /**
     * {@inheritDoc}
     */
    public function getRelatedCategoryIds($model)
    {
        $model = $model instanceof Eloquent ? $model : $this->findById($model);

        if (!$model) {
            return [];
        }

        try {
            return $model->categories()->allRelatedIds()->toArray();
        } catch (Exception $exception) {
            return [];
        }
    }

    /**
     * {@inheritDoc}
     */
    public function getByCategory($categoryId, $paginate = 12, $limit = 0)
    {
        if (!is_array($categoryId)) {
            $categoryId = [$categoryId];
        }

        $data = $this->model
            ->where('posts.status', DboardStatus::PUBLISHED)
            ->join('post_categories', 'post_categories.post_id', '=', 'posts.id')
            ->join('categories', 'post_categories.category_id', '=', 'categories.id')
            ->whereIn('post_categories.category_id', $categoryId)
            ->select('posts.*')
            ->distinct()
//            ->with('slugable')
            ->orderBy('posts.created_at', 'desc');

        if ($paginate != 0) {
            return $this->applyBeforeExecuteQuery($data)->paginate($paginate);
        }

        return $this->applyBeforeExecuteQuery($data)->limit($limit)->get();
    }

    /**
     * {@inheritDoc}
     */
    public function getByUserId($authorId, $paginate = 6)
    {
        $data = $this->model
            ->where([
                'status'    => DboardStatus::PUBLISHED,
                'author_id' => $authorId,
            ])
//            ->with('slugable')
            ->orderBy('created_at', 'desc');

        return $this->applyBeforeExecuteQuery($data)->paginate($paginate);
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
    public function getByTag($tag, $paginate = 12)
    {
        $data = $this->model
            ->with('slugable', 'categories', 'categories.slugable', 'author')
            ->where('status', DboardStatus::PUBLISHED)
            ->whereHas('tags', function ($query) use ($tag) {
                /**
                 * @var Builder $query
                 */
                $query->where('tags.id', $tag);
            })
            ->orderBy('created_at', 'desc');

        return $this->applyBeforeExecuteQuery($data)->paginate($paginate);
    }

    /**
     * {@inheritDoc}
     */
    public function getRecentPosts($limit = 5, $categoryId = 0)
    {
        $data = $this->model->where(['status' => DboardStatus::PUBLISHED]);

        if ($categoryId != 0) {
            $data = $data
                ->join('post_categories', 'post_categories.post_id', '=', 'posts.id')
                ->where('post_categories.category_id', $categoryId);
        }

        $data = $data->limit($limit)
            ->with('slugable')
            ->select('posts.*')
            ->orderBy('created_at', 'desc');

        return $this->applyBeforeExecuteQuery($data)->get();
    }

    /**
     * {@inheritDoc}
     */
    public function getSearch($keyword, $limit = 10, $paginate = 10)
    {
        $data = $this->model
            ->with('slugable')
            ->where('status', DboardStatus::PUBLISHED)
            ->where(function ($query) use ($keyword) {
                $query->addSearch('name', $keyword);
            })
            ->orderBy('created_at', 'desc');

        if ($limit) {
            $data = $data->limit($limit);
        }

        if ($paginate) {
            return $this->applyBeforeExecuteQuery($data)->paginate($paginate);
        }

        return $this->applyBeforeExecuteQuery($data)->get();
    }

    /**
     * {@inheritDoc}
     */
    public function getAllPosts($perPage = 12, $active = true, array $with = ['slugable'])
    {
        $data = $this->model
            ->with($with)
            ->orderBy('created_at', 'desc');

        if ($active) {
            $data = $data->where('status', DboardStatus::PUBLISHED);
        }

        return $this->applyBeforeExecuteQuery($data)->paginate($perPage);
    }

    /**
     * {@inheritDoc}
     */
    public function getPopularPosts($limit=5, array $args = [])
    {
        $data = $this->model
//            ->with('slug')
            ->orderBy('views', 'desc')
            ->where('status', DboardStatus::PUBLISHED)
            ->limit($limit);

        if (!empty(Arr::get($args, 'where'))) {
            $data = $data->where($args['where']);
        }

        return $this->applyBeforeExecuteQuery($data)->get();
    }

    /**
     * {@inheritDoc}
     */
    public function getFilters(array $filters)
    {
        $data = $this->originalModel;

        if ($filters['categories'] !== null) {
            $categories = array_filter((array)$filters['categories']);

            $data = $data->whereHas('categories', function ($query) use ($categories) {
                $query->whereIn('id', $categories);
            });
        }

        if ($filters['categories_exclude'] !== null) {
            $data = $data
                ->whereHas('categories', function ($query) use ($filters) {
                    $query->whereNotIn('id', array_filter((array)$filters['categories_exclude']));
                });
        }

        if ($filters['exclude'] !== null) {
            $data = $data->whereNotIn('id', array_filter((array)$filters['exclude']));
        }

        if ($filters['include'] !== null) {
            $data = $data->whereNotIn('id', array_filter((array)$filters['include']));
        }

        if ($filters['author'] !== null) {
            $data = $data->whereIn('author_id', array_filter((array)$filters['author']));
        }

        if ($filters['author_exclude'] !== null) {
            $data = $data->whereNotIn('author_id', array_filter((array)$filters['author_exclude']));
        }

        if ($filters['featured'] !== null) {
            $data = $data->where('is_featured', $filters['featured']);
        }

        if ($filters['search'] !== null) {
            $data = $data
                ->where(function ($query) use ($filters) {
                    $query
                        ->addSearch('name', $filters['search'])
                        ->addSearch('description', $filters['search']);
                });
        }

        $orderBy = Arr::get($filters, 'order_by', 'updated_at');
        $order = Arr::get($filters, 'order', 'desc');

        $data = $data
            ->where('status', DboardStatus::PUBLISHED)
            ->orderBy($orderBy, $order);

        return $this->applyBeforeExecuteQuery($data)->paginate((int)$filters['per_page']);
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
}
