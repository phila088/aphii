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
            </div>
        </div>
        <div class="card-body">
            @can ('clients.viewAny')
                @if ($clients->isEmpty())
                    <x-no-data/>
                @else
                    <table
                        id="employee-clients-list-table"
                        data-classes="text-center table table-bordered table-sm"
                        data-cookie="true"
                        data-cookie-id-table="employeeClientsListTable"
                        data-group-by="true"
                        data-group-by-field="2"
                        data-mobile-responsive="true"
                        data-remember-order="true"
                        data-search="true"
                        data-show-multi-sort="true"
                        data-show-print="true"
                        data-sticky-header="true"
                        data-sticky-header-offset-y="64"
                    >
                        <thead>
                            <tr>
                                <th rowspan="2" data-sortable="true">Name</th>
                                <th rowspan="2" data-sortable="true">Abbreviation</th>
                                <th rowspan="2" data-sortable="true">Status</th>
                                <th colspan="4">Portal</th>
                                <th rowspan="2">Actions</th>

                            </tr>
                            <tr>
                                <th scope="col" data-sortable="true">Name</th>
                                <th scope="col" data-sortable="true">Link</th>
                                <th scope="col" data-sortable="true">Username</th>
                                <th scope="col" data-sortable="true">Password</th>
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
                @endif
            @else
                <x-not-auth />
            @endcan
        </div>
    </div>
    <script src="{{ asset('js/bst/bootstrap-table.min.js') }}"></script>
    <script src="{{ asset('js/bst/extensions/sticky-header/bootstrap-table-sticky-header.min.js') }}"></script>
    <script src="{{ asset('js/bst/extensions/group-by-v2/bootstrap-table-group-by.min.js') }}"></script>
    <script src="{{ asset('js/bst/extensions/cookie/bootstrap-table-cookie.min.js') }}"></script>
    <script src="{{ asset('js/bst/extensions/multiple-sort/bootstrap-table-multiple-sort.js') }}"></script>
    <script src="{{ asset('js/bst/extensions/mobile/bootstrap-table-mobile.min.js') }}"></script>
    <script src="{{ asset('js/bst/extensions/print/bootstrap-table-print.min.js') }}"></script>
    <script>
        let $table = $('#employee-clients-list-table')

        $table.bootstrapTable({})
    </script>
</div>
