@props(['borderless' => 'true'])
@if($borderless === false)
    <div class="tw-min-h-60 tw-flex tw-flex-col tw-bg-white tw-border tw-shadow-sm tw-rounded-xl dark:tw-bg-slate-900 dark:tw-border-gray-700 dark:tw-shadow-slate-700/[.7]">
        <div class="tw-flex tw-flex-auto tw-flex-col tw-justify-center tw-items-center tw-p-4 md:tw-p-5">
            <svg class="tw-size-10 tw-text-gray-500" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-shield-x"><path d="M20 13c0 5-3.5 7.5-7.66 8.95a1 1 0 0 1-.67-.01C7.5 20.5 4 18 4 13V6a1 1 0 0 1 1-1c2 0 4.5-1.2 6.24-2.72a1.17 1.17 0 0 1 1.52 0C14.51 3.81 17 5 19 5a1 1 0 0 1 1 1z"/><path d="m14.5 9.5-5 5"/><path d="m9.5 9.5 5 5"/></svg>
            <p class="tw-mt-5 tw-text-sm tw-text-gray-800 dark:tw-text-gray-300">
                Not authorized
            </p>
        </div>
    </div>
@else
    <div class="tw-min-h-60 tw-flex tw-flex-col tw-rounded-xl dark:tw-bg-slate-900 dark:tw-border-gray-700 dark:tw-shadow-slate-700/[.7]">
        <div class="tw-flex tw-flex-auto tw-flex-col tw-justify-center tw-items-center tw-p-4 md:tw-p-5">
            <svg class="tw-size-10 tw-text-gray-500" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-shield-x"><path d="M20 13c0 5-3.5 7.5-7.66 8.95a1 1 0 0 1-.67-.01C7.5 20.5 4 18 4 13V6a1 1 0 0 1 1-1c2 0 4.5-1.2 6.24-2.72a1.17 1.17 0 0 1 1.52 0C14.51 3.81 17 5 19 5a1 1 0 0 1 1 1z"/><path d="m14.5 9.5-5 5"/><path d="m9.5 9.5 5 5"/></svg>
            <p class="tw-mt-5 tw-text-sm tw-text-gray-800 dark:tw-text-gray-300">
                Not authorized
            </p>
        </div>
    </div>
@endif
