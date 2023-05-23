<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\VendorController;
use App\Http\Controllers\AccountController;
use App\Http\Controllers\BrandController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ListingOwnerController;
use App\Http\Controllers\VariantController;
use App\Http\Controllers\WareHouseController;
use App\Http\Controllers\ExpenseController;
use App\Http\Controllers\SalesController;
use App\Http\Controllers\ExpenseCategoryController;
use App\Http\Controllers\ProductItemController;
use App\Http\Controllers\PurchaseController;
use App\Http\Controllers\StockController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\PermissionController;
use Illuminate\Support\Facades\Auth;


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

Route::get('/', function () {
    return view('auth.login');
});

Auth::routes();


Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
///////////////////////popup modal/////////////////////////////////////////////////////
Route::get('/open_popup/{page_name}', [App\Http\Controllers\HomeController::class, 'popup'])->name('open_popup');
Route::post('/get_account_brands}', [App\Http\Controllers\HomeController::class, 'get_account_brands'])->name('get_account_brands');
Route::post('/get_brand_categories}', [App\Http\Controllers\HomeController::class, 'get_brand_categories'])->name('get_brand_categories');
Route::post('/get_product_items}', [App\Http\Controllers\HomeController::class, 'get_product_items'])->name('get_product_items');
Route::post('/get_item_details}', [App\Http\Controllers\HomeController::class, 'get_item_details'])->name('get_item_details');
Route::post('/get_item_quantity}', [App\Http\Controllers\HomeController::class, 'get_item_quantity'])->name('get_item_quantity');
Route::post('/get_item_stock_details}', [App\Http\Controllers\HomeController::class, 'get_item_stock_details'])->name('get_item_stock_details');

Route::middleware(['auth'])->group(function () {
    Route::resource('/category', CategoryController::class);
    Route::get('/dashboard/{id}', [HomeController::class, 'user_dashboard'])->name('dashboard');
});
///////////////////////Accounts//////////////////////////////////////////////////////
Route::controller(AccountController::class)->middleware(['auth'])->group(function () {
    Route::get('create_account', 'create')->name('account.create');
    Route::post('create_account', 'store')->name('create_account.store');
    Route::get('/account', 'index')->name('account.index');
    Route::get('/account_edit/{id}', 'edit')->name('account.edit');
    Route::post('/account_edit/{id}', 'update')->name('account.update');
    Route::get('/account_delete/{id}', 'destroy')->name('account.delete');
});
///////////////////////Listing Owner//////////////////////////////////////////////////
Route::controller(ListingOwnerController::class)->middleware(['auth'])->group(function () {
    Route::get('create_listing_owner', 'create');
    Route::post('create_listing_owner', 'store')->name('create_listing_owner.store');
    Route::get('/listingowner', 'index')->name('listingowner.index');
    Route::get('/listingowner_edit/{id}', 'edit')->name('listingowner.edit');
    Route::post('/listingowner_edit/{id}', 'update')->name('listingowner.update');
    Route::get('/listingowner_delete/{id}', 'destroy')->name('listingowner.delete');
});
///////////////////////Brand//////////////////////////////////////////////////////
Route::controller(BrandController::class)->middleware(['auth'])->group(function () {
    Route::get('create_brand', 'create')->name('brand.create');
    Route::post('create_brand', 'store')->name('create_brand.store');
    Route::get('/brand', 'index')->name('brand.index');
    Route::get('/brand_edit/{id}', 'edit')->name('brand.edit');
    Route::post('/brand_edit/{id}', 'update')->name('brand.update');
    Route::get('/brand_delete/{id}', 'destroy')->name('brand.delete');
});
///////////////////////Variant//////////////////////////////////////////////////////
Route::controller(VariantController::class)->middleware(['auth'])->group(function () {
    Route::get('create_variant', 'create')->name('variant.create');
    Route::post('create_variant', 'store')->name('create_variant.store');
    Route::get('/variant', 'index')->name('variant.index');
    Route::get('/variant_edit/{id}', 'edit')->name('variant.edit');
    Route::post('/variant_edit/{id}', 'update')->name('variant.update');
    Route::get('/variant_delete/{id}', 'destroy')->name('variant.delete');
});
///////////////////////Product//////////////////////////////////////////////////////
Route::controller(ProductController::class)->middleware(['auth'])->group(function () {
    Route::get('create_product', 'create')->name('create_product');
    Route::post('create_product', 'store')->name('create_product.store');
    Route::get('/products', 'index')->name('product.index');
    Route::get('/product_edit/{id}', 'edit')->name('product.edit');
    Route::post('/product_edit/{id}', 'update')->name('product.update');
    Route::get('/product_delete/{id}', 'destroy')->name('product.delete');
    // Route::get('/product_show/{id}','show')->name('product.show');
});
///////////////////////Product-Item//////////////////////////////////////////////////////
Route::controller(ProductItemController::class)->middleware(['auth'])->group(function () {
    Route::get('create_product_item/{id?}', 'create')->name('productitem.create');
    Route::post('create_product_item', 'store')->name('productitem.store');
    Route::get('/product_item', 'index')->name('productitem.index');
    Route::get('/product_item_edit/{id}', 'edit')->name('product_item.edit');
    Route::post('/product_item_edit/{id}', 'update')->name('product_item.update');
    Route::get('/product_item_delete/{id}', 'destroy')->name('product_item.delete');
    Route::get('/product_item_price/{id}', 'product_item_price')->name('productitem.price');
    Route::post('/product_item_price/{id}', 'update_price')->name('productitem.update_price');
});
///////////////////////Supplier//////////////////////////////////////////////////////
Route::controller(VendorController::class)->middleware(['auth'])->group(function () {
    Route::get('create_vendor', 'create')->name('vendor.create');
    Route::post('create_vendor', 'store')->name('create_vendor.store');
    Route::get('/vendors', 'index')->name('vendor.index');
    Route::get('/vendor_edit/{id}', 'edit')->name('vendor.edit');
    Route::post('/vendor_edit/{id}', 'update')->name('vendor.update');
    Route::get('/vendor_delete/{id}', 'destroy')->name('vendor.delete');
});
///////////////////////Purchase//////////////////////////////////////////////////////
Route::controller(PurchaseController::class)->middleware(['auth'])->group(function () {
    Route::get('create_purchase', 'create')->name('purchase.create');
    Route::post('create_purchase', 'store')->name('create_purchase.store');
    Route::get('/purchases', 'index')->name('purchase.index');
    Route::get('/purchase_edit/{id}', 'edit')->name('purchase.edit');
    Route::post('/purchase_edit/{id}', 'update')->name('purchase.update');
    Route::get('/purchase_delete/{id}', 'destroy')->name('purchase.delete');
    Route::get('/purchase_show/{id}', 'show')->name('purchase.show');
    Route::get('/purchase_print/{id}', 'print')->name('purchase.print');
    Route::get('/filter', 'filterpurchase')->name('filter');
    // Route::get('/download/{id}','downloadImage');
});
///////////////////////Stock Transfer//////////////////////////////////////////////////////
Route::controller(StockController::class)->middleware(['auth'])->group(function () {
    Route::get('add_stock', 'create')->name('stock.create');
    Route::post('add_stock', 'store')->name('add_stock.store');
    Route::get('transfer_stock', 'transferstock');
    Route::post('transfer_stock', 'transfer_stock')->name('transfer_stock.store');
    Route::get('/stock', 'index')->name('stock.index');
    Route::get('/stocktransferinvoice/{id}', 'stocktransfer_invoice')->name('stocktransferinvoice.show');
    Route::get('/stock_list', 'all_stock_list')->name('stock.list');
    Route::get('/stocktransferprint/{id}', 'stocktransfer_print')->name('stocktransfer.print');
    Route::get('/stock_edit/{id}', 'edit')->name('stock.edit');
    Route::post('/stock_edit/{id}', 'update')->name('stock.update');
    Route::get('/stock_delete/{id}', 'destroy')->name('stock.delete');
});

///////////////////////Warehouse//////////////////////////////////////////////////////
Route::controller(WareHouseController::class)->middleware(['auth'])->group(function () {
    Route::get('create_warehouse', 'create')->name('warehouse.create');
    Route::post('create_warehouse', 'store')->name('create_warehouse.store');
    Route::get('/warehouse', 'index')->name('warehouse.index');
    Route::get('/warehouse_edit/{id}', 'edit')->name('warehouse.edit');
    Route::post('/warehouse_edit/{id}', 'update')->name('warehouse.update');
    Route::get('/warehouse_delete/{id}', 'destroy')->name('warehouse.delete');
});
///////////////////////Expenses//////////////////////////////////////////////////
Route::controller(ExpenseController::class)->middleware(['auth'])->group(function () {
    Route::get('expense', 'create')->name('expense.create');
    Route::post('expense', 'store')->name('expense.store');
    Route::get('/view_expenses', 'index')->name('expenses.index');
    Route::post('/print_expenses', 'print_expenses')->name('expenses.print_expenses');
    //  Route::get('/expense_edit/{id}', 'edit')->name('expenses.edit');
    //  Route::post('/expense_edit/{id}', 'update')->name('expenses.update');
    //  Route::get('/expense_delete/{id}', 'destroy')->name('expenses.delete');
});
///////////////////////Expense Categories//////////////////////////////////////////////////
Route::controller(ExpenseCategoryController::class)->middleware(['auth'])->group(function () {
    Route::get('expensecategories', 'create')->name('expensecategories.create');
    Route::post('expensecategories', 'store')->name('expensecategories.store');
    Route::get('/expense_categories', 'index')->name('expensecategory.index');
    Route::get('/expense_categories_edit/{id}', 'edit')->name('expensecategories.edit');
    Route::post('/expense_categories_edit/{id}', 'update')->name('expensecategories.update');
    Route::get('/expense_categories_delete/{id}', 'destroy')->name('expensecategories.delete');
});

///////////////////////Sales//////////////////////////////////////////////////
Route::controller(SalesController::class)->middleware(['auth'])->group(function () {
    Route::get('sale', 'create')->name('sale.create');
    Route::post('sale', 'store')->name('sale.store');
    Route::get('/view_sales', 'index')->name('sale.index');
    Route::get('/sale_edit/{id}', 'edit')->name('sale.edit');
    Route::post('/sale_edit/{id}', 'update')->name('sale.update');
    Route::get('/sale_delete/{id}', 'destroy')->name('sale.delete');
    Route::get('/sale_show/{id}', 'show')->name('sale.show');
    Route::get('/sale_print/{id}', 'print')->name('sale.print');
});
///////////////////////ReportController//////////////////////////////////////////////////////
Route::controller(ReportController::class)->middleware(['auth'])->group(function () {
    Route::get('/stock_transfer_history', 'stock_transfer_history')->name('stock.stock_transfer_history');
    Route::get('/stock_price_detail', 'stock_price_detail')->name('stock.stock_price_detail');
    Route::get('/item_metrics', 'item_metrics_report')->name('reports.item_metrics');
    Route::get('/low_stock_items', 'low_stock_items')->name('reports.low_stock_items');
    Route::get('/out_stock_items', 'outof_stock_items')->name('reports.out_stock_items');
    Route::get('/expected_report', 'expected_report')->name('reports.expected_report');
});


///////////////////////Roles//////////////////////////////////////////////////////
// Route::controller(RoleController::class)->middleware(['auth'])->group(function () {
//     Route::get('create_role', 'create')->name('roles.create');
//     Route::post('create_role', 'store')->name('roles.store');
//     Route::get('/role', 'index')->name('roles.index');
//     Route::get('/role_edit/{id}', 'edit')->name('roles.edit');
//     Route::post('/role_edit/{id}', 'update')->name('roles.update');
//     Route::post('/role_show/{id}', 'show')->name('roles.show');
//     Route::get('/role_delete/{id}', 'destroy')->name('roles.destroy');
// });

// /////////////////////UserController//////////////////////////////////////////////////////
// Route::controller(UserController::class)->middleware(['auth'])->group(function () {
//     Route::get('create_user', 'create')->name('users.create');
//     Route::post('create_user', 'store')->name('users.store');
//     Route::get('/users', 'index')->name('users.index');
//     Route::get('/user_edit/{id}', 'edit')->name('users.edit');
//     Route::post('/user_edit/{id}', 'update')->name('users.update');
//     Route::get('/user_show/{id}', 'show')->name('users.show');
//     Route::get('/user_delete/{id}', 'destroy')->name('users.destroy');
//     Route::get('/user_profile/{id}', 'profile')->name('users.user_profile');
// });
// /////////////////////PermissionController//////////////////////////////////////////////////////
// Route::controller(PermissionController::class)->middleware(['auth'])->group(function () {
//     Route::get('create_per', 'create')->name('permissions.create');
//     Route::post('create_per', 'store')->name('permissions.store');
//     Route::get('/permissions', 'index')->name('permissions.index');
//     Route::get('/per_edit/{id}', 'edit')->name('permissions.edit');
//     Route::post('/per_edit/{id}', 'update')->name('permissions.update');
//     Route::get('/per_show/{id}', 'show')->name('permissions.show');
//     Route::get('/per_delete/{id}', 'destroy')->name('permissions.destroy');
// });

Route::group(['middleware' => ['auth', 'permission.check']] , function() {
    Route::get('create_per',[PermissionController::class,'create'])->name('permissions.create');
    Route::post('create_per', [PermissionController::class,'store'])->name('permissions.store');
    Route::get('/permissions', [PermissionController::class,'index'])->name('permissions.index');
    Route::get('/per_edit/{id}', [PermissionController::class,'edit'])->name('permissions.edit');
    Route::post('/per_edit/{id}', [PermissionController::class,'update'])->name('permissions.update');
    Route::get('/per_show/{id}', [PermissionController::class,'show'])->name('permissions.show');
    Route::get('/per_delete/{id}', [PermissionController::class,'destroy'])->name('permissions.destroy');

    Route::get('create_user', [UserController::class,'create'])->name('users.create');
    Route::post('create_user', [UserController::class,'store'])->name('users.store');
    Route::get('/users', [UserController::class,'index'])->name('users.index');
    Route::get('/user_edit/{id}', [UserController::class,'edit'])->name('users.edit');
    Route::post('/user_edit/{id}', [UserController::class,'update'])->name('users.update');
    Route::get('/user_show/{id}', [UserController::class,'show'])->name('users.show');
    Route::get('/user_delete/{id}', [UserController::class,'destroy'])->name('users.destroy');
    Route::get('/user_profile/{id}', [UserController::class,'profile'])->name('users.user_profile');

    Route::get('create_role', [RoleController::class,'create'])->name('roles.create');
    Route::post('create_role', [RoleController::class,'store'])->name('roles.store');
    Route::get('/role', [RoleController::class,'index'])->name('roles.index');
    Route::get('/role_edit/{id}', [RoleController::class,'edit'])->name('roles.edit');
    Route::post('/role_edit/{id}', [RoleController::class,'update'])->name('roles.update');
    Route::post('/role_show/{id}', [RoleController::class,'show'])->name('roles.show');
    Route::get('/role_delete/{id}', [RoleController::class,'destroy'])->name('roles.destroy');
});



