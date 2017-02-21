<?php



// Route::get('/',function(){
// 	return view('layouts.app');
// });

Route::get('/master',function(){
	return view('layouts.master');
});
/*
|--------------------------------------------------------------------------
| SignIn & SignUp Routes
|--------------------------------------------------------------------------
|
  
*/
Route::get('/login','UserController@getLoginPage');

Route::post('/signUp','UserController@getSignUp');
Route::post('/signIn','UserController@getSignIn');
Route::get('/logout','UserController@logout');
Route::get('/', [
	'uses' => 'ProductController@getIndex',
	'as' => 'index'

]);
/*
|--------------------------------------------------------------------------
|End SignIn & SignUp Routes
|--------------------------------------------------------------------------
|
  
*/
Route::get('/contact',function(){
	return view('pages.contact-us');
});

Route::get('/product/show/{id}', [
	'uses' => 'ProductController@show',
	'as' => 'show'

]);

Route::get('/shop', [
	'uses' => 'ProductController@shop',
	'as' => 'shop'

]);

Route::get('/product-details', [
	'uses' => 'ProductController@productDetails',
	'as' => 'productDetails'

]);
Route::get('/add-to-cart/{id}',[
	'uses'=>'ProductController@getAddToCArt',
	'as' => 'product.addToCart'
]);

Route::get('/shopping-cart',[
	'uses'=>'ProductController@getCart',
	'as' => 'product.shoppingCart'
]);

Route::get('/cart',function(){
	return view('pages.cart');
});

Route::get('/checkout',[
	'uses'=>'ProductController@getCheckOut',
	'as'=>'cart.checkout'
]);

Route::post('/checkout-cart','ProductController@checkout');

Route::post('/cart/update/{id}','ProductController@updateCart');

Route::post('/addReview/{id}',[
	'uses'=>'ReviewController@storeReview',
	'as'=>'review.store'
]);

Route::get('/blog',[
    'uses' => 'blogController@getBlog',
    'as'  => 'get.blog'

]);

Route::get('/blog-single/{id}', [
    'uses' => 'blogController@showBlog',
    'as'  => 'blog.single'
]);




Route::group(['prefix'=>'user'],function(){
	Route::get('/account',[
		'uses'=>'UserController@getAccount',
		'as'=>'user.account'	
	]);
	
	Route::get('/myblog/{id}',[
		'uses'=> 'UserController@getMyblog',
		'as' => 'user.blog',
		'middleware'=>'auth'
	]);

	Route::post('/create-blog',[
		'uses'=> 'blogController@create',
		'as' => 'create.blog'
	]);


});


Route::group(['prefix'=>'admin'],function(){

	Route::get('/login',[
		'uses' => 'adminController@getLogin',
		'as' =>'admin.login'
	]);


	Route::post('/login',[
		'uses' => 'adminController@postLogin',
		'as' =>'admin.postlogin'
	]);


	Route::get('/profile',[
		'uses' => 'adminController@getProfile',
		'as'=> 'admin.profile',
		'middleware'=> 'admin'
	]);


	Route::get('/dashboard',[
		'uses'=>'adminController@getDasborad',
		'as' =>'admin.dashboard',
		'middleware'=>'admin'
	]);


	Route::get('/logout',function(){
		Auth::logout();
		return redirect('/admin/login');
	});

	Route::get('/product',[
		'uses'=>'adminController@showProduct',
		'as'=>'admin.getProduct',
		'middleware'=>'admin'
	]);

	Route::post('/addProduct',[
		'uses'=>'adminController@addProduct',
		'as'=>'admin.addProduct',
		'middleware'=>'admin'
	]);

	Route::get('/product/edit/{id}',[
		'uses'=>'adminController@editProductInfo',
		'as'=>'admin.editProductInfo',
		'middleware'=>'admin'
	]);
	Route::post('/editProduct/{id}',[
		'uses' =>'adminController@saveProductInfo',
		'as'=> 'admin.saveProductInfo',
		'middleware'=>'admin'
	]);

	Route::get('/deleteProduct/{id}',[
		'uses'=>'adminController@deleteProduct',
		'as'=>'admin.deleteProduct',
		'middleware'=>'admin'
	]);

	
});

Route::get('/chart',function(){
	return view('admin.charts');
});

Route::get('/elements',function(){
return view('admin.elements');
});

Route::get('/icons',function(){
return view('admin.icons');
});

Route::get('/notification',function(){
return view('admin.notifications');
});

Route::get('/pagelock',function(){
return view('admin.page-lockscreen');
});



Route::get('/panel',function(){
return view('admin.panels');
});

Route::get('/table',function(){
return view('admin.tables');
});

Route::get('/typo',function(){
return view('admin.typography');
});

