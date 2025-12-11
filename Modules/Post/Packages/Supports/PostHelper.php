<?php

namespace Modules\Post\Packages\Supports;


use Illuminate\Contracts\Database\Query\Builder;
use Modules\Post\Repositories\Interfaces\CategoryInterface;
use Modules\Post\Repositories\Interfaces\PostInterface;
use Modules\Post\Repositories\Interfaces\PosttypeInterface;

class PostHelper
{

    public function getPostFilter(?int $perPage = 12, array $extra = [])
    {
        $request = request();

//        dd($request);
//        $perPage = $request->integer('per_page') ?: ($perPage ?: 12);
        $perPage = (int) $request->input('per_page', $perPage ?: 12);

        $filters = $request->validate(apply_filters('workshops_filter_validation_rules', [
            'keyword' => 'nullable|string|max:255',
            'location' => 'nullable|string',
            'city_id' => 'nullable|numeric',
            'city' => 'nullable|string',
            'state' => 'nullable|string',
            'state_id' => 'nullable|numeric',
            'category_id' => 'nullable|numeric',
            'sort_by' => 'nullable|string',
            'blocks' => 'nullable|numeric',
            'locations' => 'nullable|array',
            'category_ids' => 'nullable|array',
            'type' => 'string|nullable',
            'category' => 'string|nullable',
            'date' => 'string|nullable',
        ]));

        $filters['date'] = $request->input('date');
        $filters['keyword'] = $request->input('search');

        $params = array_merge([
            'paginate' => [
                'per_page' => (int) $perPage,  // Ensure perPage is an integer
                'current_paged' => (int) $request->input('page', 1), // Cast to integer
            ],
            'order_by' => ['admin_workshops.created_at' => 'DESC'],
            'with' => self::gePostRelationsQuery(),
        ], $extra);

        return app(PostInterface::class)->getPost($filters, $params);
    }

    public function gePostRelationsQuery(): array
    {
        return [
            'slugable:id,key,prefix,reference_id',
//            'state:id,name',
//            'city:id,name',
//            'categories' => function (Builder $query) {
//                return $query
//                    ->wherePublished()
//                    ->orderBy('created_at', 'DESC')
//                    ->orderBy('is_default', 'DESC')
//                    ->orderBy('order', 'ASC')
//                    ->select('re_categories.id', 're_categories.name');
//            },
        ];
    }

    public function getTypeFilter(?int $perPage = 12, array $extra = [])
    {
        $request = request();

//        dd($request);
//        $perPage = $request->integer('per_page') ?: ($perPage ?: 12);
        $perPage = (int) $request->input('per_page', $perPage ?: 12);

        $filters = $request->validate(apply_filters('workshops_filter_validation_rules', [
            'keyword' => 'nullable|string|max:255',
            'location' => 'nullable|string',
            'city_id' => 'nullable|numeric',
            'city' => 'nullable|string',
            'state' => 'nullable|string',
            'state_id' => 'nullable|numeric',
            'category_id' => 'nullable|numeric',
            'sort_by' => 'nullable|string',
            'blocks' => 'nullable|numeric',
            'locations' => 'nullable|array',
            'category_ids' => 'nullable|array',
        ]));

        $filters['keyword'] = $request->input('k');

        $params = array_merge([
            'paginate' => [
                'per_page' => (int) $perPage,  // Ensure perPage is an integer
                'current_paged' => (int) $request->input('page', 1), // Cast to integer
            ],
            'order_by' => ['admin_workshops.created_at' => 'DESC'],
//            'with' => self::geTypeRelationsQuery(),
        ], $extra);

        return app(PosttypeInterface::class)->getType($filters, $params);
    }

    public function geTypeRelationsQuery(): array
    {
        return [
            'slugable:id,key,prefix,reference_id',
//            'state:id,name',
//            'city:id,name',
//            'categories' => function (Builder $query) {
//                return $query
//                    ->wherePublished()
//                    ->orderBy('created_at', 'DESC')
//                    ->orderBy('is_default', 'DESC')
//                    ->orderBy('order', 'ASC')
//                    ->select('re_categories.id', 're_categories.name');
//            },
        ];
    }
    public function getCategoryFilter(?int $perPage = 12, array $extra = [])
    {
        $request = request();

//        dd($request);
//        $perPage = $request->integer('per_page') ?: ($perPage ?: 12);
        $perPage = (int) $request->input('per_page', $perPage ?: 12);

        $filters = $request->validate(apply_filters('workshops_filter_validation_rules', [
            'keyword' => 'nullable|string|max:255',
            'location' => 'nullable|string',
            'city_id' => 'nullable|numeric',
            'city' => 'nullable|string',
            'state' => 'nullable|string',
            'state_id' => 'nullable|numeric',
            'category_id' => 'nullable|numeric',
            'sort_by' => 'nullable|string',
            'blocks' => 'nullable|numeric',
            'locations' => 'nullable|array',
            'category_ids' => 'nullable|array',
        ]));

        $filters['keyword'] = $request->input('k');

        $params = array_merge([
            'paginate' => [
                'per_page' => (int) $perPage,  // Ensure perPage is an integer
                'current_paged' => (int) $request->input('page', 1), // Cast to integer
            ],
            'order_by' => ['admin_workshops.created_at' => 'DESC'],
            'with' => self::geCategoryRelationsQuery(),
        ], $extra);

        return app(CategoryInterface::class)->getCategory($filters, $params);
    }

    public function geCategoryRelationsQuery(): array
    {
        return [
            'slugable:id,key,prefix,reference_id',
//            'state:id,name',
//            'city:id,name',
//            'categories' => function (Builder $query) {
//                return $query
//                    ->wherePublished()
//                    ->orderBy('created_at', 'DESC')
//                    ->orderBy('is_default', 'DESC')
//                    ->orderBy('order', 'ASC')
//                    ->select('re_categories.id', 're_categories.name');
//            },
        ];
    }

    public function getSortByList(): array
    {
        return [
            'date_asc' => __('Oldest'),
            'date_desc' => __('Newest'),
            'price_asc' => __('Price (low to high)'),
            'price_desc' => __('Price (high to low)'),
            'name_asc' => __('Name (A-Z)'),
            'name_desc' => __('Name (Z-A)'),
        ];
    }
}
