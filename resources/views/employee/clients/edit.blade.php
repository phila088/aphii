<x-app-layout>
    @section('styles')


    @endsection

    @section('content')

        <!-- PAGE HEADER -->
        <div class="page-header-breadcrumb d-md-flex d-block align-items-center justify-content-between ">
            <h4 class="fw-medium tw-text-xl mb-0"></h4>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('employee.brands.index') }}"
                                               class="text-white-50">{{ __('Brands') }}</a>
                </li>
                <li class="breadcrumb-item active" aria-current="page">{{ __('Edit') }}</li>
            </ol>
        </div>
        <!-- END PAGE HEADER -->

        <!-- APP CONTENT -->
        <div class="main-content app-content">
            <div class="container-fluid">
                <!-- Start::row-1 -->
                <div class="card custom-card">
                    <div class="card-body">
                        <div class="tw-flex tw-justify-between tw-items-center">
                            <x-tab-button-parent>
                                @can ('brands.edit')
                                    <x-tab-button id="pills-general-tab" data-bs-toggle="pill-client-edit"
                                                  target="pills-general" selected="true" label="General"/>
                                @endcan

                                @canany (['client-billing-instructions.create', 'client-billing-instructions.viewAny'])
                                    <x-tab-button id="pills-client-billing-instructions-tab" data-bs-toggle="pill-client-edit"
                                                  target="pills-client-billing-instructions" selected="false" label="Billing instructions"/>
                                @endcanany

                                @canany (['client-contacts.create', 'client-contacts.viewAny'])
                                    <x-tab-button id="pills-client-contacts-tab" data-bs-toggle="pill-client-edit"
                                                  target="pills-client-contacts" selected="false" label="Contacts" />
                                @endcanany
                            </x-tab-button-parent>
                            <div class="tw-flex tw-items-center tw-gap-x-1">
                                <a href="{{ route('employee.brands.index') }}" class="btn btn-danger btn-sm rounded-pill">
                                    Cancel
                                    <i class="bi bi-x-circle"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card custom-card">
                    <div class="card-body">
                        <h1>{{ $client->name }}</h1>
                    </div>
                </div>
                <x-tab-content-parent>
                    @can ('clients.edit')
                        <x-tab-content active="true" id="pills-general" labelledby="pills-general-tab">
                            <livewire:employee.clients.edit :client="$client" />
                        </x-tab-content>
                    @endcan

                    @canany (['client-billing-instructions.create', 'client-billing-instructions.viewAny'])
                        <x-tab-content id="pills-client-billing-instructions" labelledby="pills-client-billing-instructions-tab">
                            <livewire:employee.client-billing-instructions.create :client="$client" />
                        </x-tab-content>
                    @endcanany

                    @canany (['client-contacts.create', 'client-contacts.viewAny'])
                        <x-tab-content id="pills-client-contacts" labelledby="pills-client-contacts-tab">
                            ...
                        </x-tab-content>
                    @endcanany
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
                    const {target} = event;
                    const {id: targetId} = target;

                    savePillId(targetId);
                });
            });

            const savePillId = (selector) => {
                localStorage.setItem('client{{ $client->id }}EditActivePillId', selector);
            };

            const getPillId = () => {
                const activePillId = localStorage.getItem('client{{ $client->id }}EditActivePillId');

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

                Livewire.on('unauthorized-action', () => {
                    toastr['error']('You are not authorized to complete that action.')
                })
            })
        </script>

    @endsection
</x-app-layout>
