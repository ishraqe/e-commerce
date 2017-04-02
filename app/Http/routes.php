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



Route::get('/category/all', [
	'uses' => 'ProductController@categoryAll',
	'as' => 'category.all'

]);

Route::get('/brand/all', [
	'uses' => 'ProductController@brandAll',
	'as' => 'brand.all'

]);

Route::get('/contact',function(){
	return view('pages.contact-us');
});

Route::get('/product/show/{id}', [
	'uses' => 'ProductController@show',
	'as' => 'show'

]);

Route::get('/categories/product/{id}', [
    'uses' => 'ProductController@categoriesProduct',
    'as' => 'categories.products'
]);

Route::get('/brands/product/{id}', [
    'uses' => 'ProductController@brandsProduct',
    'as' => 'brands.products'
]);
Route::post('/categorisedProduct', 'ProductController@categorisedProduct');



Route::get('/shop', [
	'uses' => 'ProductController@shop',
	'as' => 'shop'

]);

Route::get('/search', [
    'uses' => 'searchController@getSearch',
    'as' => 'all.search'
]);


Route::get('/product-details', [
	'uses' => 'ProductController@productDetails',
	'as' => 'productDetails'
]);

Route::get('/add-to-cart/{id}',[
	'uses'=>'ProductController@getAddToCArt',
	'as' => 'product.addToCart'
]);

Route::get('/add-to-wishlist/{id}',[
	'uses'=>'ProductController@addToWishlist',
	'as' => 'product.addToWishlist'
]);

Route::get('/shopping-cart',[
	'uses'=>'ProductController@getCart',
	'as' => 'product.shoppingCart'
]);

Route::get('/shopping-wishlist',[
	'uses'=>'ProductController@getWishList',
	'as' => 'product.wishListmain'
]);


Route::get('/cart',function(){
	return view('pages.cart');
});

Route::get('/checkout',[
	'uses'=>'ProductController@getCheckOut',
	'as'=>'cart.checkout'
]);

Route::post('/checkout-cart','ProductController@checkout');

Route::post('/cart/update','ProductController@updatIncreaseCart');

Route::post('/cart/decreaseProduct','ProductController@updateDecreaseCart');

Route::get('cart/deleteItem/{id}',[
    'uses'=>'ProductController@deleteCartItem',
    'as' => 'cart.deleteItem'
]);

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

Route::post('/add/comment','blogController@addComment');


//Route::post('/blog/addComment/{id}', [
//    'uses' => 'blogController@addComment',
//    'as'  => 'blog.addComment'
//]);


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

    Route::post('/blog/update/info',[
        'uses'=> 'blogController@editMyBlog',
        'as' => 'user.editMyBlog',
        'middleware'=>'auth'
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

    Route::post('/edit/basicProfile',[
        'uses' =>'adminController@editBasicProfile',
        'as'  => 'admin.editBasicProfile',
        'middleware' => 'admin'
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
		'uses'=>'ProductController@editProductInfo',
		'as'=>'admin.editProductInfo',
		'middleware'=>'admin'
	]);
    Route::post('/product/update/info','ProductController@getProductInfo');

	Route::post('/product/delete',[
		'uses'=>'adminController@deleteProduct',
		'as'=>'admin.deleteProduct',
		'middleware'=>'admin'
	]);
	Route::post('/product/makeDelete',[
		'uses'=>'adminController@makeDelete',
		'as'=>'admin.makeDelete',
		'middleware'=>'admin'
	]);
	
	Route::get('/getInfo/{id}',[
		'uses'=>'adminController@showInfo',
		'as'=>'admin.showInfo',
		'middleware'=>'admin'
	]);
	
	Route::get('/users',[
		'uses'=>'adminController@showUsers',
		'as'=>'admin.users',
		'middleware'=>'admin'
	]);
	Route::get('/allusers',[
		'uses' => 'adminController@getAlluser',
		'as' => 'admin.alluser',
		'middleware' => 'admin'
	]);
	Route::get('/allAdmin',[
		'uses' => 'adminController@getAllAdmin',
		'as' => 'admin.allAdmin',
		'middleware' => 'admin'
	]);
	Route::post('/add',[
		'uses' => 'adminController@addNewAdmin',
		'as' => 'admin.addAdmin',
		'middleware' => 'admin'
	]);

    Route::get('/notification/landing',[
        'uses' => 'adminController@notificationLanding',
        'as' => 'admin.notificationLanding',
        'middleware' => 'admin'
    ]);
    Route::get('/message/landing',[
        'uses' => 'adminController@messageLanding',
        'as' => 'admin.messages',
        'middleware' => 'admin'
    ]);

    Route::post('/product/saveUpdate',[
        'uses' => 'ProductController@saveupdateproduct',
        'as' => 'admin.updateProductInfo',
        'middleware' => 'admin'
    ]);

    Route::get('/todo',[
        'uses' => 'adminController@getTodo',
        'as' => 'admin.to-do',
        'middleware' => 'admin'
    ]);
    Route::post('/todo/status',[
        'uses' => 'adminController@changeTodoStatus',
        'as' => 'admin.status',
        'middleware' => 'admin'
    ]);
    Route::post('/edit/todo',[
        'uses' => 'adminController@editTodo',
        'as' => 'admin.editTodo',
        'middleware' => 'admin'
    ]);
    Route::post('/todo/saveUpdate',[
        'uses' => 'adminController@updateTodo',
        'as' => 'admin.updateTodo',
        'middleware' => 'admin'
    ]);
    Route::post('/notification/makeRead',[
        'uses' => 'adminController@notificationMakeRead',
        'as' => 'admin.notificationMakeRead',
        'middleware' => 'admin'
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

