<?php

use Livewire\Volt\Component;
use Livewire\Attributes\On;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\LengthAwarePaginator;
use App\Models\DocumentCategory;

new class extends Component {

    public Collection $categories;

    public function mount()
    {
        $this->getCategories();
    }

    #[On('document-category-created')]
    public function getCategories()
    {
        $this->categories = DocumentCategory::orderBy('document_category_id')
            ->orderBy('title')
            ->with('documentCategory')
            ->get();
    }
}; ?>


<div>
    <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
        <thead>
        <tr class="text-center">
            <td class="px-6 py-2 text-xs font-medium text-gray-500 uppercase">Parent Category</td>
            <td class="px-6 py-2 text-xs font-medium text-gray-500 uppercase">Title</td>
            <td class="px-6 py-2 text-xs font-medium text-gray-500 uppercase">Author</td>
            <td class="px-6 py-2 text-xs font-medium text-gray-500 uppercase">Created</td>
        </tr>
        </thead>
        <tbody class="divide-y divide-gray-200 dark:divide-gray-700">
        @foreach($categories as $category)
            <tr class="odd:bg-white even:bg-gray-100 dark:odd:bg-slate-900 dark:even:bg-slate-800 text-center">
                @if (!is_null($category->document_category_id))
                    <td class="px-6 py-2 whitespace-nowrap text-sm font-medium text-gray-800 dark:text-gray-200">{{ $category->documentCategory->title }}</td>
                @else
                    <td class="px-6 py-2 whitespace-nowrap text-sm font-medium text-gray-800 dark:text-gray-200"></td>
                @endif
                <td class="px-6 py-2 whitespace-nowrap text-sm font-normal text-gray-800 dark:text-gray-200">{{ $category->title }}</td>
                <td class="px-6 py-2 whitespace-nowrap text-sm font-normal text-gray-800 dark:text-gray-200">{{ $category->user->name }}</td>
                <td class="px-6 py-2 whitespace-nowrap text-sm font-normal text-gray-800 dark:text-gray-200">{{ $category->created_at->format('m/d/Y h:m:s') }}</td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>
