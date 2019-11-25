<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

    Route::get('/PttSummary', 'PttSummaryController@index');
    Route::get('/TwitterSummary', 'TwitterSummaryController@index');
    Route::get('/ShowPtt', 'PttSummaryController@show_all');
    Route::get('/ShowPtt30', 'PttSummaryController@show_all_30');
    Route::get('/TemplateTest', 'TemplateTestController@select_type');
    Route::get('/ShowTwitter14', 'TwitterSummaryController@show_all_14');
    Route::get('/ShowNews14', 'NewsSummaryController@show_all_14');
    Route::get('/ptttitleselect', 'PttSummaryController@titleSelect');
    Route::get('/pttindexcategory', 'PttSummaryController@indexCategory');
    Route::get('/pttshow/{category}', 'PttSummaryController@showByCategory');
    Route::get('/twitterindexcategory', 'TwitterSummaryController@indexCategory');
    Route::get('/twittershow/{category}','TwitterSummaryController@showByCategory');
    Route::get('/newsindexcategory', 'NewsSummaryController@indexCategory');
    Route::get('/newsshow/{category}', 'NewsSummaryController@showByCategory');
    Route::get('/overviewshow/{title}', 'OverallSummaryController@showByTitle');
    Route::get('/overviewcategory', 'OverallSummaryController@indexCategory');
    Route::post('/floodfiredata','PostController@store');
    Route::get('/test', function(Request $request) {
        return(['1']);
    });
    