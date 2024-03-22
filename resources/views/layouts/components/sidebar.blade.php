<aside class="app-sidebar" id="sidebar">

    <!-- Logos -->
    <div class="main-sidebar-header">
        <a href="{{url('index')}}" class="header-logo">
            <img src="{{asset('build/assets/images/brand-logos/logo-full-color-dark-trans.svg')}}" alt="logo" class="desktop-logo tw-size-28">
            <img src="{{asset('build/assets/images/brand-logos/logo-icon-color-trans.svg')}}" alt="logo" class="toggle-logo tw-w-50">
            <img src="{{asset('build/assets/images/brand-logos/logo-full-color-light-trans.svg')}}" alt="logo" class="desktop-dark tw-w-36">
            <img src="{{asset('build/assets/images/brand-logos/logo-icon-color-trans.svg')}}" alt="logo" class="toggle-dark tw-w-75">
        </a>
    </div>

    <!-- Container -->
    <div class="main-sidebar" id="sidebar-scroll">

        <!-- Nav -->
        <nav class="main-menu-container nav nav-pills flex-column sub-open">

            <div class="slide-left" id="slide-left">
                <svg xmlns="http://www.w3.org/2000/svg" fill="#7b8191" width="24" height="24" viewBox="0 0 24 24">
                    <path d="M13.293 6.293 7.586 12l5.707 5.707 1.414-1.414L10.414 12l4.293-4.293z"></path>
                </svg>
            </div>

            <!-- Employee Menu -->
            <ul class="main-menu">
                @if($user->is_admin || $user->is_employee)

                    <!-- Main category -->
                    <x-custom.slide-category label="Main" />

                    <!-- Dashboards -->
                    <x-custom.slide-parent icon="bi bi-speedometer" label="Dashboards">
                        <x-custom.slide-label label="Dashboards" />

                        <x-custom.slide-item route="dashboards.personal" label="Personal" />

                        <x-custom.slide-item route="dashboards.ap" label="Payables" />

                        <x-custom.slide-item route="dashboards.ar" label="Receivables" />

                        <x-custom.slide-item route="dashboards.quoting" label="Quoting" />

                        <x-custom.slide-item route="dashboards.sales" label="Sales" />

                        <x-custom.slide-item route="dashboards.sales" label="Work Orders" />
                    </x-custom.slide-parent>

                    <!-- Accounting -->
                    <x-custom.slide-parent icon="bi bi-bank" label="Accounting">
                        <x-custom.slide-label label="Accounting" />

                        <x-custom.slide-with-child label="Payables">
                            <x-custom.slide-item route="url:#" label="Awaiting invoice" />

                            <x-custom.slide-item route="url:#" label="Enter payment" />

                            <x-custom.slide-item route="url:#" label="On-hold" />

                            <x-custom.slide-item route="url:#" label="Pending invoices" />

                            <x-custom.slide-item route="url:#" label="Paid" />

                            <x-custom.slide-item route="url:#" label="Reports" />
                        </x-custom.slide-with-child>

                        <x-custom.slide-with-child label="Receivables">
                            <x-custom.slide-item route="url:#" label="Awaiting submission" />

                            <x-custom.slide-item route="url:#" label="Create invoice" />

                            <x-custom.slide-item route="url:#" label="Enter payment" />

                            <x-custom.slide-item route="url:#" label="Pending payment" />

                            <x-custom.slide-item route="url:#" label="Paid" />

                            <x-custom.slide-item route="url:#" label="Purgatory" />

                            <x-custom.slide-item route="url:#" label="Reports" />
                        </x-custom.slide-with-child>

                    </x-custom.slide-parent>

                    <!-- Brands -->
                    <x-custom.slide-parent icon="bi bi-building" label="Brands">
                        <x-custom.slide-label label="Brands" />

                        <x-custom.slide-item route="employee.brands.index" label="View all" />

                        <x-custom.slide-item route="employee.brands.create" label="Create" />

                        <x-custom.slide-item route="url:#" label="Reports" />
                    </x-custom.slide-parent>


                    <!-- Clients -->
                    <x-custom.slide-parent icon="bi bi-people" label="Clients">
                        <x-custom.slide-label label="Clients" />

                        <x-custom.slide-with-child label="Locations">

                            <x-custom.slide-item route="url:#" label="View all" />

                            <x-custom.slide-item route="url:#" label="Create" />

                        </x-custom.slide-with-child>

                        <x-custom.slide-with-child label="Potential clients">
                            <x-custom.slide-item route="employee.potential-clients.index" label="View all" />

                            <x-custom.slide-item route="employee.potential-clients.create" label="Create" />
                        </x-custom.slide-with-child>

                        <x-custom.slide-item route="url:#" label="View all" />

                        <x-custom.slide-item route="url:#" label="Create" />

                        <x-custom.slide-with-child label="Requests">
                            <x-custom.slide-item route="url:#" label="Insurance" />

                            <x-custom.slide-item route="url:#" label="Meeting" />
                        </x-custom.slide-with-child>
                    </x-custom.slide-parent>

                    <!-- Quote -->
                    <x-custom.slide-parent icon="bi bi-pencil" label="Quoting">
                        <x-custom.slide-label label="Quoting" />

                        <x-custom.slide-with-child label="Catalog">
                            <x-custom.slide-item route="url:#" label="View all" />

                            <x-custom.slide-item route="url:#" label="Create" />
                        </x-custom.slide-with-child>

                        <x-custom.slide-item route="url:#" label="Create" />

                        <x-custom.slide-item route="url:#" label="Pending" />

                        <x-custom.slide-item route="url:#" label="Revisions" />
                    </x-custom.slide-parent>


                    <!-- Vendors -->
                    <x-custom.slide-parent icon="bi bi-hammer" label="Vendors">
                        <x-custom.slide-label label="Vendors" />

                        <x-custom.slide-item route="url:#" label="View all" />

                        <x-custom.slide-item route="url:#" label="Create" />

                    </x-custom.slide-parent>

                    <!-- Work orders -->
                    <x-custom.slide-parent icon="bi bi-cone-striped" label="Work orders">
                        <x-custom.slide-label label="Work orders" />

                        <x-custom.slide-item route="url:#" label="View all" />

                        <x-custom.slide-item route="url:#" label="Create" />

                    </x-custom.slide-parent>

                    <x-custom.slide-category label="Misc" />

                    <!-- Documents -->
                    <x-custom.slide-parent icon="bi bi-file-earmark" label="Documents">
                        <x-custom.slide-label label="Documents" />

                        <x-custom.slide-item route="url:#" label="View all" />

                        <x-custom.slide-item route="url:#" label="Upload" />

                    </x-custom.slide-parent>

                    <!-- Web apps category -->
                    <li class="slide__category"><span class="category-name">Web Apps</span></li>

                    <!-- CRM -->
                    <x-custom.slide-parent icon="bi bi-person-rolodex" label="CRM">
                        <x-custom.slide-label label="CRM" />

                        <x-custom.slide-with-child label="Calls">

                            <x-custom.slide-item route="url:#" label="View all" />

                            <x-custom.slide-item route="url:#" label="Create" />

                        </x-custom.slide-with-child>

                        <x-custom.slide-with-child label="Contacts">

                            <x-custom.slide-item route="url:#" label="View all" />

                            <x-custom.slide-item route="url:#" label="Create" />

                            <x-custom.slide-item route="url:#" label="Import" />

                        </x-custom.slide-with-child>

                        <x-custom.slide-with-child label="Loops">

                            <x-custom.slide-item route="url:#" label="View all" />

                            <x-custom.slide-item route="url:#" label="Create" />

                        </x-custom.slide-with-child>

                    </x-custom.slide-parent>

                    <!-- KB -->
                    <x-custom.slide-parent icon="bi bi-chat-left-quote" label="Knowledge base">
                        <x-custom.slide-item route="url:#" label="Articles" />

                        <x-custom.slide-item route="url:#" label="Courses" />

                        <x-custom.slide-item route="url:#" label="Request an article" />

                    </x-custom.slide-parent>
                @endif

                <!-- Settings category -->
                <li class="slide__category"><span class="category-name">User</span></li>

                <!-- User settings -->
                <x-custom.slide-parent icon="bi bi-gear" label="User">
                    <x-custom.slide-label label="User" />

                    <x-custom.slide-item route="url:#" label="Account" />

                    <x-custom.slide-item route="url:#" label="Site" />

                </x-custom.slide-parent>

                @if ($user->is_admin)
                    <!-- Admin slide start -->
                    <x-custom.slide-parent icon="bi bi-shield-lock" label="Admin">
                        <x-custom.slide-label label="Admin" />

                        <x-custom.slide-with-child label="Articles">

                            <x-custom.slide-item route="url:#" label="View all" />

                            <x-custom.slide-item route="url:#" label="Create" />

                        </x-custom.slide-with-child>

                        <x-custom.slide-with-child label="Certifications">

                            <x-custom.slide-item route="url:#" label="View all" />

                            <x-custom.slide-item route="url:#" label="Create" />

                        </x-custom.slide-with-child>

                        <x-custom.slide-with-child label="Cities">

                            <x-custom.slide-item route="url:#" label="View all" />

                            <x-custom.slide-item route="url:#" label="Create" />

                        </x-custom.slide-with-child>

                        <x-custom.slide-with-child label="Contact departments">

                            <x-custom.slide-item route="url:#" label="View all" />

                            <x-custom.slide-item route="url:#" label="Create" />

                        </x-custom.slide-with-child>

                        <x-custom.slide-with-child label="Contact positions">

                            <x-custom.slide-item route="url:#" label="View all" />

                            <x-custom.slide-item route="url:#" label="Create" />

                        </x-custom.slide-with-child>

                        <x-custom.slide-with-child label="Counties">

                            <x-custom.slide-item route="url:#" label="View all" />

                            <x-custom.slide-item route="url:#" label="Create" />

                        </x-custom.slide-with-child>

                        <x-custom.slide-with-child label="Document categories">

                            <x-custom.slide-item route="url:#" label="View all" />

                            <x-custom.slide-item route="url:#" label="Create" />

                        </x-custom.slide-with-child>

                        <x-custom.slide-with-child label="Payment methods">

                            <x-custom.slide-item route="url:#" label="View all" />

                            <x-custom.slide-item route="url:#" label="Create" />

                        </x-custom.slide-with-child>

                        <x-custom.slide-with-child label="Payment terms">

                            <x-custom.slide-item route="url:#" label="View all" />

                            <x-custom.slide-item route="url:#" label="Create" />

                        </x-custom.slide-with-child>

                        <x-custom.slide-with-child label="States">

                            <x-custom.slide-item route="url:#" label="View all" />

                            <x-custom.slide-item route="url:#" label="Create" />

                        </x-custom.slide-with-child>

                        <x-custom.slide-with-child label="Status codes">

                            <x-custom.slide-item route="admin.status-codes.index" label="View all" />

                            <x-custom.slide-item route="url:#" label="Create" />

                        </x-custom.slide-with-child>

                        <x-custom.slide-with-child label="Trash">

                            <x-custom.slide-item route="url:#" label="View all" />

                        </x-custom.slide-with-child>

                    </x-custom.slide-parent>
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
