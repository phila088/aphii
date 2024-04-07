<?php

use App\Models\ContactDepartment;
use Livewire\Volt\Component;
use Livewire\Attributes\Validate;
use Livewire\Attributes\On;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Carbon;

new class extends Component {
    public Collection $contactDepartments;

    public ?ContactDepartment $editing = null;

    public string $search_term = '';

    public function mount(): void
    {
        $this->getContactDepartments();
    }

    #[On('contact-department-created')]
    public function getContactDepartments(): void
    {
        $this->search_term = '';

        $this->contactDepartments = ContactDepartment::orderBy('name')
            ->get();
    }

    public function edit(ContactDepartment $contactDepartment): void
    {
        $this->editing = $contactDepartment;

        $this->getContactDepartments();
    }

    #[On('contact-department-edit-canceled')]
    #[On('contact-department-updated')]
    public function disableEditing(): void
    {
        $this->editing = null;

        $this->getContactDepartments();
    }

    public function delete(ContactDepartment $contactDepartment): void
    {
        $this->authorize('contact-departments.delete');

        $contactDepartment->delete();

        $this->getContactDepartments();
    }

    public function searchResults(string $partial): void
    {
        if (empty($partial)) {
            $this->getContactDepartments();
        } else {
            $this->contactDepartments = ContactDepartment::where('name', 'like', '%' . $partial . '%')
                ->orderBy('name')
                ->get();
        }
    }
}; ?>

<div>
    <div class="card custom-card">
        <div class="card-header">
            <div class="d-flex justify-content-between align-items-center w-100">
                <h2>All contact departments</h2>
                <div>
                    <label for="search" class="sr-only">Search</label>
                    <input type="text" id="search" wire:model="search_term"
                           class="form-control form-control-sm rounded-pill" placeholder="Search"
                           x-on:input="$wire.searchResults($el.value);">
                </div>
            </div>
        </div>
        <div class="card-body">
            @can ('contactDepartments.viewAny')
                <ul class="list-group">
                    @empty ($contactDepartments[0])
                        <x-no-data/>
                    @else
                        @foreach ($contactDepartments as $contactDepartment)
                            <li class="list-group-item" :key="$contactDepartment->id">
                                <div class="d-flex justify-content-between align-items-center">
                                    <p>{{ $contactDepartment->name }}</p>
                                    <div>
                                        @can ('contactDepartments.edit')
                                            <button type="button" class="btn btn-icon btn-sm btn-info-light rounded-pill btn-wave waves-effect waves-light" wire:click.prevent="edit({{ $contactDepartment->id }})"><i class="bi bi-pencil"></i></button>
                                        @endcan
                                        @can ('contactDepartments.delete')
                                            <button type="button" class="btn btn-icon btn-sm btn-danger-light rounded-pill btn-wave waves-effect waves-light" wire:click.prevent="delete({{ $contactDepartment->id }})" wire:confirm="Are you sure you want to delete this contact department?"><i class="bi bi-trash"></i></button>
                                        @endcan
                                    </div>
                                </div>
                                @if ($contactDepartment->is($editing))
                                    <livewire:admin.contact-departments.edit :contactDepartment="$contactDepartment" wire:key="{{ $contactDepartment->id }}" />
                                @endif
                            </li>
                        @endforeach
                    @endempty
                </ul>
            @else
                <x-not-auth />
            @endcan
        </div>
    </div>
</div>
