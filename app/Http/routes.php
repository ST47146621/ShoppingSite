<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/
Route::get('/', function () {
	return view('welcome');
});
//測試資料庫連接
Route::get('linkDB','ProductController@linkDB');

//認識我們
Route::get('/about_us','InfoController@about_us');

//上方類別列表(header)
Route::post('header_ajax','ProductController@product_showclass_ajax');
Route::post('ajax_test','ProductController@ajax_test');
Route::post('search_ajax','ProductController@product_searchui_ajax'); //搜尋列表顯示
Route::post('get_quick_view','OrderController@get_quick_view');//購物車小圖示


//上方類別連結
Route::get('/product_class',"ProductController@product_class");

//首頁下方類別圖片
Route::post('index_class','ProductController@index_class');


//產品(product)
Route::get('/product_index','ProductController@product_index');//產品首頁view
Route::get('/product_info','ProductController@product_info');//產品資訊view
Route::get('/product_search',"ProductController@product_search");//產品搜尋view
Route::post('product_search', 'ProductController@search_act');//產品搜尋

//會員(member)
Route::get('/member','MemberController@member'); // 登入註冊view
Route::post('/login','MemberController@member_login'); // 登入
Route::get('/logout','MemberController@member_logout'); // 登出	
Route::post('/registered','MemberController@member_registered'); // 註冊 
Route::get('/forget_emailcheck','MemberController@member_forget_emailcheck_view'); //忘記密碼view
Route::post('/forget_emailcheck','MemberController@member_forget_emailcheck'); // 忘記密碼
Route::get('/forget_changepsw','MemberController@member_forget_changepsw_view'); // 忘記密碼修改密碼view
Route::post('/forget_changepsw','MemberController@member_forget_changepsw'); // 忘記密碼修改密碼

//登入後才能使用的功能
Route::group(['middleware' => ['auth']],function(){
	Route::get('/member_center','MemberController@member_center'); // 會員中心
	Route::get('/member_change','MemberController@member_change_view'); // 修改會員資料view
	Route::post('/member_change','MemberController@member_change'); // 修改會員資料
	Route::get('/member_changepsw','MemberController@member_changepsw_view'); // 修改密碼view
	Route::post('/member_changepsw','MemberController@member_changepsw'); // 修改密碼

	//訂單(order)
	Route::get('/order_list','OrderController@order_list');	// 訂單列表
	Route::get('/order_shoppingcart','OrderController@order_shoppingcart'); // 購物車
	Route::get('/order_detail','OrderController@order_detail'); // 訂單細節
	Route::post('/order_delete','OrderController@order_delete'); // 刪除購物車商品
	Route::post('/order_putshoppingcart','OrderController@order_putshoppingcart'); // 加入購物車
	Route::post('/order_confirm','OrderController@order_confirm'); // 確認交易
	Route::post('/order_complete','OrderController@order_complete'); // 完成交易
	Route::post('/order_userinfo','OrderController@order_userinfo'); // 自動載入使用者資訊
	Route::post('/order_unit_change','OrderController@order_unit_change'); // 變更購買數量
});