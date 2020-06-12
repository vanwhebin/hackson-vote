<?php
use think\facade\Route;


Route::get('model', 'index/index/model');



Route::group('api', function () {
    Route::group('v1', function () {
        Route::group('product', function () {
            // 平台推送分站产品数据
            Route::post('update', 'api/v1.Product/update');
        });
    });
})->header('Access-Control-Allow-Origin', '*')
    // ->middleware(['permissionAuth'])
    // ->domain(Env::get('api.domain','chat.freebie-queen.com'))
    ->allowCrossDomain();