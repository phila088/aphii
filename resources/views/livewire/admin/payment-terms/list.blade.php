<?php

use App\Models\PaymentTerm;
use Livewire\Volt\Component;
use Livewire\Attributes\On;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Carbon;

new class extends Component {
    public Collection $paymentTerms;
    public string $searchTerm = '';

    public ?PaymentTerm $editing = null;

    public function mount(): void
    {
        $this->getPaymentTerms();
    }

    #[On('payment-term-created')]
    public function getPaymentTerms(): void
    {
        if (empty($this->searchTerm)) {
            $this->paymentTerms = PaymentTerm::orderBy('code')
                ->get();
        } else {
            $this->searchResults($this->searchTerm);
        }
    }

    public function edit(PaymentTerm $paymentTerm): void
    {
        $this->editing = $paymentTerm;

        $this->getPaymentTerms();
    }

    #[On('payment-term-edit-canceled')]
    #[On('payment-term-updated')]
    public function disableEditing(): void
    {
        $this->editing = null;

        $this->getPaymentTerms();
    }

    public function delete(PaymentTerm $paymentTerm): void
    {
        if (auth()->user()->can('paymentterm.delete')) {
            $paymentTerm->delete();

            $this->getPaymentTerms();
        }
    }

    public function searchResults(string $partial): void
    {
        if (empty($partial)) {
            $this->getPaymentTerms();
        } else {
            $this->paymentTerms = PaymentTerm::orderBy('code')
                ->where('name', 'like', '%' . $partial . '%')
                ->orWhere('code', 'like', '%' . $partial . '%')
                ->orWhere('net_days', 'like', '%' . $partial . '%')
                ->orWhere('cod_amount', 'like', '%' . $partial . '%')
                ->orWhere('cod_percent', 'like', '%' . $partial . '%')
                ->orWhere('net_amount', 'like', '%' . $partial . '%')
                ->orWhere('net_percent', 'like', '%' . $partial . '%')
                ->get();
        }
    }
}; ?>

<div>
    <div class="card custom-card">
        <div class="card-header">
            <div class="tw-flex tw-justify-between tw-items-center tw-w-full">
                <h2>All payment terms</h2>
                <div>
                    <input type="text" id="payment-terms-index-search" wire:model="searchTerm" class="form-control form-control-sm rounded-pill" placeholder="Search" x-on:input="$wire.searchResults($el.value)">
                    <label for="payment-terms-index-search" class="tw-sr-only">Search</label>
                </div>
            </div>
        </div>
        <div class="card-body">
            @can ('paymentTerms.viewAny')
                @if ($paymentTerms->isEmpty())
                    <x-no-data />
                @else
                    <ul class="list-group">
                        @foreach ($paymentTerms as $paymentTerm)
                            <li class="list-group-item">
                                <div class="d-flex justify-content-between align-items-center">
                                    <div class="col-auto">
                                        <table class="table table-sm table-borderless">
                                            <tbody>
                                            <tr>
                                                <th>Code: </th>
                                                <td>{{ $paymentTerm->code }}</td>
                                            </tr>
                                            <tr>
                                                <th>Name: </th>
                                                <td>{{ $paymentTerm->name }}</td>
                                            </tr>
                                            <tr>
                                                <th>NET days to pay: </th>
                                                <td>{{ $paymentTerm->net_days }}</td>
                                            </tr>
                                            <tr>
                                                <th>COD amount: </th>
                                                <td>{{ Number::currency($paymentTerm->cod_amount) }}</td>
                                            </tr>
                                            <tr>
                                                <th>COD percent: </th>
                                                <td>{{ Number::percentage($paymentTerm->cod_percent) }}</td>
                                            </tr>
                                            <tr>
                                                <th>NET amount: </th>
                                                <td>{{ Number::currency($paymentTerm->net_amount) }}</td>
                                            </tr>
                                            <tr>
                                                <th>NET percent: </th>
                                                <td>{{ Number::percentage($paymentTerm->net_percent) }}</td>
                                            </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                    <div>
                                        @can ('contact-titles.edit')
                                            <button type="button" class="btn btn-icon btn-sm btn-info-light rounded-pill btn-wave waves-effect waves-light" wire:click.prevent="edit({{ $paymentTerm->id }})"><i class="bi bi-pencil"></i></button>
                                        @endcan
                                        @can ('contact-titles.delete')
                                            <button type="button" class="btn btn-icon btn-sm btn-danger-light rounded-pill btn-wave waves-effect waves-light" wire:click.prevent="delete({{ $paymentTerm->id }})" wire:confirm="Are you sure you want to delete this contact title?"><i class="bi bi-trash"></i></button>
                                        @endcan
                                    </div>
                                </div>
                                @if ($paymentTerm->is($editing))
                                    <livewire:admin.payment-terms.edit :paymentTerm="$paymentTerm" wire:key="$paymentTerm->id" />
                                @endif
                            </li>
                        @endforeach
                    </ul>
                @endif
            @else
                <x-not-auth />
            @endcan
        </div>
    </div>
</div>
