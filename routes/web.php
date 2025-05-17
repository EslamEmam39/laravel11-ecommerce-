<?php

use App\Http\Controllers\BackendController;
use App\Http\Controllers\FrontEndController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProfileController;
use App\Mail\ForgetPassword;
use Illuminate\Support\Facades\Route;

// Route::get('/', function () {
//     return view('welcome');
// });


Route::controller(FrontEndController::class)->group(function () {

        Route::get('/', 'home')->name('home');

        Route::any('/user/login', 'user_login');
        Route::any('/new-account', 'new_Account');

        Route::get('/products-by-category/{id}' ,'products_by_category')->name('products.by.category');
        Route::get('/product-view/{id}' , 'product_view')->name('products.view');

        Route::get('/super-deals' , 'super_deals')->name('super.deals');
        Route::get('/all-products' , 'products')->name('products');

        Route::get('/user/forget-password' , 'user_forget_password')->name('user.forget.password');
        Route::post('/user/reset-password' , 'user_reset_password');
        Route::get('/user/update-password/{id}' , 'user_update_password')->name('user.update.password');

        Route::post('/search-product' , 'product_search') ; 
        Route::get('/search-result/{data}' , 'search_result') ; 

        Route::get( '/cart-view', 'cart_view')->name('cart.view');
        Route::post('/add-cart' , 'add_cart');
        Route::get( '/cart-delete/{id}', 'cart_delete');
        Route::get( '/empty-cart', 'empty_cart');

        Route::get( '/favorite-view', 'favorite_view')->name('favorite.view');
        Route::post('/add-favorite' , 'add_favorite');
        Route::get('/delete-favorite/{id}' , 'delete_favorite');
        Route::get('/favorite/add-cart/{id}' , 'favorite_add_cart');

    Route::controller(OrderController::class)->group(function () {

        Route::get('/checkout-details',  'showDetails')->name('checkout.details');
        Route::post('/checkout', 'confirmOrder')->name('checkout.confirm');
        Route::get('/my-orders' , 'my_orders' )->name('my.orders');
       
    
    });

    Route::get('/contact-us' , 'contact_us')->name('contact.us');
    Route::post('/contact-us/update' , 'contact_us_update')->name('contact.update');


         Route::middleware(['auth' , 'verified', 'role:user'])->group(function (){
     
        Route::get('/user-logout', 'user_logout')->name('user.logout');
        Route::get('/user-profile', 'user_profile')->name('user.profile');
        Route::post('/user-profile/update', 'updateProfile')->name('user.profile.update');
    });

});

 
 
 

Route::controller(BackendController::class)->group(function () {
    
    Route::middleware(['auth' , 'verified', 'role:admin'])->group(function (){
        Route::get('/dashboard', 'dashboard')->name('dashboard');
        
        Route::get('/category/list' , 'category')->name('category');
        Route::get('/category-add' , 'category_add')->name('category.add');
        Route::post('/add-category/store' , 'add_category_store');
        Route::get('/category-edit/{id}' , 'category_edit')->name('category.edit');
        Route::post('/category/update' , 'category_update');
        Route::any('/category/delete' , 'category_delete');
 

        Route::get('/product-add' , 'product_add')->name('product.add');
        Route::post('/product-store' , 'product_store');
        Route::get('/product' , 'product')->name('product');
        Route::get('/product-edit/{id}' , 'product_edit')->name('product.edit');
        Route::post('/product-update' , 'product_update');
        Route::any('/product-delete','product_delete');

        Route::get('/featured-products','featured_products_list')->name('featured.products.list');
        Route::get('/featured-products/add','featured_products_add')->name('featured.products.add');
        Route::post('/featured/products/store','featured_products_store');
        Route::get('/featured-product/edit/{id}','featured_products_edit')->name('featured.product.edit');
        Route::post('/featured-product-update','featured_products_update');
        Route::post('/featured-product-delete','featured_products_delete');

        Route::get('/admin-profile','admin_profile')->name('admin.profile');
        Route::post('/admin-profile/edit','admin_profile_edit')->name('admin.profile.edit');

 
        Route::get('/general-setting','general_setting')->name('general.setting');
        Route::get('/general-setting/edit','general_setting_edit')->name('general.setting.edit');
        Route::post('/setting-general/update' ,'general_setting_update');



        Route::controller(OrderController::class)->group(function () {
            Route::get('/admin-orders',  'admin_orders')->name('all.orders');
            Route::post('/orders/update-status', 'updateStatus')->name('orders.updateStatus');
        });

       
    Route::get('admin/contactUs','admin_contactUs')->name('admin.contactUs');
    Route::get('contact/delete/{id}','contact_delete')->name('contact.delete');
     
    Route::get('admin/users','admin_users')->name('admin.users');
    Route::get('admin/users/delete/{id}','admin_users_delete')->name('admin.users.delete');
    

    Route::get('/admin-logout', 'admin_logout')->name('admin.logout');
    });
    
}); 
 
 




// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
