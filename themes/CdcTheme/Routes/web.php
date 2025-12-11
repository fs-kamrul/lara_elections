<?php

Route::group(['namespace' => 'Theme\CdcTheme\Http\Controllers', 'middleware' => 'web'], function () {
    Route::group(apply_filters(FILTER_GROUP_PUBLIC_ROUTE, []), function () {
        Route::get('ajax/cart', 'CdcThemeController@ajaxCart')
            ->name('public.ajax.cart');

        Route::get('ajax/products', 'CdcThemeController@ajaxGetProducts')
            ->name('public.ajax.products');

        Route::get('ajax/product-categories/products', 'CdcThemeController@ajaxGetProductsByCategoryId')
            ->name('public.ajax.product-category-products');

        Route::get('ajax/featured-products', 'CdcThemeController@getFeaturedProducts')
            ->name('public.ajax.featured-products');

        Route::get('ajax/posts', 'CdcThemeController@ajaxGetPosts')->name('public.ajax.posts');

        Route::get('ajax/featured-product-categories', 'CdcThemeController@getFeaturedProductCategories')
            ->name('public.ajax.featured-product-categories');

        Route::get('ajax/featured-brands', 'CdcThemeController@ajaxGetFeaturedBrands')
            ->name('public.ajax.featured-brands');

        Route::get('ajax/related-products/{id}', 'CdcThemeController@ajaxGetRelatedProducts')
            ->name('public.ajax.related-products');

        Route::get('ajax/product-reviews/{id}', 'CdcThemeController@ajaxGetProductReviews')
            ->name('public.ajax.product-reviews');

        Route::get('ajax/get-flash-sales', 'CdcThemeController@ajaxGetFlashSales')
            ->name('public.ajax.get-flash-sales');

        Route::get('ajax/quick-view/{id}', 'CdcThemeController@getQuickView')
            ->name('public.ajax.quick-view');
    });
});

Theme::routes();
Route::group(['namespace' => 'Theme\CdcTheme\Http\Controllers', 'middleware' => ['web']], function () {
    Route::group(apply_filters(FILTER_GROUP_PUBLIC_ROUTE, []), function () {
        Route::get('ajax/get-panel-inner', 'CdcThemeController@ajaxGetPanelInner')
            ->name('theme.ajax-get-panel-inner');

        Route::get('/', 'CdcThemeController@getIndex')
            ->name('public.index');
        Route::get('sitemap.xml', 'CdcThemeController@getSiteMap')
            ->name('public.sitemap');
        Route::get('{slug?}' . config('kamruldashboard.public_single_ending_url'), 'CdcThemeController@getView')
            ->name('public.single');
    });
});
