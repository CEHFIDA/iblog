<?php
Route::group(['prefix' => 'admin/blog', 'middleware' => 'web'], function() {
    Route::get('/', 'selfreliance\iblog\BlogController@index')->name('AdminBlog');
    Route::delete('{id}', 'selfreliance\iblog\BlogController@destroy')->name('AdminBlogDeleted');
    Route::put('/{news_id}', 'selfreliance\iblog\BlogController@update')->name('AdminBlogUpdate');
    Route::put('/', 'selfreliance\iblog\BlogController@add')->name('AdminBlogAdd');
    Route::get('/addEdit{lang?}', 'selfreliance\iblog\BlogController@addEdit')->name('AdminBlogEditAdd');
    Route::get('/{id}', 'selfreliance\iblog\BlogController@edit')->name('AdminBlogEdit');
});