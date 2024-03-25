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

    public $brand;
    public ?Collection $statuses = null;

    #[Validate('required|string|exists:status_codes,code')]
    public ?string $status;
    #[Validate('required|string|min:2|max:50')]
    public ?string $legal_name = '';
    #[Validate('nullable|string|min:2|max:50')]
    public ?string $dba = '';
    #[Validate('required|string|min:1|max:10')]
    public ?string $abbreviation = '';
    #[Validate('nullable|string')]
    public ?string $internal_work_order_prefix = '';
    #[Validate('nullable|int|min:1|max:10')]
    public ?int $internal_work_order_max_length = null;
    #[Validate('nullable|int|min:1|max:999')]
    public ?int $internal_work_order_postfix_increment = null;
    #[Validate('nullable|image|max:5120')]
    public $photo;
    public $logo_path;
    #[Validate('nullable|string')]
    public ?string $fein;
    #[Validate('nullable|string')]
    public ?string $state_license_number;
    #[Validate('nullable|string')]
    public ?string $county_license_number;
    #[Validate('nullable|string')]
    public ?string $city_license_number;

    public function mount(): void
    {
        $this->getStatuses();

        $this->status = $this->brand->status;
        $this->legal_name = $this->brand->legal_name;
        $this->dba = $this->brand->dba;
        $this->abbreviation = $this->brand->abbreviation;
        $this->internal_work_order_prefix = $this->brand->internal_work_order_prefix;
        $this->internal_work_order_max_length = $this->brand->internal_work_order_max_length;
        $this->internal_work_order_postfix_increment = $this->brand->internal_work_order_postfix_increment;
        $this->logo_path = $this->brand->logo_path;
        $this->fein = $this->brand->fein;
        $this->state_license_number = $this->brand->state_license_number;
        $this->county_license_number = $this->brand->county_license_number;
        $this->city_license_number = $this->brand->city_license_number;
    }

    public function getStatuses()
    {
        $this->statuses = StatusCode::where('for_model', '=', 'Brand')->get();
    }

    public function updateBrand()
    {
        $statuses = [];
        foreach($this->statuses as $status) {
            $statuses[] = $status->code;
        }
        $validated = $this->validate([
            'status' => ['required', Rule::in($statuses)],
            'legal_name' => ['required', 'string', 'min:2', 'max:50', Rule::unique('brands')->ignore($this->brand->id)],
            'dba' => ['nullable', 'string', 'min:2', 'max:50'],
            'abbreviation' => ['required', 'string', 'min:2', 'max:50', Rule::unique('brands')->ignore($this->brand->id)],
            'internal_work_order_prefix' => ['nullable', 'string'],
            'internal_work_order_max_length' => ['nullable', 'int', 'min:1', 'max:10'],
            'internal_work_order_postfix_increment' => ['nullable', 'int', 'min:1', 'max:999'],
            'photo' => ['nullable', 'image', 'max:5120'],
            'state_license_number' => ['nullable', 'string'],
            'county_license_number' => ['nullable', 'string'],
            'city_license_number' => ['nullable', 'string'],
        ]);

        if ($this->brand->update($validated)) {

            if (!empty($this->photo)) {
                $path = 'public/brand-logos';
                $path = 'storage/' . $this->photo->storePublicly(path: $path);
                $path = str_replace('public/', '', $path);
                $this->brand->forceFill([
                    'logo_path' => $path
                ])->save();
            }

            $this->brand->setStatus($this->status);

            $this->dispatch('brand-updated');
        }
    }
}; ?>

<div>
    <form wire:submit="updateBrand" class="need-validation" novalidate autocomplete="off">
        <h1 class="tw-text-lg">Status</h1>

        <div class="row g-2">
            <x-select id="status" model="status" label="Status">
                <option></option>
                @foreach ($statuses as $status)
                    <option value="{{ $status->code }}">{{ $status->code }} - {{ $status->title }}</option>
                @endforeach
            </x-select>
        </div>

        <x-hr />

        <x-hr />

        <h1 class="tw-text-lg">Brand name</h1>

        <div class="row g-2">
            <p>These settings will help identify the brand throughout the site.</p>
            <dl>
                <dt>Legal name</dt>
                <dl>This is the full legal name of the brand to be created.</dl>
                <dt>DBA</dt>
                <dl>The name that will be displayed on all forms. If you do not use a DBA, the legal name will be used instead.</dl>
                <dt>Abbreviation</dt>
                <dl>This is the name that will be displayed within the system to represent the brand.</dl>
            </dl>
        </div>

        <div class="row g-2">
            <x-input cols="col-lg-3" id="legal-name" model="legal_name" placeholder="Legal name" label="Legal name" class="{{ ($errors->get('legal_name')) ? 'is-invalid' : '' }}" required />

            <x-input cols="col-lg-3" id="dba" model="dba" placeholder="DBA" label="DBA" class="{{ ($errors->get('dba')) ? 'is-invalid' : '' }}" />

            <x-input cols="col-lg-3" id="abbreviation" model="abbreviation" placeholder="Abbreviation" label="Abbreviation" class="{{ ($errors->get('abbreviation')) ? 'is-invalid' : '' }}" required />
        </div>

        <x-hr />

        <h1 class="tw-text-lg">Internal work order settings</h1>

        <div class="row g-2">
            <p>You can control the internal work order number that is generated automatically.</p>
            <dl>
                <dt>Prefix</dt>
                <dl>The prefix added before an internal work order number. This can be useful if you are running multiple brands.</dl>
                <dt>Length</dt>
                <dl>
                    This is the total length of work order number. When you enter a work order number, the system will
                    automatically truncate the last x characters of the work order numbers of the work order number entered,
                    where x is the number entered below, or 6 by default.
                </dl>
                <dt>Postfix increment</dt>
                <dl>
                    As a work order is assigned, and reassigned, the system will automatically append a postfix. You can
                    control the increment of the postfix here.
                </dl>
            </dl>
        </div>

        <div class="row g-2">
            <x-input cols="col-lg-3" id="internal-work-order-prefix" model="internal_work_order_prefix" placeholder="Prefix" label="Prefix" class="{{ ($errors->get('internal_work_order_prefix')) ? 'is-invalid' : '' }}" />

            <x-input cols="col-lg-3" id="internal-work-order-max-length" model="internal_work_order_max_length" placeholder="Length" label="Length" class="{{ ($errors->get('internal_work_order_max_length')) ? 'is-invalid' : '' }}" x-mask="99" />

            <x-input cols="col-lg-3" id="internal-work-order-postfix-increment" model="internal_work_order_postfix_increment" placeholder="Postfix increment" label="Postfix increment" class="{{ ($errors->get('internal_work_order_postfix_increment')) ? 'is-invalid' : '' }}" x-mask="999" />
        </div>

        <div class="row g-2" wire:ignore>
            <p class="tw-font-bold">Example: </p>
            <p class="tw-font-semibold">Input: </p>
            <p id="example-work-order-input"></p>
            <p class="tw-font-semibold">Output: </p>
            <p id="example-work-order-output"></p>
        </div>

        <x-hr />

        <!-- Start logo upload -->
        <div
            class="row g-2"
            x-data="{
                upload: false,
                photoName: null,
                photoPreview: null,
                uploading: false,
                progress: 0,
                logo: false
            }"
            x-on:livewire-upload-start="uploading = true"
            x-on:livewire-upload-finish="
                uploading = false
            "
            x-on:livewire-upload-cancel="uploading = false"
            x-on:livewire-upload-error="uploading = false"
            x-on:livewire-upload-progress="progress = $event.detail.progress"
            x-init="
                logo = ($wire.logo_path !== '') ? true : false
            "
        >

            <h1 class="tw-text-lg">Brand logo</h1>

            <!-- Dropzone and input -->
            <div class="col-md-6 mb-2">
                <div class="pb-2 tw-flex tw-items-center tw-text-xs tw-text-gray-400 tw-uppercase before:tw-flex-[1_1_0%] before:tw-border-t before:tw-border-gray-200 before:tw-me-6 after:tw-flex-[1_1_0%] after:tw-border-t after:tw-border-gray-200 after:tw-ms-6 dark:tw-text-gray-500 dark:before:tw-border-gray-600 dark:after:tw-border-gray-600">Upload</div>
                <div id="droparea" class="tw-flex tw-items-center tw-justify-center tw-w-full">
                    <label for="photo" class="tw-flex tw-flex-col tw-items-center tw-justify-center tw-w-full tw-h-64 tw-border-2 tw-border-gray-300 tw-border-dashed tw-rounded-lg tw-cursor-pointer tw-bg-gray-50 dark:hover:tw-bg-bray-800 dark:tw-bg-gray-700 hover:tw-bg-gray-100 dark:tw-border-gray-600 dark:hover:tw-border-gray-500 dark:hover:tw-bg-gray-600">
                        <div class="tw-flex tw-flex-col tw-items-center tw-justify-center tw-pt-5 tw-pb-6">
                            <svg class="tw-w-8 tw-h-8 tw-mb-4 tw-text-gray-500 dark:tw-text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 16">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 13h3a3 3 0 0 0 0-6h-.025A5.56 5.56 0 0 0 16 6.5 5.5 5.5 0 0 0 5.207 5.021C5.137 5.017 5.071 5 5 5a4 4 0 0 0 0 8h2.167M10 15V6m0 0L8 8m2-2 2 2"/>
                            </svg>
                            <p class="tw-mb-2 tw-text-sm tw-tw-text-gray-500 dark:tw-text-gray-400"><span class="tw-font-semibold">Click to upload</span> or drag and drop</p>
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

                                logo = false
                            "
                        />
                    </label>
                </div>
            </div>

            <!-- Previewer -->
            <div class="col-md-6 mb-2">
                <div class="pb-2 tw-flex tw-items-center tw-text-xs tw-text-gray-400 tw-uppercase before:tw-flex-[1_1_0%] before:tw-border-t before:tw-border-gray-200 before:tw-me-6 after:tw-flex-[1_1_0%] after:tw-border-t after:tw-border-gray-200 after:tw-ms-6 dark:tw-text-gray-500 dark:before:tw-border-gray-600 dark:after:tw-border-gray-600">Preview</div>
                <div class="tw-flex tw-items-center tw-justify-center tw-w-full">
                    <div class="tw-flex tw-flex-col tw-items-center tw-justify-center tw-w-full tw-h-64 tw-border-2 tw-border-gray-300 tw-border-dashed tw-rounded-lg tw-cursor-pointer tw-bg-gray-50 dark:hover:tw-bg-bray-800 dark:tw-bg-gray-700 hover:tw-bg-gray-100 dark:tw-border-gray-600 dark:hover:tw-border-gray-500 dark:hover:tw-bg-gray-600">
                        <div x-show="uploading" class="">
                            <div class="progress" role="progressbar" aria-label="Upload progress" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100">
                                <progress class="progress-bar" max="100" x-bind:value="progress"></progress>
                            </div>
                        </div>
                        <span
                            x-bind:class="(progress === 0 && !uploading && logo) ? 'tw-inline-block' : 'tw-hidden'"
                            class="tw-w-full tw-h-full tw-bg-contain tw-bg-no-repeat tw-bg-center"
                            x-bind:style="'background-image: url(\'{{ asset($logo_path) }}\');'"
                            id="logo-preview"
                        >
                        </span>
                        <span
                            x-bind:class="(progress === 100 && !uploading && !logo) ? 'tw-inline-block' : 'tw-hidden'"
                            class="tw-w-full tw-h-full tw-bg-contain tw-bg-no-repeat tw-bg-center"
                            x-bind:style="'background-image: url(\'' + photoPreview + '\');'"
                            id="logo-preview"
                        >
                        </span>
                    </div>
                </div>
            </div>
        </div>

        <x-hr />

        <h1 class="tw-text-lg">Licenses</h1>

        <div class="row g-2">
            <x-input cols="col-lg-3" id="fein" model="fein" placeholder="FEIN" label="FEIN" />

            <x-input cols="col-lg-3" id="state-license-number" model="state_license_number" placeholder="State license number" label="State license number" />

            <x-input cols="col-lg-3" id="county-license-number" model="county_license_number" placeholder="County license number" label="County license number" />

            <x-input cols="col-lg-3" id="city-license-number" model="city_license_number" placeholder="City license number" label="City license number" />
        </div>

        <x-hr />

        <x-submit />

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
