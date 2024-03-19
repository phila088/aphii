<x-app-layout>
    @section('styles')


    @endsection

    @section('content')

        <!-- PAGE HEADER -->
        <div class="page-header-breadcrumb d-md-flex d-block align-items-center justify-content-between ">
            <h4 class="fw-medium mb-0">{{ __('Edit Client') }}</h4>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('employee.clients.index') }}" class="text-white-50">{{ __('Client') }}</a>
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
                            <div class="card-body p-4">
                                <div class="card-title">
                                    <h1 class="text-lg">Header</h1>
                                </div>
                                <div class="py-8">
                                    <hr class="border-gray-400"/>
                                </div>
                                <div class="card-body">
                                    @livewire('employee.clients.edit', ['id' => $id])
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
