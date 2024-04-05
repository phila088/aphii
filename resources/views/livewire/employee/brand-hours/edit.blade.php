<?php

use App\Models\BrandHour;
use Livewire\Volt\Component;
use Livewire\Attributes\Validate;

new class extends Component {
    public BrandHour $brandHour;

    #[Validate('required|int')]
    public int $brand_id;
    #[Validate('required|string')]
    public string $title;
    #[Validate('nullable|string')]
    public string $monday_open;
    #[Validate('nullable|string')]
    public string $monday_close;
    #[Validate('nullable|string')]
    public string $tuesday_open;
    #[Validate('nullable|string')]
    public string $tuesday_close;
    #[Validate('nullable|string')]
    public string $wednesday_open;
    #[Validate('nullable|string')]
    public string $wednesday_close;
    #[Validate('nullable|string')]
    public string $thursday_open;
    #[Validate('nullable|string')]
    public string $thursday_close;
    #[Validate('nullable|string')]
    public string $friday_open;
    #[Validate('nullable|string')]
    public string $friday_close;
    #[Validate('nullable|string')]
    public string $saturday_open;
    #[Validate('nullable|string')]
    public string $saturday_close;
    #[Validate('nullable|string')]
    public string $sunday_open;
    #[Validate('nullable|string')]
    public string $sunday_close;

    public function mount(): void
    {
        $this->brand_id = $this->brandHour->brand_id;
        $this->title = $this->brandHour->title;
        $this->monday_open = $this->brandHour->monday_open;
        $this->monday_close = $this->brandHour->monday_close;
        $this->tuesday_open = $this->brandHour->tuesday_open;
        $this->tuesday_close = $this->brandHour->tuesday_close;
        $this->wednesday_open = $this->brandHour->wednesday_open;
        $this->wednesday_close = $this->brandHour->wednesday_close;
        $this->thursday_open = $this->brandHour->thursday_open;
        $this->thursday_close = $this->brandHour->thursday_close;
        $this->friday_open = $this->brandHour->friday_open;
        $this->friday_close = $this->brandHour->friday_close;
        $this->saturday_open = $this->brandHour->saturday_open;
        $this->saturday_close = $this->brandHour->saturday_close;
        $this->sunday_open = $this->brandHour->sunday_open;
        $this->sunday_close = $this->brandHour->sunday_close;
    }

    public function update(): void
    {
        $this->authorize('brand-hours.edit');

        $validated = $this->validate();

        $this->brandHour->update($validated);

        $this->dispatch('brand-hours-edited');
    }

    public function cancel():void
    {
        $this->dispatch('brand-hours-edit-canceled');
    }
}; ?>

<div>
    <form wire:submit="update" novalidate autocomplete="off">
        <div class="card custom-card">
            <div class="card-header">
                <h2>Update hours</h2>
            </div>
            <div class="card-body">
                <x-input id="title" model="title" label="Title"/>
                <div class="row">
                    <table class="table table-borderless table-sm">
                        <thead>
                        <tr>
                            <th></th>
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
                            <td>
                                <input type="time" id="monday-open" wire:model="monday_open" class="form-control"/>
                                <label class="sr-only">Monday open</label>
                            </td>
                            <td>
                                <input type="time" id="tuesday-open" wire:model="tuesday_open" class="form-control"/>
                                <label class="sr-only">Tuesday open</label>
                            </td>
                            <td>
                                <input type="time" id="wednesday-open" wire:model="wednesday_open" class="form-control"/>
                                <label class="sr-only">Wednesday open</label>
                            </td>
                            <td>
                                <input type="time" id="thursday-open" wire:model="thursday_open" class="form-control"/>
                                <label class="sr-only">Thursday open</label>
                            </td>
                            <td>
                                <input type="time" id="friday-open" wire:model="friday_open" class="form-control"/>
                                <label class="sr-only">Friday open</label>
                            </td>
                            <td>
                                <input type="time" id="saturday-open" wire:model="saturday_open" class="form-control"/>
                                <label class="sr-only">Saturday open</label>
                            </td>
                            <td>
                                <input type="time" id="sunday-open" wire:model="sunday_open" class="form-control"/>
                                <label class="sr-only">Sunday open</label>
                            </td>
                        </tr>
                        <tr>
                            <th>Close</th>
                            <td>
                                <input type="time" id="monday-close" wire:model="monday_close" class="form-control"/>
                                <label class="sr-only">Monday close</label>
                            </td>
                            <td>
                                <input type="time" id="tuesday-close" wire:model="tuesday_close" class="form-control"/>
                                <label class="sr-only">Tuesday close</label>
                            </td>
                            <td>
                                <input type="time" id="wednesday-close" wire:model="wednesday_close" class="form-control"/>
                                <label class="sr-only">Wednesday close</label>
                            </td>
                            <td>
                                <input type="time" id="thursday-close" wire:model="thursday_close" class="form-control"/>
                                <label class="sr-only">Thursday close</label>
                            </td>
                            <td>
                                <input type="time" id="friday-close" wire:model="friday_close" class="form-control"/>
                                <label class="sr-only">Friday close</label>
                            </td>
                            <td>
                                <input type="time" id="saturday-close" wire:model="saturday_close" class="form-control"/>
                                <label class="sr-only">Saturday close</label>
                            </td>
                            <td>
                                <input type="time" id="sunday-close" wire:model="sunday_close" class="form-control"/>
                                <label class="sr-only">Sunday close</label>
                            </td>
                        </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="card-footer">
                <x-submit-cancel id="brand-hours-create"/>
            </div>
        </div>
    </form>
</div>
