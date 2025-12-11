<?php



Route::group(['middleware' => ['auth', '\Modules\KamrulDashboard\Http\Middleware\IsInstalled', '\Modules\KamrulDashboard\Http\Middleware\AdminSidebarMenu']], function () {
    Route::prefix('icon')->group(function() {
        Route::get('/install', 'InstallController@index');
        Route::get('/install/update', 'InstallController@update');
        Route::get('/install/uninstall', 'InstallController@uninstall');
    //    Route::get('/import', 'IconController@import')->name('icon.import');
    //    Route::post('/store_import', 'IconController@store_import')->name('icon.store_import');
    //    Route::get('/pdf_show/{icon}', 'IconController@pdf')->name('icon.pdf_show');

    });
  //  Route::get('api/icon','IconController@data');
    Route::group(['prefix' => DboardHelper::getAdminPrefix()], function () {
        Route::resource('icon', 'IconController');
        Route::delete('icon/items/destroy', [
            'as'         => 'icon.deletes',
            'uses'       => 'IconController@deletes',
        ]);
    });
});

