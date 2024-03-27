<?php

use App\Models\Brand;
use Livewire\Volt\Component;
use Livewire\Attributes\On;
use Illuminate\Database\Eloquent\Collection;

new class extends Component {
    public ?Collection $brands;

    public function mount(): void
    {
        $this->getBrands();
    }

    #[On('brand-created')]
    #[On('brand-edited')]
    public function getBrands(): void
    {
        $this->brands = Brand::with('user')
            ->get();
    }
}; ?>

<div class="row tw-max-w-full tw-overflow-x-auto mx-auto">

</div>
