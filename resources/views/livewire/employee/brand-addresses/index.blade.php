<?php

use App\Models\BrandAddress;
use Livewire\Volt\Component;
use Livewire\Attributes\On;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Carbon;

new class extends Component {
    public $brand;
    public ?Collection $brandAddresses;
    public string $searchTerm = '';

    public ?BrandAddress $editing = null;

    public function mount(): void
    {
        $this->getAddresses();
    }

    #[On('brand-address-created')]
    public function getAddresses(): void
    {
        $this->brandAddresses = BrandAddress::with('user', 'brand')
            ->where('brand_id', '=', $this->brand->id)
            ->orderBy('title')
            ->get();
    }

    public function edit(BrandAddress $address)
    {
        $this->editing = $address;

        $this->getAddresses();
    }

    #[On('brand-address-edit-canceled')]
    #[On('brand-address-updated')]
    public function disableEditing(): void
    {
        $this->editing = null;

        $this->getAddresses();
    }

    public function delete(BrandAddress $address): void
    {
        $address->delete();

        $this->dispatch('brand-address-deleted');

        $this->getAddresses();
    }

    public function searchResults(string $partial): void
    {
        if (!empty($this->searchTerm)) {
            $this->brandAddresses = BrandAddress::where('brand_id', '=', $this->brand->id)
                ->whereAny([
                    'title',
                    'building_number',
                    'pre_direction',
                    'street_name',
                    'street_type',
                    'post_direction',
                    'city',
                    'state',
                    'zip',
                    'po_box'
                ], 'LIKE', '%' . $partial . '%')->orderBy('title')->get();
        } else {
            $this->getAddresses();
        }
    }
}; ?>

<div>
    <div class="card custom-card">
        <div class="card-header">
            <div class="d-flex justify-content-between align-items-center w-100">
                <h1>All addresses</h1>
                <div>
                    <label for="search" class="sr-only">Search</label>
                    <input type="text" id="search" wire:model="searchTerm" class="form-control form-control-sm rounded-pill" placeholder="Search" x-on:input="$wire.searchResults($el.value);">
                </div>
            </div>
        </div>
        <div class="card-body">
            <ul class="list-group">
                @if(!empty($brandAddresses[0]))
                    @foreach ($brandAddresses as $brandAddress)
                        <li class="list-group-item">
                            <div class="d-flex justify-content-between align-items-center w-100">
                                <div class="col-auto">
                                    <table class="table table-borderless table-sm">
                                        <tbody>
                                        <tr>
                                            <th>Name: </th>
                                            <td>{{ $brandAddress->title }}</td>
                                        </tr>
                                        <tr>
                                            <th>Address: </th>
                                            <td>
                                                <address class="mb-0">
                                                    <br />
                                                    {{ $brandAddress->building_number }}
                                                    @if(!empty($brandAddress->pre_direction))
                                                        {{ $brandAddress->pre_direction }}
                                                    @endif
                                                    {{ $brandAddress->street_name }}
                                                    {{ $brandAddress->street_type }}
                                                    @if(!empty($brandAddress->post_direction))
                                                        {{ $brandAddress->post_direction }}
                                                    @endif
                                                    @if(!empty($brandAddress->unit_type))
                                                        <br />
                                                        {{ $brandAddress->unit_type }}
                                                        {{ $brandAddress->unit }}
                                                    @endif
                                                    <br />
                                                    {{ $brandAddress->city }},
                                                    {{ $brandAddress->state }}
                                                    {{ $brandAddress->zip }}
                                                </address>
                                            </td>
                                        </tr>
                                        <tr>
                                            <th>Created by: </th>
                                            <td>{{ $brandAddress->user->name }}</td>
                                        </tr>
                                        <tr>
                                            <th>Created: </th>
                                            <td>{{ Carbon::parse($brandAddress->created_at)->timezone(auth()->user()->timezone)->format('m-d-Y G:i') }}</td>
                                        </tr>
                                        </tbody>
                                    </table>
                                </div>
                                <div>
                                    @can ('brands.edit')
                                        <button type="button" class="btn btn-icon btn-sm btn-info-light rounded-pill btn-wave waves-effect waves-light" wire:click.prevent="edit({{ $brandAddress->id }})"><i class="bi bi-pencil"></i></button>
                                    @endcan
                                    @can ('brands.delete')
                                        <button type="button" class="btn btn-icon btn-sm btn-danger-light rounded-pill btn-wave waves-effect waves-light" wire:click.prevent="delete({{ $brandAddress->id }})" wire:confirm="Are you sure you want to delete this brand?"><i class="bi bi-trash"></i></button>
                                    @endcan
                                </div>
                            </div>
                            @if ($brandAddress->is($editing))
                                <div class="w-100">
                                    <livewire:employee.brand-addresses.edit :brandAddress="$brandAddress" :brand="$brand" :key="$brandAddress->id" />
                                </div>
                           @endif
                        </li>
                    @endforeach
                @else
                    <x-no-data />
                @endif
            </ul>
        </div>
    </div>
</div>
