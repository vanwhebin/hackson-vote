<?php
use think\facade\Route;


Route::get('model', 'index/index/model');



Route::group('api', function () {
    Route::group('v1', function () {
        // 平台推送分站产品数据
        Route::post('program', 'api/v1.Program/post');
    });
})->header('Access-Control-Allow-Origin', '*')
    // ->middleware(['permissionAuth'])
    // ->domain(Env::get('api.domain','chat.freebie-queen.com'))
    ->allowCrossDomain();