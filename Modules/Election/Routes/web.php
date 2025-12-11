<?php
Route::group(['middleware' => ['auth', '\Modules\KamrulDashboard\Http\Middleware\IsInstalled', '\Modules\KamrulDashboard\Http\Middleware\AdminSidebarMenu']], function () {
    Route::group(['prefix' => DboardHelper::getAdminPrefix()], function () {
        Route::resource('electionparty', 'ElectionPartyController');
        Route::delete('electionparty/items/destroy', [
            'as'         => 'electionparty.deletes',
            'uses'       => 'ElectionPartyController@deletes',
        ]);
    });
});
?>
<?php
Route::group(['middleware' => ['auth', '\Modules\KamrulDashboard\Http\Middleware\IsInstalled', '\Modules\KamrulDashboard\Http\Middleware\AdminSidebarMenu']], function () {
    Route::group(['prefix' => DboardHelper::getAdminPrefix()], function () {
        Route::resource('election', 'ElectionController');
        Route::delete('election/items/destroy', [
            'as'         => 'election.deletes',
            'uses'       => 'ElectionController@deletes',
        ]);
    });
});
Route::group(['middleware' => ['auth', '\Modules\KamrulDashboard\Http\Middleware\IsInstalled', '\Modules\KamrulDashboard\Http\Middleware\AdminSidebarMenu']], function () {
    Route::prefix('election')->group(function() {
        Route::get('/install', 'InstallController@index');
        Route::get('/install/update', 'InstallController@update');
        Route::get('/install/uninstall', 'InstallController@uninstall');
    //    Route::get('/import', 'ElectionController@import')->name('election.import');
    //    Route::post('/store_import', 'ElectionController@store_import')->name('election.store_import');
    //    Route::get('/pdf_show/{election}', 'ElectionController@pdf')->name('election.pdf_show');

    });
  //  Route::get('api/election','ElectionController@data');
//    Route::group(['prefix' => DboardHelper::getAdminPrefix()], function () {
//        Route::resource('election', 'ElectionController');
//        Route::delete('election/items/destroy', [
//            'as'         => 'election.deletes',
//            'uses'       => 'ElectionController@deletes',
//        ]);
//    });
});

