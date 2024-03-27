<?php

use Livewire\Volt\Component;

new class extends Component {
    public function searchResults(string $partial): void
    {

    }
}; ?>

<div class="tw-shadow-md tw-rounded-lg tw-p-4">
    <div class="tw-flex tw-justify-between tw-items-center tw-mb-2 tw-shadow-md tw-rounded-lg tw-p-4">
        <div></div>
        <div>
            <label for="search" class="sr-only">Search</label>
            <input type="text" id="search" wire:model="search" class="tw-py-3 tw-px-4 tw-block w-full tw-border-gray-200 tw-rounded-lg text-sm focus:tw-border-blue-500 focus:tw-ring-blue-500 disabled:tw-opacity-50 disabled:tw-pointer-events-none dark:tw-bg-slate-900 dark:tw-border-gray-700 dark:tw-text-gray-400 dark:focus:tw-ring-gray-600" placeholder="Search" x-on:input="$wire.searchResults($el.value);">
        </div>
    </div>
</div>
