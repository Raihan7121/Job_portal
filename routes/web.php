<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AccountController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\SellController;
use App\Http\Controllers\StripeController;

// Route::get('/', function () {
//     return view('welcome');
// });

Route::any('/profile',[HomeController::class,'profile'])->name('panel.profile')->middleware('authenticate');

Route::get('/dashboard',[HomeController::class,'dashboard'])->name('panel.dashboard')->middleware('authenticate');
Route::get('/',[HomeController::class,'login'])->name('panel.login')->middleware('redirectauthenticate');
Route::get('/register',[HomeController::class,'registration'])->name('panel.registration')->middleware('redirectauthenticate');
Route::post('/registrationProcess',[HomeController::class,'processRegistration'])->name('panel.processRegistration');
Route::post('/a',[HomeController::class,'authenticate'])->name('panel.authenticate');
Route::get('/cp',[HomeController::class,'changeProfilePic'])->name('panel.changeProfilePic')->middleware('authenticate');
Route::post('/upp',[HomeController::class,'updateProfilePic'])->name('panel.updateProfilePic')->middleware('authenticate');

Route::get('/log',[HomeController::class,'logout'])->name('panel.logout');

Route::post('/uup',[HomeController::class,'updateProfile'])->name('panel.updateProfile')->middleware('authenticate');

Route::any('/updaterole1/{id}',[HomeController::class,'adminRole'])->name('user.adminrole')->middleware('authenticate');
Route::any('/updaterole2/{id}',[HomeController::class,'sellerRole'])->name('user.sellerrole')->middleware('authenticate');
Route::any('/updaterole3/{id}',[HomeController::class,'userRole'])->name('user.userrole')->middleware('authenticate');

Route::post('/updatePassword',[HomeController::class,'updatePassword'])->name('panel.changePassword')->middleware('authenticate');
Route::any('/deleteUser/{id}',[HomeController::class,'deleteUser'])->name('user.delete')->middleware('authenticate');

//product controller

Route::any('/createProduct',[ProductController::class,'createProduct'])->name('product.register')->middleware('authenticate');
Route::post('/addProduct',[ProductController::class,'addProduct'])->name('product.add')->middleware('authenticate');
Route::get('/showProduct',[ProductController::class,'showProduct'])->name('product.show')->middleware('authenticate');
Route::any('/deleteProduct/{id}',[ProductController::class,'deleteProduct'])->name('product.delete')->middleware('authenticate');
Route::any('/editProduct/{id}',[ProductController::class,'editProduct'])->name('product.edit')->middleware('authenticate');
Route::post('/updateProduct/{id}',[ProductController::class,'updateProduct'])->name('product.update')->middleware('authenticate');
Route::any('/addCart/{id}',[ProductController::class,'addCart'])->name('product.addCart')->middleware('authenticate');

Route::post('/send',[ProductController::class,'sendemail'])->name('sendemail');



//order controller

Route::any('/header',[OrderController::class,'header'])->name('view.home');

Route::get('/notfound',[OrderController::class,'notfound'])->name('view.notfound');
Route::get('/cart',[OrderController::class,'cart'])->name('view.cart')->middleware('authenticate');

Route::get('/chackout',[OrderController::class,'chackout'])->name('view.chackout');

Route::get('/contact',[OrderController::class,'contact'])->name('view.contact');

Route::get('/shop',[OrderController::class,'shop'])->name('view.shop');

Route::get('/product-detail/{id}',[OrderController::class,'productdetail'])->name('product.product-detail');

Route::get('/testimonial',[OrderController::class,'testimonial'])->name('view.testimonial');

Route::any('/deleteCart/{id}',[OrderController::class,'deleteCart'])->name('product.delete-cart');

Route::post('/addsell',[OrderController::class,'addsell'])->name('product.addsell');


//Route::get('/',[HomeController::class,'rai'])->name('home');
// Route::get('/account/register',[AccountController::class,'registrarion'])->name('account.registration')->middleware('redirectauthenticate');

// Route::post('/account/process-register',[AccountController::class,'processRegistration'])->name('account.processRegistration');

// Route::get('/account/login',[AccountController::class,'login'])->name('account.login')->middleware('redirectauthenticate');

// Route::post('/account/authenticate',[AccountController::class,'authenticate'])->name('account.authenticate');

// Route::get('/account/profile',[AccountController::class,'profile'])->name('account.profile')->middleware('authenticate');
// Route::put('/account/update-profile',[AccountController::class,'updateProfile'])->name('account.updateProfile')->middleware('authenticate');

// Route::get('/account/logout',[AccountController::class,'logout'])->name('account.logout');

// Route::post('/account/update-profile-pic',[AccountController::class,'updateProfilePic'])->name('account.updateProfilePic');

// Route::get('/account/create-job',[AccountController::class,'createJob'])->name('account.createJob');

// Route::post('/account/save-job',[AccountController::class,'saveJob'])->name('account.saveJob');
// Route::get('/account/my-jobs',[AccountController::class,'myJobs'])->name('account.myJobs');


// stripe controller
// Route::get('/stripe', 'App\Http\Controllers\StripeController@checkout')->name('checkout');
// Route::post('/test', 'App\Http\Controllers\StripeController@test');
// Route::post('/live', 'App\Http\Controllers\StripeController@live');
// Route::get('/success', 'App\Http\Controllers\StripeController@success')->name('success');

Route::get('/s',[StripeController::class,'index'])->name('index');
Route::post('/checkout',[StripeController::class,'checkout'])->name('checkout');
Route::get('/checkout',[OrderController::class,'addsell'])->name('success');