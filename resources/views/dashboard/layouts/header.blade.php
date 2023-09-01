<nav class="navbar navbar-expand-lg navbar-light bg-white mb-3">
    <div class="container-fluid">
        <a class="app-brand-link" href="{{ route('home') }}">

            <img src="{{$setting->app_logo}}" alt="{{$setting->app_name}}" style="width:100px; height:50px;">
         

        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    @can('crud-customer')
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="javascript:void(0)" id="navbarDropdown" role="button"
                        data-bs-toggle="dropdown" aria-expanded="false">
                        Customer
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                       @can('create-customer')
                        <li>
                            <a href="{{ route('customer.create') }}" class="dropdown-item">
                                <div data-i18n="Without menu">Add New Customer</div>
                            </a>
                        </li>
                        @endcan
                        @can('view-customer')
                        <li>
                            <a href="{{ route('customer.index') }}" class="dropdown-item">
                                <div data-i18n="Without navbar">View All Customer </div>
                            </a>
                        </li>
                        @endcan
                    </ul>
                </li>
                @endcan
                @can('crud-supplier')
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="javascript:void(0)" id="navbarDropdown" role="button"
                        data-bs-toggle="dropdown" aria-expanded="false">
                        Supplier
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                       @can('create-supplier')
                        <li>
                            <a href="{{ route('supplier.create') }}" class="dropdown-item">
                                <div data-i18n="Without menu">Add New Supplier</div>
                            </a>
                        </li>
                        @endcan
                        @can('view-supplier')
                        <li>
                            <a href="{{ route('supplier.index') }}" class="dropdown-item">
                                <div data-i18n="Without navbar">View All Supplier</div>
                            </a>
                        </li>
                        @endcan
                    </ul>
                </li>
                @endcan
                @can('crud-material')
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="javascript:void(0)" id="navbarDropdown" role="button"
                        data-bs-toggle="dropdown" aria-expanded="false">
                        Material
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                       @can('create-material')
                        <li>
                            <a href="{{ route('material.create') }}" class="dropdown-item">
                                <div data-i18n="Without menu">Add New Material</div>
                            </a>
                        </li>
                        @endcan
                        @can('view-material')
                        <li>
                            <a href="{{ route('material.index') }}" class="dropdown-item">
                                <div data-i18n="Without navbar">View All Materials</div>
                            </a>
                        </li>
                        @endcan
                    </ul>
                </li>
                @endcan
                @can('crud-purchase')
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="javascript:void(0)" id="navbarDropdown" role="button"
                        data-bs-toggle="dropdown" aria-expanded="false">
                        Purchase
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                        @can('create-purchase')
                        <li>
                            <a href="{{ route('purchase.create') }}" class="dropdown-item">
                                <div data-i18n="Without menu">Add New purchases</div>
                            </a>
                        </li>
                        @endcan
                        @can('view-purchase')
                        <li>
                            <a href="{{ route('purchase.index') }}" class="dropdown-item">
                                <div data-i18n="Without navbar">View Purchases</div>
                            </a>
                        </li>
                        @endcan
                    </ul>
                </li>
                @endcan
                @can('crud-order')
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="javascript:void(0)" id="navbarDropdown" role="button"
                        data-bs-toggle="dropdown" aria-expanded="false">
                        Job Order
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                        @can('create-order')


                        <li>
                            <a href="{{ route('job-order.create') }}" class="dropdown-item">
                                <div data-i18n="Without menu">Add New Job Order</div>
                            </a>
                        </li>
                        @endcan
                        @can('view-order')
                        <li>
                            <a href="{{ route('job-order.index') }}" class="dropdown-item">
                                <div data-i18n="Without navbar">View Job Orders</div>
                            </a>
                        </li>
                        @endcan
                    </ul>
                </li>
                @endcan
                @can('view-summary')
                <li class="nav-item">
                    <a class="nav-link" href="{{route('summary.index')}}">
                        Summary
                    </a>
                </li>
                @endcan
            </ul>


            <ul class="navbar-nav" >
                    <li class="nav-item navbar-dropdown dropdown-user dropdown float-end">
                        <a class="nav-link dropdown-toggle hide-arrow" href="javascript:void(0);" data-bs-toggle="dropdown">
                            <div class="avatar avatar-online">
                                <img src="{{auth()->user()->user_image}}" alt class="w-px-40 h-auto rounded-circle" />
                            </div>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end">
                            <li>
                                <a class="dropdown-item" href="#">
                                    <div class="d-flex">
                                        <div class="flex-shrink-0 me-3">
                                            <div class="avatar avatar-online">
                                                <img src="{{auth()->user()->user_image}}" alt="{{auth()->user()->user_name}}" class="w-px-40 h-auto rounded-circle" />
                                            </div>
                                        </div>
                                        <div class="flex-grow-1">
                                            <span class="fw-semibold d-block">{{auth()->user()->user_name}}</span>
                                            {{-- <small class="text-muted">{{auth()->user()->role}}</small> --}}
                                        </div>
                                    </div>
                                </a>
                            </li>
                            <li>
                                <div class="dropdown-divider"></div>
                            </li>
                            <li>
                                <a class="dropdown-item" href="{{route('user.profile.edit')}}">
                                    <i class="bx bx-user me-2"></i>
                                    <span class="align-middle">My Profile</span>
                                </a>
                            </li>
                            @hasanyrole('super-admin|admin')
                            <li>
                                <a class="dropdown-item" href="{{route('setting.index')}}">
                                    <i class="bx bx-cog me-2"></i>
                                    <span class="align-middle">Settings</span>
                                </a>
                            </li>
                            <li>
                                @endhasanyrole
                                <a class="dropdown-item" href="{{ route('change-password.edit') }}">
                                    <i class="bx bx-cog me-2"></i>
                                    <span class="align-middle">Change Password</span>
                                </a>
                            </li>
                            <li>
                                <div class="dropdown-divider"></div>
                            </li>
                            <li>
                                <form action="{{route('logout')}}" method="post">
                                    @csrf
                                    <button class="dropdown-item" type="submit">
                                        <i class="bx bx-power-off me-2"></i>
                                        <span class="align-middle">Log Out</span>
                                    </button>

                                </form>
                            </li>
                        </ul>
                    </li>
                </ul>


        </div>
    </div>
</nav>
