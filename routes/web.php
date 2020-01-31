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

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/', function () {
    return redirect('/home');
    //website route
   // return view('pages.dashboard');
});
Route::get('/home','ecoController@home');
Route::get('/papers','ecoController@papers');
Route::get('/stickers', 'ecoController@stickers');
Route::get('/flyers', 'ecoController@flyers');
Route::get('/posters', 'ecoController@posters');
Route::get('/calendars', 'ecoController@calendars');
Route::get('/books', 'ecoController@books');
Route::get('/mugs', 'ecoController@mugs');
Route::get('/manuals', 'ecoController@manuals');
Route::get('/invitations', 'ecoController@invitations');
Route::get('/forms', 'ecoController@forms');
Route::get('/brochures', 'ecoController@brochures');
Route::get('/booklets', 'ecoController@booklets');
Route::get('/receipts', 'ecoController@receipts');
Route::get('/callingcards', 'ecoController@callingcards');
Route::get('/planners', 'ecoController@planners');

Route::get('/orderlandingpage', 'ecoController@orderlandingpage');

Route::post('/insertQuatation', 'ecoController@addQuataion');



Auth::routes();
Route::get('/logout', '\App\Http\Controllers\Auth\LoginController@logout');

//dashboard

Route::get('/dashboard','ecocorp\DashboardController@vdashboard');
Route::get('/dashboard/year-sale/{year}','ecocorp\DashboardController@year_sale');
route::get('/dashboard/net-income','ecocorp\DashboardController@month_net_income');
Route::get('/dashboard/monthly-income','ecocorp\DashboardController@daily_income');
Route::get('/dashboard/today/sale','ecocorp\DashboardController@today_sale');

//Records
//Supplier
Route::get('/suppliers', 'ecocorp\Records\SupplierController@vsupplier');
Route::get('/supplier/profile/{id}','ecocorp\Records\SupplierController@supplier_profile');
Route::get('/my-product/{sid}','ecocorp\Records\SupplierController@my_products');



//add
Route::post('/add-supplier', 'ecocorp\Records\SupplierController@add_supplier');
Route::post('/update-supplier','ecocorp\Records\SupplierController@update_supplier');

Route::post('/user/new/users','ecocorp\RecordsController@new_user');


//remittance

Route::get('/Remittance/Categories','ecocorp\RecordsController@vremittance');

Route::post('/add-remittance','ecocorp\RecordsController@store_remittance');
Route::post('/update-remittance','ecocorp\RecordsController@patch_remittance');
//end

Route::get('/products','ecocorp\RecordsController@vproduct');
Route::get('/get-product/{id}','ecocorp\Records\ProductController@getproduct');
Route::post('/update-product','ecocorp\Records\ProductController@update_product');
Route::post('/add-product','ecocorp\Records\ProductController@add_product');

//vehicles
Route::get('/vehicles','ecocorp\Records\VehicleController@vVehicles');
Route::get('/vehicle/info/{vid}','ecocorp\Records\VehicleController@my_vehicle');

Route::post('/add-vehicle','ecocorp\Records\VehicleController@add_vehicle');
Route::post('/vehicle/update/info','ecocorp\Records\VehicleController@update_vehicle');

Route::get('/units','ecocorp\RecordsController@vunits');
Route::post('/add-units','ecocorp\RecordsController@add_units');
Route::post('/update-units','ecocorp\RecordsController@update_units');

//customer
Route::get('/customers','ecocorp\RecordsController@vcustomer');
Route::get('/customer/id/{id}','ecocorp\Records\CustomerController@customerinfo');
Route::post('/add-customer','ecocorp\Records\CustomerController@add_customer');
Route::post('/update-customer','ecocorp\Records\CustomerController@update_customer');

Route::get('/users','ecocorp\RecordsController@vusers');
// Route::get('/users/profile/{uid}','ecocorp\RecordsController@user_profile');
Route::post('/users/profile/myinfo','ecocorp\RecordsController@user_profile');

Route::post('/user/update/details','ecocorp\RecordsController@update_user');
Route::post('/user/update/password','ecocorp\RecordsController@update_password'); 
Route::post('/users/profile/image','ecocorp\RecordsController@upload_profile');

//warehouse
Route::get('/warehouse','ecocorp\Records\WarehouseController@vwarehouse');
Route::get('/warehouse/info/{wid}','ecocorp\Records\WarehouseController@mywarehouse_infos');
Route::get('/warehouse/products/{id}','ecocorp\Records\WarehouseController@products');
Route::get('/warehouse/stock/{pid}/{wid}','ecocorp\Records\WarehouseController@products_stock');
Route::get('/warehouse/mystock/{sid}','ecocorp\Records\WarehouseController@mystock');
Route::post('/add-warehouse','ecocorp\Records\WarehouseController@add_warehouse');
Route::post('/warehouse/update-info','ecocorp\Records\WarehouseController@update_warehouse');



//job orders

Route::get('/job-order/list','ecocorp\Jobs\JobOrderController@vjo_list');
Route::get('/job-order/category','ecocorp\Jobs\JobOrderController@vjo_cat');
Route::get('/job-order/byid/{id}','ecocorp\Jobs\JobOrderController@jo_byid');
Route::get('/job-order/bycat/{cid}','ecocorp\Jobs\JobOrderController@jo_bycat');
Route::get('/job-order/delete/{id}','ecocorp\Jobs\JobOrderController@jo_delete');
Route::get('/job-orders/payment','ecocorp\Jobs\JobOrderController@vjo_payment');
Route::get('/job-orders/print/jo/{jid}','ecocorp\Jobs\JobOrderController@print_jo');
Route::get('/job-order/history','ecocorp\Jobs\JobOrderController@jo_history');
Route::get('/job-order/balance/{jo_id}','ecocorp\Jobs\JobOrderController@job_order_balance');


Route::post('/job-order/new/jo','ecocorp\Jobs\JobOrderController@new_jo');
Route::post('/job-order/update/jo','ecocorp\Jobs\JobOrderController@update_jo');
Route::post('/jo/add/jo-category','ecocorp\Jobs\JobOrderController@new_jocat');
Route::post('/job-order/update/jo-category','ecocorp\Jobs\JobOrderController@update_jocat');
Route::post('/job-order/new/payment','ecocorp\Jobs\JobOrderController@new_payment');

//Transactions

Route::get('/customer/inquiries','ecocorp\Records\CustomerController@vcustomer_inquiries');

Route::get('/customer/get/inquiries/{id}','ecocorp\Records\CustomerController@get_inquiries');
Route::post('/customer/add/lead','ecocorp\Records\CustomerController@add_lead');
Route::post('/customer/lead/add/customer','ecocorp\Records\CustomerController@lead_customer');
Route::post('/customer/inquiry/delete','ecocorp\Records\CustomerController@inquiry_delete');


//expenses

Route::get('/Expenses/Categories','ecocorp\Transaction\ExpensesController@vexpenses_cat');
Route::get('/Expenses/Expenses','ecocorp\Transaction\ExpensesController@vexpenses');
Route::get('/expense/delete/{eid}','ecocorp\Transaction\ExpensesController@delete_expense');
Route::get('/expense/refno/{expid}','ecocorp\Transaction\ExpensesController@expense_refno');

Route::post('/expenses/add/expense-category','ecocorp\Transaction\ExpensesController@add_category');
Route::post('/expenses/update/expense-category','ecocorp\Transaction\ExpensesController@update_category');
Route::post('/expenses/new/expenses','ecocorp\Transaction\ExpensesController@new_expense');
Route::post('/expenses/update/expenses','ecocorp\Transaction\ExpensesController@update_expense');
//Shippment

Route::get('/pending-orders','ecocorp\Transaction\ShippmentController@vpending');
Route::get('/customer-orders','ecocorp\Transaction\ShippmentController@vcustomer_orders');
Route::get('/intransit-orders','ecocorp\Transaction\ShippmentController@vintransit_orders');
Route::get('/pickup-orders','ecocorp\Transaction\ShippmentController@vpickup_orders');
Route::get('/shipped-orders','ecocorp\Transaction\ShippmentController@vshipped_orders');

Route::get('/pickup/intransit-form/{drno}','ecocorp\Transaction\ShippmentController@intransit_pickup');
Route::get('/pickup/drform/{drno}','ecocorp\Transaction\ShippmentController@pickup_drform');


//cheque request

Route::get('/checque-request','ecocorp\Transaction\BankAccountController@vcheque_request');
Route::get('/cheque/voucher/{vid}','ecocorp\Transaction\BankAccountController@cheque_voucher');
Route::get('/cheque/details/{vid}','ecocorp\Transaction\BankAccountController@cheque_details');

Route::post('/new/chequest/request','ecocorp\Transaction\BankAccountController@store_cheque_request');
Route::post('/new/chequest/update','ecocorp\Transaction\BankAccountController@update_cheque_request');
Route::post('/approved/cheque/request','ecocorp\Transaction\BankAccountController@approved_voucher');
Route::post('/check/remove','ecocorp\Transaction\BankAccountController@voucher_remove');
//--trucking--

Route::get('/trucking/schedule','ecocorp\Transaction\TruckingController@vtrucking');
Route::get('/trucking/vehicle/cargo/{sid}','ecocorp\Transaction\TruckingController@vehicle_cargos');
Route::post('/trucking/new-sched','ecocorp\Transaction\TruckingController@new_schedule');

//------------customer Orders-----------

Route::get('/customer/my-order/{drno}','ecocorp\Transaction\ShippmentController@vmyorders_customer');
Route::get('/customer/order/view/{drno}','ecocorp\Transaction\ShippmentController@view_order');
Route::get('/customer/order/item/{id}','ecocorp\Transaction\ShippmentController@edit_myorder');
Route::get('/customer/print/dr-form/{drno}','ecocorp\Transaction\ShippmentController@print_drform');
Route::get('/customer/remove/order/{id}','ecocorp\Transaction\ShippmentController@remove_list');
Route::get('/pending/customer/orders/{dono}','ecocorp\Transaction\ShippmentController@fetch_pending');
Route::get('/intransit/form/{drno}','ecocorp\Transaction\ShippmentController@print_tripform');
Route::get('/customer-order/return/order/{drno}','ecocorp\Transaction\ShippmentController@order_return');
Route::get('/customer-order/return-order','ecocorp\Transaction\ShippmentController@vcustomer_return');

Route::post('/pending/order/approve','ecocorp\Transaction\ShippmentController@approve_pending');
Route::post('/customer-dr','ecocorp\Transaction\ShippmentController@customer_dr');
Route::post('/customer/dr/add-order','ecocorp\Transaction\ShippmentController@add_myorder');
Route::post('/customer/update-order','ecocorp\Transaction\ShippmentController@update_myorder');
Route::post('/customer/order/submit','ecocorp\Transaction\ShippmentController@submit_order');
Route::post('/customer/order/send','ecocorp\Transaction\ShippmentController@send_order');
Route::post('/pending/order/delete','ecocorp\Transaction\ShippmentController@delete_order');
Route::post('/customer/order/pickup','ecocorp\Transaction\ShippmentController@recieve_pickup');

//customer Payment here;;

Route::get('/transaction/payment','ecocorp\Transaction\CustomerPayment@vpayment');
Route::get('/po-order/payment','ecocorp\Transaction\PoPaymentController@vpo_payment');
Route::get('/customer/balance/{drno}','ecocorp\Transaction\CustomerPayment@customer_balance');
Route::get('/customer/fund-available/{drno}','ecocorp\Transaction\CustomerPayment@customer_afund');
Route::post('/transanction/add/payment','ecocorp\Transaction\CustomerPayment@order_payment');

Route::get('/payment/do-balance/{poid}','ecocorp\Transaction\PoPaymentController@po_balance');
Route::post('/po/transaction/payment','ecocorp\Transaction\PoPaymentController@purchase_payment');


//Customer Funds

Route::get('/transactions/customer-funds','ecocorp\Transaction\CustomerPayment@vcustomer_funds');

Route::get('/customer/transaction/{tid}','ecocorp\Transaction\CustomerPayment@transaction_list');
Route::get('/transaction/csfund/info/{tid}','ecocorp\Transaction\CustomerPayment@csfund_transaction');

Route::post('/transaction/new/customer-funds','ecocorp\Transaction\CustomerPayment@store_csfunds');
Route::post('/transaction/update/customer-funds','ecocorp\Transaction\CustomerPayment@update_csfunds');

//banking

Route::get('/bank-accounts','ecocorp\Transaction\BankAccountController@vbanks');
Route::get('/bank-transactions','ecocorp\Transaction\BankAccountController@vbank_transaction');
Route::get('/bank-transactions/report/{transdate}','ecocorp\Transaction\BankAccountController@transaction_summary');
Route::get('/banking/bank-transaction/{bid}','ecocorp\Transaction\BankAccountController@banking_transactions');

Route::get('/banking/my-bankaccount/{bank}','ecocorp\Transaction\BankAccountController@get_bankaccounts');
Route::get('/banking/bankaccount/info/{bid}','ecocorp\Transaction\BankAccountController@my_bankaccount');
Route::get('/bank/transaction-info/{tid}','ecocorp\Transaction\BankAccountController@transaction_info');

Route::post('/banking/add/bank-account','ecocorp\Transaction\BankAccountController@new_bankaccount');
Route::post('/banking/new-transaction','ecocorp\Transaction\BankAccountController@add_transaction');
Route::post('/banking/update-transaction','ecocorp\Transaction\BankAccountController@update_transaction');
Route::post('/transaction/remove/select','ecocorp\Transaction\BankAccountController@remove_transaction');
//Reports

//inventory

Route::get('/stock-on-hand','ecocorp\Reports\InventoryController@vstock_onhand');
Route::get('/warehouse-stock','ecocorp\Reports\InventoryController@vstock_warehouse');
Route::get('/warehouse/all-stock/{wid}','ecocorp\Reports\InventoryController@warehouse_stocks');
Route::get('/stock/product-total','ecocorp\Reports\InventoryController@stock_total');

Route::get('/inventory/do-report','ecocorp\Reports\InventoryController@do_index');
Route::get('/inventory/do/{from}/{to}','ecocorp\Reports\InventoryController@do_reports');


//wala pa to
Route::get('/warehouse-audit','ecocorp\Reports\InventoryController@vwarehouse_audit');

//Financial Reports

Route::get('/Banking','ecocorp\Reports\FinancialController@vbanking');

Route::get('/banking/transactions/{from}/{to}','ecocorp\Reports\FinancialController@transactions');
Route::get('/banking/transactions-summary/{from}/{to}','ecocorp\Reports\FinancialController@transaction_summary');
Route::get('/Sales-report','ecocorp\Reports\FinancialController@vsales');

//sales report routes

Route::get('/report/income-sale/{from}/{to}','ecocorp\Reports\FinancialController@income_sale');
Route::get('/report/my-expenses/{from}/{to}','ecocorp\Reports\FinancialController@my_expenses');
Route::get('/report/my-netincome/{from}/{to}','ecocorp\Reports\FinancialController@my_netincome');

//Stocks
Route::get('/product/available/{pid}','ecocorp\Inventory\StockController@allstock_product');
Route::get('/product/all-available','ecocorp\Inventory\StockController@available_stock');

//Warehouse
//transfer
Route::get('/transfer-stock','ecocorp\Inventory\StockController@vtransfer_stock');
Route::get('/transfer/ticket/{id}','ecocorp\Inventory\StockController@ticket_info');

Route::post('/transfer/mystock','ecocorp\Inventory\StockController@transfer_stock');


//Purchase Order routes;
Route::get('/delivery-order','ecocorp\Inventory\StockController@vpurchase_order');
Route::get('/delivery-order-details/{id}','ecocorp\Inventory\StockController@po_details');
Route::get('/delivery-order/edit/{id}','ecocorp\Inventory\StockController@vpo_edit');
Route::get('/getpo/product/{id}','ecocorp\Inventory\StockController@get_poitem');
Route::get('/delete/po-item/{id}','ecocorp\Inventory\StockController@del_item');

Route::post('/new-purchase-order','ecocorp\Inventory\StockController@add_po');
Route::post('/add-extra-order','ecocorp\Inventory\StockController@add_extrapo');
Route::post('/update-po','ecocorp\Inventory\StockController@update_po');


//Recieve Order
Route::get('/recieve-order','ecocorp\Inventory\StockController@vrecieve_order');
Route::get('/recieve/delivery-order/{id}','ecocorp\Inventory\StockController@recieve_purchase_order');


Route::post('/add-stock','ecocorp\Inventory\StockController@add_stock');


Route::get('/history/{table}', 'ecocorp\RecordsController@history');

//notif

Route::get('/notif/order/post-dated','ecocorp\Transaction\CustomerPayment@posted_dated_order');
Route::get('/notif/payment/post-dated','ecocorp\Transaction\PoPaymentController@posted_dated_payment');
Route::get('/notif/joborder/post-dated','ecocorp\Jobs\JobOrderController@posted_dated_payment');
Route::get('/notif/cheque-issue/post-dated','ecocorp\Transaction\BankAccountController@posted_dated_payment');

//return 

Route::get('/customer/orderlist/{drno}','ecocorp\Transaction\ShippmentController@fetch_csorders');
Route::get('/returns/fetch-items/{id}','ecocorp\Transaction\ShippmentController@fetch_returnitems');

Route::post('/customer/product-return','ecocorp\Transaction\ShippmentController@store_return');
Route::post('/resolve/customer-return','ecocorp\Transaction\ShippmentController@resolve_return');
//cancel order
//view

Route::get('/customer-order/cancel-order','ecocorp\Transaction\ShippmentController@cancel_myorder');
//customer
Route::post('/cancel/customer-order','ecocorp\Transaction\ShippmentController@cancel_csorder');

//supplier

Route::get('/sendback/product-order','ecocorp\Records\ProductController@vsend_back');
Route::get('/supplier/recieved-return/{rtnid}','ecocorp\Records\ProductController@recieve_returns');
Route::post('/supplier/sendback-product','ecocorp\Records\ProductController@backtosupplier');
Route::post('/supplier/return-recieve','ecocorp\Records\ProductController@recieve_myreturn');


//permissions;;;

Route::get('/fetch/user/permission/{uid}','ecocorp\RecordsController@fetch_userpermission');
Route::post('/user/assigned/permission','ecocorp\RecordsController@assigned_permission');
Route::post('/user/revoke/permission','ecocorp\RecordsController@revoke_permission');



//construction

Route::get('/Materials','ecocorp\Construction\EcoConsMaterialsController@vmaterials');
Route::get('/Materials/Suppliers','ecocorp\Construction\EcoConsMaterialsController@vmat_suppliers');
Route::get('/construction/recieve-materials','ecocorp\Construction\EcoConsMaterialsController@vmaterials_recieve');
Route::get('/construction-materials','ecocorp\Construction\EcoConsMaterialsController@materials_onhand');
Route::get('/materials/cs-order','ecocorp\Construction\EcoConsMaterialsController@vmat_order');

Route::get('/material/info/{mid}','ecocorp\Construction\EcoConsMaterialsController@material_info');
Route::get('/supplier/material-list/{sid}','ecocorp\Construction\EcoConsMaterialsController@list_materials_supplier');
Route::get('/recieved/materials-data/{rid}','ecocorp\Construction\EcoConsMaterialsController@print_recieve_data');
Route::get('/material/stock-list/{mid}','ecocorp\Construction\EcoConsMaterialsController@stock_list_mat');
Route::get('/material/stock-info/{msid}','ecocorp\Construction\EcoConsMaterialsController@stock_info');
Route::get('/list/material-order/{osid}','ecocorp\Construction\EcoConsMaterialsController@myorder_list');
Route::get('/remove/from-order/{mid}','ecocorp\Construction\EcoConsMaterialsController@rmv_order');
Route::get('/material-order/details/{mid}','ecocorp\Construction\EcoConsMaterialsController@my_material_order');

Route::get('/material/print-delinfo/{did}','ecocorp\Construction\EcoConsMaterialsController@vprint_delivery');


Route::post('/materials/store/supplier','ecocorp\Construction\EcoConsMaterialsController@store_mat_supplier');
Route::post('/new/construction/material','ecocorp\Construction\EcoConsMaterialsController@store_material');
Route::post('/update/material','ecocorp\Construction\EcoConsMaterialsController@update_material');
Route::post('/store/recieve/materials','ecocorp\Construction\EcoConsMaterialsController@store_recived');
Route::post('/new/material-order','ecocorp\Construction\EcoConsMaterialsController@store_order');
Route::post('/add/material/to-order','ecocorp\Construction\EcoConsMaterialsController@add_to_order');
Route::post('/mat/order-info/update','ecocorp\Construction\EcoConsMaterialsController@update_order_info');
Route::post('/send/mo-deliver','ecocorp\Construction\EcoConsMaterialsController@mat_deliver');


//Eco Branches Stores.. 

Route::get('/Branch/Store','ecocorp\Branch\StoreController@vstore_records');
Route::get('/Branch/Remittance','ecocorp\Branch\StoreController@vremittance');


Route::get('/Branch/store-info/{sid}','ecocorp\Branch\StoreController@store_infos');
Route::post('/Branch/new/store','ecocorp\Branch\StoreController@new_stores');
Route::post('/Branch/update/store','ecocorp\Branch\StoreController@update_store');

//remittance
Route::get('/Branch/Remittance-info/{rid}','ecocorp\Branch\StoreController@remittance_info');
Route::post('/Branch/New/Remittance','ecocorp\Branch\StoreController@new_remittance');
Route::post('/Branch/update/remittance','ecocorp\Branch\StoreController@update_remittance');

//report

Route::get('/remittance-report','ecocorp\Reports\RemittanceReportController@vreport');
Route::get('/report/remittance-sum/{from}/{to}','ecocorp\Reports\RemittanceReportController@remit_sum');

//watchlist routes

Route::get('/watchlist/products','ecocorp\Inventory\WatchlistController@watchlist');

Route::post('/watchlist/store/product','ecocorp\Inventory\WatchlistController@add_watchlist');
Route::post('/watchlist/remove/product','ecocorp\Inventory\WatchlistController@remove_towatlist');


Route::get('/payments/order-sum/{drno}','ecocorp\Reports\FinancialController@customer_drpayments');
Route::get('/payments/po-sum/{po_id}','ecocorp\Reports\FinancialController@supplier_popayments');
Route::get('/order-payment/details/{transid}','ecocorp\Reports\FinancialController@drpayment_details');
Route::get('/jo/details/{jid}','ecocorp\Jobs\JobOrderController@jopayment_details');
Route::get('/jo/jopayment/summary/{jo_id}','ecocorp\Jobs\JobOrderController@jopayment_summary');

//collection report

Route::get('/collection-report','ecocorp\Reports\FinancialController@vcollection_report');

Route::get('/total-collection/{from}/{to}','ecocorp\Reports\FinancialController@total_collection');
Route::get('/jo-collection/{from}/{to}','ecocorp\Reports\FinancialController@total_jocollection');

//expenses report

Route::get('/expenses-report','ecocorp\Reports\FinancialController@vexpenses_report');
Route::get('/report/expenses-list/{from}/{to}','ecocorp\Reports\FinancialController@expenses_list');
Route::get('/expenses-category','ecocorp\Reports\FinancialController@vexpenses_catreport');
Route::get('/report/expenses-cat/{from}/{to}/{catid}','ecocorp\Reports\FinancialController@expenses_category');
Route::get('/report/expenses-joborder/{from}/{to}','ecocorp\Reports\FinancialController@jocat_expenses');

//sales order report

Route::get('/salesorder-report','ecocorp\Reports\SalesOrderController@index');
Route::get('/salesorder/{from}/{to}','ecocorp\Reports\SalesOrderController@so_report');

Route::get('/salesorder-joreport','ecocorp\Reports\SalesOrderController@jo_index');
Route::get('/joreport/{from}/{to}','ecocorp\Reports\SalesOrderController@jo_report');

Route::get('/recievables/{item}','ecocorp\Reports\SalesOrderController@recievables');
Route::get('/recievable/so-order/{from}/{to}','ecocorp\Reports\SalesOrderController@so_recievables');
Route::get('/recievable/jo-order/{from}/{to}','ecocorp\Reports\SalesOrderController@jo_recievables');
//manual correction for admin only

Route::get('/stock-records','ecocorp\Inventory\StockInventory@index');
Route::post('/inventory/stock/update','ecocorp\Inventory\StockInventory@update_stock');