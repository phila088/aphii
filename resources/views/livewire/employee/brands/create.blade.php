<?php

use App\Models\Brand;
use App\Models\States;
use App\Models\City;
use App\Models\StatusCode;
use Livewire\WithFileUploads;
use Livewire\Volt\Component;
use Livewire\Attributes\Validate;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

new class extends Component {
    use WithFileUploads;

    public ?Collection $statuses = null;

    #[Validate('required|string|exists:status_codes,code')]
    public string $status;
    #[Validate('nullable|string')]
    public string $status_reason;
    public string $default_reason;
    #[Validate('required|string|min:2|max:50|unique:brands')]
    public string $name = '';
    #[Validate('nullable|string|min:2|max:50')]
    public string $dba = '';
    #[Validate('required|string|min:1|max:10')]
    public string $abbreviation = '';
    #[Validate('nullable|string')]
    public string $internal_work_order_prefix = '';
    #[Validate('nullable|int|min:1|max:10')]
    public ?int $internal_work_order_max_length = null;
    #[Validate('nullable|int|min:1|max:999')]
    public ?int $internal_work_order_postfix_increment = null;
    #[Validate('nullable|image|max:5120')]
    public $photo;
    #[Validate('nullable|string')]
    public $logo_path;
    #[Validate('nullable|string')]
    public string $fein;
    #[Validate('nullable|string')]
    public string $state_license_number;
    #[Validate('nullable|string')]
    public string $county_license_number;
    #[Validate('nullable|string')]
    public string $city_license_number;

    public function mount(): void
    {
        $this->getStatuses();
    }

    public function getStatuses()
    {
        $this->statuses = StatusCode::where('for_model', '=', 'Brand')->get();
    }

    public function store()
    {
        if ($this->internal_work_order_max_length === null || $this->internal_work_order_max_length === '') {
            $this->internal_work_order_max_length = 6;
        }

        if ($this->internal_work_order_postfix_increment === null || $this->internal_work_order_postfix_increment === '') {
            $this->internal_work_order_postfix_increment = 10;
        }

        $validated = $this->validate();

        if ($brand = auth()->user()->brand()->create($validated)) {

            if (!empty($this->photo)) {
                $path = 'public/brand-logos';
                $path = 'storage/' . $this->photo->storePublicly(path: $path);
                $path = str_replace('public/', '', $path);
                $brand->forceFill([
                    'logo_path' => $path
                ])->save();
            }

            if (empty($this->status_reason)) {
                $reason = StatusCode::where('code', '=', $this->status)
                    ->limit(1)
                    ->get();
                $this->status_reason = $reason[0]->default_reason;
            }

            $brand->setStatus($this->status, $this->status_reason);

            $this->status = '';
            $this->name = '';
            $this->dba = '';
            $this->abbreviation = '';
            $this->internal_work_order_prefix = '';
            $this->internal_work_order_max_length = null;
            $this->internal_work_order_postfix_increment = null;
            $this->photo = null;
            $this->logo_path = null;
            $this->fein = '';
            $this->state_license_number = '';
            $this->county_license_number = '';
            $this->city_license_number = '';

            request()->session()->flash('toast', 'Brand successfully created!');
            request()->session()->flash('toast_type', 'success');

            return redirect()->route('employee.brands.edit', [$brand]);
        }
    }

    public function cityLookupByName(string $name)
    {
        $cities = City::where('name', 'like', '%' . $name . '%')
            ->orderBy('name')
            ->limit(250)
            ->with('state')
            ->get();

        $city = [];

        foreach ($cities as $k => $v) {
            $city[] = [
                'city' => $cities[$k]->name,
                'state' => $cities[$k]->state->code,
                'zip' => $cities[$k]->zip
            ];
        }
        return $city;
    }

    public function cityLookupByZip(string $zip)
    {
        $cities = City::where('zip', 'like', '%' . $zip . '%')
            ->with('state')
            ->orderBy('name')
            ->limit(250)
            ->get();

        if (count($cities) == 1) {
            return $citiy = [
                'city' => $cities[0]->name,
                'state' => $cities[0]->state->code
            ];
        }
    }

}; ?>

<div>
    <form wire:submit="store" class="need-validation" novalidate autocomplete="off">

        <div class="card custom-card">
            <div class="card-header">
                <h1>Status</h1>
            </div>
            <div class="card-body">
                <div class="row">
                    <x-select id="status" model="status" label="Status">
                        <option></option>
                        @foreach ($statuses as $status)
                            <option value="{{ $status->code }}">{{ $status->code }} - {{ $status->title }}</option>
                        @endforeach
                    </x-select>
                    <x-input cols="col-lg-10" id="status-reason" model="status_reason" label="Status reason" />
                </div>
            </div>
        </div>

        <div class="card custom-card">
            <div class="card-header">
                <h1>Brand name</h1>
            </div>
            <div class="card-body">
                <div class="row">
                    <x-input cols="col-lg-3" id="legal-name" model="name" label="Name"
                             class="{{ ($errors->get('name')) ? 'is-invalid' : '' }}" required/>

                    <x-input cols="col-lg-3" id="dba" model="dba" label="DBA"
                             class="{{ ($errors->get('dba')) ? 'is-invalid' : '' }}"/>

                    <x-input id="abbreviation" model="abbreviation"
                             label="Abbreviation" class="{{ ($errors->get('abbreviation')) ? 'is-invalid' : '' }}" required/>
                </div>
            </div>
        </div>
        <div class="card custom-card">
            <div class="card-header">
                <h1>Internal work order settings</h1>
            </div>
            <div class="card-body">
                <div class="col-lg-12 mb-3">
                    <dl>
                        <dl>You can control the internal work order number that is generated automatically.</dl>
                        <dt>Prefix</dt>
                        <dl>The prefix added before an internal work order number. This can be useful if you are running
                            multiple brands.
                        </dl>
                        <dt>Length</dt>
                        <dl>
                            This is the total length of work order number. When you enter a work order number, the system will
                            automatically truncate the last x characters of the work order numbers of the work order number
                            entered,
                            where x is the number entered below, or 6 by default.
                        </dl>
                        <dt>Postfix increment</dt>
                        <dl>
                            As a work order is assigned, and reassigned, the system will automatically append a postfix. You can
                            control the increment of the postfix here.
                        </dl>
                    </dl>
                </div>
                <div class="row">
                    <x-input id="internal-work-order-prefix" model="internal_work_order_prefix"
                             label="Prefix"
                             class="{{ ($errors->get('internal_work_order_prefix')) ? 'is-invalid' : '' }}"/>

                    <x-input id="internal-work-order-max-length" model="internal_work_order_max_length"
                             label="Length"
                             class="{{ ($errors->get('internal_work_order_max_length')) ? 'is-invalid' : '' }}" x-mask="99"/>

                    <x-input id="internal-work-order-postfix-increment"
                             model="internal_work_order_postfix_increment"
                             label="Postfix increment"
                             class="{{ ($errors->get('internal_work_order_postfix_increment')) ? 'is-invalid' : '' }}"
                             x-mask="999"
                             wire:ignore.self
                    />
                </div>
                <div class="row" wire:ignore>
                    <p class="tw-font-bold">Example: </p>
                    <p><span class="fw-semibold">Input: </span><span id="example-work-order-input"></span></p>
                    <p><span class="fw-semibold">Output: </span><span id="example-work-order-output"></span></p>
                </div>
            </div>
        </div>


        <div class="card custom-card">
            <div class="card-header">
                <h1>Brand logo</h1>
            </div>
            <div class="card-body">
                <div
                    class="row g-2"
                    x-data="{
                        upload: false,
                        photoName: null,
                        photoPreview: null,
                        uploading: false,
                        progress: 0
                    }"
                    x-on:livewire-upload-start="uploading = true"
                    x-on:livewire-upload-finish="
                        uploading = false
                    "
                    x-on:livewire-upload-cancel="uploading = false"
                    x-on:livewire-upload-error="uploading = false"
                    x-on:livewire-upload-progress="progress = $event.detail.progress"
                >
                    <!-- Dropzone and input -->
                    <div class="col-md-6 mb-2">
                        <div
                            class="pb-2 tw-flex tw-items-center tw-text-xs tw-text-gray-400 tw-uppercase before:tw-flex-[1_1_0%] before:tw-border-t before:tw-border-gray-200 before:tw-me-6 after:tw-flex-[1_1_0%] after:tw-border-t after:tw-border-gray-200 after:tw-ms-6 dark:tw-text-gray-500 dark:before:tw-border-gray-600 dark:after:tw-border-gray-600">
                            Upload
                        </div>
                        <div id="droparea" class="tw-flex tw-items-center tw-justify-center tw-w-full">
                            <label for="photo"
                                   class="tw-flex tw-flex-col tw-items-center tw-justify-center tw-w-full tw-h-64 tw-border-2 tw-border-gray-300 tw-border-dashed tw-rounded-lg tw-cursor-pointer tw-bg-gray-50 dark:hover:tw-bg-bray-800 dark:tw-bg-gray-700 hover:tw-bg-gray-100 dark:tw-border-gray-600 dark:hover:tw-border-gray-500 dark:hover:tw-bg-gray-600">
                                <div class="tw-flex tw-flex-col tw-items-center tw-justify-center tw-pt-5 tw-pb-6">
                                    <svg class="tw-w-8 tw-h-8 tw-mb-4 tw-text-gray-500 dark:tw-text-gray-400" aria-hidden="true"
                                         xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 16">
                                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                              stroke-width="2"
                                              d="M13 13h3a3 3 0 0 0 0-6h-.025A5.56 5.56 0 0 0 16 6.5 5.5 5.5 0 0 0 5.207 5.021C5.137 5.017 5.071 5 5 5a4 4 0 0 0 0 8h2.167M10 15V6m0 0L8 8m2-2 2 2"/>
                                    </svg>
                                    <p class="tw-mb-2 tw-text-sm tw-tw-text-gray-500 dark:tw-text-gray-400"><span
                                            class="tw-font-semibold">Click to upload</span> or drag and drop</p>
                                    <p class="tw-text-xs tw-text-gray-500 dark:tw-text-gray-400">SVG, PNG, JPG or GIF</p>
                                </div>
                                <input
                                    type="file"
                                    id="photo"
                                    class="tw-hidden"
                                    accept="image/*"
                                    wire:model.live="photo"
                                    x-ref="photo"
                                    x-on:change="
                                        photoName = $refs.photo.files[0].name;
                                        const reader = new FileReader();
                                        reader.onload = (e) => {
                                            photoPreview = e.target.result;
                                        };
                                        reader.readAsDataURL($refs.photo.files[0]);

                                        upload = true;
                                    "
                                />
                            </label>
                        </div>
                    </div>

                    <!-- Previewer -->
                    <div class="col-md-6 mb-2">
                        <div
                            class="pb-2 tw-flex tw-items-center tw-text-xs tw-text-gray-400 tw-uppercase before:tw-flex-[1_1_0%] before:tw-border-t before:tw-border-gray-200 before:tw-me-6 after:tw-flex-[1_1_0%] after:tw-border-t after:tw-border-gray-200 after:tw-ms-6 dark:tw-text-gray-500 dark:before:tw-border-gray-600 dark:after:tw-border-gray-600">
                            Preview
                        </div>
                        <div class="tw-flex tw-items-center tw-justify-center tw-w-full">
                            <div
                                class="tw-flex tw-flex-col tw-items-center tw-justify-center tw-w-full tw-h-64 tw-border-2 tw-border-gray-300 tw-border-dashed tw-rounded-lg tw-cursor-pointer tw-bg-gray-50 dark:hover:tw-bg-bray-800 dark:tw-bg-gray-700 hover:tw-bg-gray-100 dark:tw-border-gray-600 dark:hover:tw-border-gray-500 dark:hover:tw-bg-gray-600">
                                <div x-show="uploading" class="">
                                    <div class="progress" role="progressbar" aria-label="Upload progress" aria-valuenow="0"
                                         aria-valuemin="0" aria-valuemax="100">
                                        <progress class="progress-bar" max="100" x-bind:value="progress"></progress>
                                    </div>
                                </div>
                                <span
                                    x-bind:class="(progress === 100 && !uploading) ? 'tw-inline-block' : 'tw-hidden'"
                                    class="tw-w-full tw-h-full tw-bg-contain tw-bg-no-repeat tw-bg-center"
                                    x-bind:style="'background-image: url(\'' + photoPreview + '\');'"
                                    id="logo-preview"
                                >
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="card custom-card">
            <div class="card-header">
                <h1>Licenses</h1>
            </div>
            <div class="card-body">
                <div class="row g-2">
                    <x-input cols="col-lg-3" id="fein" model="fein" label="FEIN"/>

                    <x-input cols="col-lg-3" id="state-license-number" model="state_license_number"
                             label="State license number"/>

                    <x-input cols="col-lg-3" id="county-license-number" model="county_license_number"
                             label="County license number"/>

                    <x-input cols="col-lg-3" id="city-license-number" model="city_license_number"
                             label="City license number"/>
                </div>
            </div>
        </div>
        <div class="card custom-card">
            <div class="card-body">
                <x-submit id="brand-edit"/>
            </div>
        </div>
    </form>

    @script
    <script>
        const e = document.querySelector("#droparea"), a = document.querySelector("#photo");

        function u(e) {
            e.preventDefault(), e.stopPropagation()
        }

        e.addEventListener("drop", (e => {
            a.files = e.dataTransfer.files, a.dispatchEvent(new Event("change")), e.preventDefault()
        })), ["dragenter", "dragover", "dragleave"].forEach((t => {
            e.addEventListener(t, u, !1)
        }));
        const iwoPrefix = document.querySelector("#internal-work-order-prefix"),
            iwoMaxLength = document.querySelector("#internal-work-order-max-length"),
            iwoPostfixIncrement = document.querySelector("#internal-work-order-postfix-increment"),
            iwoExampleInput = document.querySelector("#example-work-order-input"),
            iwoExampleOutput = document.querySelector("#example-work-order-output");
        let iwoText = "123456789";
        iwoExampleInput.innerText = iwoText, iwoExampleOutput.innerText = iwoPrefix.value + iwoText.substring(iwoText.length - ("" !== iwoMaxLength.value && 0 !== iwoMaxLength.value ? iwoMaxLength.value : 6), iwoText.length) + "-" + ("" !== iwoPostfixIncrement.value && 0 !== iwoPostfixIncrement.value ? iwoPostfixIncrement.value : 10), [iwoPrefix, iwoMaxLength, iwoPostfixIncrement].forEach((e => {
            e.addEventListener("change", (() => {
                iwoExampleOutput.innerText = iwoPrefix.value + iwoText.substring(iwoText.length - ("" !== iwoMaxLength.value && 0 !== iwoMaxLength.value ? iwoMaxLength.value : 6), iwoText.length) + "-" + ("" !== iwoPostfixIncrement.value && 0 !== iwoPostfixIncrement.value ? iwoPostfixIncrement.value : 10)
            }))
        }));

    </script>
    @endscript
</div>
