<?php

use App\Models\BrandPhoneNumber;
use App\Models\Brand;
use Livewire\Volt\Component;
use Livewire\Attributes\On;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Builder;

new class extends Component {
    public Collection $brandPhoneNumbers;
    public ?BrandPhoneNumber $editing = null;

    public Brand $brand;

    public function mount(): void
    {
        $this->getBrandPhoneNumbers();
    }

    #[On('brand-phone-number-created')]
    public function getBrandPhoneNumbers(): void
    {
        $this->brandPhoneNumbers = BrandPhoneNumber::where('brand_id', '=', $this->brand->id)
            ->orderBy('title')
            ->get();
    }

    public function edit(BrandPhoneNumber $brandPhoneNumber)
    {
        $this->editing = $brandPhoneNumber;

        $this->getBrandPhoneNumbers();
    }

    #[On('brand-phone-number-edit-canceled')]
    #[On('brand-phone-number-updated')]
    public function disableEditing(): void
    {
        $this->editing = null;

        $this->getBrandPhoneNumbers();
    }

    public function delete(BrandPhoneNumber $brandPhoneNumber)
    {
        $this->authorize('brand-phone-numbers.delete');

        $brandPhoneNumber->delete();

        $this->dispatch('brand-phone-number-deleted');

        $this->getBrandPhoneNumbers();
    }

    public function searchResults(string $partial)
    {
        if (!empty($partial)) {
            $this->brandPhoneNumbers = BrandPhoneNumber::query()
                ->where('brand_id', '=', $this->brand->id)
                ->where(function (Builder $query) use ($partial) {
                    $query->where('title', 'like', '%' . $partial . '%')
                        ->orWhere('number', 'like', '%' . $partial . '%');
                })
                ->orderBy('title')
                ->get();
        } else {
            $this->getBrandPhoneNumbers();
        }
    }

}; ?>

<div>
    <div class="card custom-card">
        <div class="card-header">
            <div class="d-flex justify-content-between align-items-center w-100">
                <h1>All phone numbers</h1>
                <div>
                    <label for="search" class="sr-only">Search</label>
                    <input type="text" id="search" wire:model="search" class="form-control form-control-sm rounded-pill" placeholder="Search" x-on:input="$wire.searchResults($el.value);">
                </div>
            </div>
        </div>
        <div class="card-body">
            <ul class="list-group">
                @empty ($brandPhoneNumbers[0])
                    <x-no-data />
                @else
                    @foreach ($brandPhoneNumbers as $brandPhoneNumber)
                        <li class="list-group-item">
                            <div class="d-flex justify-content-between align-items-center w-100">
                                <div class="col-auto">
                                    <table class="table table-borderless table-sm">
                                        <tbody>
                                        <tr>
                                            <th>Name: </th>
                                            <td>{{ $brandPhoneNumber->title }}</td>
                                        </tr>
                                        <tr>
                                            <th>Phone number: </th>
                                            <td><a href="tel:+1{{ str_replace('-', '', $brandPhoneNumber->number) }}">{{ $brandPhoneNumber->number }}</a></td>
                                        </tr>
                                        </tbody>
                                    </table>
                                </div>
                                <div>
                                    @can ('brand-phone-numbers.edit')
                                        <button type="button" class="btn btn-icon btn-sm btn-info-light rounded-pill btn-wave waves-effect waves-light" wire:click.prevent="edit({{ $brandPhoneNumber->id }})"><i class="bi bi-pencil"></i></button>
                                    @endcan
                                    @can ('brand-phone-numbers.delete')
                                        <button type="button" class="btn btn-icon btn-sm btn-danger-light rounded-pill btn-wave waves-effect waves-light" wire:click.prevent="delete({{ $brandPhoneNumber->id }})" wire:confirm="Are you sure you want to delete this brand?"><i class="bi bi-trash"></i></button>
                                    @endcan
                                </div>
                            </div>
                            @if ($brandPhoneNumber->is($editing))
                                <livewire:employee.brand-phone-numbers.edit :brandPhoneNumber="$brandPhoneNumber" :key="$brandPhoneNumber->id" />
                            @endif
                        </li>
                    @endforeach
                @endempty
            </ul>
        </div>
    </div>
</div>
