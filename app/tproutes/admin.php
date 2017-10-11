<?php
Route::group(array('before' => 'auth-admin'), function() {
    Route::get('/admin', 'AdminController@home');
    Route::get('admin/category', 'AdminController@category_index');
    Route::get('admin/category/update/{id?}', 'AdminController@category_update');
    Route::post('admin/category/update/{id?}', 'AdminController@category_update_post');

    Route::get('admin/product', 'AdminController@product_index');
    Route::get('admin/product/update/{id?}', 'AdminController@product_update');
    Route::post('admin/product/update/{id?}', 'AdminController@product_update_post');
    Route::get('admin/product/delete/{id}', 'AdminController@product_delete_post');

    Route::get('admin/banner', 'AdminController@banner_index');
    Route::get('admin/banner/update/{id?}', 'AdminController@banner_update');
    Route::post('admin/banner/update/{id?}', 'AdminController@banner_update_post');
    Route::get('admin/banner/delete/{id}', 'AdminController@banner_delete_post');

    Route::get('admin/discount', 'AdminController@discount_index');
    Route::get('admin/discount/code/{id}', 'AdminController@discount_code');
    Route::get('admin/discount/update/{id?}', 'AdminController@discount_update');
    Route::post('admin/discount/update/{id?}', 'AdminController@discount_update_post');

    Route::get('admin/blog', 'AdminController@blog_index');
    Route::get('admin/blog/update/{id?}', 'AdminController@blog_update');
    Route::post('admin/blog/update/{id?}', 'AdminController@blog_update_post');

    Route::get('admin/sales', 'AdminController@sales');
    Route::post('admin/sales', 'AdminController@sales_post');

    Route::get('admin/order', 'AdminController@order');
    Route::get('admin/order/update-status', 'AdminController@order_update_status');
    Route::get('admin/order/detail/{id}', 'AdminController@orderdetail');
    Route::get('admin/order/delete/{id}', 'AdminController@order_delete_post');

    Route::get('admin/setup', 'AdminController@setup');
    Route::post('admin/setup', 'AdminController@setup_post');
    Route::get('admin/newsletter', 'AdminController@newsletter');
    Route::get('admin/customer', 'AdminController@customer');
    Route::get('admin/update/profile', 'AdminController@profile');
    Route::post('admin/update/profile', 'AdminController@profile_post');

    Route::get('admin/update/profile', 'AdminController@profile');
    Route::post('admin/update/profile', 'AdminController@profile_post');

    Route::get('admin/shipping', 'AdminController@shipping');
    Route::post('admin/shipping', 'AdminController@shipping_post');
});

