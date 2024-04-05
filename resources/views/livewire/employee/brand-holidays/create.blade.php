<?php

use App\Models\BrandHoliday;
use Livewire\Volt\Component;
use Livewire\Attributes\On;
use Livewire\Attributes\Validate;

new class extends Component {
    public $brand;

    public int $brand_id;
    public string $holiday_name = '';
    public string $date = '';
    public string $open = '';
    public string $close = '';

    public function mount(): void
    {
        $this->brand_id = $this->brand->id;
    }

    public function brandHolidayCreate(): void
    {
        if (auth()->user()->can('brandholiday.create')) {
            $validated = $this->validate([
                'brand_id' => ['required', 'integer', 'exists:brands,id'],
                'holiday_name' => ['required', 'string', 'min:2', 'max:50'],
                'date' => ['required', 'date'],
                'open' => ['nullable', 'string'],
                'close' => ['nullable', 'string'],
            ]);

            if (auth()->user()->brandHoliday()->create($validated)) {
                $this->dispatch('brand-holiday-created');

                $this->holiday_name = '';
                $this->date = '';
                $this->open = '';
                $this->close = '';
            }
        } else {
            $this->dispatch('unauthorized-action');
        }
    }
}; ?>

<div>
    <form wire:submit="brandHolidayCreate" novalidate autocomplete="off">
        <div class="card custom-card">
            <div class="card-header">
                <h1>Create a holiday</h1>
            </div>
            <div class="card-body">
                <div class="row g-2">
                    <x-input id="holiday_name" model="holiday_name" label="Holiday name" />

                    <x-input type="date" id="date" model="date" label="Date" />

                    <x-input type="time" id="open" model="open" label="Open" />

                    <x-input type="time" id="close" model="close" label="Close" />
                </div>
            </div>
            <div class="card-footer">
                <x-submit id="brand-holiday-create" />
            </div>
        </div>
    </form>
</div>
