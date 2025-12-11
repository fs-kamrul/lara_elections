<?php

use Modules\LanguageAdvanced\Http\Controllers\LanguageAdvancedController;


Route::group([
    'controller' => LanguageAdvancedController::class,
    'middleware' => ['web'],
    'prefix' => 'account',
    'as' => 'public.account.language-advanced.',
], function () {
//    Route::post('language-advanced/save/{id}', ['as' => 'save', 'uses' => 'save'])->wherePrimaryKey();
    Route::post('language-advanced/save/{id}', ['as' => 'save', 'uses' => 'save']);
});
