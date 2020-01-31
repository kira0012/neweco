        <!-- Left Sidebar -->


        <aside id="leftsidebar" class="sidebar n-bar ">
            <!-- Menu -->
            <div class="menu m-cont bg-sidebar">
                <ul class="list">
                    <li class="header">-- Main</li>
                    <li class="dashboard active">
                        <a href="/dashboard"><i data-feather="home"></i>
                            <span>Dashbard</span>
                        </a>
                    </li>
                    @if(Gate::check('Inventory') || Gate::check('Reports'))
                        <li class="nav-purchase-order"><a href="/delivery-order"><i data-feather="shopping-cart"></i><span> Delivery Order</span></a></li>
                    @endif
                    @if(Gate::check('Customers') || Gate::check('Reports'))
                        <li class="nav-customer-inquiries"><a href="/customer/inquiries"><i data-feather="cast"></i><span> Customer Inquiries</span></a></li>
                   
                        <li class="nav-ship-orders"><a href="#" onClick="return false;" class="menu-toggle"><i data-feather="shopping-bag"></i><span>Orders</span></a>
                        <ul class="ml-menu">
                                {{-- <li class="nav-pending-orders"><a href="/pending-orders"><i data-feather="shopping-cart"></i><span>Pending Orders</span></a></li> --}}
                                <li class="nav-customer-orders"><a href="/customer-orders"><i data-feather="shopping-cart"></i><span>Customer Orders</span></a></li>
                                <li class="nav-intransit-orders"><a href="/intransit-orders"><i data-feather="box"></i><span>Intransit Orders</span></a></li>
                                <li class="nav-pickup-orders"><a href="/pickup-orders"><i data-feather="box"></i><span>Pick Up Orders</span></a></li>
                                <li class="nav-shipped-orders"><a href="/shipped-orders"><i data-feather="box"></i><span>Shiped Orders</span></a></li>    
                                <li class="nav-shipped-return"><a href="/customer-order/return-order"><i data-feather="shopping-bag"></i><span>Return Orders</span></a></li>    
                                <li class="nav-shipped-cancel"><a href="/customer-order/cancel-order"><i data-feather="minus-circle"></i><span>Cancel Orders</span></a></li>          
                        </ul>
                    </li>  
                    @endif  
                    
                    @if(Gate::check('Payments') || Gate::check('Reports'))
                    <li class="nav-payment"><a href="#" onClick="return false;" class="menu-toggle"><i class="material-icons">payment</i><span>&nbsp;Payment</span></a>
                        <ul class="ml-menu">
                            <li class="nav-order-po-payment"><a href="/po-order/payment"><i i data-feather="credit-card"></i><span>Delivery Order Payment</span></a></li>
                            <li class="nav-order-payment"><a href="/transaction/payment"><i i data-feather="credit-card"></i><span>Customer Order Payment</span></a></li>
                            <li class="nav-jos-payment"><a href="/job-orders/payment"><i i data-feather="credit-card"></i><span>Job Order Payment</span></a></li>
                       
                        </ul>
                    </li>
                   @endif
                   @if(Gate::check('Customers') || Gate::check('Reports'))
                    <li>
                        <a href="#" onClick="return false;" class="menu-toggle nav-job">
                            <i class="material-icons">business</i>
                            <span>&nbsp; Job Orders</span>
                        </a> 
                        <ul class="ml-menu">
                            <li class="nav-jo-list"><a href="/job-order/list"><i class="material-icons">format_list_bulleted</i><span>List of Job Orders</span></a></li>
                            <li class="nav-jo-cat"><a href="/job-order/category"><i class="material-icons">directions_run</i><span> Job Order Category</span></a></li>
                            <li class="nav-jo-history"><a href="/job-order/history"><i class="material-icons">layers</i><span>History</span></a></li>        
                        </ul>
                    </li>
                    @endif

                 

                @if(Gate::check('Payments') || Gate::check('Reports'))
                   <li class="nav-transaction">
                        <a href="#" onClick="return false;" class="menu-toggle nav-transaction">
                            <i data-feather="activity"></i>
                            <span>Transaction</span>
                        </a>
                        <ul class="ml-menu">
                            @can('Payments')

                                <li class="nav-banking"><a href="#" onClick="return false;" class="menu-toggle"><i class="material-icons">account_balance</i><span>Banking</span></a>
                                    <ul class="ml-menu">
                                        <li class="nav-bankaccounts"><a href="/bank-accounts"><i i data-feather="credit-card"></i><span>Bank Accounts</span></a></li>
                                        <li class="nav-banktransactions"><a href="/bank-transactions"><i class="material-icons">touch_app</i><span>Bank Transaction</span></a></li>                           
                                    </ul>
                                </li>

                                <li class="nav-remittance"><a href="#" onClick="return false;" class="menu-toggle"><i class="material-icons">account_balance</i><span>Branch Remittance</span></a>
                                    <ul class="ml-menu">
                                        {{-- <li class="nav-remittance-branch"><a href="/#"><i i data-feather="credit-card"></i><span>Branch Remittance</span></a></li> --}}
                                        <li class="nav-remittance-list"><a href="/Branch/Remittance"><i class="material-icons">touch_app</i><span>Branch Remittance</span></a></li>                           
                                    </ul>
                                </li>

                                <li class="nav-trans-customer"><a href="#" onClick="return false;" class="menu-toggle"><i class="material-icons">contacts</i><span>Customers</span></a>
                                    <ul class="ml-menu">
                                        <li class="nav-trans-customer-funds"><a href="/transactions/customer-funds"><i i data-feather="credit-card"></i><span>Customer Funds</span></a></li>
                                        {{-- <li class="nav-banktransactions"><a href="/#"><i class="material-icons">touch_app</i><span>Bank Transaction</span></a></li>                            --}}
                                    </ul>
                                </li>
                                @endcan

                                <li class="nav-cheque"><a href="#" onClick="return false;" class="menu-toggle"><i class="material-icons">account_balance</i><span>Cheque Request</span></a>
                                    <ul class="ml-menu">
                                        <li class="nav-cheque-request"><a href="/checque-request"><i i data-feather="credit-card"></i><span>Request</span></a></li>
                                        {{-- <li class="nav-banktransactions"><a href="/bank-transactions"><i class="material-icons">touch_app</i><span>Bank Transaction</span></a></li>                            --}}
                                    </ul>
                                </li>
                                @can('Payments')
                                <li class="nav-expenses"><a href="#" onClick="return false;" class="menu-toggle"><i class="material-icons">developer_board</i><span>Expenses</span></a>
                                    <ul class="ml-menu">
                                        <li class="nav-expenselist"><a href="/Expenses/Expenses"><i i class="material-icons">devices_other</i><span>Expenses</span></a></li>
                                        <li class="nav-expensecat"><a href="/Expenses/Categories"><i class="material-icons">touch_app</i><span>Expenses Categories</span></a></li>                           
                                    </ul>
                                </li>

                                @endcan               
                        </ul>
                    </li>
                    @endif
                    
                    @if(Gate::check('Inventory') || Gate::check('Construction') || Gate::check('Reports'))
                    <li><a href="#" onClick="return false;" class="menu-toggle nav-shippment"><i data-feather="truck"></i><span>Shipment</span></a>
                        <ul class="ml-menu">
                                @if(Gate::check('Inventory') || Gate::check('Reports'))
                                <li class="nav-ship-trucking"><a href="#" onClick="return false;" class="menu-toggle"><i class="material-icons">local_shipping</i><span>Trucking</span></a>
                                    <ul class="ml-menu">
                                        <li class="nav-trucking-schedule"><a href="/trucking/schedule"><i class="material-icons">schedule</i><span>Trip Schedule</span></a></li>                           
                                    </ul>
                                </li>
                                @endif
                                @if(Gate::check('Construction') || Gate::check('Reports'))
                                <li class="nav-ship-materials"><a href="#" onClick="return false;" class="menu-toggle"><i class="material-icons">local_shipping</i><span>Material Order</span></a>
                                    <ul class="ml-menu">
                                        <li class="nav-mat-csorder"><a href="/materials/cs-order"><i class="material-icons">view_day</i><span>Orders</span></a></li>                           
                                    </ul>
                                </li>
                                @endif
                                @if(Gate::check('Inventory') || Gate::check('Reports'))
                                <li class="nav-pickup-orders"><a href="/pickup-orders"><i data-feather="box"></i><span>Pick Up Orders</span></a></li>
                                <li class="nav-shipped-orders"><a href="/shipped-orders"><i data-feather="box"></i><span>Shiped Orders</span></a></li>  
                                @endif
                            </ul>
                    </li> 

                   
                    <li>
                        <a href="#" onClick="return false;" class="menu-toggle nav-inventory">
                            <i data-feather="archive"></i>
                            <span>Inventory</span>
                        </a> 
                        <ul class="ml-menu">
                                @if(Gate::check('Inventory') || Gate::check('Reports'))
                                <li class="nav-warehouse-inventory"><a href="#" onClick="return false;" class="menu-toggle"><i data-feather="truck"></i><span>Warehouse Inventory</span></a>
                                    <ul class="ml-menu">
                                            <li class="nav-transfer-stock"><a href="/transfer-stock">Transfer Stock</a></li>
                                            <li class="nav-send-back"><a href="/sendback/product-order">Return to Supplier</a></li>
                                            <li class="nav-recieve-order" ><a href="/recieve-order">Receive Order</a></li>
                                    </ul>
                                </li>
                                @endif
                                {{-- //Construction --}}
                                @if(Gate::check('Construction') || Gate::check('Reports'))
                                <li class="nav-warehouse-construction"><a href="#" onClick="return false;" class="menu-toggle nav-warehouse-construction"><i data-feather="crop"></i><span>Construction Materials</span></a>
                                    <ul class="ml-menu">
                                            <li class="nav-construction-recieve"><a href="/construction/recieve-materials">Recieve Stock</a></li>
                                            <li class="nav-construction-materials"><a href="/construction-materials">Materials On Hand</a></li>
                                           
                                    </ul>
                                </li>
                                @endif
                        </ul>
                    </li>
                    @endif

                    <li class="nav-records">
                        <a href="#" onClick="return false;" class="menu-toggle nav-records">
                            <i data-feather="book-open"></i>
                                <span>Records</span>
                        </a>
                            <ul class="ml-menu">
                                
                                @if(Gate::check('Customers') || Gate::check('Reports'))
                                    <li class="nav-r-customer"><a href="/customers">Customer</a></li>
                                @endif
                                @role('admin')
                                <li class="nav-r-users"><a href="/users">Users</a></li>
                                <li class="nav-r-st"><a href="/stock-records">Stock Records</a></li>
                                @endrole
                                @if(Gate::check('Inventory') || Gate::check('Reports'))
                                <li class="nav-records-inventory"><a href="#" onClick="return false;" class="menu-toggle nav-records-inventory"><i data-feather="crop"></i><span>Inventory Records</span></a>
                                    <ul class="ml-menu">
                                        <li class="nav-r-products"><a href="/products">Products</a></li>
                                        <li class="nav-r-suppliers"><a href="/suppliers">Suppliers</a> </li>
                                        <li class="nav-r-vehicles"><a href="/vehicles">Vehicles</a></li>
                                        <li class="nav-r-warehouse"><a href="/warehouse">Warehouse</a></li>
                                        <li class="nav-r-units"><a href="/units">Units</a></li>     
                                    </ul>
                                </li>
                                   



                                @endif

                                {{-- //Construction --}}

                                @can('Construction')
                                <li class="nav-records-construction"><a href="#" onClick="return false;" class="menu-toggle nav-records-material"><i data-feather="crop"></i><span>Material Records</span></a>
                                    <ul class="ml-menu">
                                        <li class="nav-cons-mat"><a href="/Materials">Materials</a></li>
                                        <li class="nav-cons-supplier"><a href="/Materials/Suppliers">Materials Suppliers</a></li>
                                    </ul>
                                </li>
                                @endcan
                                @can('Payments')
                                <li class="nav-records-financial"><a href="#" onClick="return false;" class="menu-toggle nav-records-financial"><i data-feather="crop"></i><span>Remittance Records</span></a>
                                    <ul class="ml-menu">
                                        <li class="nav-remittance-cat"><a href="/Remittance/Categories">Remittance Categories</a></li>
                                        <li class="nav-branch-store"><a href="/Branch/Store">Eco Stores</a></li>
                                    </ul>
                                </li>
                                @endcan
                                   
                            </ul>
                    </li>
                    {{-- @can('Reports') --}}
                    @if(Gate::check('Reports') || Gate::check('Inventory') || Gate::check('Payments'))
                    <li>
                            <a href="#" onClick="return false;" class="menu-toggle nav-reports">
                                <i data-feather="file"></i>
                                    <span>Reports</span>
                            </a>
                                <ul class="ml-menu">
                                        @if(Gate::check('Reports') || Gate::check('Inventory'))
                                        <li class=""> <a href="#" onClick="return false;" class="menu-toggle nav-inventory-reports">
                                                <i data-feather="box"></i><span>Inventory Reports</span></a>
                                                     <ul class="ml-menu">
                                                           
                                                        <li class="nav-inventory-stockonhand"><a href="/stock-on-hand">Stock On Hand</a></li>
                                                        <li class="nav-inventory-warehousestock"><a href="/warehouse-stock">Warehouse Stock</a></li>
                                                        <li class="nav-inventory-doreport"><a href="/inventory/do-report">DO Report</a></li>
                                                       
                                                        {{-- <li><a href="/warehouse-audit">Warehouse Audit</a></li>  --}}
                                                    </ul>
                                        </li>
                                        @endif
                                        @if(Gate::check('Reports') || Gate::check('Payments') || Gate::check('Inventory'))
                                        <li> <a href="#" onClick="return false;" class="menu-toggle nav-financial-reports">
                                                <i data-feather="credit-card"></i><span>Financial Report</span></a>
                                                     <ul class="ml-menu">
                                                        <li class="nav-sales-report"><a href="/Sales-report">Sales Report</a></li>
                                                        <li class="nav-expenses-report"><a href="/expenses-report">Expenses Report</a></li>
                                                        <li class="nav-expenses-catreport"><a href="/expenses-category">Expenses Category Report</a></li>
                                                        @if(Gate::check('Reports') || Gate::check('Payments'))
                                                        <li class="nav-banking-report"><a href="/Banking">Banking Report</a></li>   
                                                        <li class="nav-collection-report"><a href="/collection-report">Collection Report</a></li>
                                                        @endif
                                                    </ul>
                                        </li>
                                        @endif

                                        @if (Gate::check('Reports') || Gate::check('Payments'))
                                        <li> <a href="#" onClick="return false;" class="menu-toggle nav-remit-reports">
                                                <i data-feather="credit-card"></i><span>Remittance Report</span></a>
                                                     <ul class="ml-menu">
                                                        <li class="nav-branch-sale"><a href="/remittance-report">Branch Remittances</a></li>    
                                                    </ul>
                                        </li>
                                        @endif

                                        @if (Gate::check('Reports') || Gate::check('Payments'))
                                        <li> <a href="#" onClick="return false;" class="menu-toggle nav-so-reports">
                                                <i data-feather="credit-card"></i><span>Sales Order Report</span></a>
                                                     <ul class="ml-menu">
                                                        <li class="nav-so-report"><a href="/salesorder-report">Customer Order Report</a></li>   
                                                        <li class="nav-so-joreport"><a href="/salesorder-joreport">Job Order Report</a></li>    
                                                        <li class="nav-so-sorecievables"><a href="/recievables/salesorder">SO Recievables Report</a></li>
                                                        <li class="nav-so-jorecievables"><a href="/recievables/joborder">JO Recievables Report</a></li>
                                                    </ul>
                                        </li>
                                        @endif


                                </ul>
                        </li>
                        {{-- @endcan --}}
                        @endif
                      
                </ul>
            </div>
            <!-- #Menu -->
        </aside>
        <!-- #END# Left Sidebar -->
