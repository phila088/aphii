
            <aside class="app-sidebar" id="sidebar">

                <!-- Start::main-sidebar-header -->
                <div class="main-sidebar-header">
                    <a href="{{url('index')}}" class="header-logo">
                        <img src="{{asset('build/assets/images/brand-logos/logo-full-color-dark-trans.svg')}}" alt="logo" class="desktop-logo size-28">
                        <img src="{{asset('build/assets/images/brand-logos/logo-icon-color-trans.svg')}}" alt="logo" class="toggle-logo w-50">
                        <img src="{{asset('build/assets/images/brand-logos/logo-full-color-light-trans.svg')}}" alt="logo" class="desktop-dark size-28">
                        <img src="{{asset('build/assets/images/brand-logos/logo-icon-color-trans.svg')}}" alt="logo" class="toggle-dark w-75">
                    </a>
                </div>
                <!-- End::main-sidebar-header -->

                <!-- Start::main-sidebar -->
                <div class="main-sidebar" id="sidebar-scroll">

                    <!-- Start::nav -->
                    <nav class="main-menu-container nav nav-pills flex-column sub-open">
                        <div class="slide-left" id="slide-left">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="#7b8191" width="24" height="24" viewBox="0 0 24 24"> <path d="M13.293 6.293 7.586 12l5.707 5.707 1.414-1.414L10.414 12l4.293-4.293z"></path> </svg>
                        </div>
                        <ul class="main-menu">
                            <!-- Start::slide__category -->
                            <li class="slide__category"><span class="category-name">Main</span></li>
                            <!-- End::slide__category -->

                            <!-- Start::slide -->
                            <li class="slide has-sub">
                                <a href="javascript:void(0);" class="side-menu__item">
                                    <span class=" side-menu__icon">
                                        <i class='bx bx-desktop'></i>
                                    </span>
                                    <span class="side-menu__label mt-[0.3rem]">Dashboards<span class="badge bg-warning-transparent ms-2">12</span></span>
                                    <i class="fe fe-chevron-right side-menu__angle mt-[0.3rem]"></i>
                                </a>
                                <ul class="slide-menu child1">
                                    <li class="slide side-menu__label1">
                                        <a href="javascript:void(0);">Dashboards</a>
                                    </li>
                                    <li class="slide">
                                        <a href="{{ url('dashboards/personal') }}" class="side-menu__item">Personal</a>
                                    </li>
                                    <li class="slide">
                                        <a href="{{url('index')}}" class="side-menu__item">Accounts Payables</a>
                                    </li>
                                    <li class="slide">
                                        <a href="{{url('index')}}" class="side-menu__item">Accounts Receivables</a>
                                    </li>
                                    <li class="slide">
                                        <a href="{{url('index')}}" class="side-menu__item">Quoting</a>
                                    </li>
                                    <li class="slide">
                                        <a href="{{url('index')}}" class="side-menu__item">Sales</a>
                                    </li>
                                    <li class="slide">
                                        <a href="{{url('index')}}" class="side-menu__item">Work Orders</a>
                                    </li>
                                </ul>
                            </li>

                            <!-- End::slide -->

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
                                        <a href="javascript:void(0);" class="side-menu__item">Documents
                                            <i class="fe fe-chevron-right side-menu__angle"></i></a>
                                        <ul class="slide-menu child2">
                                            <li class="slide">
                                                <a href="{{ route('admin.documents.categories') }}" class="side-menu__item">Categories</a>
                                            </li>
                                            <li class="slide has-sub">
                                                <a href="javascript:void(0);" class="side-menu__item">Nested-2-2
                                                    <i class="fe fe-chevron-right side-menu__angle"></i></a>
                                                <ul class="slide-menu child3">
                                                    <li class="slide">
                                                        <a href="javascript:void(0);" class="side-menu__item">Nested-2-2-1</a>
                                                    </li>
                                                    <li class="slide">
                                                        <a href="javascript:void(0);" class="side-menu__item">Nested-2-2-2</a>
                                                    </li>
                                                </ul>
                                            </li>
                                        </ul>
                                    </li>
                                </ul>
                            </li>
                            <!-- Admin slide end -->

                        </ul>
                        <div class="slide-right" id="slide-right"><svg xmlns="http://www.w3.org/2000/svg" fill="#7b8191" width="24" height="24" viewBox="0 0 24 24"> <path d="M10.707 17.707 16.414 12l-5.707-5.707-1.414 1.414L13.586 12l-4.293 4.293z"></path> </svg></div>
                    </nav>
                    <!-- End::nav -->

                </div>
                <!-- End::main-sidebar -->

            </aside>
