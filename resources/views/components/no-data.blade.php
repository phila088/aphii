@props(['borderless' => 'true'])
@if($borderless === false)
    <div class="tw-min-h-60 tw-flex tw-flex-col">
        <div class="tw-flex tw-flex-auto tw-flex-col tw-justify-center tw-items-center tw-p-4 md:tw-p-5">
            <svg class="tw-size-10 tw-text-gray-500" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1" stroke-linecap="round" stroke-linejoin="round">
                <line x1="22" x2="2" y1="12" y2="12"/>
                <path d="M5.45 5.11 2 12v6a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2v-6l-3.45-6.89A2 2 0 0 0 16.76 4H7.24a2 2 0 0 0-1.79 1.11z"/>
                <line x1="6" x2="6.01" y1="16" y2="16"/>
                <line x1="10" x2="10.01" y1="16" y2="16"/>
            </svg>
            <p class="tw-mt-5 tw-text-sm tw-text-gray-800 dark:tw-text-gray-300">
                No data to show
            </p>
        </div>
    </div>
@else
    <div class="tw-min-h-60 tw-flex tw-flex-col">
        <div class="tw-flex tw-flex-auto tw-flex-col tw-justify-center tw-items-center tw-p-4 md:tw-p-5">
            <svg class="tw-size-10 tw-text-gray-500" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1" stroke-linecap="round" stroke-linejoin="round">
                <line x1="22" x2="2" y1="12" y2="12"/>
                <path d="M5.45 5.11 2 12v6a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2v-6l-3.45-6.89A2 2 0 0 0 16.76 4H7.24a2 2 0 0 0-1.79 1.11z"/>
                <line x1="6" x2="6.01" y1="16" y2="16"/>
                <line x1="10" x2="10.01" y1="16" y2="16"/>
            </svg>
            <p class="tw-mt-5 tw-text-sm tw-text-gray-800 dark:tw-text-gray-300">
                No data to show
            </p>
        </div>
    </div>
@endif
