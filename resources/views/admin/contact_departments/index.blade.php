<x-app-layout>
    @section('styles')


    @endsection

    @section('content')

        <!-- PAGE HEADER -->
        <div class="page-header-breadcrumb d-md-flex d-block align-items-center justify-content-between ">
            <h1 class="fw-medium tw-text-xl tw-text-white mb-0">Contact departments</h1>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="javascript:void(0);" class="text-white-50">{{ __('Admin') }}</a>
                </li>
                <li class="breadcrumb-item active" aria-current="page">{{ __('Contact departments') }}</li>
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
                            <x-tab-button id="pills-list-contact-departments-tab" data-bs-toggle="pill-contact-departments-index" target="pills-contact-departments"
                                          selected="true" label="Contact departments"/>
                        </x-tab-button-parent>
                    </div>
                </div>
                <x-tab-content-parent>
                    <x-tab-content active="true" id="pills-list-list-contact-departments" labelledby="pills-list-contact-departments-tab">
                        <div class="row">
                            <div class="col-lg-4">
                                <livewire:admin.contact-departments.create />
                            </div>
                            <div class="col-lg-8">
                                <livewire:admin.contact-departments.list />
                            </div>
                        </div>
                    </x-tab-content>
                </x-tab-content-parent>
            </div>
        </div>
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
                localStorage.setItem('ContactDepartmentIndexActivePillId', selector);
            };

            const getPillId = () => {
                const activePillId = localStorage.getItem('ContactDepartmentIndexActivePillId');

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
                Livewire.on('contact-department-created', () => {
                    toastr['success']('Contact department created successfully.')
                })
            })
        </script>
    @endsection
</x-app-layout>
