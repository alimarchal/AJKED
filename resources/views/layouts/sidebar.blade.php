<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion d-print-none" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="{{route('dashboard')}}">
        <div class="sidebar-brand-icon ">
            <!-- rotate-n-15 -->
            <img src="{{Storage::url('logo.png')}}" alt="{{Storage::url('logo.png')}}" style="height: 70px;">

        </div>
        <div class="sidebar-brand-text mx-3">AJKED</div>
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider my-0">

    <!-- Nav Item - Dashboard -->
    <li class="nav-item @if(request()->routeIs('dashboard')) active @endif">
        <a class="nav-link" href="{{route('dashboard')}}">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Dashboard</span></a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Heading -->
    <div class="sidebar-heading">
        Interface
    </div>

    <!-- Nav Item - Pages Collapse Menu -->

    <li class="nav-item @if(request()->routeIs('product.*')) active @endif">
        <a class="nav-link collapsed " href="#" data-toggle="collapse" data-target="#collapseFour"
           aria-expanded="true" aria-controls="collapseFour">
            <i class="fas fa-fw fa-warehouse"></i>
            <span>Hardware Item List</span>
        </a>
        <div id="collapseFour" class="collapse  @if(request()->routeIs('product.*')) show @endif" aria-labelledby="headingFour" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                {{--                <h6 class="collapse-header">Custom Components:</h6>--}}
                <a class="collapse-item @if(request()->routeIs('product.create')) active @endif" href="{{route('product.create')}}">Create Store Items</a>
                <a class="collapse-item @if(request()->routeIs('product.index')) active @endif" href="{{route('product.index')}}">Show All</a>
                <a class="collapse-item @if(request()->routeIs('product.stockOut')) active @endif" href="{{route('product.stockOut')}}">Stock Out</a>
                        <h6 class="collapse-header">Stock In/Out Status:</h6>
                <a class="collapse-item @if(request()->routeIs('product.stockInRegister')) active @endif" href="{{route('product.stockInRegister')}}">Stock In Details</a>
                <a class="collapse-item @if(request()->routeIs('product.stockOutRegister')) active @endif" href="{{route('product.stockOutRegister')}}">Stock Out Details</a>
            </div>
        </div>
    </li>


    <li class="nav-item @if(request()->routeIs('report.*')) active @endif">
        <a class="nav-link collapsed " href="#" data-toggle="collapse" data-target="#collapseReport"
           aria-expanded="true" aria-controls="collapseReport">
            <i class="fas fa-fw fa-clipboard-list"></i>
            <span>Reporting</span>
        </a>
        <div id="collapseReport" class="collapse  @if(request()->routeIs('report.*')) show @endif" aria-labelledby="headingReport" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                {{--                <h6 class="collapse-header">Custom Components:</h6>--}}
                <a class="collapse-item @if(request()->routeIs('product.create')) active @endif" href="{{route('report.stockReturn')}}">Stock Return</a>
            </div>
        </div>
    </li>


    <li class="nav-item @if(request()->routeIs('supplier.*')) active @endif">
        <a class="nav-link collapsed " href="#" data-toggle="collapse" data-target="#collapseTwo"
           aria-expanded="true" aria-controls="collapseTwo">
            <i class="fas fa-fw fa-users"></i>
            <span>Suppliers</span>
        </a>
        <div id="collapseTwo" class="collapse  @if(request()->routeIs('supplier.*')) show @endif" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
{{--                <h6 class="collapse-header">Custom Components:</h6>--}}
                <a class="collapse-item @if(request()->routeIs('supplier.create')) active @endif" href="{{route('supplier.create')}}">Create Supplier</a>
                <a class="collapse-item @if(request()->routeIs('supplier.index')) active @endif" href="{{route('supplier.index')}}">Show All</a>
            </div>
        </div>
    </li>


    <li class="nav-item @if(request()->routeIs('division.*')) active @endif">
        <a class="nav-link collapsed " href="#" data-toggle="collapse" data-target="#collapseThree"
           aria-expanded="true" aria-controls="collapseThree">
            <i class="fas fa-fw fa-building"></i>
            <span>Divisions</span>
        </a>
        <div id="collapseThree" class="collapse  @if(request()->routeIs('division.*')) show @endif" aria-labelledby="headingThree" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                {{--                <h6 class="collapse-header">Custom Components:</h6>--}}
                <a class="collapse-item @if(request()->routeIs('division.create')) active @endif" href="{{route('division.create')}}">Create Division</a>
                <a class="collapse-item @if(request()->routeIs('division.index')) active @endif" href="{{route('division.index')}}">Show All</a>
            </div>
        </div>
    </li>



{{--    <li class="nav-item @if(request()->routeIs('stockInOut.*')) active @endif">--}}
{{--        <a class="nav-link collapsed " href="#" data-toggle="collapse" data-target="#collapseSix"--}}
{{--           aria-expanded="true" aria-controls="collapseSix">--}}
{{--            <i class="fas fa-fw fa-list-alt"></i>--}}
{{--            <span>Stock In/Out</span>--}}
{{--        </a>--}}
{{--        <div id="collapseSix" class="collapse  @if(request()->routeIs('stockInOut.*')) show @endif" aria-labelledby="headingSix" data-parent="#accordionSidebar">--}}
{{--            <div class="bg-white py-2 collapse-inner rounded">--}}
{{--                <a class="collapse-item @if(request()->routeIs('stockInOut.index')) active @endif" href="{{route('stockInOut.index')}}">Show All</a>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    </li>--}}




    <!-- Divider -->
    <hr class="sidebar-divider d-none d-md-block">
    <div class="sidebar-heading">
        Settings
    </div>

    <li class="nav-item @if(request()->routeIs('category.*')) active @endif">
        <a class="nav-link collapsed " href="#" data-toggle="collapse" data-target="#collapseFive"
           aria-expanded="true" aria-controls="collapseFive">
            <i class="fas fa-fw fa-list-alt"></i>
            <span>Category</span>
        </a>
        <div id="collapseFive" class="collapse  @if(request()->routeIs('category.*')) show @endif" aria-labelledby="headingFive" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                {{--                <h6 class="collapse-header">Custom Components:</h6>--}}
                <a class="collapse-item @if(request()->routeIs('category.create')) active @endif" href="{{route('category.create')}}">Create Category</a>
                <a class="collapse-item @if(request()->routeIs('category.index')) active @endif" href="{{route('category.index')}}">Show All</a>
            </div>
        </div>
    </li>




    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>



</ul>
