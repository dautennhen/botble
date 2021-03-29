<?php

Route::group(['namespace' => 'Botble\Miss\Http\Controllers', 'middleware' => ['web', 'core']], function () {

    Route::group(['prefix' => BaseHelper::getAdminPrefix(), 'middleware' => 'auth'], function () {

        Route::group(['prefix' => 'misses', 'as' => 'miss.'], function () {
            Route::resource('', 'MissController')->parameters(['' => 'miss']);
            Route::delete('items/destroy', [
                'as'         => 'deletes',
                'uses'       => 'MissController@deletes',
                'permission' => 'miss.destroy',
            ]);
        });
        Route::group(['prefix' => 'truongs', 'as' => 'truong.'], function () {
            Route::resource('', 'TruongController')->parameters(['' => 'truong']);
            Route::delete('items/destroy', [
                'as'         => 'deletes',
                'uses'       => 'TruongController@deletes',
                'permission' => 'truong.destroy',
            ]);
        });
        Route::group(['prefix' => 'namhocs', 'as' => 'namhoc.'], function () {
            Route::resource('', 'NamhocController')->parameters(['' => 'namhoc']);
            Route::delete('items/destroy', [
                'as'         => 'deletes',
                'uses'       => 'NamhocController@deletes',
                'permission' => 'namhoc.destroy',
            ]);
        });
        Route::group(['prefix' => 'thisinhs', 'as' => 'thisinh.'], function () {
            Route::resource('', 'ThisinhController')->parameters(['' => 'thisinh']);
            Route::delete('items/destroy', [
                'as'         => 'deletes',
                'uses'       => 'ThisinhController@deletes',
                'permission' => 'thisinh.destroy',
            ]);
        });
        Route::group(['prefix' => 'photos', 'as' => 'photo.'], function () {
            Route::resource('', 'PhotoController')->parameters(['' => 'photo']);
            Route::delete('items/destroy', [
                'as'         => 'deletes',
                'uses'       => 'PhotoController@deletes',
                'permission' => 'photo.destroy',
            ]);
        });
        Route::group(['prefix' => 'thachthucs', 'as' => 'thachthuc.'], function () {
            Route::resource('', 'ThachthucController')->parameters(['' => 'thachthuc']);
            Route::delete('items/destroy', [
                'as'         => 'deletes',
                'uses'       => 'ThachthucController@deletes',
                'permission' => 'thachthuc.destroy',
            ]);
        });

    });

});
