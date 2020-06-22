<?php
use think\facade\Route;


Route::get('model', 'index/index/model');
Route::get('uuid', 'index/index/uuid');
Route::post('login', 'api/auth/email');



Route::group('api', function () {
    Route::group('v1', function () {
        // 平台推送分站产品数据

        Route::get('campaign/latest', 'api/v1.Campaign/latest');
        Route::get('campaign/list', 'api/v1.Campaign/collections');
        Route::put('campaign/:campaignUID/vote', 'api/v1.Campaign/batchSubmit');
        Route::get('campaign/:campaignUID/rater', 'api/v1.Campaign/rater');
        Route::get('campaign/:campaignUID', 'api/v1.Campaign/index');
        Route::get('campaign/:campaignUID/result', 'api/v1.Campaign/top');
        Route::post('campaign', 'api/v1.Campaign/create');
        Route::put('campaign/:campaignUID', 'api/v1.Campaign/update');
        Route::put('campaign/:campaignUID/rule', 'api/v1.Campaign/rule');

        Route::post('program', 'api/v1.Program/create');
        Route::put('program/:programUID', 'api/v1.Program/rating');
        Route::rule('login', 'api/v1.Auth/wx', 'GET|POST');
        Route::get('user', 'api/v1.User/all');
    });
})->header('Access-Control-Allow-Origin', '*')
    ->middleware(['loginStatus'])
    // ->domain(Env::get('api.domain','chat.freebie-queen.com'))
    ->allowCrossDomain();