<?php

use App\Models\DocumentCategory;
use Livewire\Volt\Component;
use Livewire\Attributes\Validate;
use Livewire\Attributes\On;
use Illuminate\Database\Eloquent\Collection;
use Kalnoy\Nestedset\NestedSet;

new class extends Component {
    public array $documentCategories;

    public ?DocumentCategory $editing = null;

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
                $documentCategories[$category->id] = $prefix . '>' . $category->name;

                $traverse($category->children, $prefix . ',');
            }
        };
        $traverse($nodes);

        $this->documentCategories = $documentCategories;
    }

    public function edit(int $id): void
    {
        $node = DocumentCategory::find($id);

        $this->editing = $node;

        $this->getCategories();
    }

    #[On('document-category-edit-canceled')]
    #[On('document-category-updated')]
    public function disableEditing(): void
    {
        $this->editing = null;

        $this->getCategories();
    }

    public function moveUp($id): void
    {
        $node = DocumentCategory::find($id);

        $node->up();

        $this->dispatch('node-moved');
    }

    public function moveDown($id): void
    {
        $node = DocumentCategory::find($id);

        $node->down();

        $this->dispatch('node-moved');
    }

    public function delete($id): void
    {
        $node = DocumentCategory::find($id);

        $node->delete();

        $this->dispatch('node-deleted');
    }
}; ?>

<div>
    <div class="card custom-card">
        <div class="card-header">
            <h2>All document categories</h2>
        </div>
        <div class="card-body">
            <ul class="list-group">
                @if (empty($documentCategories))
                    <x-no-data />
                @else
                    @foreach ($documentCategories as $id => $documentCategory)
                        @php
                            $node = DocumentCategory::find($id);
                            $isLeaf = false;
                            if (!is_null($node)) {
                                $isLeaf = $node->isLeaf();
                            }
                        @endphp
                        @if ($isLeaf)
                            <li class="list-group-item p-2" :key="{{ $id }}">
                                <div class="tw-flex tw-justify-between tw-items-center">
                                    <p>
                                        {!! str_replace('>', '<i class="bi bi-caret-right-fill tw-pr-1.5 text-muted"></i>', str_replace(',', '&emsp;', ' ' . $documentCategory)) !!}
                                    </p>
                                    <div>
                                        <button type="button" class="btn btn-icon btn-sm btn-info-light rounded-pill btn-wave waves-effect waves-light" wire:click.prevent="edit({{ $id }})"><i class="bi bi-pencil"></i></button>
                                        <button type="button" class="btn btn-icon btn-sm btn-success-light rounded-pill btn-wave waves-effect waves-light" wire:click.prevent="moveUp({{ $id }})"><i class="bi bi-caret-up-fill"></i></button>
                                        <button type="button" class="btn btn-icon btn-sm btn-warning-light rounded-pill btn-wave waves-effect waves-light" wire:click.prevent="moveDown({{ $id }})"><i class="bi bi-caret-down-fill"></i></button>
                                        <button type="button" class="btn btn-icon btn-sm btn-danger-light rounded-pill btn-wave waves-effect waves-light" wire:click.prevent="delete({{ $id }})"><i class="bi bi-trash"></i></button>
                                    </div>
                                </div>
                                @if (!is_null($node))
                                    @if ($node->is($editing))
                                        <livewire:admin.document-categories.edit :documentCategory="$node" wire:key="$id" />
                                    @endif
                                @endif
                            </li>
                        @else
                            <li class="list-group-item p-2" :key="{{ $id }}">
                                <div class="tw-flex tw-justify-between tw-items-center">
                                    <p>
                                        {!! str_replace('>', '<i class="bi bi-caret-down-fill tw-pr-1.5 text-muted"></i>', str_replace(',', '&emsp;', ' ' . $documentCategory)) !!}
                                    </p>
                                    <div>
                                        <button type="button" class="btn btn-icon btn-sm btn-info-light rounded-pill btn-wave waves-effect waves-light" wire:click.prevent="edit({{ $id }})"><i class="bi bi-pencil"></i></button>
                                        <button type="button" class="btn btn-icon btn-sm btn-success-light rounded-pill btn-wave waves-effect waves-light" wire:click.prevent="moveUp({{ $id }})"><i class="bi bi-caret-up-fill"></i></button>
                                        <button type="button" class="btn btn-icon btn-sm btn-warning-light rounded-pill btn-wave waves-effect waves-light" wire:click.prevent="moveDown({{ $id }})"><i class="bi bi-caret-down-fill"></i></button>
                                        <button type="button" class="btn btn-icon btn-sm btn-danger-light rounded-pill btn-wave waves-effect waves-light" wire:click.prevent="delete({{ $id }})"><i class="bi bi-trash"></i></button>
                                    </div>
                                </div>
                                @if (!is_null($node))
                                    @if ($node->is($editing))
                                        <livewire:admin.document-categories.edit :documentCategory="$node" wire:key="$id" />
                                    @endif
                                @endif
                            </li>
                        @endif
                    @endforeach
                @endif
            </ul>
        </div>
    </div>
</div>
