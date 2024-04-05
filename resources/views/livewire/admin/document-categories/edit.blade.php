<?php

use App\Models\DocumentCategory;
use Livewire\Volt\Component;
use Livewire\Attributes\Validate;
use Livewire\Attributes\On;
use Illuminate\Database\Eloquent\Collection;
use Kalnoy\Nestedset\NestedSet;

new class extends Component {
    public DocumentCategory $documentCategory;

    #[Validate('required|string|min:2|max:50')]
    public string $name;

    public function mount(): void
    {
        $this->name = $this->documentCategory->name;
    }

    public function updateDocumentCategory(): void
    {
        $this->authorize('documentCategories.create');

        $validated = $this->validate();

        $this->documentCategory->update($validated);

        $this->dispatch('document-category-updated');
    }

    public function cancel(): void
    {
        $this->dispatch('document-category-edit-canceled');
    }
}; ?>

<div class="tw-m-4">
    <form wire:submit="updateDocumentCategory" novalidate autocomplete="off">
        <div class="card">
            <div class="card-header">
                <h2>Create a document category</h2>
            </div>
            <div class="card-body">
                <div class="row g-2">
                    <x-input cols="col-lg-6" id="name" model="name" label="Category" />
                </div>
            </div>
            <div class="card-footer">
                <x-submit-cancel id="document-categories-create" />
            </div>
        </div>
    </form>
</div>
