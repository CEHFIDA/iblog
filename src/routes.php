<?php
Route::group(['middleware' => 'web'], function () {
    Route::get(config('adminamazing.path').'/blog', 'selfreliance\iblog\BlogController@index')->middleware('role:admin')->name('AdminBlog');
    Route::delete(config('adminamazing.path').'/blog/{id}', 'selfreliance\iblog\BlogController@destroy')->middleware('role:admin')->name('AdminBlogDeleted');
    Route::put(config('adminamazing.path').'/blog/{news_id}', 'selfreliance\iblog\BlogController@update')->middleware('role:admin')->name('AdminBlogUpdate');
    Route::put(config('adminamazing.path').'/blog/', 'selfreliance\iblog\BlogController@add')->middleware('role:admin')->name('AdminBlogAdd');
    Route::get(config('adminamazing.path').'/blog/addEdit{lang?}', 'selfreliance\iblog\BlogController@addEdit')->middleware('role:admin')->name('AdminBlogEditAdd');
    Route::get(config('adminamazing.path').'/blog/{id}', 'selfreliance\iblog\BlogController@edit')->middleware('role:admin')->name('AdminBlogEdit');
});