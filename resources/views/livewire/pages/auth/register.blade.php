<?php

use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules;
use JetBrains\PhpStorm\NoReturn;
use Livewire\Attributes\Layout;
use Livewire\Volt\Component;
use Livewire\WithFileUploads;
use App\Models\Client;
use Carbon\Carbon;
use Illuminate\Support\Str;
use Livewire\Attributes\Validate;

new /**
 * This class represents a user registration component.
 * It extends the Component class and uses the WithFileUploads trait.
 *
 * @package App\Components
 */ #[Layout('layouts.guest')] class extends Component {

    use WithFileUploads;

    public Collection $clientList;
    public array $vendorList;
    public bool $is_admin = false;
    public bool $is_client = false;
    public bool $is_employee = false;
    public bool $is_vendor = false;
    public bool $active = false;
    public bool $locked = false;
    public $photo;
    public string $profile_picture_path = '';
    public string $client_name = '';
    public ?int $client_id = null;
    public string $vendor_name = '';
    public ?int $vendor_id = null;
    public string $first_name = '';
    public string $last_name = '';
    public ?string $name = null;
    public string $email = '';
    public string $password = '';
    public string $password_confirmation = '';
    public ?string $phone_fax = null;
    public ?string $phone_mobile = null;
    public ?string $phone_work = null;
    public string $sex = '';
    public ?string $date_of_birth = null;
    public ?int $dob_day = null;
    public ?int $dob_month = null;
    public ?int $dob_year = null;
    public ?string $facebook = null;
    public ?string $instagram = null;
    public ?string $tiktok = null;
    public ?string $twitter = null;
    public ?string $url = null;

    public function mount(): void
    {
        $this->clientList = $this->getClients();
        $this->vendorList = $this->getVendors();
    }

    /**
     * Handle an incoming registration request.
     */
    #[NoReturn] public function register(): void
    {
        if (!empty($this->photo)) {
            $this->savePhoto($this->photo);
        }

        $this->generateName();

        $this->generateDateOfBirthString();

        $validated = $this->validate([
            'client_id' => ['nullable', 'exists:clients'],
            'is_admin' => ['boolean'],
            'is_client' => ['boolean'],
            'is_employee' => ['boolean'],
            'is_vendor' => ['boolean'],
            'active' => ['boolean'],
            'locked' => ['boolean'],
            'profile_picture_path' => ['nullable', 'string'],
            'first_name' => ['required', 'string', 'max:50'],
            'last_name' => ['required', 'string', 'max:50'],
            'name' => ['required', 'string', 'max:50'],
            'email' => ['required', 'string', 'lowercase', 'email:rfc,dns,spoof', 'max:255', 'unique:' . User::class],
            'password' => ['required', 'string', 'confirmed'],
            'phone_fax' => ['nullable', 'string'],
            'phone_mobile' => ['nullable', 'string'],
            'phone_work' => ['nullable', 'string'],
            'sex' => ['required', 'string', Rule::in(['male', 'female', 'other'])],
            'date_of_birth' => ['required', 'string'],
            'facebook' => ['nullable', 'string'],
            'instagram' => ['nullable', 'string'],
            'tiktok' => ['nullable', 'string'],
            'twitter' => ['nullable', 'string'],
            'url' => ['nullable', 'string'],
        ]);

        $validated['password'] = Hash::make($validated['password']);

        event(new Registered($user = User::create($validated)));

        Auth::login($user);

        $this->redirect(RouteServiceProvider::HOME, navigate: true);
    }

    public function savePhoto($photo, $path = 'public/profile-pictures'): void
    {
        $path = 'storage/' . $photo->storePublicly(path: $path);
        $path = str_replace('public/', '', $path);
        $this->profile_picture_path = $path;
    }

    public function generateName(): void
    {
        $this->name = $this->first_name . ' ' . $this->last_name;
    }

    public function generateDateOfBirthString(): void
    {
        $this->date_of_birth = Carbon::create($this->dob_year, $this->dob_month, $this->dob_day)->toDateString();
    }

    public function trueUserType($admin, $client, $employee, $vendor): void
    {
        $this->is_admin = $admin;
        $this->is_client = $client;
        $this->is_employee = $employee;
        $this->is_vendor = $vendor;
    }

    public function getClients(): Collection
    {
        return Client::all();
    }

    public function setClient($client): void
    {
        $this->client_name = $client;
        $this->getClientId($client);
    }

    public function getClientId($client): void
    {
        $id = Client::select('id')
            ->where('legal_name', '=', $client)
            ->limit(1)
            ->get();
        $this->client_id = $id[0]->id;
    }

    public function getVendors(): array
    {
        return [];
    }

    public function setVendor($vendor): void
    {
        $this->vendor_name = $vendor;
        $this->getVendorId($vendor);
    }

    public function getVendorId($vendor): void
    {
        $this->vendor_id = null;
    }
}; ?>

<div class="max-w-4xl px-4 py-10 sm:px-6 lg:px-8 lg:py-14 mx-auto">
    <style>

    </style>
    <form wire:submit="register" autocomplete="off">
        <label for="hidden" class="hidden"></label>
        <input autocomplete="false" id="hidden" name="hidden" type="text" style="display:none;" />
        <!-- Card -->
        <div class="bg-white rounded-xl shadow p-4 sm:p-7 dark:bg-slate-900">
            <div class="mb-8">
                <h2 class="text-xl font-bold text-gray-800 dark:text-gray-200">
                    Registration
                </h2>
                <p class="text-sm text-gray-600 dark:text-gray-400">
                    Set up your profile for use on the site.
                </p>
            </div>

            @if ($errors->any())
                <div class="text-red-500 mb-8">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form wire:submit="register">
                <div
                    class="grid sm:grid-cols-12 gap-2 sm:gap-6"
                    x-data="{
                        upload: false,
                        photoName: null,
                        photoPreview: null,
                        generatedUrl: null,
                        is_admin: false,
                        is_client: false,
                        is_employee: false,
                        is_vendor: false
                    }"
                    x-init=""
                >
                    <!-- TODO: Remove in prod -->
                    <div class="sm:col-span-12"
                    >
                        <div class="grid sm:grid-cols-2 gap-2">
                            <label for="is-admin"
                                   class="flex p-2 w-full bg-white border border-gray-200 rounded-lg text-sm focus:border-blue-500 focus:ring-blue-500 dark:bg-slate-900 dark:border-gray-700 dark:text-gray-400">
                                <input id="is-admin"
                                       name="is-admin"
                                       wire:model="is_admin"
                                       type="checkbox"
                                       class="shrink-0 mt-0.5 border-gray-200 rounded text-blue-600 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-gray-800 dark:border-gray-700 dark:checked:bg-blue-500 dark:checked:border-blue-500 dark:focus:ring-offset-gray-800"
                                       x-bind:value="is_admin"
                                       x-model="is_admin"
                                       x-on:change="
                                            is_client = false;
                                            is_employee = false;
                                            is_vendor = false;
                                            $el.value = (is_admin)
                                            $wire.trueUserType(is_admin, is_client, is_employee, is_vendor)
                                       "
                                />
                                <span class="text-sm text-gray-500 ms-3 dark:text-gray-400">Admin</span>
                            </label>

                            <label for="is-client"
                                   class="flex p-2 w-full bg-white border border-gray-200 rounded-lg text-sm focus:border-blue-500 focus:ring-blue-500 dark:bg-slate-900 dark:border-gray-700 dark:text-gray-400">
                                <input id="is-client"
                                       name="is-client"
                                       wire:model="is_client"
                                       type="checkbox"
                                       class="shrink-0 mt-0.5 border-gray-200 rounded text-blue-600 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-gray-800 dark:border-gray-700 dark:checked:bg-blue-500 dark:checked:border-blue-500 dark:focus:ring-offset-gray-800"
                                       x-bind:value="is_client"
                                       x-model="is_client"
                                       x-on:change="
                                            is_admin = false;
                                            is_employee = false;
                                            is_vendor = false;
                                            $el.value = (is_client)
                                            $wire.trueUserType(is_admin, is_client, is_employee, is_vendor)
                                       "
                                />
                                <span class="text-sm text-gray-500 ms-3 dark:text-gray-400">Client</span>
                            </label>

                            <label for="is-employee"
                                   class="flex p-2 w-full bg-white border border-gray-200 rounded-lg text-sm focus:border-blue-500 focus:ring-blue-500 dark:bg-slate-900 dark:border-gray-700 dark:text-gray-400">
                                <input id="is-employee"
                                       name="is-employee"
                                       wire:model="is_employee"
                                       type="checkbox"
                                       class="shrink-0 mt-0.5 border-gray-200 rounded text-blue-600 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-gray-800 dark:border-gray-700 dark:checked:bg-blue-500 dark:checked:border-blue-500 dark:focus:ring-offset-gray-800"
                                       x-bind:value="is_employee"
                                       x-model="is_employee"
                                       x-on:change="
                                            is_admin = false;
                                            is_client = false;
                                            is_vendor = false;
                                            $el.value = (is_employee)
                                            $wire.trueUserType(is_admin, is_client, is_employee, is_vendor)
                                       "
                                />
                                <span class="text-sm text-gray-500 ms-3 dark:text-gray-400">Employee</span>
                            </label>

                            <label for="is-vendor"
                                   class="flex p-2 w-full bg-white border border-gray-200 rounded-lg text-sm focus:border-blue-500 focus:ring-blue-500 dark:bg-slate-900 dark:border-gray-700 dark:text-gray-400">
                                <input id="is-vendor"
                                       name="is-vendor"
                                       wire:model="is_vendor"
                                       type="checkbox"
                                       class="shrink-0 mt-0.5 border-gray-200 rounded text-blue-600 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-gray-800 dark:border-gray-700 dark:checked:bg-blue-500 dark:checked:border-blue-500 dark:focus:ring-offset-gray-800"
                                       x-bind:value="is_vendor"
                                       x-model="is_vendor"
                                       x-on:change="
                                            is_admin = false;
                                            is_client = false;
                                            is_employee = false;
                                            $el.value = (is_vendor)
                                            $wire.trueUserType(is_admin, is_client, is_employee, is_vendor)
                                       "
                                />
                                <span class="text-sm text-gray-500 ms-3 dark:text-gray-400">Vendor</span>
                            </label>
                        </div>
                    </div>
                    <!-- TODO: Remove in prod -->
                    <div class="sm:col-span-12">
                        <hr>
                    </div>
                    <!-- TODO: Remove in prod -->
                    <div class="sm:col-span-12">
                        <div class="grid sm:grid-cols-2 gap-2">
                            <label for="active"
                                   class="flex p-2 w-full bg-white border border-gray-200 rounded-lg text-sm focus:border-blue-500 focus:ring-blue-500 dark:bg-slate-900 dark:border-gray-700 dark:text-gray-400">
                                <input
                                    id="active"
                                    name="active"
                                    wire:model="active"
                                    type="checkbox"
                                    class="shrink-0 mt-0.5 border-gray-200 rounded text-blue-600 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-gray-800 dark:border-gray-700 dark:checked:bg-blue-500 dark:checked:border-blue-500 dark:focus:ring-offset-gray-800"
                                />
                                <span class="text-sm text-gray-500 ms-3 dark:text-gray-400">Active</span>
                            </label>

                            <label for="locked"
                                   class="flex p-2 w-full bg-white border border-gray-200 rounded-lg text-sm focus:border-blue-500 focus:ring-blue-500 dark:bg-slate-900 dark:border-gray-700 dark:text-gray-400">
                                <input
                                    id="locked"
                                    name="locked"
                                    wire:model="locked" type="checkbox"
                                    class="shrink-0 mt-0.5 border-gray-200 rounded text-blue-600 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-gray-800 dark:border-gray-700 dark:checked:bg-blue-500 dark:checked:border-blue-500 dark:focus:ring-offset-gray-800"
                                />
                                <span class="text-sm text-gray-500 ms-3 dark:text-gray-400">Locked</span>
                            </label>
                        </div>
                    </div>
                    <!-- TODO: Remove in prod -->
                    <div class="sm:col-span-12">
                        <hr>
                    </div>
                    <div class="sm:col-span-3">
                        <label for="" class="inline-block text-sm text-gray-800 mt-2.5 dark:text-gray-200">
                            Profile Photo
                        </label>
                    </div>

                    <div class="sm:col-span-9">
                        <div class="flex items-center gap-5">
                            <img
                                x-show="! upload"
                                class="inline-block size-16 rounded-full ring-2 ring-white dark:ring-gray-800"
                                src="{{ asset('build/assets/images/authentication/default_profile_picture.jpg') }}"
                                alt="Image Description" id="profile-picture-preview"
                            />
                            <span
                                x-show="upload"
                                class="inline-block size-16 rounded-full bg-cover bg-no-repeat bg-center ring-2 ring-white dark:ring-gray-800"
                                x-bind:style="'background-image: url(\'' + photoPreview + '\');'"
                                id="profile-picture-preview"
                            >
                            </span>
                            <div class="flex gap-x-2">
                                <div>
                                    <input
                                        type="file"
                                        name="photo"
                                        id="photo"
                                        class="hidden"
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
                                            console.log(photoName, photoPreview)
                                        "
                                    />
                                    <button
                                        type="button"
                                        class="py-2 px-3 inline-flex items-center gap-x-2 text-sm font-medium rounded-lg border border-gray-200 bg-white text-gray-800 shadow-sm hover:bg-gray-50 disabled:opacity-50 disabled:pointer-events-none dark:bg-slate-900 dark:border-gray-700 dark:text-white dark:hover:bg-gray-800 dark:focus:outline-none dark:focus:ring-1 dark:focus:ring-gray-600"
                                        x-on:click.prevent="$refs.photo.click()"
                                    >
                                        <x-fas-upload class="size-4" />
                                        Upload photo
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-span-12">
                        <hr>
                    </div>

                    <div class="sm:col-span-3" x-show="is_client">
                        <label for="client-select" class="inline-block text-sm text-gray-800 mt-2.5 dark:text-gray-200">
                            Client
                        </label>
                    </div>

                    <div class="sm:col-span-9" x-show="is_client">
                        <input
                            id="client-select"
                            name="client-select"
                            type="text"
                            class="py-2 px-3 pe-3 block w-full border-gray-200 shadow-sm text-sm rounded-lg focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-slate-900 dark:border-gray-700 dark:text-gray-400 dark:focus:ring-gray-600"
                            list="clients"
                            wire:model="client_name"
                            x-on:change="
                                    $wire.setClient($el.value)
                               "
                        >
                        <datalist id="clients">
                            @foreach($clientList as $client)
                                <option value="{{ $client->legal_name }}">{{ $client->legal_name }}</option>
                            @endforeach
                        </datalist>
                        <!-- End Select -->
                    </div>

                    <div class="sm:col-span-3" x-show="is_vendor">
                        <label for="vendor-select" class="inline-block text-sm text-gray-800 mt-2.5 dark:text-gray-200">
                            Vendor
                        </label>
                    </div>

                    <div class="sm:col-span-9" x-show="is_vendor">
                        <input
                            id="vendor-select"
                            name="vendor-select"
                            type="text"
                            class="py-2 px-3 pe-3 block w-full border-gray-200 shadow-sm text-sm rounded-lg focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-slate-900 dark:border-gray-700 dark:text-gray-400 dark:focus:ring-gray-600"
                            list="vendors"
                            wire:model="vendor_name"
                            x-on:change="
                                $wire.setVendor($el.value)
                            "
                        >
                        <datalist id="vendors">
                            @foreach($vendorList as $vendor)
                                <option value="{{ $vendor->legal_name }}">{{ $vendor->legal_name }}</option>
                            @endforeach
                        </datalist>
                        <!-- End Select -->
                    </div>

                    <div class="col-span-12" x-show="is_client || is_vendor">
                        <hr>
                    </div>

                    <div class="sm:col-span-3">
                        <label for="email" class="inline-block text-sm text-gray-800 mt-2.5 dark:text-gray-200">
                            Email
                        </label>
                        <div class="hs-tooltip inline-block">
                            <button type="button" class="hs-tooltip-toggle ms-1">

                                <x-ri-information-line class="size-4 text-gray-400 dark:text-gray-600" />
                            </button>
                            <span
                                class="hs-tooltip-content hs-tooltip-shown:opacity-100 hs-tooltip-shown:visible opacity-0 transition-opacity inline-block absolute invisible w-40 text-center z-10 py-1 px-2 bg-gray-900 text-xs font-medium text-white rounded shadow-sm dark:bg-slate-700"
                                role="tooltip">
                                This will be your login for the application
                            </span>
                        </div>
                    </div>

                    <div class="sm:col-span-9">
                        <input
                            id="email"
                            name="email"
                            wire:model="email"
                            type="email"
                            class="py-2 px-3 pe-11 block w-full border-gray-200 shadow-sm text-sm rounded-lg focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-slate-900 dark:border-gray-700 dark:text-gray-400 dark:focus:ring-gray-600"
                            placeholder="maria@site.com">
                    </div>
                    <!-- End Col -->

                    <div class="sm:col-span-3">
                        <label for="password" class="inline-block text-sm text-gray-800 mt-2.5 dark:text-gray-200">
                            Password
                        </label>
                    </div>
                    <!-- End Col -->

                    <div class="sm:col-span-9" x-data="{ changed: false }">
                        <div class="space-y-2">
                            <div class="">
                                <div class="flex" :class="(changed) ? 'mb-2' : ''">
                                    <div class="flex-1">
                                        <div class="relative">
                                            <input id="password" type="password"
                                                   class="py-2 px-3 pe-11 block w-full border-gray-200 shadow-sm rounded-lg text-sm focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-slate-900 dark:border-gray-700 dark:text-gray-400 dark:focus:ring-gray-600"
                                                   placeholder="Enter your password" autocomplete="new-password"
                                                   x-on:input="
                                                       ($el.value.length > 0) ? changed = true : changed = false
                                                   "
                                                   wire:ignore
                                                   wire:model="password"
                                            />
                                            <button type="button" data-hs-toggle-password='{
                                                "target": "#password"
                                            }'
                                                    class="absolute top-0 end-0 p-3.5 rounded-e-md dark:focus:outline-none dark:focus:ring-1 dark:focus:ring-gray-600">
                                                <svg class="flex-shrink-0 size-3.5 text-gray-400 dark:text-neutral-600"
                                                     width="24" height="24" viewBox="0 0 24 24" fill="none"
                                                     stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                                     stroke-linejoin="round">
                                                    <path class="hs-password-active:hidden"
                                                          d="M9.88 9.88a3 3 0 1 0 4.24 4.24"/>
                                                    <path class="hs-password-active:hidden"
                                                          d="M10.73 5.08A10.43 10.43 0 0 1 12 5c7 0 10 7 10 7a13.16 13.16 0 0 1-1.67 2.68"/>
                                                    <path class="hs-password-active:hidden"
                                                          d="M6.61 6.61A13.526 13.526 0 0 0 2 12s3 7 10 7a9.74 9.74 0 0 0 5.39-1.61"/>
                                                    <line class="hs-password-active:hidden" x1="2" x2="22" y1="2"
                                                          y2="22"/>
                                                    <path class="hidden hs-password-active:block"
                                                          d="M2 12s3-7 10-7 10 7 10 7-3 7-10 7-10-7-10-7Z"/>
                                                    <circle class="hidden hs-password-active:block" cx="12" cy="12"
                                                            r="3"/>
                                                </svg>
                                            </button>
                                        </div>
                                        <div id="hs-strong-password" data-hs-strong-password='{
                                                "target": "#password",
                                                "hints": "#hs-strong-password-hints",
                                                "stripClasses": "hs-strong-password:opacity-100 hs-strong-password-accepted:bg-green-500 h-2 flex-auto rounded-full bg-red-500 opacity-50 mx-1",
                                                "minLength": "10"
                                              }' class="flex mt-2 -mx-1" x-show="changed" wire:ignore
                                        ></div>
                                    </div>
                                </div>

                                <div id="hs-strong-password-hints" class="mb-3" x-show="changed" wire:ignore>
                                    <div>
                                        <span class="text-sm text-gray-800 dark:text-gray-200">Level:</span>
                                        <span
                                            data-hs-strong-password-hints-weakness-text='["Empty", "Weak", "Medium", "Strong", "Very Strong", "Super Strong"]'
                                            class="text-sm font-semibold text-gray-800 dark:text-gray-200"></span>
                                    </div>

                                    <h4 class="my-2 text-sm font-semibold text-gray-800 dark:text-white">
                                        Your password must contain:
                                    </h4>

                                    <ul class="space-y-1 text-sm text-red-500">
                                        <li data-hs-strong-password-hints-rule-text="min-length"
                                            class="hs-strong-password-active:text-teal-500 flex items-center gap-x-2">
                                            <span class="hidden" data-check>
                                                <svg class="flex-shrink-0 size-4" xmlns="http://www.w3.org/2000/svg"
                                                     width="24" height="24"
                                                     viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                     stroke-width="2" stroke-linecap="round"
                                                     stroke-linejoin="round"><polyline points="20 6 9 17 4 12"/></svg>
                                            </span>
                                            <span data-uncheck>
                                                <svg class="flex-shrink-0 size-4" xmlns="http://www.w3.org/2000/svg"
                                                     width="24" height="24"
                                                     viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                     stroke-width="2" stroke-linecap="round"
                                                     stroke-linejoin="round"><path d="M18 6 6 18"/><path
                                                        d="m6 6 12 12"/></svg>
                                            </span>
                                            Minimum number of characters is 10.
                                        </li>
                                        <li data-hs-strong-password-hints-rule-text="lowercase"
                                            class="hs-strong-password-active:text-teal-500 flex items-center gap-x-2">
                                            <span class="hidden" data-check>
                                                <svg class="flex-shrink-0 size-4" xmlns="http://www.w3.org/2000/svg"
                                                     width="24" height="24"
                                                     viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                     stroke-width="2" stroke-linecap="round"
                                                     stroke-linejoin="round"><polyline points="20 6 9 17 4 12"/></svg>
                                            </span>
                                            <span data-uncheck>
                                                <svg class="flex-shrink-0 size-4" xmlns="http://www.w3.org/2000/svg"
                                                     width="24" height="24"
                                                     viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                     stroke-width="2" stroke-linecap="round"
                                                     stroke-linejoin="round"><path d="M18 6 6 18"/><path
                                                        d="m6 6 12 12"/></svg>
                                            </span>
                                            Should contain lowercase.
                                        </li>
                                        <li data-hs-strong-password-hints-rule-text="uppercase"
                                            class="hs-strong-password-active:text-teal-500 flex items-center gap-x-2">
                                            <span class="hidden" data-check>
                                                <svg class="flex-shrink-0 size-4" xmlns="http://www.w3.org/2000/svg"
                                                     width="24" height="24"
                                                     viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                     stroke-width="2" stroke-linecap="round"
                                                     stroke-linejoin="round"><polyline points="20 6 9 17 4 12"/></svg>
                                            </span>
                                            <span data-uncheck>
                                                <svg class="flex-shrink-0 size-4" xmlns="http://www.w3.org/2000/svg"
                                                     width="24" height="24"
                                                     viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                     stroke-width="2" stroke-linecap="round"
                                                     stroke-linejoin="round"><path d="M18 6 6 18"/><path
                                                        d="m6 6 12 12"/></svg>
                                            </span>
                                            Should contain uppercase.
                                        </li>
                                        <li data-hs-strong-password-hints-rule-text="numbers"
                                            class="hs-strong-password-active:text-teal-500 flex items-center gap-x-2">
                                            <span class="hidden" data-check>
                                                <svg class="flex-shrink-0 size-4" xmlns="http://www.w3.org/2000/svg"
                                                     width="24" height="24"
                                                     viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                     stroke-width="2" stroke-linecap="round"
                                                     stroke-linejoin="round"><polyline points="20 6 9 17 4 12"/></svg>
                                            </span>
                                            <span data-uncheck>
                                                <svg class="flex-shrink-0 size-4" xmlns="http://www.w3.org/2000/svg"
                                                     width="24" height="24"
                                                     viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                     stroke-width="2" stroke-linecap="round"
                                                     stroke-linejoin="round"><path d="M18 6 6 18"/><path
                                                        d="m6 6 12 12"/></svg>
                                            </span>
                                            Should contain numbers.
                                        </li>
                                        <li data-hs-strong-password-hints-rule-text="special-characters"
                                            class="hs-strong-password-active:text-teal-500 flex items-center gap-x-2">
                                            <span class="hidden" data-check>
                                                <svg class="flex-shrink-0 size-4" xmlns="http://www.w3.org/2000/svg"
                                                     width="24" height="24"
                                                     viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                     stroke-width="2" stroke-linecap="round"
                                                     stroke-linejoin="round"><polyline points="20 6 9 17 4 12"/></svg>
                                            </span>
                                            <span data-uncheck>
                                                <svg class="flex-shrink-0 size-4" xmlns="http://www.w3.org/2000/svg"
                                                     width="24" height="24"
                                                     viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                     stroke-width="2" stroke-linecap="round"
                                                     stroke-linejoin="round"><path d="M18 6 6 18"/><path
                                                        d="m6 6 12 12"/></svg>
                                            </span>
                                            Should contain special characters.
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- End Col -->

                    <div class="sm:col-span-3">
                        <label for="password-confirmation"
                               class="inline-block text-sm text-gray-800 mt-2.5 dark:text-gray-200">
                            Confirm Password
                        </label>
                    </div>
                    <!-- End Col -->

                    <div class="sm:col-span-9">
                        <!-- Form Group -->
                        <div class="">
                            <div class="relative">
                                <input
                                    id="password-confirmation"
                                    name="password-confirmation"
                                    wire:model="password_confirmation"
                                    type="password"
                                    class="py-2 px-4 block w-full border-gray-200 rounded-lg text-sm focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-slate-900 dark:border-gray-700 dark:text-gray-400 dark:focus:ring-gray-600"
                                    placeholder="Confirm your password"
                                />
                                <button type="button" data-hs-toggle-password='{
                                        "target": "#password-confirmation"
                                    }'
                                        class="absolute top-0 end-0 p-3.5 rounded-e-md dark:focus:outline-none dark:focus:ring-1 dark:focus:ring-gray-600"
                                >
                                    <svg class="flex-shrink-0 size-3.5 text-gray-400 dark:text-neutral-600" width="24"
                                         height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                         stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                        <path class="hs-password-active:hidden" d="M9.88 9.88a3 3 0 1 0 4.24 4.24"/>
                                        <path class="hs-password-active:hidden"
                                              d="M10.73 5.08A10.43 10.43 0 0 1 12 5c7 0 10 7 10 7a13.16 13.16 0 0 1-1.67 2.68"/>
                                        <path class="hs-password-active:hidden"
                                              d="M6.61 6.61A13.526 13.526 0 0 0 2 12s3 7 10 7a9.74 9.74 0 0 0 5.39-1.61"/>
                                        <line class="hs-password-active:hidden" x1="2" x2="22" y1="2" y2="22"/>
                                        <path class="hidden hs-password-active:block"
                                              d="M2 12s3-7 10-7 10 7 10 7-3 7-10 7-10-7-10-7Z"/>
                                        <circle class="hidden hs-password-active:block" cx="12" cy="12" r="3"/>
                                    </svg>
                                </button>
                            </div>
                        </div>
                        <!-- End Form Group -->
                    </div>
                    <!-- End Col -->

                    <div class="col-span-12">
                        <hr>
                    </div>

                    <div class="sm:col-span-3">
                        <label for="first_name" class="inline-block text-sm text-gray-800 mt-2.5 dark:text-gray-200">
                            Full name
                        </label>
                        <label for="last_name" class="hidden">

                        </label>
                    </div>

                    <div class="sm:col-span-9">
                        <div class="sm:flex">
                            <input id="first_name" name="first_name" wire:model="first_name" type="text"
                                   class="py-2 px-3 pe-11 block w-full border-gray-200 shadow-sm -mt-px -ms-px first:rounded-t-lg last:rounded-b-lg sm:first:rounded-s-lg sm:mt-0 sm:first:ms-0 sm:first:rounded-se-none sm:last:rounded-es-none sm:last:rounded-e-lg text-sm relative focus:z-10 focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-slate-900 dark:border-gray-700 dark:text-gray-400 dark:focus:ring-gray-600"
                                   placeholder="Maria">
                            <input id="last_name" name="last_name" wire:model="last_name" type="text"
                                   class="py-2 px-3 pe-11 block w-full border-gray-200 shadow-sm -mt-px -ms-px first:rounded-t-lg last:rounded-b-lg sm:first:rounded-s-lg sm:mt-0 sm:first:ms-0 sm:first:rounded-se-none sm:last:rounded-es-none sm:last:rounded-e-lg text-sm relative focus:z-10 focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-slate-900 dark:border-gray-700 dark:text-gray-400 dark:focus:ring-gray-600"
                                   placeholder="Boone">
                        </div>
                    </div>

                    <div class="sm:col-span-3">
                        <div class="inline-block">
                            <label for="phone-mobile" class="inline-block text-sm text-gray-800 mt-2.5 dark:text-gray-200">
                                Mobile Phone
                            </label>
                            <span class="text-sm text-gray-400 dark:text-gray-600">
                                (Optional)
                            </span>
                        </div>
                    </div>
                    <!-- End Col -->

                    <div class="sm:col-span-9">
                        <input
                            id="phone-mobile"
                            name="phone-mobile"
                            wire:model="phone_mobile"
                            type="tel"
                            class="py-2 px-3 pe-11 block w-full border-gray-200 shadow-sm -mt-px -ms-px rounded-lg sm:mt-0 text-sm relative focus:z-10 focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-slate-900 dark:border-gray-700 dark:text-gray-400 dark:focus:ring-gray-600"
                            placeholder="123-456-7890" x-mask="999-999-9999"
                        >
                    </div>
                    <!-- End Col -->

                    <div class="sm:col-span-3">
                        <div class="inline-block">
                            <label for="phone-work" class="inline-block text-sm text-gray-800 mt-2.5 dark:text-gray-200">
                                Work Phone
                            </label>
                            <span class="text-sm text-gray-400 dark:text-gray-600">
                                (Optional)
                            </span>
                        </div>
                    </div>
                    <!-- End Col -->

                    <div class="sm:col-span-9">

                        <input
                            id="phone-work"
                            name="phone-work"
                            wire:model="phone_work"
                            type="tel"
                            class="py-2 px-3 pe-11 block w-full border-gray-200 shadow-sm -mt-px -ms-px rounded-lg sm:mt-0 text-sm relative focus:z-10 focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-slate-900 dark:border-gray-700 dark:text-gray-400 dark:focus:ring-gray-600"
                            placeholder="123-456-7890" x-mask="999-999-9999"
                        >
                    </div>
                    <!-- End Col -->

                    <div class="sm:col-span-3">
                        <div class="inline-block">
                            <label for="phone-fax" class="inline-block text-sm text-gray-800 mt-2.5 dark:text-gray-200">
                                Fax
                            </label>
                            <span class="text-sm text-gray-400 dark:text-gray-600">
                                (Optional)
                            </span>
                        </div>
                    </div>
                    <!-- End Col -->

                    <div class="sm:col-span-9">
                        <input
                            id="phone"
                            name="phone"
                            wire:model="phone_fax"
                            type="tel"
                            class="py-2 px-3 pe-11 block w-full border-gray-200 shadow-sm -mt-px -ms-px rounded-lg sm:mt-0 text-sm relative focus:z-10 focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-slate-900 dark:border-gray-700 dark:text-gray-400 dark:focus:ring-gray-600"
                            placeholder="123-456-7890" x-mask="999-999-9999"
                        >
                    </div>
                    <!-- End Col -->

                    <div class="sm:col-span-3">
                        <label for="sex" class="inline-block text-sm text-gray-800 mt-2.5 dark:text-gray-200">
                            Gender
                        </label>
                    </div>
                    <!-- End Col -->

                    <div class="sm:col-span-9"
                         x-data="{
                        male: false,
                        female: false,
                        other: false
                    }"
                    >
                        <div class="sm:flex">
                            <label for="sex"
                                   class="flex py-2 px-3 w-full border border-gray-200 shadow-sm -mt-px -ms-px first:rounded-t-lg last:rounded-b-lg sm:first:rounded-s-lg sm:mt-0 sm:first:ms-0 sm:first:rounded-se-none sm:last:rounded-es-none sm:last:rounded-e-lg text-sm relative focus:z-10 focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-slate-900 dark:border-gray-700 dark:text-gray-400 dark:focus:ring-gray-600">
                                <input type="radio" id="sex" name="sex" wire:model="sex" value="male"
                                       class="shrink-0 mt-0.5 border-gray-300 rounded-full text-blue-600 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-800 dark:border-neutral-500 dark:checked:bg-blue-500 dark:checked:border-blue-500 dark:focus:ring-offset-gray-800"
                                >
                                <span class="text-sm text-gray-500 ms-3 dark:text-gray-400">Male</span>
                            </label>

                            <label for="af-account-gender-checkbox-female"
                                   class="flex py-2 px-3 w-full border border-gray-200 shadow-sm -mt-px -ms-px first:rounded-t-lg last:rounded-b-lg sm:first:rounded-s-lg sm:mt-0 sm:first:ms-0 sm:first:rounded-se-none sm:last:rounded-es-none sm:last:rounded-e-lg text-sm relative focus:z-10 focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-slate-900 dark:border-gray-700 dark:text-gray-400 dark:focus:ring-gray-600">
                                <input type="radio" id="sex" name="sex" wire:model="sex" value="female"
                                       class="shrink-0 mt-0.5 border-gray-300 rounded-full text-blue-600 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-800 dark:border-neutral-500 dark:checked:bg-blue-500 dark:checked:border-blue-500 dark:focus:ring-offset-gray-800"
                                >
                                <span class="text-sm text-gray-500 ms-3 dark:text-gray-400">Female</span>
                            </label>

                            <label for="af-account-gender-checkbox-other"
                                   class="flex py-2 px-3 w-full border border-gray-200 shadow-sm -mt-px -ms-px first:rounded-t-lg last:rounded-b-lg sm:first:rounded-s-lg sm:mt-0 sm:first:ms-0 sm:first:rounded-se-none sm:last:rounded-es-none sm:last:rounded-e-lg text-sm relative focus:z-10 focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-slate-900 dark:border-gray-700 dark:text-gray-400 dark:focus:ring-gray-600">
                                <input type="radio" id="sex" name="sex" wire:model="sex" value="other"
                                       class="shrink-0 mt-0.5 border-gray-300 rounded-full text-blue-600 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-800 dark:border-neutral-500 dark:checked:bg-blue-500 dark:checked:border-blue-500 dark:focus:ring-offset-gray-800"
                                >
                                <span class="text-sm text-gray-500 ms-3 dark:text-gray-400">Other</span>
                            </label>
                        </div>
                    </div>

                    <div class="sm:col-span-3">
                        <label for="date_of_birth" class="inline-block text-sm text-gray-800 mt-2.5 dark:text-gray-200">
                            Date of Birth
                        </label>
                        <label for="dob-month" class="hidden"></label>
                        <label for="dob-day" class="hidden"></label>
                        <label for="dob-year" class="hidden"></label>
                        <label for="" class="hidden"></label>
                    </div>

                    <div class="sm:col-span-9 grid sm:grid-cols-3 gap-8">
                        <div class="col-span-1">
                            <select id="dob-month" name="dob-month" wire:model="dob_month"
                                    class="py-2 px-3 pe-11 block w-full border-gray-200 shadow-sm rounded-lg text-sm focus:z-10 focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-slate-900 dark:border-gray-700 dark:text-gray-400 dark:focus:ring-gray-600"
                            >
                                <option selected>Month</option>
                                @for($i = 1; $i < 13; $i++)
                                    <option value="{{ str_pad($i, 2, 0, STR_PAD_LEFT) }}">{{ str_pad($i, 2, 0, STR_PAD_LEFT) }}</option>
                                @endfor
                            </select>
                        </div>
                        <div class="col-span-1">
                            <select id="dob-day" name="dob-day" wire:model="dob_day"
                                    class="py-2 px-3 pe-11 block w-full border-gray-200 shadow-sm rounded-lg text-sm focus:z-10 focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-slate-900 dark:border-gray-700 dark:text-gray-400 dark:focus:ring-gray-600"
                            >
                                <option selected>Day</option>
                                @for($i = 1; $i < 32; $i++)
                                    <option value="{{ str_pad($i, 2, 0, STR_PAD_LEFT) }}">{{ str_pad($i, 2, 0, STR_PAD_LEFT) }}</option>
                                @endfor
                            </select>
                        </div>
                        <div class="col-span-1">
                            <select id="dob-year" name="dob-year" wire:model="dob_year"
                                    class="py-2 px-3 pe-11 block w-full border-gray-200 shadow-sm rounded-lg text-sm focus:z-10 focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-slate-900 dark:border-gray-700 dark:text-gray-400 dark:focus:ring-gray-600"
                            >
                                <option selected>Year</option>
                                @php
                                    $year = date("Y") - 16
                                @endphp
                                @for($i = $year; $i > 1899; $i--)
                                    <option value="{{ $i }}">{{ $i }}</option>
                                @endfor
                            </select>
                        </div>
                    </div>
                    <!-- End Col -->

                    <div class="col-span-12 grid sm:grid-cols-12 gap-2 sm:gap-6" x-show="is_client || is_vendor">
                        <div class="col-span-12">
                            <hr>
                        </div>

                        <div class="sm:col-span-3">
                            <label for="facebook" class="inline-block text-sm text-gray-800 mt-2.5 dark:text-gray-200">
                                Facebook
                            </label>
                        </div>

                        <div class="sm:col-span-9">
                            <div class="flex rounded-lg shadow-sm">
                                <span
                                    class="px-4 inline-flex items-center min-w-fit rounded-s-md border border-e-0 border-gray-200 bg-gray-50 text-sm text-gray-500 dark:bg-gray-700 dark:border-gray-700 dark:text-gray-400">
                                    <x-fab-facebook class="h-5 w-5" />
                                </span>
                                <input
                                    id="facebook"
                                    name="facebook"
                                    wire:model="facebook"
                                    type="text"
                                    class="py-2 px-3 pe-11 block w-full border-gray-200 shadow-sm rounded-e-lg text-sm focus:z-10 focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-slate-900 dark:border-gray-700 dark:text-gray-400 dark:focus:ring-gray-600"
                                >
                            </div>
                        </div>
                        <!-- End Col -->

                        <div class="sm:col-span-3">
                            <label for="instagram" class="inline-block text-sm text-gray-800 mt-2.5 dark:text-gray-200">
                                Instagram
                            </label>
                        </div>

                        <div class="sm:col-span-9">
                            <div class="flex rounded-lg shadow-sm">
                                <span
                                    class="px-4 inline-flex items-center min-w-fit rounded-s-md border border-e-0 border-gray-200 bg-gray-50 text-sm text-gray-500 dark:bg-gray-700 dark:border-gray-700 dark:text-gray-400">
                                    <x-fab-instagram class="h-5 w-5" />
                                </span>
                                <input
                                    id="instagram"
                                    name="instagram"
                                    wire:model="instagram"
                                    type="text"
                                    class="py-2 px-3 pe-11 block w-full border-gray-200 shadow-sm rounded-e-lg text-sm focus:z-10 focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-slate-900 dark:border-gray-700 dark:text-gray-400 dark:focus:ring-gray-600"
                                >
                            </div>
                        </div>
                        <!-- End Col -->

                        <div class="sm:col-span-3">
                            <label for="tiktok" class="inline-block text-sm text-gray-800 mt-2.5 dark:text-gray-200">
                                TikTok
                            </label>
                        </div>

                        <div class="sm:col-span-9">
                            <div class="flex rounded-lg shadow-sm">
                                <span
                                    class="px-4 inline-flex items-center min-w-fit rounded-s-md border border-e-0 border-gray-200 bg-gray-50 text-sm text-gray-500 dark:bg-gray-700 dark:border-gray-700 dark:text-gray-400">
                                    <x-fab-tiktok class="h-5 w-5" />
                                </span>
                                <input
                                    id="tiktok"
                                    name="tiktok"
                                    wire:model="tiktok"
                                    type="text"
                                    class="py-2 px-3 pe-11 block w-full border-gray-200 shadow-sm rounded-e-lg text-sm focus:z-10 focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-slate-900 dark:border-gray-700 dark:text-gray-400 dark:focus:ring-gray-600"
                                >
                            </div>
                        </div>
                        <!-- End Col -->

                        <div class="sm:col-span-3">
                            <label for="twitter" class="inline-block text-sm text-gray-800 mt-2.5 dark:text-gray-200">
                                Twitter / X
                            </label>
                        </div>

                        <div class="sm:col-span-9">
                            <div class="flex rounded-lg shadow-sm">
                                <span
                                    class="px-4 inline-flex items-center min-w-fit rounded-s-md border border-e-0 border-gray-200 bg-gray-50 text-sm text-gray-500 dark:bg-gray-700 dark:border-gray-700 dark:text-gray-400">
                                        <x-fab-x-twitter class="h-5 w-5" />
                                </span>
                                <input
                                    id="twitter"
                                    name="twitter"
                                    wire:model="twitter"
                                    type="text"
                                    class="py-2 px-3 pe-11 block w-full border-gray-200 shadow-sm rounded-e-lg text-sm focus:z-10 focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-slate-900 dark:border-gray-700 dark:text-gray-400 dark:focus:ring-gray-600"
                                >
                            </div>
                        </div>
                        <!-- End Col -->

                        <div class="sm:col-span-3">
                            <label for="url" class="inline-block text-sm text-gray-800 mt-2.5 dark:text-gray-200">
                                Website
                            </label>
                        </div>

                        <div class="sm:col-span-9">
                            <div class="flex rounded-lg shadow-sm">
                                <span
                                    class="px-4 inline-flex items-center min-w-fit rounded-s-md border border-e-0 border-gray-200 bg-gray-50 text-sm text-gray-500 dark:bg-gray-700 dark:border-gray-700 dark:text-gray-400">
                                    <x-fas-link class="h-5 w-5" />
                                </span>
                                <input
                                    id="url"
                                    name="url"
                                    wire:model="url"
                                    type="text"
                                    class="py-2 px-3 pe-11 block w-full border-gray-200 shadow-sm rounded-e-lg text-sm focus:z-10 focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-slate-900 dark:border-gray-700 dark:text-gray-400 dark:focus:ring-gray-600"
                                >
                            </div>
                        </div>
                        <!-- End Col -->
                    </div>

                </div>
                <div class="flex items-center justify-end mt-4">
                    <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
                       href="{{ route('login') }}" wire:navigate>
                        {{ __('Already registered?') }}
                    </a>

                    <x-primary-button class="ms-4">
                        {{ __('Register') }}
                    </x-primary-button>
                </div>
        </div>
    </form>
</div>
