<?php

use App\Models\PotentialClient;
use Livewire\Volt\Component;
use Illuminate\Database\Eloquent\Collection;

new class extends Component {
    public ?Collection $potentialClients;

    public function mount(): void
    {
        $this->getPotentialClients();
    }

    #[On('potential-client-created')]
    public function getPotentialClients(): void
    {
        $this->potentialClients = PotentialClient::where('converted_to_client', '=', false)
            ->get();
    }
}; ?>

<div class="row tw-max-w-full tw-overflow-x-auto mx-auto">
    <table id="clients" class="tw-min-w-full tw-max-w-full tw-divide-y tw-divide-gray-200" style="width:100%">
        <thead>
            <tr>
                <th>Name</th>
                <th>Interview Date</th>
                <th>Creator</th>
                <th>Created</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($potentialClients as $potentialClient)
                <tr>
                    <td>{{ $potentialClient->legal_name }}</td>
                    <td>{{ $potentialClient->date_of_interview }}</td>
                    <td>{{ $potentialClient->user->name }}</td>
                    <td>{{ $potentialClient->created_at }}</td>
                    <td>
                        <div class="btn-group" role="group" aria-label="Record actions">
                            <a href="{{ route('Employee.potential-clients.view', ['id' => $potentialClient->id]) }}" class="btn btn-info btn-sm">
                                <i class="bi bi-binoculars"></i>
                            </a>

                            <a href="{{ route('Employee.potential-clients.view', ['id' => $potentialClient->id]) }}" class="btn btn-primary btn-sm">
                                <i class="bi bi-pencil"></i>
                            </a>
                        </div>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    @assets
    <script src="https://code.jquery.com/jquery-3.7.1.js"></script>
    <script src="{{ asset('js/dataTables.js') }}"></script>
    <script src="{{ asset('js/dataTables.tailwindcss.js') }}"></script>
    @endassets

    @script
    <script>

        new DataTable('#clients', {
            lengthMenu: [
                [10, 25, 50, -1],
                [10, 25, 50, 'All']
            ],
            search: {
                return: true
            },
            stateSave: true,
        });
    </script>
    @endscript
</div>
