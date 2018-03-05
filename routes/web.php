<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
//
//Route::get('/', function () {
//    return view('welcome');
//});

Route::get('/',[
    'as' => 'get.index',
    'uses' => 'TwitterController@index'
]);

Route::get('/homeTimeline', function()
{
    return Twitter::getHomeTimeline(['count' => 2, 'format' => 'json']);
});
Route::get('/mentionsTimeline', function()
{
    return Twitter::getMentionsTimeline(['count' => 20, 'format' => 'json']);
});

//only example!
Route::get('/tweet', function()
{
    return Twitter::postTweet(array('status' => 'My First Tweet from Laravel using Twitter API (1)', 'format' => 'json'));
});
Route::get('/getgeo', function(){
    try
    {
        //зп 47.846673, 35.136873
        $response = Twitter::getGeoReverse([
            'lat' => 47.846673,
            'long' => 35.136873,
            'accuracy' => '10000m',
            'format' => 'array'
        ]);
    }
    catch (Exception $e)
    {
        // dd(Twitter::error());
        dd(Twitter::logs());
    }

    dd($response);
});


Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
