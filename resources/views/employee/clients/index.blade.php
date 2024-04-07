<x-app-layout>
    @section('styles')

        <link rel="stylesheet" href="{{ asset('js/bst/bootstrap-table.min.css') }}">
        <link rel="stylesheet" href="{{ asset('js/bst/extensions/sticky-header/bootstrap-table-sticky-header.min.css') }}">

    @endsection

    @section('content')

        <!-- PAGE HEADER -->
        <div class="page-header-breadcrumb d-md-flex d-block align-items-center justify-content-between ">
            <h4 class="fw-medium tw-text-xl mb-0">Client</h4>
            <ol class="breadcrumb">
                <li class="breadcrumb-item active" aria-current="page">{{ __('Clients') }}</li>
            </ol>
        </div>
        <!-- END PAGE HEADER -->

        <!-- APP CONTENT -->
        <div class="main-content app-content">
            <div class="container-fluid">
                <!-- Start::row-1 -->
                <div class="card custom-card">
                    <div class="card-body">
                        <x-tab-button-parent>
                            @can ('clients.viewAny')
                                <x-tab-button id="pills-list-clients-tab" data-bs-toggle="pill-clients-index" target="pills-list-clients" selected="true" label="List clients" />
                            @endcan

                            @can ('clients.create')
                                <x-tab-button id="pills-create-client-tab" data-bs-toggle="pill-clients-index" target="pills-create-client" selected="false" label="Create client" />
                            @endcan
                        </x-tab-button-parent>
                    </div>
                </div>
                <x-tab-content-parent>
                    @can ('clients.viewAny')
                        <x-tab-content active="true" id="pills-list-clients" labelledby="pills-list-clients-tab">
                            <livewire:employee.clients.list />
                        </x-tab-content>
                    @endcan

                    @can ('clients.create')
                        <x-tab-content id="pills-create-client" labelledby="pills-create-client-tab">
                            <livewire:employee.clients.create />
                        </x-tab-content>
                    @endcan
                </x-tab-content-parent>
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
                localStorage.setItem('EmployeeClientIndexActivePillId', selector);
            };

            const getPillId = () => {
                const activePillId = localStorage.getItem('EmployeeClientIndexActivePillId');

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

                Livewire.on('brand-created', () => {
                    toastr['success']('Brand created successfully.')
                })
            })
        </script>

    @endsection
</x-app-layout>
