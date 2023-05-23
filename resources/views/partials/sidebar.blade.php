<div class="sidebar-wrapper" data-simplebar="true">
    <div class="sidebar-header">
        <div>
            <!-- <img src="{{-- asset(MyApp::ASSET_IMG.'logo-icon.png') --}}" class="logo-icon" alt="logo icon"> -->
        </div>
        <div>
            @if(Session::get('acc_id') != null)
                <h4 class="logo-text">{{get_account_details(Session::get('acc_id'))->acc_title}}</h4>
            @endif
        </div>
        <div class="toggle-icon ms-auto"><i class='bx bx-arrow-to-left'></i>
        </div>
    </div>
    <!--navigation-->
    <ul class="metismenu" id="menu">
        <li>
       
            <a href="{{ URL::to('/dashboard',base64_encode(Session::get('acc_id')) ) }}">
                <div class="parent-icon"><i class='bx bx-home-circle'></i>
                </div>
                <div class="menu-title">Dashboard</div>
            </a>
        </li>
        @if(auth()->user()->can('SidebarAccount'))
        @if( Session::get('acc_id') != null  && Session::get('acc_id') == 1)
        <li>
            <a href="javascript:;" class="has-arrow">
                <div class="parent-icon"><i class="bx bx-bookmark-heart"></i>
                </div>
                <div class="menu-title">Amazon Accounts</div>
            </a>
            <ul>
                <!-- <li> <a href="{{URL::to('/create_account')}}"><i class="bx bx-right-arrow-alt"></i>Add Account</a>
                </li> -->
                <li> <a href="{{URL::to('/account')}}"><i class="bx bx-right-arrow-alt"></i>View Accounts</a>
                </li>
            </ul>
            <!-- <ul>
                <li> <a href="{{-- URL::to('/listingowner') --}}"><i class="bx bx-right-arrow-alt"></i>View Listing Owners</a>
                </li>
            </ul> -->
        </li>
        @endif
        @endif

        @if(auth()->user()->can('SidebarBrand'))
        <li>
            <a href="javascript:;" class="has-arrow">
                <div class="parent-icon"><i class="bx bx-repeat"></i>
                </div>
                <div class="menu-title">Brands</div>
            </a>
            <ul>
                <!-- <li> <a href="{{URL::to('/create_brand')}}"><i class="bx bx-right-arrow-alt"></i>Add Brand</a>
                </li> -->
                <li> <a href="{{URL::to('/brand')}}"><i class="bx bx-right-arrow-alt"></i>View Brands</a>
                </li>
            </ul>
        </li>
        @endif

        @if(auth()->user()->can('SidebarCategories'))
        <li>
            <a href="javascript:;" class="has-arrow">
                <div class="parent-icon"><i class="lni lni-joomla"></i>
                </div>
                <div class="menu-title">Categories</div>
            </a>
            <ul>
                <!-- <li> <a href="{{URL::to('/category/create')}}"><i class="bx bx-right-arrow-alt"></i>Add Category</a>
                </li> -->
                <li> <a href="{{URL::to('/category')}}"><i class="bx bx-right-arrow-alt"></i>View Categories</a>
                </li>
            </ul>
        </li>
        @endif

        @if(auth()->user()->can('SidebarProducts'))
        <li>
            <a href="javascript:;" class="has-arrow">
                <div class="parent-icon"><i class='bx bx-menu'></i>
                </div>
                <div class="menu-title">Products</div>
            </a>
            <ul>
                <li> <a href="{{URL::to('/products')}}"><i class="bx bx-right-arrow-alt"></i>Product
                        Profile</a>
                </li>
                <li> <a href="{{URL::to('/variant')}}"><i class="bx bx-right-arrow-alt"></i>Variations
                        Profile</a>
                </li>
                <li> <a href="{{URL::to('/books')}}"><i class="bx bx-right-arrow-alt"></i>Items</a>
                </li>
            </ul>
        </li>
        @endif

        @if(auth()->user()->can('SidebarSuppliers'))
        <li>
            <a href="javascript:;" class="has-arrow">
                <div class="parent-icon"><i class='bx bx-cookie'></i>
                </div>
                <div class="menu-title">Suppliers</div>
            </a>
            <ul>
                <!-- <li> <a href="{{URL::to('/create_vendor')}}"><i class="bx bx-right-arrow-alt"></i>Add Supplier</a>
            </li> -->
                <li> <a href="{{URL::to('/vendors')}}"><i class="bx bx-right-arrow-alt"></i>View Suppliers</a>
                </li>
            </ul>
        </li>
        @endif

        @if(auth()->user()->can('SidebarPurchases'))
        <li>
            <a href="javascript:;" class="has-arrow">
                <div class="parent-icon"><i class='bx bx-cart'></i>
                </div>
                <div class="menu-title">Purchases</div>
            </a>
            <ul>
                <li> <a href="{{URL::to('/create_purchase')}}"><i class="bx bx-right-arrow-alt"></i>Add Purchase Order</a>
                </li>
                <li> <a href="{{URL::to('/purchases')}}"><i class="bx bx-right-arrow-alt"></i>View Purchase Orders</a>
                </li>
            </ul>
        </li>
        @endif

        @if(auth()->user()->can('SidebarWarehouse'))
        <li>
            <a href="javascript:;" class="has-arrow">
                <div class="parent-icon"><i class='bx bx-store-alt'></i>
                </div>
                <div class="menu-title">Warehouse</div>
            </a>
            <ul>
                <!-- <li> <a href="{{URL::to('/create_warehouse')}}"><i class="bx bx-right-arrow-alt"></i>Add Warehouse</a>
            </li> -->
                <li> <a href="{{URL::to('/warehouse')}}"><i class="bx bx-right-arrow-alt"></i>View warehouse</a>
                </li>
            </ul>
        </li>
        @endif

        @if(auth()->user()->can('SidebarStockAddTransfer'))
        <li>
            <a href="javascript:;" class="has-arrow">
                <div class="parent-icon"><i class='bx bx-grid-alt'></i>
                </div>
                <div class="menu-title">Stock Add/Transfer</div>
            </a>
            <ul>
                <li> <a href="{{URL::to('/add_stock')}}"><i class="bx bx-right-arrow-alt"></i>Add Stock</a>
                </li>
                <li> <a href="{{URL::to('/transfer_stock')}}"><i class="bx bx-right-arrow-alt"></i>Transfer Stock</a>
                </li>
                <li> <a href="{{URL::to('/stock')}}"><i class="bx bx-right-arrow-alt"></i>Transfer Vouchers</a>
                </li>
                <li> <a href="{{URL::to('/stock_list')}}"><i class="bx bx-right-arrow-alt"></i>View Stock</a>
                </li>
            </ul>
        </li>
        @endif

        @if(auth()->user()->can('SidebarExpenses'))
        <li>
            <a href="javascript:;" class="has-arrow">
                <div class="parent-icon"><i class='lni lni-pencil-alt'></i>
                </div>
                <div class="menu-title">Expenses</div>
            </a>
            <ul>
                <li> <a href="{{URL::to('/view_expenses')}}"><i class="bx bx-right-arrow-alt"></i>View Expenses</a>
                </li>
                <li> <a href="{{URL::to('/expense_categories')}}"><i class="bx bx-right-arrow-alt"></i>Expense
                        Categories</a>
                </li>
            </ul>
        </li>
        @endif

        @if(auth()->user()->can('SidebarSales'))
        <li>
            <a href="javascript:;" class="has-arrow">
                <div class="parent-icon"><i class='bx bx-cart'></i>
                </div>
                <div class="menu-title">Sales</div>
            </a>
            <ul>
                <li> <a href="{{URL::to('/sale')}}"><i class="bx bx-right-arrow-alt"></i>Add Sale</a>
                </li>
                <li> <a href="{{URL::to('/view_sales')}}"><i class="bx bx-right-arrow-alt"></i>View Sales</a>
                </li>

            </ul>
        </li>
        @endif
       
        @if( Session::get('acc_id') != null  && Session::get('acc_id') == 1)
        @if(auth()->user()->can('SidebarAuthentication'))
        <li>
            <a href="javascript:;" class="has-arrow">
                <div class="parent-icon"><i class='bx bx-lock'></i>
                </div>
                <div class="menu-title">Authentication</div>
            </a>
            <ul>
                <li> <a href="{{URL::to('/create_user')}}"><i class="bx bx-right-arrow-alt"></i>Add Users</a>
                </li>
                <li> <a href="{{URL::to('/users')}}"><i class="bx bx-right-arrow-alt"></i>View Users</a>
                </li>
                <li> <a href="{{URL::to('/create_role')}}"><i class="bx bx-right-arrow-alt"></i>Add Roles</a>
                </li>
                <li> <a href="{{URL::to('/role')}}"><i class="bx bx-right-arrow-alt"></i>View Roles</a>
                </li>
                <li> <a href="{{URL::to('/create_per')}}"><i class="bx bx-right-arrow-alt"></i>Add Permissions</a>
                </li>
                <li> <a href="{{URL::to('/permissions')}}"><i class="bx bx-right-arrow-alt"></i>View Permissions</a>
                </li>
            </ul>
        </li>
        @endif
        @endif
       
        @if(auth()->user()->can('SidebarReports'))
        <li>
            <a href="javascript:;" class="has-arrow">
                <div class="parent-icon"><i class='bx bx-lock'></i>
                </div>
                <div class="menu-title">Reports</div>
            </a>
            <ul>
                <li> <a href="{{URL::to('/stock_transfer_history')}}"><i class="bx bx-right-arrow-alt"></i>Stock
                        Transfer
                        History</a>
                </li>
                <li> <a href="{{URL::to('/stock_price_detail')}}"><i class="bx bx-right-arrow-alt"></i>Stock Pricing
                        Details</a>
                </li>
                <li> <a href="{{URL::to('/item_metrics')}}"><i class="bx bx-right-arrow-alt"></i>Item Metrics </a>
                </li>
                <li> <a href="{{URL::to('/low_stock_items')}}"><i class="bx bx-right-arrow-alt"></i>Low Stock</a>
                </li>
                <li> <a href="{{URL::to('/out_stock_items')}}"><i class="bx bx-right-arrow-alt"></i>Out of Stock</a>
                </li>
                <li> <a href="{{URL::to('/expected_report')}}"><i class="bx bx-right-arrow-alt"></i>Expected Report</a>
                </li>
            </ul>
        </li>
        @endif

    </ul>
    <!--end navigation-->
</div>