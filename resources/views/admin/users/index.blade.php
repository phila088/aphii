<x-app-layout>
    @section('styles')


    @endsection

    @section('content')

        <!-- PAGE HEADER -->
        <div class="page-header-breadcrumb d-md-flex d-block align-items-center justify-content-between ">
            <h4 class="fw-medium tw-text-xl mb-0">{{ __('Users') }}</h4>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="javascript:void(0);" class="text-white-50">{{ __('Admin') }}</a>
                </li>
                <li class="breadcrumb-item active" aria-current="page">{{ __('Users') }}</li>
            </ol>
        </div>
        <!-- END PAGE HEADER -->

        <!-- APP CONTENT -->
        <div class="main-content app-content">
            <div class="container-fluid">
                <!-- Start::row-1 -->
                <div class="row">
                    <div class="col-xl-12">
                        <div class="card custom-card">
                            <div class="card-header tw-flex tw-justify-between tw-items-center">
                                <h1>Users</h1>
                                <div class="tw-flex tw-items-center tw-gap-x-1">
                                    <a href="{{ route('employee.brands.index') }}" class="btn btn-danger btn-sm">
                                        Cancel
                                        <i class="bi bi-x-circle"></i>
                                    </a>
                                </div>
                            </div>
                            <div class="card-body tw-p-4">
                                <x-tab-button-parent>
                                    <x-tab-button id="pills-list-users-tab" data-bs-toggle="pill-admin-index" target="pills-list-users" selected="true" label="List users" />

                                    <x-tab-button id="pills-create-users-tab" data-bs-toggle="pill-admin-index" target="pills-create-users" selected="false" label="Create users" />

                                    <x-tab-button id="pills-permissions-tab" data-bs-toggle="pill-admin-index" target="pills-permissions" selected="false" label="Permissions" />

                                    <x-tab-button id="pills-roles-tab" data-bs-toggle="pill-admin-index" target="pills-roles" selected="false" label="Roles" />

                                    <x-tab-button id="pills-roles-permissions-tab" data-bs-toggle="pill-admin-index" target="pills-roles-permissions" selected="false" label="Roles Permissions" />

                                    <x-tab-button id="pills-user-roles-tab" data-bs-toggle="pill-admin-index" target="pills-user-roles" selected="false" label="User Roles" />
                                </x-tab-button-parent>

                                <style>
                                    .tab-content,
                                    .tab-pane {
                                        border: 0 !important;
                                        padding: 0 !important;
                                    }
                                </style>

                                <x-tab-content-parent>
                                    <x-tab-content active="true" id="pills-list-users" labelledby="pills-list-users-tab">
                                            @livewire('admin.users.list')
                                    </x-tab-content>

                                    <x-tab-content id="pills-create-users" labelledby="pills-create-users-tab">
                                        @if (auth()->user()->can('users.create'))
                                            @livewire('admin.users.create')
                                        @else
                                            <x-not-auth />
                                        @endif
                                    </x-tab-content>

                                    <x-tab-content id="pills-permissions" labelledby="pills-permissions-tab">
                                        @livewire('admin.permissions.create')
                                        @livewire('admin.permissions.list')
                                    </x-tab-content>

                                    <x-tab-content id="pills-roles" labelledby="pills-roles-tab">
                                        @livewire('admin.roles.create')
                                        @livewire('admin.roles.list')
                                    </x-tab-content>

                                    <x-tab-content id="pills-roles-permissions" labelledby="pills-roles-permissions-tab">
                                        @livewire('admin.permissions-roles.create')
                                        @livewire('admin.permissions-roles.list')
                                    </x-tab-content>

                                    <x-tab-content id="pills-user-roles" labelledby="pills-user-roles-tab">
                                        @livewire('admin.user-roles.create')
                                    </x-tab-content>
                                </x-tab-content-parent>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- End::row-1 -->
            </div>
        </div>
        <!-- END APP CONTENT -->

    @endsection

    @section('scripts')

        <script>
            const pillsTab = document.querySelector('#pills-tab');
            const pills = pillsTab.querySelectorAll('button[data-bs-toggle="pill"]');

            pills.forEach(pill => {
                pill.addEventListener('shown.bs.tab', (event) => {
                    const { target } = event;
                    const { id: targetId } = target;

                    savePillId(targetId);
                });
            });

            const savePillId = (selector) => {
                localStorage.setItem('AdminUserIndexActivePillId', selector);
            };

            const getPillId = () => {
                const activePillId = localStorage.getItem('AdminUserIndexActivePillId');

                // if local storage item is null, show default tab
                if (!activePillId) return;

                // call 'show' function
                const someTabTriggerEl = document.querySelector(`#${activePillId}`)
                const tab = new bootstrap.Tab(someTabTriggerEl);

                tab.show();
            };

            // get pill id on load
            getPillId();
            document.addEventListener('livewire:initialized', () => {

                toastr.options = {
                    "closeButton": true,
                    "debug": false,
                    "newestOnTop": true,
                    "progressBar": true,
                    "positionClass": "toast-bottom-right",
                    "preventDuplicates": false,
                    "onclick": null,
                    "showDuration": "1000",
                    "hideDuration": "1000",
                    "timeOut": "10000",
                    "extendedTimeOut": "1000",
                    "showEasing": "swing",
                    "hideEasing": "linear",
                    "showMethod": "fadeIn",
                    "hideMethod": "fadeOut"
                }

                Livewire.on('user-created', () => {
                    toastr['success']('User created successfully.')
                })
                Livewire.on('permission-created', () => {
                    toastr['success']('Permission created successfully.')
                })
                Livewire.on('permission-updated', () => {
                    toastr['success']('Permission updated successfully.')
                })
                Livewire.on('permission-edit-canceled', () => {
                    toastr['error']('Permission edit canceled.')
                })
                Livewire.on('role-created', () => {
                    toastr['success']('Role created successfully.')
                })
                Livewire.on('role-updated', () => {
                    toastr['success']('Role updated successfully.')
                })
                Livewire.on('role-edit-canceled', () => {
                    toastr['error']('Role edit canceled.')
                })
                Livewire.on('roles-permission-created', () => {
                    toastr['success']('Role permission created successfully.')
                })
                Livewire.on('roles-permission-already-exists', () => {
                    toastr['error']('Role permission already exists.')
                })
                Livewire.on('user-role-created', () => {
                    toastr['success']('Role assigned to user successfully.')
                })
            })
        </script>


    @endsection
</x-app-layout>
