<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthenticationController as auth;
use App\Http\Controllers\DashboardController as dash;
use App\Http\Controllers\Settings\UserController as user;
use App\Http\Controllers\Settings\AdminUserController as admin;
use App\Http\Controllers\Products\CategoryController as category;
use App\Http\Controllers\Products\SubcategoryController as subcat;
use App\Http\Controllers\Products\ChildcategoryController as childcat;
use App\Http\Controllers\Products\ProductController as product;
use App\Http\Controllers\Suppliers\SupplierController as supplier;
use App\Http\Controllers\Customers\CustomerController as customer;
use App\Http\Controllers\Purchases\PurchaseController as purchase;
use App\Http\Controllers\Sales\SaleController as sales;
use App\Http\Controllers\ReportController as report;
/* Middleware */
use App\Http\Middleware\isAdmin;
use App\Http\Middleware\isOwner;
use App\Http\Middleware\isSalesmanager;
use App\Http\Middleware\isSalesman;

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

Route::get('/register', [auth::class,'signUpForm'])->name('register');
Route::post('/register', [auth::class,'signUpStore'])->name('register.store');
Route::get('/', [auth::class,'signInForm'])->name('signIn');
Route::get('/login', [auth::class,'signInForm'])->name('login');
Route::post('/login', [auth::class,'signInCheck'])->name('login.check');
Route::get('/logout', [auth::class,'singOut'])->name('logOut');


Route::group(['middleware'=>isAdmin::class],function(){
    Route::prefix('admin')->group(function(){
        Route::get('/dashboard', [dash::class,'adminDashboard'])->name('admin.dashboard');
        
    });
});

Route::group(['middleware'=>isOwner::class],function(){
    Route::prefix('owner')->group(function(){
        Route::get('/dashboard', [dash::class,'ownerDashboard'])->name('owner.dashboard');
        Route::resource('users',user::class,['as'=>'owner']);


        //Supplier and Customer
        Route::resource('supplier',supplier::class,['as'=>'owner']);
        Route::resource('customer',customer::class,['as'=>'owner']);
        
         //report
         Route::get('/purchase_report',[report::class,'purchase_report'])->name('owner.purchase_report');
         Route::get('/sale_report',[report::class,'sale_report'])->name('owner.sale_report');
         Route::get('/stock_report',[report::class,'stock_report'])->name('owner.stock_report');

        //Product
        Route::resource('category',category::class,['as'=>'owner']);
        Route::resource('subcategory',subcat::class,['as'=>'owner']);
        Route::resource('childcategory',childcat::class,['as'=>'owner']);
        Route::resource('product',product::class,['as'=>'owner']);
    
        //Purchase
        Route::resource('purchase',purchase::class,['as'=>'owner']);

        //Sale
        Route::resource('sale',sales::class,['as'=>'owner']);
    });
});

Route::group(['middleware'=>isSalesmanager::class],function(){
    Route::prefix('salesmanager')->group(function(){
        Route::get('/dashboard', [dash::class,'salesmanagerDashboard'])->name('salesmanager.dashboard');
        
    });
});

Route::group(['middleware'=>isSalesman::class],function(){
    Route::prefix('salesman')->group(function(){
        Route::get('/dashboard', [dash::class,'salesmanDashboard'])->name('salesman.dashboard');
        
    });
});


