<?php

use App\Models\StatusCode;
use Livewire\Volt\Component;
use Livewire\Attributes\Validate;

new class extends Component {
    public StatusCode $statusCode;

    #[Validate('required|string|min:2|max:50')]
    public string $for_model = '';
    #[Validate('required|string|min:6|max:6|unique:status_codes,code,NULL,NULL,deleted_at,NULL')]
    public string $code = '';
    #[Validate('required|string|min:2|max:50')]
    public int $title = 0;
    #[Validate('required|string|min:2')]
    public int $default_reason = 0;

    public function mount(): void
    {
        $this->for_model = $this->statusCode->for_model;
        $this->code = $this->statusCode->code;
        $this->title = $this->statusCode->title;
        $this->default_reason = $this->statusCode->default_reason;
    }

    public function updateStatusCode()
    {
        if (auth()->user()->can('statuscode.edit')) {
            $validated = $this->validate();

            if ($this->statusCode->update($validated)) {
                $this->dispatch('payment-term-updated');

                $this->name = '';
                $this->code = '';
                $this->net_days = 0;
                $this->cod_amount = 0;
                $this->cod_percent = 0;
                $this->net_amount = 0;
                $this->net_percent = 0;
            } else {
                $this->dispatch('payment-term-not-updated');
            }
        } else {
            $this->dispatch('unauthorized-action');
        }
    }

    public function cancel(): void
    {
        $this->dispatch('payment-term-edit-canceled');
    }
}; ?>

<div>
    //
</div>
