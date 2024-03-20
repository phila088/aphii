<aside class="app-sidebar" id="sidebar">

    <!-- Start::main-sidebar-header -->
    <div class="main-sidebar-header">
        <a href="{{url('index')}}" class="header-logo">
            <img src="{{asset('build/assets/images/brand-logos/logo-full-color-dark-trans.svg')}}" alt="logo"
                 class="desktop-logo tw-size-28">
            <img src="{{asset('build/assets/images/brand-logos/logo-icon-color-trans.svg')}}" alt="logo"
                 class="toggle-logo tw-w-50">
            <img src="{{asset('build/assets/images/brand-logos/logo-full-color-light-trans.svg')}}" alt="logo"
                 class="desktop-dark tw-size-28">
            <img src="{{asset('build/assets/images/brand-logos/logo-icon-color-trans.svg')}}" alt="logo"
                 class="toggle-dark tw-w-75">
        </a>
    </div>
    <!-- End::main-sidebar-header -->

    <!-- Start::main-sidebar -->
    <div class="main-sidebar" id="sidebar-scroll">

        <!-- Start::nav -->
        <nav class="main-menu-container nav nav-pills flex-column sub-open">
            <div class="slide-left" id="slide-left">
                <svg xmlns="http://www.w3.org/2000/svg" fill="#7b8191" width="24" height="24" viewBox="0 0 24 24">
                    <path d="M13.293 6.293 7.586 12l5.707 5.707 1.414-1.414L10.414 12l4.293-4.293z"></path>
                </svg>
            </div>
            <ul class="main-menu">
                @if($user->is_admin || $user->is_employee)
                    <!-- Start::slide__category -->
                    <li class="slide__category"><span class="category-name">Main</span></li>
                    <!-- End::slide__category -->

                    <!-- Start::slide -->
                    <li class="slide has-sub">
                        <a href="javascript:void(0);" class="side-menu__item">
                                        <span class=" side-menu__icon">
                                            <i class="bi bi-speedometer"></i>
                                        </span>
                            <span class="side-menu__label tw-mt-[0.4rem]">Dashboards</span>

                            <i class="fe fe-chevron-right side-menu__angle tw-mt-[0.3rem]"></i>
                        </a>
                        <ul class="slide-menu child1">
                            <li class="slide side-menu__label1">
                                <a href="javascript:void(0);">Dashboards</a>
                            </li>
                            <li class="slide">
                                <a href="{{ route('dashboards.personal') }}" class="side-menu__item">Personal</a>
                            </li>
                            <li class="slide">
                                <a href="{{ route('dashboards.ap') }}" class="side-menu__item">Accounts Payables</a>
                            </li>
                            <li class="slide">
                                <a href="{{ route('dashboards.ar') }}" class="side-menu__item">Accounts Receivables</a>
                            </li>
                            <li class="slide">
                                <a href="{{ route('dashboards.quoting') }}" class="side-menu__item">Quoting</a>
                            </li>
                            <li class="slide">
                                <a href="{{ route('dashboards.sales') }}" class="side-menu__item">Sales</a>
                            </li>
                            <li class="slide">
                                <a href="{{ route('dashboards.work-orders') }}" class="side-menu__item">Work Orders</a>
                            </li>
                        </ul>
                    </li>
                    <!-- End::slide -->

                    <!-- Brand menu -->
                    <li class="slide has-sub">
                        <a href="javascript:void(0);" class="side-menu__item">
                                        <span class=" side-menu__icon">
                                            <i class="bi bi-building"></i>
                                        </span>
                            <span class="side-menu__label tw-mt-[0.3rem]">Brands</span>
                            <i class="fe fe-chevron-right side-menu__angle mt-[0.3rem]"></i>
                        </a>
                        <ul class="slide-menu child1">
                            <li class="slide side-menu__label1">
                                <a href="javascript:void(0);">Brands</a>
                            </li>
                            <li class="slide">
                                <a href="{{ route('employee.brands.index') }}" class="side-menu__item">View All</a>
                            </li>
                            <li class="slide">
                                <a href="{{ route('employee.brands.create') }}" class="side-menu__item">Create</a>
                            </li>
                        </ul>
                    </li>

                    <!-- Client menu -->
                    <li class="slide has-sub">
                        <a href="javascript:void(0);" class="side-menu__item">
                                        <span class=" side-menu__icon">
                                            <i class="bi bi-people"></i>
                                        </span>
                            <span class="side-menu__label tw-mt-[0.3rem]">Clients</span>
                            <i class="fe fe-chevron-right side-menu__angle mt-[0.3rem]"></i>
                        </a>
                        <ul class="slide-menu child1">
                            <li class="slide side-menu__label1">
                                <a href="javascript:void(0);">Client</a>
                            </li>
                            <li class="slide has-sub">
                                <a href="javascript:void(0);" class="side-menu__item">Potential Clients
                                    <i class="fe fe-chevron-right side-menu__angle"></i></a>
                                <ul class="slide-menu child2">
                                    <li class="slide">
                                        <a href="{{ route('employee.potential-clients.index') }}" class="side-menu__item">View All</a>
                                    </li>
                                    <li class="slide">
                                        <a href="{{ route('employee.potential-clients.create') }}" class="side-menu__item">Create</a>
                                    </li>
                                </ul>
                            </li>
                            <li class="slide">
                                <a href="{{ route('employee.clients.index') }}" class="side-menu__item">
                                    View All
                                </a>
                            </li>
                            <li class="slide">
                                <a href="{{ route('employee.clients.create') }}" class="side-menu__item">
                                    Create
                                </a>
                            </li>
                        </ul>
                    </li>

                    <!-- Quote menu -->
                    <li class="slide has-sub">
                        <a href="javascript:void(0);" class="side-menu__item">
                                        <span class=" side-menu__icon">
                                            <i class="bi bi-pencil"></i>
                                        </span>
                            <span class="side-menu__label tw-mt-[0.3rem]">Quoting</span>
                            <i class="fe fe-chevron-right side-menu__angle mt-[0.3rem]"></i>
                        </a>
                        <ul class="slide-menu child1">
                            <li class="slide side-menu__label1">
                                <a href="javascript:void(0);">Client</a>
                            </li>
                            <li class="slide">
                                <a href="{{ route('brands.index') }}" class="side-menu__item">View All</a>
                            </li>
                        </ul>
                    </li>

                    <!-- Vendors menu -->
                    <li class="slide has-sub">
                        <a href="javascript:void(0);" class="side-menu__item">
                                        <span class=" side-menu__icon">
                                            <i class="bi bi-hammer"></i>
                                        </span>
                            <span class="side-menu__label tw-mt-[0.3rem]">Vendors</span>
                            <i class="fe fe-chevron-right side-menu__angle mt-[0.3rem]"></i>
                        </a>
                        <ul class="slide-menu child1">
                            <li class="slide side-menu__label1">
                                <a href="javascript:void(0);">Brands</a>
                            </li>
                            <li class="slide">
                                <a href="{{ route('brands.index') }}" class="side-menu__item">View All</a>
                            </li>
                        </ul>
                    </li>

                    <!-- Work orders -->
                    <li class="slide has-sub">
                        <a href="javascript:void(0);" class="side-menu__item">
                                        <span class=" side-menu__icon">
                                            <i class="bi bi-list-ul"></i>
                                        </span>
                            <span class="side-menu__label tw-mt-[0.3rem]">Work Orders</span>
                            <i class="fe fe-chevron-right side-menu__angle mt-[0.3rem]"></i>
                        </a>
                        <ul class="slide-menu child1">
                            <li class="slide side-menu__label1">
                                <a href="javascript:void(0);">Brands</a>
                            </li>
                            <li class="slide">
                                <a href="{{ route('brands.index') }}" class="side-menu__item">View All</a>
                            </li>
                        </ul>
                    </li>

                    <!-- Start::slide__category -->
                    <li class="slide__category"><span class="category-name">Web Apps</span></li>
                    <!-- End::slide__category -->
                    <!-- Web apps - CRM start -->
                    <li class="slide">
                        <a href="#" class="side-menu__item">
                                        <span class=" side-menu__icon">
                                            <i class="bi bi-person-rolodex"></i>
                                        </span>
                            <span class="side-menu__label mt-[0.4rem]">CRM</span>
                        </a>
                    </li>
                    <!-- Web apps - CRM end -->

                    <!-- Web apps - CRM start -->
                    <li class="slide">
                        <a href="#" class="side-menu__item">
                                        <span class=" side-menu__icon">
                                            <i class="bi bi-list-task"></i>
                                        </span>
                            <span class="side-menu__label mt-[0.2rem]">Project Management</span>
                        </a>
                    </li>
                    <!-- Web apps - CRM end -->
                @endif

                @if ($user->is_admin || $user->is_vendor)
                        <!-- Start::slide__category -->
                        <li class="slide__category"><span class="category-name">Vendor</span></li>
                        <!-- End::slide__category -->
                @endif

                @if ($user->is_admin || $user->is_client)
                    <!-- Start::slide__category -->
                    <li class="slide__category"><span class="category-name">Client</span></li>
                    <!-- End::slide__category -->

                    <li class="slide">
                        <a href="javascript:void(0);" class="side-menu__item">
                                    <span class=" side-menu__icon">
                                        <i class="bi bi-speedometer"></i>
                                    </span>
                            <span class="side-menu__label tw-mt-[0.4rem]">Dashboard</span>
                        </a>
                    </li>
                    <li class="slide has-sub">
                        <a href="javascript:void(0);" class="side-menu__item">
                                <span class=" side-menu__icon">
                                    <i class="bi bi-list-task"></i>
                                </span>
                            <span class="side-menu__label tw-mt-[0.4rem]">Work Orders</span>
                            <i class="fe fe-chevron-right side-menu__angle mt-[0.35rem]"></i>
                        </a>
                        <ul class="slide-menu child1">
                            <li class="slide side-menu__label1">
                                <a href="javascript:void(0);">Work Orders</a>
                            </li>
                            <li class="slide">
                                <a href="javascript:void(0);" class="side-menu__item">
                                    <span class="side-menu__label">Submit</span>
                                </a>
                            </li>
                            <li class="slide">
                                <a href="javascript:void(0);" class="side-menu__item">
                                    <span class="side-menu__label">Manage</span>
                                </a>
                            </li>
                        </ul>
                    </li>
                @endif

                @if ($user->is_admin)
                    <!-- Start::slide__category -->
                    <li class="slide__category"><span class="category-name">Settings</span></li>
                    <!-- End::slide__category -->

                    <!-- Admin slide start -->
                    <li class="slide has-sub">
                        <a href="javascript:void(0);" class="side-menu__item">
                                        <span class=" side-menu__icon">
                                            <i class="bi bi-shield-lock"></i>
                                        </span>
                            <span class="side-menu__label mt-[0.35rem]">Admin</span>
                            <i class="fe fe-chevron-right side-menu__angle mt-[0.35rem]"></i>
                        </a>
                        <ul class="slide-menu child1">
                            <li class="slide has-sub">
                                <a href="javascript:void(0);" class="side-menu__item">Brands
                                    <i class="fe fe-chevron-right side-menu__angle"></i></a>
                                <ul class="slide-menu child2">
                                    <li class="slide">
                                        <a href="{{ route('admin.brands.index') }}" class="side-menu__item">View All</a>
                                    </li>
                                    <li class="slide">
                                        <a href="{{ route('admin.brands.create') }}" class="side-menu__item">Create</a>
                                    </li>
                                </ul>
                            </li>
                            <li class="slide has-sub">
                                <a href="javascript:void(0);" class="side-menu__item">Documents
                                    <i class="fe fe-chevron-right side-menu__angle"></i></a>
                                <ul class="slide-menu child2">
                                    <li class="slide">
                                        <a href="{{ route('admin.documents.categories') }}" class="side-menu__item">Categories</a>
                                    </li>
                                </ul>
                            </li>
                        </ul>
                    </li>
                    <!-- Admin slide end -->
                @endif

            </ul>
            <div class="slide-right" id="slide-right">
                <svg xmlns="http://www.w3.org/2000/svg" fill="#7b8191" width="24" height="24" viewBox="0 0 24 24">
                    <path d="M10.707 17.707 16.414 12l-5.707-5.707-1.414 1.414L13.586 12l-4.293 4.293z"></path>
                </svg>
            </div>
        </nav>
        <!-- End::nav -->

    </div>
    <!-- End::main-sidebar -->

</aside>
