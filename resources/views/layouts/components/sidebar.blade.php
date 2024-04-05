<aside class="app-sidebar" id="sidebar">

    <!-- Logos -->
    <div class="main-sidebar-header">
        <a href="javascript:void(0)" class="header-logo">
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
                    <x-slide-category label="Main" />

                    <!-- Dashboards -->
                    <x-slide-parent icon="bi bi-speedometer" label="Dashboards">
                        <x-slide-label label="Dashboards" />

                        <x-slide-item route="dashboards.personal" label="Personal" />

                        <x-slide-item route="dashboards.ap" label="Payables" />

                        <x-slide-item route="dashboards.ar" label="Receivables" />

                        <x-slide-item route="dashboards.quoting" label="Quoting" />

                        <x-slide-item route="dashboards.sales" label="Sales" />

                        <x-slide-item route="dashboards.sales" label="Work Orders" />
                    </x-slide-parent>

                    <!-- Accounting -->
                    <x-slide-parent icon="bi bi-bank" label="Accounting">
                        <x-slide-label label="Accounting" />

                        <x-slide-with-child label="Payables">
                            <x-slide-item route="url:#" label="Awaiting invoice" />

                            <x-slide-item route="url:#" label="Enter payment" />

                            <x-slide-item route="url:#" label="On-hold" />

                            <x-slide-item route="url:#" label="Pending invoices" />

                            <x-slide-item route="url:#" label="Paid" />

                            <x-slide-item route="url:#" label="Reports" />
                        </x-slide-with-child>

                        <x-slide-with-child label="Receivables">
                            <x-slide-item route="url:#" label="Awaiting submission" />

                            <x-slide-item route="url:#" label="Create invoice" />

                            <x-slide-item route="url:#" label="Enter payment" />

                            <x-slide-item route="url:#" label="Pending payment" />

                            <x-slide-item route="url:#" label="Paid" />

                            <x-slide-item route="url:#" label="Purgatory" />

                            <x-slide-item route="url:#" label="Reports" />
                        </x-slide-with-child>

                    </x-slide-parent>

                    <!-- Brands -->
                    @canany (['brands.viewAny', 'brands.create', 'brands.report'])
                        <x-slide-parent icon="bi bi-building" label="Brands">
                            <x-slide-label label="Brands" />

                            <x-slide-item route="employee.brands.index" label="View all" permission="brands.viewAny" />

                            <x-slide-item route="url:javascript:void(0);" label="Reports" permission="brands.report" />
                        </x-slide-parent>
                    @endcanany


                    <!-- Clients -->
                    @canany([
                        'clientLocations.viewAny', 'clientLocations.view', 'clientLocations.create', 'clientLocations.generateReport',
                        'potentialClients.viewAny', 'potentialClients.view', 'potentialClients.create', 'potentialClients.generateReport',
                        'clients.viewAny', 'clients.view', 'clients.create', 'clients.generateReport',
                    ])
                        <x-slide-parent icon="bi bi-people" label="Clients">
                            <x-slide-label label="Clients" />

                            @canany(['clientLocations.viewAny', 'clientLocations.view', 'clientLocations.create', 'clientLocations.generateReport'])
                                <x-slide-with-child label="Locations">

                                    <x-slide-item route="url:#" label="View all" />

                                    <x-slide-item route="url:#" label="Create" />

                                </x-slide-with-child>
                            @endcanany

                            @canany(['potentialclient.viewAny', 'potentialclient.view', 'potentialclient.create', 'potentialclient.generateReport'])
                                <x-slide-with-child label="Potential clients">
                                    <x-slide-item route="url:#" label="View all" permission="potentialclient.viewAny, potentialclient.view" />

                                    <x-slide-item route="url:#" label="Create" permission="potentialclient.create" />
                                </x-slide-with-child>
                            @endcanany

                            <x-slide-item route="employee.clients.index" label="View all" />

                            <x-slide-item route="url:#" label="Create" />

                            <x-slide-with-child label="Requests">
                                <x-slide-item route="url:#" label="Insurance" />

                                <x-slide-item route="url:#" label="Meeting" />
                            </x-slide-with-child>

                            <x-slide-item route="url:#" label="Reports" permission="client.generateReport" />
                        </x-slide-parent>
                    @endcanany

                    <!-- Quote -->
                    <x-slide-parent icon="bi bi-pencil" label="Quoting">
                        <x-slide-label label="Quoting" />

                        <x-slide-with-child label="Catalog">
                            <x-slide-item route="url:#" label="View all" />

                            <x-slide-item route="url:#" label="Create" />
                        </x-slide-with-child>

                        <x-slide-item route="url:#" label="Create" />

                        <x-slide-item route="url:#" label="Pending" />

                        <x-slide-item route="url:#" label="Revisions" />
                    </x-slide-parent>


                    <!-- Vendors -->
                    <x-slide-parent icon="bi bi-hammer" label="Vendors">
                        <x-slide-label label="Vendors" />

                        <x-slide-item route="url:#" label="View all" />

                        <x-slide-item route="url:#" label="Create" />

                    </x-slide-parent>

                    <!-- Work orders -->
                    <x-slide-parent icon="bi bi-cone-striped" label="Work orders">
                        <x-slide-label label="Work orders" />

                        <x-slide-item route="url:#" label="View all" />

                        <x-slide-item route="url:#" label="Create" />

                    </x-slide-parent>

                    <x-slide-category label="Misc" />

                    <!-- Documents -->
                    <x-slide-parent icon="bi bi-file-earmark" label="Documents">
                        <x-slide-label label="Documents" />

                        <x-slide-item route="url:#" label="View all" />

                        <x-slide-item route="url:#" label="Upload" />

                    </x-slide-parent>

                    <!-- Web apps category -->
                    <li class="slide__category"><span class="category-name">Web Apps</span></li>

                    <!-- CRM -->
                    <x-slide-parent icon="bi bi-person-rolodex" label="CRM">
                        <x-slide-label label="CRM" />

                        <x-slide-with-child label="Calls">

                            <x-slide-item route="url:#" label="View all" />

                            <x-slide-item route="url:#" label="Create" />

                        </x-slide-with-child>

                        <x-slide-with-child label="Contacts">

                            <x-slide-item route="url:#" label="View all" />

                            <x-slide-item route="url:#" label="Create" />

                            <x-slide-item route="url:#" label="Import" />

                        </x-slide-with-child>

                        <x-slide-with-child label="Loops">

                            <x-slide-item route="url:#" label="View all" />

                            <x-slide-item route="url:#" label="Create" />

                        </x-slide-with-child>

                    </x-slide-parent>

                    <!-- KB -->
                    <x-slide-parent icon="bi bi-chat-left-quote" label="Knowledge base">
                        <x-slide-item route="url:#" label="Articles" />

                        <x-slide-item route="url:#" label="Courses" />

                        <x-slide-item route="url:#" label="Request an article" />

                    </x-slide-parent>
                @endif

                <!-- Settings category -->
                <li class="slide__category"><span class="category-name">User</span></li>

                <!-- User settings -->
                <x-slide-parent icon="bi bi-gear" label="User">
                    <x-slide-label label="User" />

                    <x-slide-item route="url:#" label="Account" />

                    <x-slide-item route="url:#" label="Site" />

                </x-slide-parent>

                @if ($user->is_admin)
                    <!-- Admin slide start -->
                    <x-slide-parent icon="bi bi-shield-lock" label="Admin">
                        <x-slide-label label="Admin" />

                        <x-slide-item route="admin.contact-departments.index" label="Contact departments" />

                        <x-slide-item route="admin.document-categories.index" label="Document categories" />

                        <x-slide-item route="admin.payment-methods.index" label="Payment methods" />

                        <x-slide-item route="admin.payment-terms.index" label="Payment terms" />

                        <x-slide-item route="admin.status-codes.index" label="Status codes" />

                        <x-slide-item route="admin.trash.index" label="Trash" />

                        <x-slide-item route="admin.users.index" label="Users" />

                    </x-slide-parent>
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
