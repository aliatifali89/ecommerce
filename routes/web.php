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

//Route::get('/', function () {
//    return view('welcome');
//});
//
//Auth::routes();

Route::get('/', 'IndexController@index');
Route::get('/products/{url}', 'ProductsController@products');
Route::get('/product/{url}', 'ProductsController@product');//for product detail
Route::any('/get-product-price', 'ProductsController@getproductprice');
Route::post('/apply-coupon', 'ProductsController@applycoupon');
//Route::get('/admin', 'AdminController@login'); //no need this function after creating below match function

Route::group(['middleware'=>['auth']],function(){
	Route::get('/admin/dashboard','AdminController@dashboard');
	Route::get('/admin/settings','AdminController@settings');
    Route::get('/admin/check-pwd', 'AdminController@chk_pwd');
    Route::match(['get','post'],'/admin/update-pwd', 'AdminController@update_password');
    //categories routes admin
    Route::match(['get','post'],'/admin/add-category', 'CategoryController@addCategory');
     Route::match(['get','post'],'/admin/edit-category/{id}', 'CategoryController@editCategory');
     Route::match(['get','post'],'/admin/delete-category/{id}', 'CategoryController@deleteCategory');
    Route::get('/admin/view-categories', 'CategoryController@viewCategories');
     //Products routes admin
     Route::match(['get','post'],'/admin/add-product', 'ProductsController@addProducts');
     Route::get('/admin/view-products', 'ProductsController@viewProducts');
     Route::match(['get','post'],'/admin/edit-product/{id}', 'ProductsController@editProduct');
     Route::get('/admin/delete-pimage/{id}', 'ProductsController@deleteproductsimage');
     Route::get('/admin/delete-product/{id}', 'ProductsController@deleteproducts');
     Route::get('admin/delete-alt-image/{id}', 'ProductsController@deletealtimage');
    
    //Add to cart
    Route::match(['get','post'],'/add-cart', 'ProductsController@addtocart');
    
    //Cart page
    Route::match(['get','post'],'/cart', 'ProductsController@cart');

   //Delete Cart product
    Route::get('/cart/delete-cartproduct/{id}', 'ProductsController@deletecartproducts');
    
    //Update cart quantity
        Route::get('/cart/update-cartquantity/{id}/{quantity}', 'ProductsController@updatecartquantity');

    
    //product attribute
      Route::match(['get','post'],'/admin/addp-attributes/{id}', 'ProductsController@addpAttributes');
      Route::match(['get','post'],'/admin/editp-attributes/{id}', 'ProductsController@editpAttributes');
      Route::match(['get','post'],'/admin/addp-images/{id}', 'ProductsController@addImages');
      Route::get('/admin/delete-attributes/{id}', 'ProductsController@deleteattributes');
    
    //Coupons
     Route::match(['get','post'],'/admin/add-coupons', 'CouponController@addcoupon');
     Route::match(['get','post'],'/admin/view-coupons', 'CouponController@viewcoupon');
     Route::match(['get','post'],'/admin/edit-coupons/{id}', 'CouponController@editcoupon');
     Route::match(['get','post'],'/admin/delete-coupons/{id}', 'CouponController@deletecoupon');
    
    //banners
     Route::match(['get','post'],'/admin/add-banners', 'BannersController@addbanner');
     Route::match(['get','post'],'/admin/view-banners', 'BannersController@viewbanner');
     Route::match(['get','post'],'/admin/edit-banners/{id}', 'BannersController@editbanner');     Route::match(['get','post'],'/admin/delete-bannerimage/{id}', 'BannersController@deletebannerimage');
     Route::match(['get','post'],'/admin/edit-banners/{id}', 'BannersController@editbanner');     Route::match(['get','post'],'/admin/delete-banners/{id}', 'BannersController@deletebanner');


});
//User Login and Register
//sign up
Route::post('/login-register', 'UsersController@register');
//login directly after sign up
Route::get('/user-login', 'UsersController@userlogin');
//Route::match(['get','post'],'/login-register', 'UsersController@register');
//user logout
Route::get('/user-logout', 'UsersController@userlogout');
//login
Route::post('/login', 'UsersController@login');

Route::group(['middleware'=>['frontlogin']],function(){
//account
Route::match(['get','post'],'/account', 'UsersController@account');
Route::get('/check-pwd', 'UsersController@chk_pwd');
Route::match(['get','post'],'/update-pwd', 'UsersController@updatepassword');    
});
//Check email where exists or not using function and main.js 
Route::match(['get','post'],'/check-email', 'UsersController@checkemail');


//Admin Login and Register
Route::match(['get','post'],'/admin', 'AdminController@login');
//Route::get('/admin/dashboard', 'AdminController@dashboard');
Route::get('/logout', 'AdminController@logout');

