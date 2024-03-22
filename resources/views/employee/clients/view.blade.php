<x-app-layout>
    @section('styles')


    @endsection

    @section('content')

        <!-- PAGE HEADER -->
        <div class="page-header-breadcrumb d-md-flex d-block align-items-center justify-content-between ">
            <h4 class="fw-medium mb-0">{{ __('View') }}</h4>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('Employee.clients.index') }}" class="text-white-50">{{ __('Clients') }}</a>
                </li>
                <li class="breadcrumb-item active" aria-current="page">{{ $client->legal_name }}</li>
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
                            <div class="card-body tw-p-4">
                                <div class="card-title">
                                    <div class="tw-flex tw-justify-between">
                                        <h1 class="tw-text-lg">{{ __('View') }} {{ $client->legal_name }}</h1>
                                        <div class="tw-flex tw-items-center tw-gap-x-1">
                                            <div class="tw-inline-block">
                                                <a
                                                    href="{{ route('Employee.clients.edit', $client->id) }}"
                                                    class="tw-size-8 tw-inline-flex tw-justify-center tw-items-center tw-gap-x-2 tw-text-sm tw-font-semibold tw-rounded-full tw-border tw-border-transparent tw-text-gray-500 hover:tw-bg-gray-100 disabled:tw-opacity-50 disabled:tw-pointer-events-none dark:tw-text-gray-400 dark:hover:tw-bg-gray-700 dark:focus:tw-outline-none dark:focus:tw-ring-1 dark:focus:tw-ring-gray-600"
                                                    data-bs-toggle="tooltip"
                                                    data-bs-placement="top"
                                                    data-bs-title="Edit {{ $client->legal_name }}"
                                                >
                                                    <svg class="tw-flex-shrink-0 tw-size-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-file-pen-line"><path d="m18 5-3-3H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2"/><path d="M8 18h1"/><path d="M18.4 9.6a2 2 0 1 1 3 3L17 17l-4 1 1-4Z"/></svg>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="tw-py-8">
                                    <hr class="tw-border-gray-400"/>
                                </div>
                                <div class="card-body">
                                    @livewire('Employee.clients.view', ['client' => $client])
                                </div>
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


    @endsection
</x-app-layout>
