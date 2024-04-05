<?php

use App\Models\Client;
use Livewire\Volt\Component;
use Livewire\Attributes\Validate;
use Livewire\Attributes\On;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Carbon;

new class extends Component {
    public Collection $clients;

    public ?Client $editing = null;

    public string $search_term = '';

    public function mount(): void
    {
        $this->getClients();
    }

    #[On('client-created')]
    public function getClients(): void
    {
        $this->search_term = '';

        $this->clients = Client::with([
            'clientBillingInstruction',
            'clientPortal',
        ])->get();
    }

    public function edit(Client $client): void
    {
        $this->editing = $client;

        $this->getClients();
    }

    #[On('client-edit-canceled')]
    #[On('client-updated')]
    public function disableEditing(): void
    {
        $this->editing = null;

        $this->getClients();
    }

    public function delete(Client $client): void
    {
        $this->authorize('clients.delete');

        $client->delete;

        $this->getClients();
    }

    public function searchResults(string $partial): void
    {
        if (empty($partial)) {
            $this->getClients();
        } else {
            $this->clients = Client::get();
        }
    }
}; ?>

<div>
    <div class="card custom-card">
        <div class="card-header">
            <div class="d-flex justify-content-between align-items-center w-100">
                <h2>All clients</h2>
                <div>
                    <label for="search" class="sr-only">Search</label>
                    <input type="text" id="search" wire:model="search_term"
                           class="form-control form-control-sm rounded-pill" placeholder="Search"
                           x-on:input="$wire.searchResults($el.value);">
                </div>
            </div>
        </div>
        <div class="card-body">
            @empty ($clients[0])
                <x-no-data/>
            @else
                <table class="table table-responsive-lg table-bordered text-center rounded-5">
                    <thead>
                    <col>
                    <collgroup span="4"></collgroup>
                    <tr>
                        <th rowspan="2">Name</th>
                        <th rowspan="2">Abbreviation</th>
                        <th rowspan="2">Status</th>
                        <th colspan="4" scope="colgroup">Portal</th>
                        <th rowspan="2">Actions</th>

                    </tr>
                    <tr>
                        <th scope="col">Name</th>
                        <th scope="col">Link</th>
                        <th scope="col">Username</th>
                        <th scope="col">Password</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach ($clients as $client)
                        <tr>
                            <td>{{ $client->name }}</td>
                            <td>{{ $client->abbreviation }}</td>
                            <td>{{ $client->status() }}</td>
                            @empty ($client->clientPortal[0])
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                            @else
                                <td>{{ $client->clientPortal->name }}</td>
                                <td><a href="{{ $client->clientPortal->url }}">Link</a></td>
                                <td>{{ $client->clientPortal->username }}</td>
                                <td>{{ $client->clientPortal->password }}</td>
                            @endempty
                            <td>
                                <div>
                                    @can ('clients.view')
                                        <button type="button"
                                                class="btn btn-icon btn-sm btn-success-light rounded-pill btn-wave waves-effect waves-light"
                                                wire:click.prevent="view({{ $client->id }})"><i
                                                class="bi bi-binoculars"></i></button>
                                    @endcan
                                    @can ('clients.edit')
                                        <button type="button"
                                                class="btn btn-icon btn-sm btn-info-light rounded-pill btn-wave waves-effect waves-light"
                                                wire:click.prevent="edit({{ $client->id }})"><i
                                                class="bi bi-pencil"></i></button>
                                    @endcan
                                    @can ('clients.delete')
                                        <button type="button"
                                                class="btn btn-icon btn-sm btn-danger-light rounded-pill btn-wave waves-effect waves-light"
                                                wire:click.prevent="delete({{ $client->id }})"
                                                wire:confirm="Are you sure you want to delete this brand?"><i
                                                class="bi bi-trash"></i></button>
                                    @endcan
                                </div>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            @endempty
        </div>
    </div>
</div>
