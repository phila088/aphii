<?php

use App\Models\Brand;
use App\Models\StatusCode;
use Livewire\Volt\Component;
use Livewire\Attributes\On;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Carbon;

new class extends Component {
    public Collection $brands;

    public string $search = '';

    public function mount(): void
    {
        $this->getBrands();
    }

    #[On('brand-created')]
    #[On('brand-edited')]
    public function getBrands(): void
    {
        $this->search = '';

        $this->brands = Brand::orderBy('name')
            ->get();
    }

    public function searchResults(string $partial): void
    {
        if (!empty($partial)) {
            $this->brands = Brand::where('name', 'like', '%' . $partial . '%')
                ->orWhere('dba', 'like', '%' . $partial . '%')
                ->orWhere('abbreviation', 'like', '%' . $partial . '%')
                ->orderBy('name')
                ->get();
        } else {
            $this->getBrands();
        }
    }

    public function edit(Brand $brand): void
    {
        if (auth()->user()->can('brands.edit')) {
            redirect()->route('employee.brands.edit', [$brand]);
        } else {
            $this->dispatch('user-not-authorized');
        }
    }

    public function delete(Brand $brand): void
    {
        $this->authorize('brands.delete');

        $brand->delete();

        $this->getBrands();
    }

    public function view(Brand $brand): void
    {
        if (auth()->user()->can('brands.view')) {
            redirect()->route('employee.brands.view', [$brand]);
        } else {
            $this->dispatch('user-not-authorized');
        }
    }

    public function getStatus(Brand $brand)
    {
        $brandStatus = $brand->status;
        $title = StatusCode::select('title')
            ->where('code', '=', $brandStatus)
            ->limit(1)
            ->get();

        if (!empty($title[0])) {
            return $brand->status . ' - ' . $title[0]->title;
        } else {
            return null;
        }
    }

}; ?>

<div>
    <div class="card custom-card">
        <div class="card-header">
            <div class="tw-flex tw-justify-between tw-items-center tw-w-full">
                <h2>All brands</h2>
                <div>
                    <label for="search" class="sr-only">Search</label>
                    <input type="text" id="search" wire:model="search" class="form-control form-control-sm rounded-pill" placeholder="Search" x-on:input="$wire.searchResults($el.value);">
                </div>
            </div>
        </div>
        <div class="card-body">
            <ul class="list-group">
                @empty ($brands[0]))
                    <x-no-data />
                @else
                    @foreach ($brands as $brand)
                        <li class="list-group-item" >
                            <div class="d-flex w-100 justify-content-between align-items-center">
                                <div class="row">
                                    <div class="col-auto d-flex align-items-center">
                                        <span class="avatar avatar-xxl avatar-rounded my-auto">
                                            <img src="{{ asset($brand->logo_path) }}" alt="">
                                        </span>
                                    </div>
                                    <div class="col-auto">
                                        <table class="table table-borderless table-sm">
                                            <tbody>
                                            <tr>
                                                <th>Name:</th>
                                                <td>{{ $brand->name }}</td>
                                            </tr>
                                            <tr>
                                                <th>Abbreviation:</th>
                                                <td>{{ $brand->abbreviation }}</td>
                                            </tr>
                                            <tr>
                                                <th>Status:</th>
                                                <td>{{ $brand->status }}</td>
                                            </tr>
                                            <tr>
                                                <th>Created:</th>
                                                <td>{{ Carbon::parse($brand->created_at)->timezone(auth()->user()->timezone)->format('m-d-Y g:i A') }}</td>
                                            </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                <div>
                                    @can ('brands.view')
                                        <button type="button" class="btn btn-icon btn-sm btn-success-light rounded-pill btn-wave waves-effect waves-light" wire:click.prevent="view({{ $brand->id }})"><i class="bi bi-binoculars"></i></button>
                                    @endcan
                                    @can ('brands.edit')
                                        <button type="button" class="btn btn-icon btn-sm btn-info-light rounded-pill btn-wave waves-effect waves-light" wire:click.prevent="edit({{ $brand->id }})"><i class="bi bi-pencil"></i></button>
                                    @endcan
                                    @can ('brands.delete')
                                        <button type="button" class="btn btn-icon btn-sm btn-danger-light rounded-pill btn-wave waves-effect waves-light" wire:click.prevent="delete({{ $brand->id }})" wire:confirm="Are you sure you want to delete this brand?"><i class="bi bi-trash"></i></button>
                                    @endcan
                                </div>
                            </div>
                        </li>
                    @endforeach
                @endempty
            </ul>
        </div>
    </div>
</div>
