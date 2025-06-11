<div wire:ignore>
    <aside class="main-sidebar sidebar-dark-primary elevation-4 sidebar-no-expand">
        <!-- Brand Logo -->
        <a href="#" class="brand-link logo-switch d-flex justify-content-center">
            <span class="logo-xs">{{ strtoupper(substr(config('app.name'), 0, 1)) }}{{ strtoupper(substr(config('app.name'), -1)) }}</span>
            <span class="logo-xl">{{ config('app.name') }}</span>
        </a>

        <!-- Sidebar -->
        <div class="sidebar">
            <!-- Sidebar Menu -->
            <nav class="mt-3 pb-3 mb-b">
                <ul class="nav nav-pills nav-sidebar flex-column nav-collapse-hide-child" data-widget="treeview" role="menu" data-accordion="false">
                    <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
                    <li class="nav-item">
                        <a href="{{ route('dashboard') }}" class="nav-link {{ request()->routeIs('dashboard') ? 'active' : '' }}">
                            <i class="nav-icon fas fa-tachometer-alt"></i>
                            <p>
                                Dashboard
                            </p>
                        </a>
                    </li>
                    @can(['master_products_access', 'master_inggridients_access', 'suppliers_access'])
                        <li class="nav-header">MASTER</li>
                    @endcan
                    @can('master_products_access')
                        <li class="nav-item">
                            <a href="{{ route('master_product.index') }}" class="nav-link {{ request()->routeIs('master_product.*') ? 'active' : '' }}">
                                <i class="nav-icon fab fa-product-hunt"></i>
                                <p>
                                    Products
                                </p>
                            </a>
                        </li>
                    @endcan
                    @can('master_inggridients_access')
                        <li class="nav-item">
                            <a href="{{ route('master_inggridient.index') }}" class="nav-link {{ request()->routeIs('master_inggridient.*') ? 'active' : '' }}">
                                <i class="nav-icon fas fa-warehouse"></i>
                                <p>
                                    Inggridients
                                </p>
                            </a>
                        </li>
                    @endcan
                    @can('suppliers_access')
                        <li class="nav-item">
                            <a href="{{ route('supplier.index') }}" class="nav-link {{ request()->routeIs('supplier.*') ? 'active' : '' }}">
                                <i class="nav-icon fas fa-parachute-box"></i>
                                <p>
                                    Suppliers
                                </p>
                            </a>
                        </li>
                    @endcan
                    @can(['purchases_access', 'request_sales_access'])
                        <li class="nav-header">TRANSACTION</li>
                    @endcan
                    @can('purchases_access')
                        <li class="nav-item">
                            <a href="{{ route('purchase.index') }}" class="nav-link {{ request()->routeIs('purchase.*') ? 'active' : '' }}">
                                <i class="nav-icon fas fa-truck-loading"></i>
                                <p>
                                    Purchases
                                </p>
                            </a>
                        </li>
                    @endcan
                    @can('request_sales_access')
                        <li class="nav-item">
                            <a href="{{ route('sale.index') }}" class="nav-link {{ request()->routeIs('sale.*') ? 'active' : '' }}">
                                <i class="nav-icon fas fa-shopping-basket"></i>
                                <p>
                                    Sales
                                </p>
                            </a>
                        </li>
                    @endcan
                    @can('master_inggridients_access')
                        <li class="nav-item">
                            <a href="{{ route('stock_report.index') }}" class="nav-link {{ request()->routeIs('stock_report*') ? 'active' : '' }}">
                               <i class="fas fa-warehouse"></i>
                                <p>
                                    Inggridient stock report
                                </p>
                            </a>
                        </li>
                    @endcan
                      @can('master_inggridients_access')
                        <li class="nav-item">
                            <a href="{{ route('fuzzy.index') }}" class="nav-link {{ request()->routeIs('fuzzy.*') ? 'active' : '' }}">
                               <i class="fas fa-key"></i>
                                <p>
                                   Fuzzy Sugeno
                                </p>
                            </a>
                        </li>
                    @endcan
                    @can(['users_access', 'roles_access', 'permissions_access'])
                        <li class="nav-header">MANAGEMENT USER</li>
                    @endcan
                    @can('users_access')
                        <li class="nav-item">
                            <a href="{{ route('user.index') }}" class="nav-link {{ request()->routeIs('user.*') ? 'active' : '' }}">
                                <i class="nav-icon fas fa-user"></i>
                                <p>
                                    Users
                                </p>
                            </a>
                        </li>
                    @endcan
                    @can('roles_access')
                        <li class="nav-item">
                            <a href="{{ route('role.index') }}" class="nav-link {{ request()->routeIs('role.*') ? 'active' : '' }}">
                                <i class="nav-icon fas fa-user-lock"></i>
                                <p>
                                    Role
                                </p>
                            </a>
                        </li>
                    @endcan
                    @can('permissions_access')
                        <li class="nav-item">
                            <a href="{{ route('permission.index') }}" class="nav-link {{ request()->routeIs('permission.*') ? 'active' : '' }}">
                                <i class="nav-icon fas fa-user-tag"></i>
                                <p>
                                    Permissions
                                </p>
                            </a>
                        </li>
                    @endcan
                </ul>
            </nav>
            <!-- /.sidebar-menu -->
        </div>
        <!-- /.sidebar -->
    </aside>
</div>
