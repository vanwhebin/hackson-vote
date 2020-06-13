<?php
use think\facade\Route;


Route::get('model', 'index/index/model');



Route::group('api', function () {
    Route::group('v1', function () {
        // 平台推送分站产品数据
        Route::post('program', 'api/v1.Program/post');
        Route::get('campaign/:id', 'api/v1.Campaign/index');
        Route::put('program/:id', 'api/v1.Program/rating');
        Route::get('program/:id', 'api/v1.Program/all');
        Route::rule('login', 'api/v1.Auth/wx', 'GET|POST');
        Route::get('user', 'api/v1.User/all');
    });
})->header('Access-Control-Allow-Origin', '*')
    // ->middleware(['permissionAuth'])
    // ->domain(Env::get('api.domain','chat.freebie-queen.com'))
    ->allowCrossDomain();