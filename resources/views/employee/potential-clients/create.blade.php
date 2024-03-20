<x-app-layout>
    @section('styles')


    @endsection

    @section('content')

        <!-- PAGE HEADER -->
        <div class="page-header-breadcrumb d-md-flex d-block align-items-center justify-content-between ">
            <h4 class="fw-medium tw-text-xl mb-0">{{ __('Create') }}</h4>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('employee.potential-clients.index') }}" class="text-white-50">{{ __('Potential Clients') }}</a>
                </li>
                <li class="breadcrumb-item active" aria-current="page">{{ __('Create') }}</li>
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
                                <h1>Create</h1>
                                <div class="tw-flex tw-items-center tw-gap-x-1">
                                    <a href="" class="btn btn-danger btn-sm">
                                        Cancel
                                        <i class="bi bi-x-circle"></i>
                                    </a>
                                </div>
                            </div>
                            <div class="card-body tw-p-4">
                                @livewire('employee.potential-clients.create')
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
