<?php

Theme::routes();

Route::group(['namespace' => 'Theme\Missuniversity\Http\Controllers', 'middleware' => ['web', 'core']], function () {
    Route::group(apply_filters(BASE_FILTER_GROUP_PUBLIC_ROUTE, []), function () {

        Route::get('/', 'MissController@getIndex')->name('public.index');

        Route::get('sitemap.xml', [
            'as'   => 'public.sitemap',
            'uses' => 'MissController@getSiteMap',
        ]);

        Route::get('{slug?}' . config('core.base.general.public_single_ending_url'), [
            'as'   => 'public.single',
            'uses' => 'MissController@getView',
        ]);

    });

    Route::post('member/do-vote', 'VoteController@doVote')->name('member.vote');
    Route::post('member/do-vote-dis', 'VoteController@doVoteDis')->name('member.votedis');
    Route::post('thisinh/register', 'ThisinhController@register')->name('thisinh.register');
    Route::post('thisinh/update-info', 'ThisinhController@updateInfo')->name('thisinh.updateinfo');
    Route::post('thisinh/upload/{folder}/{name}', 'ThisinhController@uploadPhoto')->name('ajax-upload-image');
    Route::get('/profile-thisinh?id={id}')->name('profile-thisinh');
    Route::get('/chi-tiet-thi-sinh?id={id}')->name('chitiet-thisinh');
    Route::get('/danh-sach-thi-sinh')->name('danhsach-thisinh');
    Route::get('/dang-ki-du-thi')->name('dang-ki-du-thi');
});
