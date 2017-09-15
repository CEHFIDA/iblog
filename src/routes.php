<?php
Route::group(['middleware' => 'web'], function () {
    Route::get(config('adminamazing.path').'/blog', 'selfreliance\iblog\BlogController@index')->name('AdminBlog');
    Route::delete(config('adminamazing.path').'/blog/{id}', 'selfreliance\iblog\BlogController@destroy')->name('AdminBlogDeleted');
    Route::put(config('adminamazing.path').'/blog/{id}', 'selfreliance\iblog\BlogController@update')->name('AdminBlogUpdate');
    Route::put(config('adminamazing.path').'/blog/add{lang?}', 'selfreliance\iblog\BlogController@add')->name('AdminBlogAdd');
    Route::get(config('adminamazing.path').'/blog/addEdit{lang?}', 'selfreliance\iblog\BlogController@addEdit')->name('AdminBlogEditAdd');
    Route::get(config('adminamazing.path').'/blog/{id}', 'selfreliance\iblog\BlogController@edit')->name('AdminBlogEdit');
});