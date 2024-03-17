<x-app-layout>
    @section('styles')

        <link rel="stylesheet" href="https://cdn.datatables.net/2.0.2/css/dataTables.tailwindcss.css">

    @endsection

    @section('content')

        <!-- PAGE HEADER -->
        <div class="page-header-breadcrumb d-md-flex d-block align-items-center justify-content-between ">
            <h4 class="fw-medium mb-0">{{ __('Clients') }}</h4>
            <ol class="breadcrumb">
                <li class="breadcrumb-item active" aria-current="page">{{ __('Clients') }}</li>
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
                            <div class="card-body p-4">
                                <div class="card-title">
                                    <h1 class="text-lg">All Clients</h1>
                                </div>
                                <div class="py-8">
                                    <hr class="border-gray-400"/>
                                </div>
                                <div class="card-body">

                                    <livewire:employee.clients.index />
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- End::row-1 -->
            </div>
            <div class="tw-hidden">
                <div class="tw-mb-8 tw-w-24 tw-px-4 tw-me-4 tw-border tw-placeholder-gray-500 tw-ml-2 tw-px-3 tw-py-2 tw-rounded-lg tw-border-gray-200 focus:tw-border-blue-500 focus:tw-ring focus:tw-ring-blue-500 focus:tw-ring-opacity-50 dark:tw-bg-gray-800 dark:tw-border-gray-600 dark:tw-focus:tw-border-blue-500 dark:tw-placeholder-gray-400 tw-border tw-w-fit tw-px-3 tw-py-2 tw-rounded-lg tw-border-gray-200 focus:tw-border-blue-500 focus:tw-ring focus:tw-ring-blue-500 focus:tw-ring-opacity-50 dark:tw-bg-gray-800 dark:tw-border-gray-600 dark:focus:tw-border-blue-500 tw-font-semibold tw-bg-gray-100 dark:tw-bg-gray-700/75 tw-bg-white dark:tw-bg-gray-800 tw-relative tw-inline-flex tw-justify-center tw-items-center tw-space-x-2 tw-border tw-px-4 tw-py-2 tw--mr-px tw-leading-6 hover:tw-z-10 focus:z-10 active:z-10 tw-border-gray-200 active:tw-border-gray-200 active:tw-shadow-none dark:tw-border-gray-700 dark:tw-active:border-gray-700 tw-rounded-l-lg tw-rounded-r-lg tw-text-gray-800 hover:tw-text-gray-900 hover:tw-border-gray-300 hover:tw-shadow-sm focus:tw-ring focus:tw-ring-gray-300 focus:tw-ring-opacity-25 dark:tw-text-gray-300 dark:hover:tw-border-gray-600 dark:hover:tw-text-gray-200 dark:focus:tw-ring-gray-600 dark:focus:tw-ring-opacity-40 tw-text-gray-300 dark:tw-text-gray-600 dataTable tw-min-w-full tw-text-sm tw-align-middle tw-whitespace-nowrap tw-divide-y tw-divide-gray-200 dark:tw-divide-gray-700 tw-text-center tw-px-6 tw-py-2 tw-text-xs tw-font-medium tw-text-gray-500 tw-uppercase even:tw-bg-gray-50 dark:even:tw-bg-gray-900/50 tw-p-3 even:tw-bg-gray-50 dark:even:tw-bg-gray-900/50 tw-p-3 tw-text-left tw-col-span-2 tw-justify-self-start tw-col-start-2 tw-justify-self-end tw-col-span-2 tw-justify-self-center"></div>
            </div>
        </div>
        <!-- END APP CONTENT -->

    @endsection

    @section('scripts')


    @endsection
</x-app-layout>
