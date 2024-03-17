<?php

use Livewire\Volt\Component;
use Livewire\Attributes\On;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Validation\Rules;
use App\Models\DocumentCategory;

new class extends Component {
    public Collection $categories;
    public ?int $document_category_id;
    public string $title;

    public function mount(): void
    {
        $this->categories = $this->getCategoryIds();
    }

    public function store(): void
    {
        $validated = $this->validate([
            'document_category_id' => ['nullable'],
            'title' => ['required', 'string', 'min:2', 'max:255'],
        ]);

        auth()->user()->documentCategories()->create($validated);

        $this->document_category_id = null;
        $this->title = '';

        $this->dispatch('document-category-created');
    }

    #[On('document-category-created')]
    public function getCategories()
    {
        $this->categories = DocumentCategory::orderBy('title')
            ->get();
    }

    public function getCategoryIds(): Collection
    {
        return DocumentCategory::all();
    }
}; ?>

<div>
    <form wire:submit="store">
        <div class="grid grid-cols-12 gap-2 sm:gap-6">
            <div class="sm:col-span-3">
                <label for="categories" class="inline-block text-sm text-gray-800 mt-2.5 dark:text-gray-200">Parent
                    Category</label>
            </div>
            <div class="sm:col-span-9">
                <select
                    name="document-category-id"
                    id="document-category-id"
                    wire:model="document_category_id"
                    class="py-2 px-3 pe-9 block w-full border-gray-200 rounded-lg text-sm focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-slate-900 dark:border-gray-700 dark:text-gray-400 dark:focus:ring-gray-600"
                >
                    <option selected></option>
                    @foreach ($categories as $category)
                        <option value="{{ $category->id }}">{{ $category->title }}</option>
                    @endforeach
                </select>
            </div>
            @if (!empty($errors))
                <div class="sm:col-span-12">
                    <x-input-error :messages="$errors->get('document_category_id')" class="mt-2"/>
                </div>
            @endif
            <div class="sm:col-span-3">
                <label for="title" class="inline-block text-sm text-gray-800 mt-2.5 dark:text-gray-200">Title</label>
            </div>
            <div class="sm:col-span-9">
                <input
                    name="title"
                    id="title"
                    wire:model="title"
                    type="text"
                    class="py-2 px-3 pe-11 block w-full border-gray-200 shadow-sm text-sm rounded-lg focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-slate-900 dark:border-gray-700 dark:text-gray-400 dark:focus:ring-gray-600"
                />
            </div>
            @if (!empty($errors))
                <div class="sm:col-span-12">
                    <x-input-error :messages="$errors->get('title')" class="mt-2"/>
                </div>
            @endif
        </div>
        <div class="mt-5 flex justify-end gap-x-2">
            <button type="reset"
                    id="reset-form"
                    class="form-control btn btn-primary w-fit">
                Cancel
            </button>
            <button type="submit"
                    x-on:click="
                        // Hacky way to reset the form...
                        setTimeout(function () {
                            $('#reset-form').click();
                        }, 1000);
                    "
                    class="form-control btn btn-primary w-fit">
                Save
            </button>
        </div>
    </form>
</div>
