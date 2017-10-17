<?php
Route::group(['prefix' => config('adminamazing.path').'/blog', 'middleware' => 'web'], function() {
    Route::get('/', 'selfreliance\iblog\BlogController@index')->name('AdminBlog');
    Route::delete('/delete', 'selfreliance\iblog\BlogController@destroy')->name('AdminBlogDelete');
    Route::put('/{news_id}', 'selfreliance\iblog\BlogController@update')->name('AdminBlogUpdate');
    Route::put('/', 'selfreliance\iblog\BlogController@add')->name('AdminBlogAdd');
    Route::get('/addEdit{lang?}', 'selfreliance\iblog\BlogController@addEdit')->name('AdminBlogEditAdd');
    Route::get('/{id}', 'selfreliance\iblog\BlogController@edit')->name('AdminBlogEdit');
});