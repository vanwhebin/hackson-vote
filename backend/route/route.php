<?php
use think\facade\Route;


Route::get('model', 'index/index/model');
Route::get('uuid', 'index/index/uuid');
// Route::get('api/v1/campaign/latest', 'api/v1.Campaign/latest');
Route::get('api/v1/campaign/:campaignUID/result', 'api/v1.Campaign/top');
// Route::post('login', 'api/auth/email');

Route::group('api', function () {
    Route::group('v1', function () {

        Route::get('campaign/list', 'api/v1.Campaign/collections');
        Route::get('campaign/latest', 'api/v1.Campaign/latest');
        // Route::get('campaign/:campaignUID/result', 'api/v1.Campaign/top');
        Route::put('campaign/:campaignUID/vote', 'api/v1.Campaign/batchSubmit');
        Route::get('campaign/:campaignUID/rater', 'api/v1.Campaign/rater');
        Route::get('campaign/:campaignUID', 'api/v1.Campaign/index');
        Route::post('campaign', 'api/v1.Campaign/create');
        Route::put('campaign/:campaignUID', 'api/v1.Campaign/update');
        Route::delete('campaign/:campaignUID', 'api/v1.Campaign/delete');
        Route::put('campaign/:campaignUID/rule', 'api/v1.Campaign/rule');
        Route::get('program/:campaignUID', 'api/v1.Program/collection');
        Route::post('program', 'api/v1.Program/create');
        Route::put('program/:programUID', 'api/v1.Program/rating');
        Route::post('login', 'api/v1.Auth/email');
        Route::get('user', 'api/v1.User/all');
    });
})->header('Access-Control-Allow-Origin','vote.freebie-queen.com, hackthon.freebie-queen.com')
    ->header('Access-Control-Allow-Credentials', 'true')
    ->middleware(['loginStatus'])
    ->allowCrossDomain();