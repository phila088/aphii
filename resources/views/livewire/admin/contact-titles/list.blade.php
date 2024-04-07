<?php

use App\Models\ContactTitle;
use Livewire\Volt\Component;
use Livewire\Attributes\Validate;
use Livewire\Attributes\On;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Carbon;

new class extends Component {
    public Collection $contactTitles;

    public ?ContactTitle $editing = null;

    public string $search_term = '';

    public function mount(): void
    {
        $this->getContactTitles();
    }

    #[On('contact-title-created')]
    public function getContactTitles(): void
    {
        $this->search_term = '';

        $this->contactTitles = ContactTitle::orderBy('name')
            ->get();
    }

    public function edit(ContactTitle $contactDepartment): void
    {
        $this->editing = $contactDepartment;

        $this->getContactTitles();
    }

    #[On('contact-title-edit-canceled')]
    #[On('contact-title-updated')]
    public function disableEditing(): void
    {
        $this->editing = null;

        $this->getContactTitles();
    }

    public function delete(ContactTitle $contactDepartment): void
    {
        $this->authorize('contact-titles.delete');

        $contactDepartment->delete();

        $this->getContactTitles();
    }

    public function searchResults(string $partial): void
    {
        if (empty($partial)) {
            $this->getContactTitles();
        } else {
            $this->contactTitles = ContactTitle::where('name', 'like', '%' . $partial . '%')
                ->orderBy('name')
                ->get();
        }
    }
}; ?>

<div>
    <div class="card custom-card">
        <div class="card-header">
            <div class="d-flex justify-content-between align-items-center w-100">
                <h2>All contact titles</h2>
                <div>
                    <label for="search" class="sr-only">Search</label>
                    <input type="text" id="search" wire:model="search_term"
                           class="form-control form-control-sm rounded-pill" placeholder="Search"
                           x-on:input="$wire.searchResults($el.value);">
                </div>
            </div>
        </div>
        <div class="card-body">
            @can ('contactTitles.viewAny')
                <ul class="list-group">
                    @empty ($contactTitles[0])
                        <x-no-data/>
                    @else
                        @foreach ($contactTitles as $contactTitle)
                            <li class="list-group-item" :key="$contactTitle->id">
                                <div class="d-flex justify-content-between align-items-center">
                                    <p>{{ $contactTitle->name }}</p>
                                    <div>
                                        @can ('contactTitles.edit')
                                            <button type="button" class="btn btn-icon btn-sm btn-info-light rounded-pill btn-wave waves-effect waves-light" wire:click.prevent="edit({{ $contactTitle->id }})"><i class="bi bi-pencil"></i></button>
                                        @endcan
                                        @can ('contactTitles.delete')
                                            <button type="button" class="btn btn-icon btn-sm btn-danger-light rounded-pill btn-wave waves-effect waves-light" wire:click.prevent="delete({{ $contactTitle->id }})" wire:confirm="Are you sure you want to delete this contact title?"><i class="bi bi-trash"></i></button>
                                        @endcan
                                    </div>
                                </div>
                                @if ($contactTitle->is($editing))
                                    <livewire:admin.contact-titles.edit :contactTitle="$contactTitle" wire:key="{{ $contactTitle->id }}" />
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
