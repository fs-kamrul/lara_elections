<?php


Route::group(['middleware' => ['auth', '\Modules\KamrulDashboard\Http\Middleware\IsInstalled', '\Modules\KamrulDashboard\Http\Middleware\AdminSidebarMenu']], function () {
    Route::prefix('admission')->group(function () {
        Route::get('/install', 'InstallController@index');
        Route::get('/install/update', 'InstallController@update');
        Route::get('/install/uninstall', 'InstallController@uninstall');
        //    Route::get('/import', 'AdmissionController@import')->name('admission.import');
        //    Route::post('/store_import', 'AdmissionController@store_import')->name('admission.store_import');
        //    Route::get('/pdf_show/{admission}', 'AdmissionController@pdf')->name('admission.pdf_show');

    });
    //  Route::get('api/admission','AdmissionController@data');
    Route::group(['prefix' => DboardHelper::getAdminPrefix()], function () {
        Route::resource('admission', 'AdmissionController');
        Route::delete('admission/items/destroy', [
            'as' => 'admission.deletes',
            'uses' => 'AdmissionController@deletes',
        ]);
        Route::resource('admission/class', 'AdmissionClassController')->only(['index']);
//        Route::get('/admission/class', [
//            'as'    => 'admission.class',
//            'uses'  => 'AdmissionClassController@index'
//        ]);
    });
});
Route::group(['middleware' => ['web']], function () {
    Route::group(apply_filters(FILTER_GROUP_PUBLIC_ROUTE, []), function () {
        Route::post('public/admission', [
            'as' => 'public.admission_store',
            'uses' => 'AdmissionController@admission_store'
        ]);
        Route::get('public/admission_show/{id}', [
            'as' => 'public.admission_show',
            'uses' => 'AdmissionController@admission_show'
        ]);
    });
});

