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
                                    <x-tab-button id="pills-general-tab" data-bs-toggle="pill-brand-edit"
                                                  target="pills-general" selected="true" label="General"/>
                                @endcan

                                @canany (['brand-addresses.create', 'brand-addresses.viewAny'])
                                    <x-tab-button id="pills-addresses-tab" data-bs-toggle="pill-brand-edit"
                                                  target="pills-addresses" selected="false" label="Addresses"/>
                                @endcanany

                                @canany (['brand-emails.create', 'brand-emails.viewAny'])
                                    <x-tab-button id="pills-emails-tab" data-bs-toggle="pill-brand-edit"
                                                  target="pills-emails" selected="false" label="Emails"/>
                                @endcanany

                                @canany (['brand-holidays.create', 'brand-holidays.viewAny'])
                                    <x-tab-button id="pills-holidays-tab" data-bs-toggle="pill-brand-edit"
                                                  target="pills-holidays" selected="false" label="Holidays"/>
                                @endcanany

                                @canany (['brand-hours.create', 'brand-hours.viewAny'])
                                    <x-tab-button id="pills-hours-tab" data-bs-toggle="pill-brand-edit" target="pills-hours"
                                                  selected="false" label="Hours"/>
                                @endcanany

                                @canany (['brand-phone-numbers.create', 'brand-phone-numbers.viewAny'])
                                    <x-tab-button id="pills-phone-numbers-tab" data-bs-toggle="pill-brand-edit"
                                                  target="pills-phone-numbers" selected="false" label="Phone numbers"/>
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
                        <h1>{{ $brand->name }}</h1>
                    </div>
                </div>
                <x-tab-content-parent>
                    @can ('brands.edit')
                        <x-tab-content active="true" id="pills-general" labelledby="pills-general-tab">
                            @livewire('employee.brands.edit-general', ['brand' => $brand])
                        </x-tab-content>
                    @endcan

                    @canany (['brand-addresses.create', 'brand-addresses,viewAny'])
                        <x-tab-content id="pills-addresses" labelledby="pills-addresses-tab">
                            @livewire('employee.brand-addresses.create', ['brand' => $brand])
                            @livewire('employee.brand-addresses.index', ['brand' => $brand])
                        </x-tab-content>
                    @endcanany

                    @canany (['brand-emails.create', 'brand-emails.viewAny'])
                        <x-tab-content id="pills-emails" labelledby="pills-emails-tab">
                            @livewire('employee.brand-emails.create', ['brand' => $brand])
                            @livewire('employee.brand-emails.list', ['brand' => $brand])
                        </x-tab-content>
                    @endcanany

                    @canany (['brand-holidays.create', 'brand-holidays.viewAny'])
                        <x-tab-content id="pills-holidays" labelledby="pills-holidays-tab">
                            <livewire:employee.brand-holidays.create :brand="$brand"/>
                            <livewire:employee.brand-holidays.list :brand="$brand" />
                        </x-tab-content>
                    @endcanany

                    @canany (['brand-hours.create', 'brand-hours.viewAny'])
                        <x-tab-content id="pills-hours" labelledby="pills-hours-tab">
                            <livewire:employee.brand-hours.create :brand="$brand" />
                            <livewire:employee.brand-hours.list :brand="$brand" />
                        </x-tab-content>
                    @endcanany

                    @canany (['brand-phone-numbers.create', 'brand-phone-numbers.viewAny'])
                        <x-tab-content id="pills-phone-numbers" labelledby="pills-phone-numbers-tab">
                            <livewire:employee.brand-phone-numbers.create :brand="$brand" />
                            <livewire:employee.brand-phone-numbers.list :brand="$brand" />
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
                localStorage.setItem('brand{{ $brand->id }}EditActivePillId', selector);
            };

            const getPillId = () => {
                const activePillId = localStorage.getItem('brand{{ $brand->id }}EditActivePillId');

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
                Livewire.on('brand-updated', () => {
                    toastr['success']('Brand updated successfully.')
                })
                Livewire.on('brand-address-created', () => {
                    toastr['success']('Address created successfully.')
                })
                Livewire.on('brand-address-updated', () => {
                    toastr['success']('Address updated successfully.')
                })
                Livewire.on('brand-address-deleted', () => {
                    toastr['success']('Address deleted successfully.')
                })
                Livewire.on('brand-email-created', () => {
                    toastr['success']('Email created successfully.')
                })
                Livewire.on('brand-email-deleted', () => {
                    toastr['success']('Email deleted successfully.')
                })
                Livewire.on('brand-email-updated', () => {
                    toastr['success']('Email updated successfully')
                })
                Livewire.on('brand-hours-created', () => {
                    toastr['success']('Brand hours created successfully')
                })
                Livewire.on('brand-phone-number-created', () => {
                    toastr['success']('Email created successfully.')
                })
                Livewire.on('brand-phone-number-deleted', () => {
                    toastr['success']('Email deleted successfully.')
                })
                Livewire.on('brand-phone-number-updated', () => {
                    toastr['success']('Email updated successfully')
                })
            })
        </script>

    @endsection
</x-app-layout>
