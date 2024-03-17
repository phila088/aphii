<x-app-layout>
    @section('styles')

    @endsection

    @section('content')

        <!-- PAGE HEADER -->
        <div class="page-header-breadcrumb d-md-flex d-block align-items-center justify-content-between ">
            <h4 class="fw-medium mb-0">{{ __('Categories') }}</h4>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="javascript:void(0);" class="text-white-50">{{ __('Admin') }}</a>
                </li>
                <li class="breadcrumb-item"><a href="javascript:void(0);" class="text-white-50">{{ __('Documents') }}</a>
                </li>
                <li class="breadcrumb-item active" aria-current="page">{{ __('Categories') }}</li>
            </ol>
        </div>
        <!-- END PAGE HEADER -->

        <!-- APP CONTENT -->
        <div class="main-content app-content">
            <div class="toast-container position-fixed bottom-0 end-0 p-3 tw-z-[9999]">
                <div id="bottomright-Toast" class="toast colored-toast" role="alert" aria-live="assertive"
                     aria-atomic="true">
                    <div class="toast-header bg-primary text-fixed-white">
                        <img class="bd-placeholder-img rounded me-2" src="{{asset('build/assets/images/brand-logos/toggle-dark.png')}}" alt="...">
                        <strong class="me-auto">Title...</strong>
                        <button type="button" class="btn-close" data-bs-dismiss="toast"
                                aria-label="Close"></button>
                    </div>
                    <div class="toast-body">
                        content...
                    </div>
                </div>
            </div>
            <div class="container-fluid">
                <!-- Start::row-1 -->
                <div class="row">
                    <div class="col-xl-12">
                        <div class="card custom-card">
                            <div class="card-body p-4">
                                <div class="card-title">
                                    <h1 class="text-lg">Personal Dashboard</h1>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- END APP CONTENT -->

    @endsection

    @section('scripts')



    @endsection
</x-app-layout>

