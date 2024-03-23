<?php

use App\Models\Call;
use Livewire\Volt\Component;
use Livewire\Attributes\On;
use Illuminate\Database\Eloquent\Collection;

new class extends Component {
    public ?Collection $calls = null;

    public function mount(): void
    {
        $this->getCalls();
    }

    #[On('call-created')]
    public function getCalls(): void
    {
        $this->calls = Call::with('user', 'contact', 'followup')->get();
    }
}; ?>

<div class="row tw-max-w-full tw-overflow-x-auto mx-auto">
    <table id="table" class="tw-min-w-full tw-max-w-full tw-divide-y tw-divide-gray-200" style="width:100%">
        <thead>
        <tr>
            <th>Caller</th>
            <th>Contact</th>
            <th>Office number</th>
            <th>Extension</th>
            <th>Mobile</th>
            <th>Date</th>
            <th>Actions</th>
        </tr>
        </thead>
        <tbody>
        @foreach ($calls as $call)
            <tr>
                <td>{{ $call->user->name }}</td>
                @if (!empty($call->contact[0]))
                    <td>{{ $call->contact->first_name }} {{ $call->contact->last_name }}</td>
                @else
                    <td></td>
                @endif
                <td>{{ $call->phone_office }}</td>
                <td>{{ $call->phone_office_extension }}</td>
                <td>{{ $call->phone_mobile }}</td>
                <td>{{ $call->needs_followup }}</td>
                <td>
                    <div class="btn-group" role="group" aria-label="Record actions">
                        <a href="#" class="btn btn-info btn-sm">
                            <i class="bi bi-binoculars"></i>
                        </a>

                        <a href="#" class="btn btn-primary btn-sm">
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

        new DataTable('#table', {
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
