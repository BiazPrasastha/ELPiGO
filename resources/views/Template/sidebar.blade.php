<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="#" class="brand-link"
        style="text-align: center;display:flex;align-items:center;justify-content:center;gap:10px">
        <span class="brand-text font-weight-bold"><img src="{{asset('img/logo.png')}}" alt="" class="img-logo"
                style="width: 30px;height:30px"> ELPiGO</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                {{-- ORDER --}}
                @if (Auth::user()->role == 'user')
                <li class="nav-header">ORDER</li>
                <li class="nav-item">
                    <a href="/order/subsidi" class="nav-link {{Request::is('order/subsidi')?'active':' '}}">
                        <i class=" fas fa-book nav-icon"></i>
                        <p>Gas Bersubsidi</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="/order/non-subsidi" class="nav-link {{Request::is('order/non-subsidi')?'active':' '}}">
                        <i class="fas fa-box nav-icon"></i>
                        <p>Gas Non-Subsidi</p>
                    </a>
                </li>
                {{-- INVENTORY --}}
                <li class="nav-header">STORE</li>
                <li class="nav-item">
                    <a href="/inventory" class="nav-link {{Request::is('inventory','inventory/*')?'active':' '}}">
                        <i class="fas fa-warehouse nav-icon"></i>
                        <p>LPG Stocks</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="/report" class="nav-link {{Request::is('report')?'active':' '}}">
                        <i class="fas fa-table nav-icon"></i>
                        <p>Sales Report</p>
                    </a>
                </li>
                @endif
                @if (Auth::user()->role == 'admin')
                <li class="nav-header">STORE</li>
                <li class="nav-item">
                    <a href="/store" class="nav-link {{Request::is('store')?'active':' '}}">
                        <i class="fas fa-store nav-icon"></i>
                        <p>Store List</p>
                    </a>
                </li>
                @endif
                <li class="nav-header">PROMO</li>
                <li class="nav-item">
                    <a href="/promo" class="nav-link {{Request::is('promo','promo/*')?'active':' '}}">
                        <i class="fas fa-percentage nav-icon"></i>
                        <p>Promo Code</p>
                    </a>
                </li>
                <li class="nav-header">OTHER</li>
                <li class="nav-item">
                    <a href="/citizen" class="nav-link {{Request::is('citizen','citizen/*')?'active':' '}}">
                        <i class="fas fa-user-friends nav-icon"></i>
                        <p>Masyarakat Subsidi</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="/district" class="nav-link {{Request::is('district','district/*')?'active':' '}}">
                        <i class="fas fa-globe nav-icon"></i>
                        <p>Districts</p>
                    </a>
                </li>
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>
