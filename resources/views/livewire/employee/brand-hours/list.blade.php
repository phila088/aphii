<?php

use App\Models\Brand;
use App\Models\BrandHour;
use Livewire\Volt\Component;
use Livewire\Attributes\On;
use Illuminate\Database\Eloquent\Collection;

new class extends Component {
    public Brand $brand;
    public Collection $brandHours;
    public ?BrandHour $editing = null;

    public function mount(): void
    {
        $this->getBrandHours();
    }

    #[On('brand-hours-created')]
    public function getBrandHours(): void
    {
        $this->brandHours = BrandHour::where('brand_id', $this->brand->id)
            ->orderBy('title')
            ->get();
    }

    public function edit(BrandHour $brandHour): void
    {
        $this->editing = $brandHour;

        $this->getBrandHours();
    }

    #[On('brand-hours-edited')]
    #[On('brand-hours-edit-canceled')]
    public function disableEditing(): void {
        $this->editing = null;

        $this->getBrandHours();
    }
}; ?>

<div>
    <div class="card custom-card">
        <div class="card-header">
            <div class="d-flex justify-content-between align-items-center w-100">
                <h2>All hours</h2>
                <div>
                    <input id="search-term" wire:model="search_term" x-on:input="$wire.searchResults($el.value)"
                           placeholder="Search" class="form-control form-control-sm rounded-pill"/>
                </div>
            </div>
        </div>
        <div class="card-body">
            <ul class="list-group">
                @empty ($brandHours[0])
                    <x-no-data />
                @else
                    @foreach ($brandHours as $brandHour)
                        <li class="list-group-item">
                            <div class="d-flex justify-content-between align-items-center">
                                <div class="col-auto">
                                    <table class="table table-sm">
                                        <thead>
                                        <tr>
                                            <th>{{ $brandHour->title }}</th>
                                            <th>Monday</th>
                                            <th>Tuesday</th>
                                            <th>Wednesday</th>
                                            <th>Thursday</th>
                                            <th>Friday</th>
                                            <th>Saturday</th>
                                            <th>Sunday</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <tr>
                                            <th>Open</th>
                                            <td>{{ $brandHour->monday_open }}</td>
                                            <td>{{ $brandHour->tuesday_open }}</td>
                                            <td>{{ $brandHour->wednesday_open }}</td>
                                            <td>{{ $brandHour->thursday_open }}</td>
                                            <td>{{ $brandHour->friday_open }}</td>
                                            <td>{{ $brandHour->saturday_open }}</td>
                                            <td>{{ $brandHour->sunday_open }}</td>
                                        </tr>
                                        <tr>
                                            <th>Close</th>
                                            <td>{{ $brandHour->monday_close }}</td>
                                            <td>{{ $brandHour->tuesday_close }}</td>
                                            <td>{{ $brandHour->wednesday_close }}</td>
                                            <td>{{ $brandHour->thursday_close }}</td>
                                            <td>{{ $brandHour->friday_close }}</td>
                                            <td>{{ $brandHour->saturday_close }}</td>
                                            <td>{{ $brandHour->sunday_close }}</td>
                                        </tr>
                                        </tbody>
                                    </table>
                                </div>
                                <div>
                                    @can ('brands.edit')
                                        <button type="button" class="btn btn-icon btn-sm btn-info-light rounded-pill btn-wave waves-effect waves-light" wire:click.prevent="edit({{ $brandHour->id }})"><i class="bi bi-pencil"></i></button>
                                    @endcan
                                    @can ('brands.delete')
                                        <button type="button" class="btn btn-icon btn-sm btn-danger-light rounded-pill btn-wave waves-effect waves-light" wire:click.prevent="delete({{ $brandHour->id }})" wire:confirm="Are you sure you want to delete this brands hours?"><i class="bi bi-trash"></i></button>
                                    @endcan
                                </div>
                            </div>
                            @if ($brandHour->is($editing))
                                <livewire:employee.brand-hours.edit :brandHour="$brandHour" :key="$brandHour->id" />
                            @endif
                        </li>
                    @endforeach
                @endempty
            </ul>
        </div>
    </div>
</div>
