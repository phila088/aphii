<?php

use App\Models\Brand;
use App\Models\BrandHoliday;
use Livewire\Volt\Component;
use Livewire\Attributes\On;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Carbon;

new class extends Component {
    public Brand $brand;
    public string $searchPartial = '';
    public Collection $brandHolidays;
    public ?BrandHoliday $editing = null;

    public function mount(): void
    {
        $this->getHolidays();
    }

    #[On('brand-holiday-created')]
    public function getHolidays(): void
    {
        $this->brandHolidays = BrandHoliday::orderBy('date')
            ->orderBy('holiday_name')
            ->where('brand_id', $this->brand->id)
            ->get();
    }

    public function edit(BrandHoliday $brandHoliday): void
    {
        $this->editing = $brandHoliday;

        $this->getHolidays();
    }

    #[On('brand-holiday-edit-canceled')]
    #[On('brand-holiday-edited')]
    public function disableEditing(): void
    {
        $this->editing = null;

        $this->getHolidays();
    }

    public function searchResults(string $partial): void
    {
        if (!empty($partial)) {
            $this->brandHolidays = BrandHoliday::where(['holiday_name', 'date', 'open', 'close'], 'like', '%' . $partial . '%')
                ->where('brand_id', $this->brand->id)
                ->orderBy('holiday_name')
                ->get();
        } else {
            $this->getHolidays();
        }
    }
}; ?>

<div>
    <div class="card custom-card">
        <div class="card-header">
            <div class="tw-flex tw-justify-between tw-items-center w-100">
                <h1>All holidays</h1>
                <div>
                    <label for="brand-holidays-search" class="sr-only">Search</label>
                    <input type="text" id="brand-holidays-search" wire:model="searchPartial" class="form-control form-control-sm rounded-pill" placeholder="Search" x-on:input="$wire.searchResults($el.value);">
                </div>
            </div>
        </div>
        <div class="card-body">
            <ul class="list-group">
                @empty($brandHolidays[0])
                    <x-no-data />
                @else
                    @foreach ($brandHolidays as $brandHoliday)
                        <li class="list-group-item" :key="{{ $brandHoliday->id }}">
                            <div class="d-flex justify-content-between align-items-center">
                                <div class="col-auto">
                                    <table class="table table-borderless table-sm">
                                        <tbody>
                                        <tr>
                                            <th>Holiday name: </th>
                                            <td>{{ $brandHoliday->holiday_name }}</td>
                                        </tr>
                                        <tr>
                                            <th>Date: </th>
                                            <td>{{ Carbon::parse($brandHoliday->date)->timezone(auth()->user()->timezone)->format('m-d-Y') }}</td>
                                        </tr>
                                        </tbody>
                                        <tr>
                                            <th>Open: </th>
                                            <td>{{ $brandHoliday->open }}</td>
                                        </tr>
                                        <tr>
                                            <th>Close: </th>
                                            <td>{{ $brandHoliday->close }}</td>
                                        </tr>
                                        <tr>
                                            <th>Created by: </th>
                                            <td>{{ $brandHoliday->user->name }}</td>
                                        </tr>
                                        <tr>
                                            <th>Created: </th>
                                            <td>{{ Carbon::parse($brandHoliday->created_at)->timezone(auth()->user()->timezone)->format('m-d-Y G:i') }}</td>
                                        </tr>
                                    </table>
                                </div>
                                <div>
                                    @can ('brands.edit')
                                        <button type="button" class="btn btn-icon btn-sm btn-info-light rounded-pill btn-wave waves-effect waves-light" wire:click.prevent="edit({{ $brandHoliday->id }})"><i class="bi bi-pencil"></i></button>
                                    @endcan
                                    @can ('brands.delete')
                                        <button type="button" class="btn btn-icon btn-sm btn-danger-light rounded-pill btn-wave waves-effect waves-light" wire:click.prevent="delete({{ $brandHoliday->id }})" wire:confirm="Are you sure you want to delete this holiday?"><i class="bi bi-trash"></i></button>
                                    @endcan
                                </div>
                            </div>
                            @if ($brandHoliday->is($editing))
                                <livewire:employee.brand-holidays.edit :brandHoliday="$brandHoliday" :key="$brandHoliday->id" />
                            @endif
                        </li>
                    @endforeach
                @endempty
            </ul>
        </div>
    </div>
</div>
