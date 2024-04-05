<?php

use App\Models\DocumentCategory;
use Livewire\Volt\Component;
use Livewire\Attributes\Validate;
use Livewire\Attributes\On;
use Illuminate\Database\Eloquent\Collection;
use Kalnoy\Nestedset\NestedSet;

new class extends Component {
    public array $documentCategories = [];
    public array $checkTree;

    #[Validate('nullable|int|exists:document_categories,id')]
    public int $parent_id;
    #[Validate('required|string|min:2|max:50')]
    public string $name;

    public function mount(): void
    {
        $this->getCategories();
    }

    #[On('document-category-created')]
    #[On('document-category-updated')]
    #[On('node-moved')]
    #[On('node-deleted')]
    public function getCategories(): void
    {
        $nodes = DocumentCategory::orderBy('_lft')->get()->toTree();
        $documentCategories = [];
        $traverse = function ($categories, $prefix = '') use (&$traverse, &$documentCategories) {
            foreach($categories as $category) {
                $documentCategories[$category->id] = $prefix . ' ' . $category->name;

                $traverse($category->children, $prefix . '-');
            }
        };
        $traverse($nodes);

        $this->documentCategories = $documentCategories;
    }

    public function createDocumentCategory(): void
    {
        $this->authorize('documentCategories.create');
        $validated = $this->validate();

        if (empty($this->parent_id)) {
            DocumentCategory::create($validated);
        } else {
            $parent = DocumentCategory::find($this->parent_id);
            $parent->children()->create($validated);
        }

        $this->name = '';

        $this->dispatch('document-category-created');
    }
}; ?>

<div>
    <form wire:submit="createDocumentCategory" novalidate autocomplete="off">
        <div class="card custom-card">
            <div class="card-header">
                <h2>Create a document category</h2>
            </div>
            <div class="card-body">
                <div class="row g-2">
                    <x-select cols="col-lg-6" id="parent-id" model="parent_id" label="Parent category">
                        <option></option>
                        @foreach ($documentCategories as $id => $documentCategory)
                            <option value="{{ $id }}">{{ $documentCategory }}</option>
                        @endforeach
                    </x-select>

                    <x-input cols="col-lg-6" id="name" model="name" label="Category" />
                </div>
            </div>
            <div class="card-footer">
                <x-submit id="document-categories-create" />
            </div>
        </div>
    </form>
</div>
