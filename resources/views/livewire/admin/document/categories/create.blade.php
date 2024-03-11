<?php

use Livewire\Volt\Component;
use Livewire\Attributes\On;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Validation\Rules;
use App\Models\DocumentCategory;

new class extends Component {
    public Collection $categories;
    public ?int $category_id;
    public string $title;

    public function mount(): void
    {
        $this->categories = $this->getCategoryIds();
        $this->category_id = null;
        $this->title = '';
    }

    public function store(): void
    {
        $validated = $this->validate([
            'category_id' => ['nullable', 'in:document_categories'],
            'title' => ['required', 'string', 'min:2', 'max:255'],
        ]);

        auth()->user()->documentCategories()->create($validated);

        $this->category_id = null;
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
                <label for="categories" class="inline-block text-sm text-gray-800 mt-2.5 dark:text-gray-200">Parent Category</label>
            </div>
            <div class="sm:col-span-9">
                <select
                    name="categories"
                    id="categories"
                    wire:model="category_id"
                    class="py-2 px-3 pe-9 block w-full border-gray-200 rounded-lg text-sm focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-slate-900 dark:border-gray-700 dark:text-gray-400 dark:focus:ring-gray-600"
                >
                    <option></option>
                    @foreach ($categories as $category)
                        <option value="{{ $category->id }}">{{ $category->title }}</option>
                    @endforeach
                </select>
            </div>
            @if (!empty($errors))
                <div class="sm:col-span-12">
                    <x-input-error :messages="$errors->get('category_id')" class="mt-2" />
                </div>
            @endif
            <div class="sm:col-span-3">
                <label for="title" class="inline-block text-sm text-gray-800 mt-2.5 dark:text-gray-200">Title</label>
            </div>
            <div class="sm:col-span-9">
                <input
                    name="title"
                    id="title"
                    wire:model.live="title"
                    type="text"
                    class="py-2 px-3 pe-11 block w-full border-gray-200 shadow-sm text-sm rounded-lg focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-slate-900 dark:border-gray-700 dark:text-gray-400 dark:focus:ring-gray-600"
                />
            </div>
            @if (!empty($errors))
                <div class="sm:col-span-12">
                    <x-input-error :messages="$errors->get('title')" class="mt-2" />
                </div>
            @endif
        </div>
        <div class="mt-5 flex justify-end gap-x-2">
            <button type="reset" class="py-2 px-3 inline-flex items-center gap-x-2 text-sm font-medium rounded-lg border border-gray-200 bg-white text-gray-800 shadow-sm hover:bg-gray-50 disabled:opacity-50 disabled:pointer-events-none dark:bg-slate-900 dark:border-gray-700 dark:text-white dark:hover:bg-gray-800 dark:focus:outline-none dark:focus:ring-1 dark:focus:ring-gray-600">
                Cancel
            </button>
            <button type="submit" class="py-2 px-3 inline-flex items-center gap-x-2 text-sm font-semibold rounded-lg border border-transparent bg-blue-600 text-white hover:bg-blue-700 disabled:opacity-50 disabled:pointer-events-none dark:focus:outline-none dark:focus:ring-1 dark:focus:ring-gray-600">
                Save
            </button>
        </div>
    </form>
</div>
