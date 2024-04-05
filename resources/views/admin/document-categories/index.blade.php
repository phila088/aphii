<x-app-layout>
    @section('styles')


    @endsection

    @section('content')

        <!-- PAGE HEADER -->
        <div class="page-header-breadcrumb d-md-flex d-block align-items-center justify-content-between ">
            <h1 class="fw-medium tw-text-xl tw-text-white mb-0">Document categories</h1>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="javascript:void(0);" class="text-white-50">{{ __('Admin') }}</a>
                </li>
                <li class="breadcrumb-item active" aria-current="page">{{ __('Document categories') }}</li>
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
                            <x-tab-button id="pills-list-document-categories-tab" data-bs-toggle="pill-document-categories-index" target="pills-list-document-categories"
                                          selected="true" label="Document categories"/>
                        </x-tab-button-parent>
                    </div>
                </div>
                <x-tab-content-parent>
                    <x-tab-content active="true" id="pills-list-document-categories" labelledby="pills-list-document-categories-tab">
                        <div class="row">
                            <div class="col-lg-4">
                                <livewire:admin.document-categories.create @documment-category-created="$refresh" />
                            </div>
                            <div class="col-lg-8">
                                <livewire:admin.document-categories.list />
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
                localStorage.setItem('DocumentCategoriesIndexActivePillId', selector);
            };

            const getPillId = () => {
                const activePillId = localStorage.getItem('DocumentCategoriesIndexActivePillId');

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
                Livewire.on('document-category-created', () => {
                    toastr['success']('Document category created successfully.')
                })
                Livewire.on('node-moved', () => {
                    toastr['success']('Document category moved successfully.')
                })
                Livewire.on('node-deleted', () => {
                    toastr['success']('Document category deleted successfully.')
                })
                Livewire.on('document-category-updated', () => {
                    toastr['success']('Document category created successfully.')
                })
                Livewire.on('tree-fixed', () => {
                    toastr['success']('Tree fixed successfully.')
                })
            })
        </script>
    @endsection
</x-app-layout>