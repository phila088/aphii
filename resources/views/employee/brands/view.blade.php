<x-app-layout>
    @section('styles')


    @endsection

    @section('content')

        <div class="page-header-breadcrumb d-md-flex d-block align-items-center justify-content-between ">
            <h1 class="fw-medium tw-text-xl mb-0"></h1>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('employee.brands.index') }}"
                                               class="text-white-50">{{ __('Brands') }}</a>
                </li>
                <li class="breadcrumb-item"><a href="javascript:void(0);"
                                               class="text-white-50">{{ __('View') }}</a>
                </li>
                <li class="breadcrumb-item active" aria-current="page">{{ $brand->name }}</li>
            </ol>
        </div>
        <!-- END PAGE HEADER -->
        <div class="main-content app-content">
            <div class="container-fluid">
                <div class="card custom-card">
                    <div class="card-body">
                        <div class="tw-flex tw-justify-between tw-items-center">
                            <x-tab-button-parent>
                                @can ('brands.view')
                                    <x-tab-button id="pills-general-tab" data-bs-toggle="pill-brand-edit"
                                                  target="pills-general" selected="true" label="{{ $brand->name }}"/>
                                @endcan
                            </x-tab-button-parent>
                            <div class="tw-flex tw-items-center tw-gap-x-1">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-2">
                        <div class="card custom-card">
                            <img src="{{ asset($brand->logo_path) }}" alt="" class="card-img-top" />
                            <div class="card-body">
                                <ul class="list-group">
                                    <li class="list-group-item">
                                        <div class="d-flex justify-content-center">
                                            @can ('brands.edit')
                                                <button type="button" class="btn btn-icon btn-sm btn-info-light rounded-pill btn-wave waves-effect waves-light" wire:click.prevent="edit({{ $brand->id }})"><i class="bi bi-pencil"></i></button>
                                            @endcan
                                            @can ('brands.delete')
                                                <button type="button" class="btn btn-icon btn-sm btn-danger-light rounded-pill btn-wave waves-effect waves-light" wire:click.prevent="delete({{ $brand->id }})" wire:confirm="Are you sure you want to delete this brand?"><i class="bi bi-trash"></i></button>
                                            @endcan
                                        </div>
                                    </li>
                                    <li class="list-group-item">
                                        <div class="d-flex justify-content-center">
                                            <p>{{ $brand->name }}</p>
                                        </div>
                                    </li>
                                    @if (!empty($brand->dba))
                                        <li class="list-group-item">
                                            <div class="d-flex justify-content-center">
                                                <p>{{ $brand->dba }}</p>
                                            </div>
                                        </li>
                                    @endif
                                    <li class="list-group-item">
                                        <div class="d-flex justify-content-center">
                                            <p>{{ $brand->abbreviation }}</p>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-10">
                        <livewire:employee.brands.view-general :brand="$brand" />
                    </div>
                </div>
            </div>
        </div>

    @endsection

    @section('scripts')


    @endsection
</x-app-layout>
