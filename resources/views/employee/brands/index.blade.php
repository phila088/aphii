<x-app-layout>
    @section('styles')


    @endsection

    @section('content')

        <!-- PAGE HEADER -->
        <div class="page-header-breadcrumb d-md-flex d-block align-items-center justify-content-between ">
            <h4 class="fw-medium tw-text-xl mb-0"></h4>
            <ol class="breadcrumb">
                <li class="breadcrumb-item active" aria-current="page">{{ __('Brands') }}</li>
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
                            <x-tab-button id="pills-list-brands-tab" data-bs-toggle="pill-brands-index" target="pills-list-brands" selected="true" label="List brands" />

                            @if(auth()->user()->can('brands.create'))
                                <x-tab-button id="pills-create-brand-tab" data-bs-toggle="pill-brands-index" target="pills-create-brand" selected="false" label="Create brand" />
                            @endif
                        </x-tab-button-parent>
                    </div>
                </div>
                <x-tab-content-parent>
                    <x-tab-content active="true" id="pills-list-brands" labelledby="pills-list-brands-tab">
                        <livewire:employee.brands.list />
                    </x-tab-content>

                    <x-tab-content id="pills-create-brand" labelledby="pills-create-brand-tab">
                        @if(auth()->user()->can('brands.create'))
                            <livewire:employee.brands.create />
                        @else
                            <div class="card">
                                <div class="card-body">
                                    <x-not-auth />
                                </div>
                            </div>
                        @endif
                    </x-tab-content>
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
                    localStorage.setItem('EmployeeBrandIndexActivePillId', selector);
                };

                const getPillId = () => {
                    const activePillId = localStorage.getItem('EmployeeBrandIndexActivePillId');

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
                    Livewire.on('user-not-authorized', () => {
                        toastr['error']('You are not authorized to complete that action.')
                    })
                })
            </script>

    @endsection
</x-app-layout>
