<?php

use Livewire\Volt\Component;
use Illuminate\Support\Facades\DB;

new class extends Component {
    public $trashed;

    public function delete($table, $id)
    {
        $record = DB::table($table)->where('id', $id)->get();
    }
}; ?>

<div>
    <div class="card custom-card">
        <div class="card-header">
            <div class="tw-flex tw-justify-between tw-items-center tw-w-full">
                <h2>All trashed items</h2>
            </div>
        </div>
        <div class="card-body">
            <div class="tw-mt-4 tw-divide-y tw-divide-gray-200 dark:tw-divide-gray-700">
                @if (empty($trashed))
                    <x-no-data />
                @else
                    @foreach ($trashed as $table => $trash)
                        @if (!empty($trash[0]))
                            <div class="tw-p-4 tw-flex tw-space-x-2 hover:tw-bg-gray-100 dark:hover:tw-bg-gray-800" wire:key="{{ $trash[0]->id }}">
                                <div class="tw-flex-1">
                                    <div class="tw-flex tw-justify-between tw-items-center">
                                        <div>
                                            <p class="tw-mt-0.5 tw-text-sm">{{ $table }}</p>
                                        </div>
                                    </div>
                                    <div class="tw-text-xs">
                                        <div class="col-12">
                                            @foreach ($trash as $k => $v)
                                                @foreach($v as $column => $data)
                                                    <div class="row g-2">
                                                        <div class="col-6 col-lg-2 tw-font-bold">
                                                            {{ $column }}:
                                                        </div>
                                                        <div class="col-6 col-lg-2">
                                                            {{ $data }}
                                                        </div>
                                                    </div>
                                                @endforeach
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endif
                    @endforeach
                @endif
            </div>
        </div>
    </div>
</div>
