<?php

use App\Models\Brand;
use App\Models\BrandEmail;
use Livewire\Volt\Component;
use Livewire\Attributes\On;
use Livewire\Attributes\Validate;

new class extends Component {
    public $brand;

    #[Validate('string|required|min:2|max:50')]
    public string $title = '';
    #[Validate('string|required|email:rfc,spoof,filter,dns')]
    public string $email = '';
    #[Validate('int|required')]
    public int $brand_id;

    public function mount(): void
    {
        $this->brand_id = $this->brand->id;
    }

    public function createBrandEmail(): void
    {
        $validated = $this->validate();

        if (auth()->user()->email()->create($validated)) {
            $this->title = '';
            $this->email = '';

            $this->dispatch('brand-email-created');
        }
    }
}; ?>

<div>
    <form wire:submit="createBrandEmail" class="needs-validate" novalidate autocomplete="off">
        <div class="card custom-card">
            <div class="card-header">
                <h4>Create an email</h4>
            </div>
            <div class="card-body">
                    <div class="row g-2">
                        <x-input cols="col-lg-3" id="title" model="title" label="Title" />

                        <x-input cols="col-lg-3" type="email" id="email" model="email" label="Email" />
                    </div>
            </div>
        </div>
        <div class="card custom-card">
            <div class="card-body">
                <x-submit id="brandEmailCreate" />
            </div>
        </div>
    </form>
</div>
