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
    <table id="brands" class="tw-min-w-full tw-max-w-full tw-divide-y tw-divide-gray-200" style="width:100%">
        <thead>
            <tr>
                <th>Name</th>
                <th>Abbreviation</th>
                <th>Active</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($brands as $brand)
                <tr>
                    <td>{{ $brand->legal_name }}</td>
                    <td>{{ $brand->abbreviation }}</td>
                    <td>{{ ($brand->active) ? 'Yes' : 'No' }}</td>
                    <td>
                        <div class="btn-group" role="group" aria-label="Record actions">
                            <a href="{{ route('employee.brands.view', ['id' => $brand->id]) }}" class="btn btn-info btn-sm">
                                <i class="bi bi-binoculars"></i>
                            </a>
                            <a href="{{ route('employee.brands.edit', ['id' => $brand->id]) }}" class="btn btn-primary btn-sm">
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

        new DataTable('#brands', {
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
