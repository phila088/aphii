<?php

use App\Models\BrandHoliday;
use Livewire\Volt\Component;
use Livewire\Attributes\Validate;
use Livewire\Attributes\On;

new class extends Component {
    public BrandHoliday $brandHoliday;

    #[Validate('required|string|min:2|max:50')]
    public string $holiday_name = '';
    #[Validate('required|date')]
    public string $date;
    #[Validate('required|string')]
    public string $open;
    #[Validate('required|string')]
    public string $close;

    public function mount(): void
    {
        $this->holiday_name = $this->brandHoliday->holiday_name;
        $this->date = $this->brandHoliday->date;
        $this->open = $this->brandHoliday->open;
        $this->close = $this->brandHoliday->close;
    }

    public function update(): void
    {
        $this->authorize('brand-holidays.edit');

        $validated = $this->validate();

        $this->brandHoliday->update($validated);

        $this->dispatch('brand-holiday-edited');
    }

    public function cancel(): void
    {
        $this->dispatch('brand-holiday-edit-canceled');
    }
}; ?>

<div>
    <form wire:submit="update" novalidate autocomplete="off">
        <div class="card">
            <div class="card-header">
                <h1>Update holiday</h1>
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
                <x-submit-cancel id="brand-holiday-create" />
            </div>
        </div>
    </form>
</div>
