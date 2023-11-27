<?php

use Illuminate\Support\Facades\Route;

//Route User
Route::get('/', ['as' => 'index', 'uses' => 'PageController@index']);

Route::get('products', ['as' => 'products', 'uses' => 'PageController@product']);
Route::post('products', ['as' => 'products', 'uses' => 'PageController@product']);

Route::get('category/{id}', ['as' => 'category', 'uses' => 'PageController@category']);

Route::get('product-detail/{id}', ['as' => 'product-detail', 'uses' => 'PageController@product_detail']);

Route::get('shop_cart', ['as' => 'shop_cart', 'uses' => 'PageController@show_carts']);
Route::post('/update_cart/', ['as' => 'update_cart', 'uses' => 'PageController@update_carts']);
Route::get('/remove_cart/{id}', ['as' => 'remove_cart', 'uses' => 'PageController@remove_carts']);

Route::get('profile', ['as' => 'profile', 'uses' => 'PageController@profile']);

Route::get('/abouts', function () {
    return view('./user/about');
});

Route::get('checkout', [
    'as' => 'checkout',
    'uses' => 'PageController@checkout'
]);

Route::post('/process_checkout', ['as' => 'process_checkout', 'uses' => 'PageController@process_checkout']);

Route::get('/contacts/', function () {
    return view('./user/contact');
});

Route::post('/send_contact', ['as' => 'send_contact', 'uses' => 'PageController@send_contact']);


Route::get('/order-status/', function () {
    return view('./user/order_status');
});

Route::get('/order-status', ['as' => 'order-status', 'uses' => 'PageController@order_status']);
Route::get('/destroy-order-status/{id}', ['as' => 'destroy-order-status', 'uses' => 'PageController@destroy_order_status']);

Route::post('/add_review/{id}', ['as' => 'add_review', 'uses' => 'PageController@add_review']);
Route::get('/delete_review/{id}', ['as' => 'delete_review', 'uses' => 'PageController@delete_review']);
Route::get('/detail_bill/{id}', ['as' => 'detail_bill', 'uses' => 'PageController@detail_bill']);
Route::post('profile', ['as' => 'profile', 'uses' => 'PageController@add_customer']);
Route::post('change_pwd', ['as' => 'change_pwd', 'uses' => 'PageController@change_pwd']);

//Blog
Route::get('blogs', ['as' => 'blogs', 'uses' => 'PageController@blog']);
Route::get('/blog-details/{id}', ['as' => 'blog-details', 'uses' => 'PageController@blog_details']);

Route::get('/login/', function () {
    return view('./user/login');
});
Route::get('/signin/', function () {
    return view('./user/signin');
});

Route::get('/return_policy/', function () {
    return view('./user/return_policy');
});
Route::get('/warranty_policy/', function () {
    return view('./user/warranty_policy');
});
Route::get('/privacy_policy/', function () {
    return view('./user/privacy_policy');
});
Route::get('/payment_delivery/', function () {
    return view('./user/payment_delivery');
});

Route::get('/size_guide/', function () {
    return view('./user/size_guide');
});
Route::post('/add-to-cart', ['as' => 'add-to-cart', 'uses' => 'PageController@add_to_cart']);
Route::post('/update_info', ['as' => 'update_info', 'uses' => 'PageController@update_info']);


// Login User
Route::post('/login', ['as' => 'login', 'uses' => 'AccountController@process_login']);
Route::get('/logout', ['as' => 'logout', 'uses' => 'AccountController@logout']);
Route::get('/forget_password', ['as' => 'forget_password', 'uses' => 'AccountController@forget_password']);
Route::post('/forget_password', ['as' => 'forget_password', 'uses' => 'AccountController@forget_password_post']);
Route::get('/reset_password/{token}', ['as' => 'reset_password', 'uses' => 'AccountController@reset_password']);
Route::post('/reset_password_post/', ['as' => 'reset_password_post', 'uses' => 'AccountController@reset_password_post']);
//Logout User
Route::post('/signin', ['as' => 'signin', 'uses' => 'AccountController@create_account']);

//Login google
Route::get('/google', 'GoogleController@redirectToGoogle');
Route::get('auth/google/callback', 'GoogleController@handleGoogleCallback');

//Route Admin
//Account Admin
Route::get('admin/index', ['as' => 'admin/index', 'uses' => 'AccountController@login_admin']);
Route::post('admin/login', ['as' => 'admin/login', 'uses' => 'AccountController@process_login_admin']);
Route::get('admin/logout', ['as' => 'admin/logout', 'uses' => 'AccountController@logout_admin']);

// Page Home
Route::get('admin/home', ['as' => 'admin/home', 'uses' => 'AdminController@home']);

//Quan Ly Danh Muc
Route::get('admin/category', ['as' => 'admin/category', 'uses' => 'CategoryController@index']);
Route::get('admin/category/show', ['as' => 'admin/category/show', 'uses' => 'CategoryController@show']);
Route::post('admin/category/create', ['as' => 'admin/category/create', 'uses' => 'CategoryController@store']);
Route::get('admin/category/edit/{id}', ['as' => 'admin/category/edit', 'uses' => 'CategoryController@edit']);
Route::post('admin/category/update/{id}', ['as' => 'admin/category/update', 'uses' => 'CategoryController@update']);
Route::get('admin/category/delete/{id}', ['as' => 'admin/category/delete', 'uses' => 'CategoryController@destroy']);

//Quan Ly San Pham
Route::get('admin/product', ['as' => 'admin/product', 'uses' => 'ProductController@index']);
Route::get('admin/product/show', ['as' => 'admin/product/show', 'uses' => 'ProductController@show']);
Route::post('admin/product/create', ['as' => 'admin/product/create', 'uses' => 'ProductController@store']);
Route::get('admin/product/edit/{id}', ['as' => 'admin/product/edit', 'uses' => 'ProductController@edit']);
Route::post('admin/product/update/{id}', ['as' => 'admin/product/update', 'uses' => 'ProductController@update']);
Route::get('admin/product/delete/{id}', ['as' => 'admin/product/delete', 'uses' => 'ProductController@destroy']);

//Quan Ly Nguoi Dung
Route::get('admin/user', ['as' => 'admin/user', 'uses' => 'UserController@index']);
Route::get('admin/user/edit/{id}', ['as' => 'admin/user/edit', 'uses' => 'UserController@edit']);
Route::post('admin/user/update/{id}', ['as' => 'admin/user/update', 'uses' => 'UserController@update']);
Route::get('admin/user/delete/{id}', ['as' => 'admin/user/delete', 'uses' => 'UserController@destroy']);

//Quan Ly Bai Viet
Route::get('admin/blog', ['as' => 'admin/blog', 'uses' => 'BlogController@index']);
Route::post('admin/blog/create', ['as' => 'admin/blog/create', 'uses' => 'BlogController@store']);
Route::get('admin/blog/show', ['as' => 'admin/blog/show', 'uses' => 'BlogController@show']);
Route::get('admin/blog/edit/{id}', ['as' => 'admin/blog/edit', 'uses' => 'BlogController@edit']);
Route::post('admin/blog/update/{id}', ['as' => 'admin/blog/update', 'uses' => 'BlogController@update']);
Route::get('admin/blog/delete/{id}', ['as' => 'admin/blog/delete', 'uses' => 'BlogController@destroy']);

//Quan Ly Banner
Route::get('admin/banner', ['as' => 'admin/banner', 'uses' => 'BannerController@index']);
Route::get('admin/banner/show', ['as' => 'admin/banner/show', 'uses' => 'BannerController@show']);
Route::post('admin/banner/create', ['as' => 'admin/banner/create', 'uses' => 'BannerController@store']);
Route::get('admin/banner/edit/{id}', ['as' => 'admin/banner/edit', 'uses' => 'BannerController@edit']);
Route::post('admin/banner/update/{id}', ['as' => 'admin/banner/update', 'uses' => 'BannerController@update']);
Route::get('admin/banner/delete/{id}', ['as' => 'admin/banner/delete', 'uses' => 'BannerController@destroy']);

//Quan Ly Hoa Don
Route::get('admin/bill', ['as' => 'admin/bill', 'uses' => 'BillController@index']);
Route::get('admin/bill/{id}', ['as' => 'admin/bill_detail', 'uses' => 'BillController@bill_detail']);
Route::post('admin/update_bill/{id}', ['as' => 'admin/update_bill', 'uses' => 'BillController@update_bill']);

//Quan Ly Thong Ke
Route::get('admin/statistic', ['as' => 'admin/statistic', 'uses' => 'AdminController@statistic']);
Route::post('admin/statistic', ['as' => 'admin/statistic', 'uses' => 'AdminController@statistic']);


//Quan Ly Tai Khoan
//Route::get('admin/account', [
//    'as' => 'admin/bill',
//    'uses' => 'BillController@index'
//]);
