<?php

use App\Models\StatusCode;
use Livewire\Volt\Component;
use Livewire\Attributes\On;
use Livewire\Attributes\Validate;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Carbon;

new class extends Component {
    public Collection $statusCodes;
    public string $searchTerm = '';

    public ?StatusCode $editing = null;

    public function mount(): void
    {
        $this->getStatusCodes();
    }

    #[On('status-code-created')]
    public function getStatusCodes(): void
    {
        if (empty($this->searchTerm)) {
            $this->statusCodes = StatusCode::orderBy('for_model')
                ->orderBy('title')
                ->orderBy('code')
                ->get();
        } else {
            $this->searchResults($this->searchTerm);
        }
    }

    public function edit(StatusCode $statusCode): void
    {
        $this->editing = $statusCode;

        $this->getStatusCodes();
    }

    #[On('status-code-edit-canceled')]
    #[On('status-code-updated')]
    public function disableEditing(): void
    {
        $this->editing = null;

        $this->getStatusCodes();
    }

    public function delete(StatusCode $statusCode): void
    {
        if (auth()->user()->can('statuscode.delete')) {
            $statusCode->delete();

            $this->getStatusCodes();
        }
    }

    public function searchResults(string $partial): void
    {
        if (empty($partial)) {
            $this->getStatusCodes();
        } else {
            $this->statusCodes = StatusCode::orderBy('code')
                ->where('for_model', 'like', '%' . $partial . '%')
                ->orWhere('code', 'like', '%' . $partial . '%')
                ->orWhere('title', 'like', '%' . $partial . '%')
                ->get();
        }
    }
}; ?>

<div>
    <div class="card custom-card">
        <div class="card-header">
            <div class="tw-flex tw-justify-between tw-items-center tw-w-full">
                <h2>All status codes</h2>
                <div>
                    <input type="text" id="status-codes-index-search" wire:model="searchTerm" class="form-control form-control-sm rounded-pill" placeholder="Search" x-on:input="$wire.searchResults($el.value)">
                    <label for="payment-methods-index-search" class="tw-sr-only">Search</label>
                </div>
            </div>
        </div>
        <div class="card-body">
            @can ('statusCodes.viewAny')
                @if ($statusCodes->isEmpty())
                    <x-no-data />
                @else
                    <ul class="list-group">
                        @foreach ($statusCodes as $statusCode)
                            <li class="list-group-item">
                                <div class="d-flex justify-content-between align-items-center">
                                    <div class="col-auto">
                                        <table class="table table-sm table-borderless">
                                            <tbody>
                                            <tr>
                                                <th>Model: </th>
                                                <td>{{ $statusCode->for_model }}</td>
                                            </tr>
                                            <tr>
                                                <th>Code: </th>
                                                <td>{{ $statusCode->code }}</td>
                                            </tr>
                                            <tr>
                                                <th>Title: </th>
                                                <td>{{ $statusCode->title }}</td>
                                            </tr>
                                            <tr>
                                                <th>Default reason: </th>
                                                <td>{{ $statusCode->default_reason }}</td>
                                            </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                    <div>
                                        @can ('contact-titles.edit')
                                            <button type="button" class="btn btn-icon btn-sm btn-info-light rounded-pill btn-wave waves-effect waves-light" wire:click.prevent="edit({{ $statusCode->id }})"><i class="bi bi-pencil"></i></button>
                                        @endcan
                                        @can ('contact-titles.delete')
                                            <button type="button" class="btn btn-icon btn-sm btn-danger-light rounded-pill btn-wave waves-effect waves-light" wire:click.prevent="delete({{ $statusCode->id }})" wire:confirm="Are you sure you want to delete this contact title?"><i class="bi bi-trash"></i></button>
                                        @endcan
                                    </div>
                                </div>
                                @if ($statusCode->is($editing))
                                    <livewire:admin.status-codes.edit :statusCode="$statusCode" wire:key="{{ $statusCode->id }}" />
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
