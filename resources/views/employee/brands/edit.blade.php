<x-app-layout>
    @section('styles')


    @endsection

    @section('content')

        <!-- PAGE HEADER -->
        <div class="page-header-breadcrumb d-md-flex d-block align-items-center justify-content-between ">
            <h4 class="fw-medium tw-text-xl mb-0">{{ __('Edit Brand') }}</h4>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('employee.brands.index') }}" class="text-white-50">{{ __('Brands') }}</a>
                </li>
                <li class="breadcrumb-item active" aria-current="page">{{ __('Edit') }}</li>
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
                                <h1>{{ $brand->legal_name }}</h1>
                                <div class="tw-flex tw-items-center tw-gap-x-1">
                                    <a href="{{ route('employee.brands.index') }}" class="btn btn-danger btn-sm">
                                        Cancel
                                        <i class="bi bi-x-circle"></i>
                                    </a>
                                </div>
                            </div>
                            <div class="card-body tw-p-4">
                                <x-tab-button-parent>
                                    <x-tab-button id="pills-general-tab" data-bs-toggle="pill-brand-edit" target="pills-general" selected="true" label="General" />

                                    <x-tab-button id="pills-addresses-tab" data-bs-toggle="pill-brand-edit" target="pills-addresses" selected="false" label="Addresses" />

                                    <x-tab-button id="pills-emails-tab" data-bs-toggle="pill-brand-edit" target="pills-emails" selected="false" label="Emails" />

                                    <x-tab-button id="pills-holidays-tab" data-bs-toggle="pill-brand-edit" target="pills-holidays" selected="false" label="Holidays" />

                                    <x-tab-button id="pills-hours-tab" data-bs-toggle="pill-brand-edit" target="pills-hours" selected="false" label="Hours" />

                                    <x-tab-button id="pills-phone-numbers-tab" data-bs-toggle="pill-brand-edit" target="pills-phone-numbers" selected="false" label="Phone numbers" />

                                    <x-tab-button id="pills-profile-tab" data-bs-toggle="pill-brand-edit" target="pills-profile" selected="false" label="Profile" />
                                </x-tab-button-parent>

                                <x-tab-content-parent>
                                    <x-tab-content active="true" id="pills-general" labelledby="pills-general-tab">
                                        @livewire('employee.brands.edit-general', ['brand' => $brand])
                                    </x-tab-content>

                                    <x-tab-content id="pills-addresses" labelledby="pills-addresses-tab">
                                        @livewire('employee.brand-addresses.create', ['brand' => $brand])
                                        @livewire('employee.brand-addresses.index', ['brand' => $brand])
                                    </x-tab-content>

                                    <x-tab-content id="pills-emails" labelledby="pills-emails-tab">
                                        @livewire('employee.brand-emails.create')
                                        @livewire('employee.brand-emails.edit')
                                    </x-tab-content>

                                    <x-tab-content id="pills-holidays" labelledby="pills-holidays-tab">
                                        ...
                                    </x-tab-content>

                                    <x-tab-content id="pills-hours" labelledby="pills-hours-tab">
                                        ...
                                    </x-tab-content>

                                    <x-tab-content id="pills-phone-numbers" labelledby="pills-phone-numbers-tab">
                                        ...
                                    </x-tab-content>

                                    <x-tab-content id="pills-profile" labelledby="pills-phone-profile">
                                        ...
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
            })
        </script>


    @endsection
</x-app-layout>
