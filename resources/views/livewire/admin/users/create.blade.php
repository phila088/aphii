<?php

use Livewire\WithFileUploads;
use Livewire\Volt\Component;
use Livewire\Attributes\Validate;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Illuminate\Support\Carbon;
use Illuminate\Auth\Events\Registered;

new class extends Component {
    use WithFileUploads;

    public array $timezones;

    #[Validate('required|boolean')]
    public bool $is_admin = false;
    #[Validate('required|boolean')]
    public bool $is_client = false;
    #[Validate('required|boolean')]
    public bool $is_employee = false;
    #[Validate('required|boolean')]
    public bool $is_vendor = false;
    #[Validate('required|boolean')]
    public bool $active = true;
    #[Validate('required|boolean')]
    public bool $locked = false;
    #[Validate('nullable|image|max:5120')]
    public $photo;
    public string $profile_picture_path;
    #[Validate('required|string|min:1|max:50')]
    public string $first_name = '';
    #[Validate('required|string|min:1|max:50')]
    public string $last_name = '';
    public string $name = '';
    #[Validate('required|email:rfc,dns,spoof,filter|min:1|max:50')]
    public string $email;
    #[Validate('required|string|min:10|max:50')]
    public string $password;
    #[Validate('required|string|min:10|max:50|same:password')]
    public string $verify_password;
    #[Validate('required|string')]
    public string $sex;
    #[Validate('required|date')]
    public string $date_of_birth;
    #[Validate('required|string')]
    public string $timezone;

    public function mount(): void
    {
        $this->timezones = (__('selects.timezones'));
    }

    public function createUser(): void
    {
        $this->authorize('users.create');

        $this->name = $this->first_name . ' ' . $this->last_name;

        $beforeDate = Carbon::create(now())->subtract('15 years and 364 days')->toString();

        $validated = $this->validate([
            'is_admin' => ['required', 'boolean'],
            'is_client' => ['required', 'boolean'],
            'is_employee' => ['required', 'boolean'],
            'is_vendor' => ['required', 'boolean'],
            'active' => ['required', 'boolean'],
            'locked' => ['required', 'boolean'],
            'photo' => ['nullable', 'image', 'max:5120'],
            'first_name' => ['required', 'string', 'min:1', 'max:50'],
            'last_name' => ['required', 'string', 'min:1', 'max:50'],
            'name' => ['required', 'string', 'min:1', 'max:50'],
            'email' => ['required', 'email:rfc,dns,spoof,filter', 'min:5', 'max:50'],
            'password' => ['required', 'min:10', 'max:255'],
            'verify_password' => ['required', 'min:10', 'max:255'],
            'sex' => ['required', 'string', Rule::in(['female', 'male'])],
            'date_of_birth' => ['required', 'before:' . $beforeDate],
            'timezone' => ['required', Rule::in($this->timezones)],
        ]);

        $validated['password'] = Hash::make($validated['password']);

        if ($user = auth()->user()->user()->create($validated)) {
            if (!empty($this->photo)) {
                $path = 'public/profile-pictures';
                $path = 'storage/' . $this->photo->storePublicly(path: $path);
                $path = str_replace('public/', '', $path);
            } else {
                if ($this->sex === 'female') {
                    $path = 'storage/profile-pictures/default-profile-picture-female-icon.svg';
                } else {
                    $path = 'storage/profile-pictures/default-profile-picture-male-icon.svg';
                }
            }

            $user->forceFill([
                'profile_picture_path' => $path
            ])->save();

            $this->dispatch('user-created');

            event(new Registered($user));

            $this->is_admin = false;
            $this->is_client = false;
            $this->is_employee = false;
            $this->is_vendor = false;
            $this->active = true;
            $this->locked = false;
            $this->photo = null;
            $this->profile_picture_path = '';
            $this->first_name = '';
            $this->last_name = '';
            $this->name = '';
            $this->email = '';
            $this->password = '';
            $this->verify_password = '';
            $this->sex = '';
            $this->date_of_birth = '';
            $this->timezone = '';
        }
    }

    public function userType($admin, $client, $Employee, $vendor): void
    {
        $this->is_admin = $admin;
        $this->is_client = $client;
        $this->is_employee = $Employee;
        $this->is_vendor = $vendor;
    }
}; ?>

<div>
    <form wire:submit="createUser" class="needs-validation" novalidate autocomplete="off">
        <div class="card custom-card">
            <div class="card-body">
                <h1>Create user</h1>
            </div>
        </div>
        <div class="card custom-card">
            <div class="card-header">
                <div class="tw-flex tw-justify-between tw-items-center tw-w-full">
                    <h2>Account type & account locks</h2>
                    <button type="button" data-bs-toggle="modal" data-bs-target="#account-type-and-account-locks-modal">
                        <i class="bi bi-question-circle"></i>
                    </button>
                </div>
            </div>
            <div class="card-body">
                <div class="row g-2">
                    <div class="col-lg-6">
                        <h3>Account type</h3>

                        <div class="col-lg-12 tw-my-6"
                             x-data="{
                            is_admin: false,
                            is_client: false,
                            is_employee: false,
                            is_vendor: false
                         }"
                        >
                            <div class="form-check-inline">
                                <div class="tw-relative tw-inline-block">
                                    <input type="checkbox" id="is_admin" wire:model="is_admin"
                                           class="tw-peer tw-relative tw-w-11 tw-h-6 tw-p-px tw-bg-gray-100 tw-border-transparent tw-text-transparent tw-rounded-full tw-cursor-pointer tw-transition-colors tw-ease-in-out tw-duration-200 focus:tw-ring-blue-600 disabled:tw-opacity-50 disabled:tw-pointer-events-none checked:tw-bg-none checked:tw-text-blue-600 checked:tw-border-blue-600 focus:checked:tw-border-blue-600 dark:tw-bg-gray-800 dark:tw-border-gray-700 dark:checked:tw-bg-blue-500 dark:checked:tw-border-blue-500 dark:focus:tw-ring-offset-gray-600 before:tw-inline-block before:tw-size-5 before:tw-bg-white checked:before:tw-bg-blue-200 before:tw-translate-x-0 checked:before:tw-translate-x-full before:tw-rounded-full before:tw-shadow before:tw-transform before:tw-ring-0 before:tw-transition before:tw-ease-in-out before:tw-duration-200 dark:before:tw-bg-gray-400 dark:checked:before:tw-bg-blue-200"
                                           x-model="is_admin"
                                           x-bind:value="is_admin"
                                           x-on:change='
                                        $el.value = (is_admin);
                                        is_client = false;
                                        is_employee = false;
                                        is_vendor = false;
                                        $wire.userType(is_admin, is_client, is_employee, is_vendor);
                                    '
                                    >
                                    <span
                                        class="peer-checked:tw-text-white tw-text-gray-500 tw-size-5 tw-absolute tw-top-[3px] tw-start-0.5 tw-flex tw-justify-center tw-items-center tw-pointer-events-none tw-transition-colors tw-ease-in-out tw-duration-200">
                                <svg class="tw-flex-shrink-0 tw-size-3" xmlns="http://www.w3.org/2000/svg" width="24"
                                     height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                     stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path
                                        d="M18 6 6 18"/><path d="m6 6 12 12"/></svg>
                                </span>
                                    <span
                                        class="peer-checked:tw-text-blue-600 tw-text-gray-500 tw-size-5 tw-absolute tw-top-[3px] tw-end-0.5 tw-flex tw-justify-center tw-items-center tw-pointer-events-none tw-transition-colors tw-ease-in-out tw-duration-200">
                                    <svg class="tw-flex-shrink-0 tw-size-3" xmlns="http://www.w3.org/2000/svg"
                                         width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                         stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><polyline
                                            points="20 6 9 17 4 12"/></svg>
                                </span>
                                </div>
                                <label for="is_admin" class="">Admin</label>
                            </div>

                            <div class="form-check-inline">
                                <div class="tw-relative tw-inline-block">
                                    <input type="checkbox" id="is_client" wire:model="is_client"
                                           class="tw-peer tw-relative tw-w-11 tw-h-6 tw-p-px tw-bg-gray-100 tw-border-transparent tw-text-transparent tw-rounded-full tw-cursor-pointer tw-transition-colors tw-ease-in-out tw-duration-200 focus:tw-ring-blue-600 disabled:tw-opacity-50 disabled:tw-pointer-events-none checked:tw-bg-none checked:tw-text-blue-600 checked:tw-border-blue-600 focus:checked:tw-border-blue-600 dark:tw-bg-gray-800 dark:tw-border-gray-700 dark:checked:tw-bg-blue-500 dark:checked:tw-border-blue-500 dark:focus:tw-ring-offset-gray-600 before:tw-inline-block before:tw-size-5 before:tw-bg-white checked:before:tw-bg-blue-200 before:tw-translate-x-0 checked:before:tw-translate-x-full before:tw-rounded-full before:tw-shadow before:tw-transform before:tw-ring-0 before:tw-transition before:tw-ease-in-out before:tw-duration-200 dark:before:tw-bg-gray-400 dark:checked:before:tw-bg-blue-200"
                                           x-model="is_client"
                                           x-bind:value="is_client"
                                           x-on:change='
                                            $el.value = (is_client);
                                            is_admin = false;
                                            is_employee = false;
                                            is_vendor = false;
                                            $wire.userType(is_admin, is_client, is_employee, is_vendor);
                                    '
                                    >
                                    <span
                                        class="peer-checked:tw-text-white tw-text-gray-500 tw-size-5 tw-absolute tw-top-[3px] tw-start-0.5 tw-flex tw-justify-center tw-items-center tw-pointer-events-none tw-transition-colors tw-ease-in-out tw-duration-200">
                                <svg class="tw-flex-shrink-0 tw-size-3" xmlns="http://www.w3.org/2000/svg" width="24"
                                     height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                     stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path
                                        d="M18 6 6 18"/><path d="m6 6 12 12"/></svg>
                                </span>
                                    <span
                                        class="peer-checked:tw-text-blue-600 tw-text-gray-500 tw-size-5 tw-absolute tw-top-[3px] tw-end-0.5 tw-flex tw-justify-center tw-items-center tw-pointer-events-none tw-transition-colors tw-ease-in-out tw-duration-200">
                                    <svg class="tw-flex-shrink-0 tw-size-3" xmlns="http://www.w3.org/2000/svg"
                                         width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                         stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><polyline
                                            points="20 6 9 17 4 12"/></svg>
                                </span>
                                </div>
                                <label for="is_client" class="">Client</label>
                            </div>

                            <div class="form-check-inline">
                                <div class="tw-relative tw-inline-block">
                                    <input type="checkbox" id="is_employee" wire:model="is_employee"
                                           class="tw-peer tw-relative tw-w-11 tw-h-6 tw-p-px tw-bg-gray-100 tw-border-transparent tw-text-transparent tw-rounded-full tw-cursor-pointer tw-transition-colors tw-ease-in-out tw-duration-200 focus:tw-ring-blue-600 disabled:tw-opacity-50 disabled:tw-pointer-events-none checked:tw-bg-none checked:tw-text-blue-600 checked:tw-border-blue-600 focus:checked:tw-border-blue-600 dark:tw-bg-gray-800 dark:tw-border-gray-700 dark:checked:tw-bg-blue-500 dark:checked:tw-border-blue-500 dark:focus:tw-ring-offset-gray-600 before:tw-inline-block before:tw-size-5 before:tw-bg-white checked:before:tw-bg-blue-200 before:tw-translate-x-0 checked:before:tw-translate-x-full before:tw-rounded-full before:tw-shadow before:tw-transform before:tw-ring-0 before:tw-transition before:tw-ease-in-out before:tw-duration-200 dark:before:tw-bg-gray-400 dark:checked:before:tw-bg-blue-200"
                                           x-model="is_employee"
                                           x-bind:value="is_employee"
                                           x-on:change='
                                        $el.value = (is_employee);
                                        is_admin = false;
                                        is_client = false;
                                        is_vendor = false;
                                        $wire.userType(is_admin, is_client, is_employee, is_vendor);
                                    '
                                    >
                                    <span
                                        class="peer-checked:tw-text-white tw-text-gray-500 tw-size-5 tw-absolute tw-top-[3px] tw-start-0.5 tw-flex tw-justify-center tw-items-center tw-pointer-events-none tw-transition-colors tw-ease-in-out tw-duration-200">
                                <svg class="tw-flex-shrink-0 tw-size-3" xmlns="http://www.w3.org/2000/svg" width="24"
                                     height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                     stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path
                                        d="M18 6 6 18"/><path d="m6 6 12 12"/></svg>
                                </span>
                                    <span
                                        class="peer-checked:tw-text-blue-600 tw-text-gray-500 tw-size-5 tw-absolute tw-top-[3px] tw-end-0.5 tw-flex tw-justify-center tw-items-center tw-pointer-events-none tw-transition-colors tw-ease-in-out tw-duration-200">
                                    <svg class="tw-flex-shrink-0 tw-size-3" xmlns="http://www.w3.org/2000/svg"
                                         width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                         stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><polyline
                                            points="20 6 9 17 4 12"/></svg>
                                </span>
                                </div>
                                <label for="hs-small-switch-with-icons" class="">Employee</label>
                            </div>

                            <div class="form-check-inline">
                                <div class="tw-relative tw-inline-block">
                                    <input type="checkbox" id="is_vendor" wire:model="is_vendor"
                                           class="tw-peer tw-relative tw-w-11 tw-h-6 tw-p-px tw-bg-gray-100 tw-border-transparent tw-text-transparent tw-rounded-full tw-cursor-pointer tw-transition-colors tw-ease-in-out tw-duration-200 focus:tw-ring-blue-600 disabled:tw-opacity-50 disabled:tw-pointer-events-none checked:tw-bg-none checked:tw-text-blue-600 checked:tw-border-blue-600 focus:checked:tw-border-blue-600 dark:tw-bg-gray-800 dark:tw-border-gray-700 dark:checked:tw-bg-blue-500 dark:checked:tw-border-blue-500 dark:focus:tw-ring-offset-gray-600 before:tw-inline-block before:tw-size-5 before:tw-bg-white checked:before:tw-bg-blue-200 before:tw-translate-x-0 checked:before:tw-translate-x-full before:tw-rounded-full before:tw-shadow before:tw-transform before:tw-ring-0 before:tw-transition before:tw-ease-in-out before:tw-duration-200 dark:before:tw-bg-gray-400 dark:checked:before:tw-bg-blue-200"
                                           x-model="is_vendor"
                                           x-bind:value="is_vendor"
                                           x-on:change='
                                        $el.value = (is_vendor);
                                        is_admin = false;
                                        is_client = false;
                                        is_employee = false;
                                        $wire.userType(is_admin, is_client, is_employee, is_vendor);
                                    '
                                    >
                                    <span
                                        class="peer-checked:tw-text-white tw-text-gray-500 tw-size-5 tw-absolute tw-top-[3px] tw-start-0.5 tw-flex tw-justify-center tw-items-center tw-pointer-events-none tw-transition-colors tw-ease-in-out tw-duration-200">
                                <svg class="tw-flex-shrink-0 tw-size-3" xmlns="http://www.w3.org/2000/svg" width="24"
                                     height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                     stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path
                                        d="M18 6 6 18"/><path d="m6 6 12 12"/></svg>
                                </span>
                                    <span
                                        class="peer-checked:tw-text-blue-600 tw-text-gray-500 tw-size-5 tw-absolute tw-top-[3px] tw-end-0.5 tw-flex tw-justify-center tw-items-center tw-pointer-events-none tw-transition-colors tw-ease-in-out tw-duration-200">
                                    <svg class="tw-flex-shrink-0 tw-size-3" xmlns="http://www.w3.org/2000/svg"
                                         width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                         stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><polyline
                                            points="20 6 9 17 4 12"/></svg>
                                </span>
                                </div>
                                <label for="hs-small-switch-with-icons" class="">Vendor</label>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <h3>Account locks</h3>
                        <div class="col-lg-12 tw-my-6">
                            <div class="form-check-inline">
                                <!-- Switch/Toggle -->
                                <div class="tw-relative tw-inline-block">
                                    <input type="checkbox" id="active" wire:model="active"
                                           class="tw-peer tw-relative tw-w-11 tw-h-6 tw-p-px tw-bg-gray-100 tw-border-transparent tw-text-transparent tw-rounded-full tw-cursor-pointer tw-transition-colors tw-ease-in-out tw-duration-200 focus:tw-ring-blue-600 disabled:tw-opacity-50 disabled:tw-pointer-events-none checked:tw-bg-none checked:tw-text-blue-600 checked:tw-border-blue-600 focus:checked:tw-border-blue-600 dark:tw-bg-gray-800 dark:tw-border-gray-700 dark:checked:tw-bg-blue-500 dark:checked:tw-border-blue-500 dark:focus:tw-ring-offset-gray-600 before:tw-inline-block before:tw-size-5 before:tw-bg-white checked:before:tw-bg-blue-200 before:tw-translate-x-0 checked:before:tw-translate-x-full before:tw-rounded-full before:tw-shadow before:tw-transform before:tw-ring-0 before:tw-transition before:tw-ease-in-out before:tw-duration-200 dark:before:tw-bg-gray-400 dark:checked:before:tw-bg-blue-200">
                                    <label for="hs-small-switch-with-icons" class="tw-sr-only">switch</label>
                                    <span
                                        class="peer-checked:tw-text-white tw-text-gray-500 tw-size-5 tw-absolute tw-top-[3px] tw-start-0.5 tw-flex tw-justify-center tw-items-center tw-pointer-events-none tw-transition-colors tw-ease-in-out tw-duration-200">
                                        <svg class="tw-flex-shrink-0 tw-size-3" xmlns="http://www.w3.org/2000/svg"
                                             width="24" height="24" viewBox="0 0 24 24" fill="none"
                                             stroke="currentColor"
                                             stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path
                                                d="M18 6 6 18"/><path d="m6 6 12 12"/></svg>
                                    </span>
                                    <span
                                        class="peer-checked:tw-text-blue-600 tw-text-gray-500 tw-size-5 tw-absolute tw-top-[3px] tw-end-0.5 tw-flex tw-justify-center tw-items-center tw-pointer-events-none tw-transition-colors tw-ease-in-out tw-duration-200">
                                    <svg class="tw-flex-shrink-0 tw-size-3" xmlns="http://www.w3.org/2000/svg"
                                         width="24"
                                         height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                         stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><polyline
                                            points="20 6 9 17 4 12"/></svg>
                                </span>
                                </div>
                                <label for="active">Active</label>
                            </div>
                            <div class="form-check-inline">
                                <!-- Switch/Toggle -->
                                <div class="tw-relative tw-inline-block">
                                    <input type="checkbox" id="locked" wire:model="locked"
                                           class="tw-peer tw-relative tw-w-11 tw-h-6 tw-p-px tw-bg-gray-100 tw-border-transparent tw-text-transparent tw-rounded-full tw-cursor-pointer tw-transition-colors tw-ease-in-out tw-duration-200 focus:tw-ring-blue-600 disabled:tw-opacity-50 disabled:tw-pointer-events-none checked:tw-bg-none checked:tw-text-blue-600 checked:tw-border-blue-600 focus:checked:tw-border-blue-600 dark:tw-bg-gray-800 dark:tw-border-gray-700 dark:checked:tw-bg-blue-500 dark:checked:tw-border-blue-500 dark:focus:tw-ring-offset-gray-600 before:tw-inline-block before:tw-size-5 before:tw-bg-white checked:before:tw-bg-blue-200 before:tw-translate-x-0 checked:before:tw-translate-x-full before:tw-rounded-full before:tw-shadow before:tw-transform before:tw-ring-0 before:tw-transition before:tw-ease-in-out before:tw-duration-200 dark:before:tw-bg-gray-400 dark:checked:before:tw-bg-blue-200">
                                    <label for="hs-small-switch-with-icons" class="tw-sr-only">switch</label>
                                    <span
                                        class="peer-checked:tw-text-white tw-text-gray-500 tw-size-5 tw-absolute tw-top-[3px] tw-start-0.5 tw-flex tw-justify-center tw-items-center tw-pointer-events-none tw-transition-colors tw-ease-in-out tw-duration-200">
                                    <svg class="tw-flex-shrink-0 tw-size-3" xmlns="http://www.w3.org/2000/svg"
                                         width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                         stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path
                                            d="M18 6 6 18"/><path d="m6 6 12 12"/></svg>
                                </span>
                                    <span
                                        class="peer-checked:tw-text-blue-600 tw-text-gray-500 tw-size-5 tw-absolute tw-top-[3px] tw-end-0.5 tw-flex tw-justify-center tw-items-center tw-pointer-events-none tw-transition-colors tw-ease-in-out tw-duration-200">
                                    <svg class="tw-flex-shrink-0 tw-size-3" xmlns="http://www.w3.org/2000/svg"
                                         width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                         stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><polyline
                                            points="20 6 9 17 4 12"/></svg>
                                </span>
                                </div>
                                <label for="locked">Locked</label>
                                <!-- End Switch/Toggle -->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="card custom-card">
            <div class="card-header">
                <div class="tw-flex tw-justify-between tw-items-center tw-w-full">
                    <h2>Basic details</h2>
                    <button type="button" data-bs-toggle="modal" data-bs-target="#basic-details-modal">
                        <i class="bi bi-question-circle"></i>
                    </button>
                </div>
            </div>
            <div class="card-body">
                <div class="row g-2">
                    <x-input id="first-name" model="first_name" placeholder="First name" label="First name"/>

                    <x-input id="last-name" model="last_name" placeholder="Last name" label="Last name"/>

                    <x-input type="email" id="email" model="email" placeholder="Email" label="Email"/>

                    <x-input type="password" id="password" model="password" placeholder="Password" label="Password"
                             autocomplete="new-password"/>

                    <x-input type="password" id="verify-password" model="verify_password" placeholder="Verify password"
                             label="Verify password"/>
                </div>
            </div>
        </div>

        <div class="card custom-card">
            <div class="card-header">
                <div class="tw-flex tw-justify-between tw-items-center tw-w-full">
                    <h2>Additional details</h2>
                    <button type="button" data-bs-toggle="modal" data-bs-target="#additional-details-modal">
                        <i class="bi bi-question-circle"></i>
                    </button>
                </div>
            </div>
            <div class="card-body">
                <div class="row g-2">
                    <x-select id="sex" model="sex" label="Sex">
                        <option></option>
                        <option value="female">Female</option>
                        <option value="male">Male</option>
                    </x-select>

                    <x-input type="date" id="date-of-birth" model="date_of_birth" label="Date of birth"/>

                    <x-select cols="col-lg-3" id="timezone" model="timezone" label="Timezone">
                        <option></option>
                        @foreach ($timezones as $tz)
                            <option value="{{ $tz }}">{{ $tz }}</option>
                        @endforeach
                    </x-select>
                </div>
            </div>
        </div>
        <div class="card custom-card">
            <div class="card-body">
                <x-submit id="create-user"/>
            </div>
        </div>
    </form>
    <div id="account-type-and-account-locks-modal" class="modal fade">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title">Account type & account locks help</h1>
                </div>
                <div class="modal-body">
                    <dl>
                        <dt>Admin</dt>
                        <dd>
                            This is reserved for system administrators. If you have an account that is an admin, but
                            also to be marked as any other type, use a role to give permissions to this account instead
                            of marking it as an admin.
                        </dd>
                        <dt>Client</dt>
                        <dd>
                            Client accounts will restrict the account to specific client only functions.
                        </dd>
                        <dt>Employee</dt>
                        <dd>
                            This is the standard internal employee account. This user will be able to perform most
                            functions on the site.
                        </dd>
                        <dt>Vendor</dt>
                        <dd>
                            Vendor accounts will restrict the account to specific vendor only functions.
                        </dd>
                    </dl>
                </div>
            </div>
        </div>
    </div>
    <div id="basic-details-modal" class="modal fade">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title">Basic details help</h1>
                </div>
                <div class="modal-body">
                    <dl>
                        <dt>First & last name</dt>
                        <dd>
                            The first and last name entered here will be generated into the display name for the user.
                            The user can change this at any time if needed. If your user has a preferred or nickname, it
                            is suggested that you enter it as it should be here.
                        </dd>
                        <dt>Email</dt>
                        <dd>
                            The email entered here will be the email used to login for the user. This must be a valid
                            email as they will need to verify their email before they can login.
                        </dd>
                        <dt>Password & verify password</dt>
                        <dd>
                            This will be the password for the user. This is required, but can be reset by the user.
                        </dd>
                    </dl>
                </div>
            </div>
        </div>
    </div>
    <div id="additional-details-modal" class="modal fade">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title">Additional details help</h1>
                </div>
                <div class="modal-body">
                    <dl>
                        <dt>Sex</dt>
                        <dd>
                            The sex of the user. This will be used to properly greet the user, as well as selecting the
                            proper default profile picture for the user.
                        </dd>
                        <dt>
                            Date of birth
                        </dt>
                        <dd>
                            Due to legal regulations, no user under the age of 16 may use this application. We only
                            collect the users date of birth to ensure this is adhered to.
                        </dd>
                        <dt>Timezone</dt>
                        <dd>
                            All timestamps are collected by the system in UTC. The timezone will adjust the dates and
                            times to display according to the users timezone.
                        </dd>
                    </dl>
                </div>
            </div>
        </div>
    </div>

</div>
