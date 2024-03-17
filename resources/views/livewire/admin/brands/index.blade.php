<?php

use Livewire\Volt\Component;
use Livewire\Attributes\On;
use Illuminate\Database\Eloquent\Collection;
use App\Models\Brand;

new class extends Component {
    public Collection $brands;

    public function mount(): void
    {
        $this->getBrands();
    }

    #[On('brand-created')]
    public function getBrands(): void
    {
        $this->brands = Brand::orderBy('legal_name')->get();
    }
}; ?>

<div>
    <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
        <thead>
        <tr class="text-center">
            <td class="px-6 py-2 text-xs font-medium text-gray-500 uppercase">Registered State</td>
            <td class="px-6 py-2 text-xs font-medium text-gray-500 uppercase">Legal Name</td>
            <td class="px-6 py-2 text-xs font-medium text-gray-500 uppercase">DBA</td>
            <td class="px-6 py-2 text-xs font-medium text-gray-500 uppercase">Abbreviation</td>
            <td class="px-6 py-2 text-xs font-medium text-gray-500 uppercase">Residential</td>
            <td class="px-6 py-2 text-xs font-medium text-gray-500 uppercase">Commercial</td>
            <td class="px-6 py-2 text-xs font-medium text-gray-500 uppercase">Created</td>
            <td class="px-6 py-2 text-xs font-medium text-gray-500 uppercase">Updated</td>
            <td class="px-6 py-2 text-xs font-medium text-gray-500 uppercase">Actions</td>
        </tr>
        </thead>
        <tbody class="divide-y divide-gray-200 dark:divide-gray-700">
        @if(isset($brands[0]))
            @foreach($brands as $brand)
                <tr class="odd:bg-white even:bg-gray-100 dark:odd:bg-slate-900 dark:even:bg-slate-800 text-center">
                    <td class="px-6 py-2 whitespace-nowrap text-sm font-normal text-gray-800 dark:text-gray-200">{{ $brand->registered_state }}</td>
                    <td class="px-6 py-2 whitespace-nowrap text-sm font-normal text-gray-800 dark:text-gray-200">{{ $brand->legal_name }}</td>
                    <td class="px-6 py-2 whitespace-nowrap text-sm font-normal text-gray-800 dark:text-gray-200">{{ $brand->dba }}</td>
                    <td class="px-6 py-2 whitespace-nowrap text-sm font-normal text-gray-800 dark:text-gray-200">{{ $brand->abbreviation }}</td>
                    <td class="px-6 py-2 whitespace-nowrap text-sm font-normal text-gray-800 dark:text-gray-200">

                    </td>
                    <td class="px-6 py-2 whitespace-nowrap text-sm font-normal text-gray-800 dark:text-gray-200">

                    </td>
                    <td class="px-6 py-2 whitespace-nowrap text-sm font-normal text-gray-800 dark:text-gray-200">{{ $brand->created_at }}</td>
                    <td class="px-6 py-2 whitespace-nowrap text-sm font-normal text-gray-800 dark:text-gray-200">{{ $brand->updated_at }}</td>
                    <td class="px-6 py-2 whitespace-nowrap text-sm font-normal text-gray-800 dark:text-gray-200">

                    </td>
                </tr>
            @endforeach
        @else
            <tr class="odd:bg-white even:bg-gray-100 dark:odd:bg-slate-900 dark:even:bg-slate-800 text-center">
                <td colspan="9" class="px-6 py-2 whitespace-nowrap text-sm font-normal text-gray-800 dark:text-gray-200">
                    <div class="flex flex-auto flex-col justify-center items-center p-4 md:p-5">
                        <svg class="size-10 text-gray-500" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1" stroke-linecap="round" stroke-linejoin="round">
                            <line x1="22" x2="2" y1="12" y2="12"/>
                            <path d="M5.45 5.11 2 12v6a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2v-6l-3.45-6.89A2 2 0 0 0 16.76 4H7.24a2 2 0 0 0-1.79 1.11z"/>
                            <line x1="6" x2="6.01" y1="16" y2="16"/>
                            <line x1="10" x2="10.01" y1="16" y2="16"/>
                        </svg>
                        <p class="mt-2 text-sm text-gray-800 dark:text-gray-300">
                            {{ __('No data to show') }}
                        </p>
                    </div>
                </td>
            </tr>
        @endif
        </tbody>
    </table>
</div>
