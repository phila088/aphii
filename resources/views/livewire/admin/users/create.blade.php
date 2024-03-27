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
    #[Validate('nullable|string|regex:/[0-9]{3}-[0-9]{3}-[0-9]{4}/i')]
    public string $phone_mobile;
    #[Validate('nullable|string|regex:/[0-9]{3}-[0-9]{3}-[0-9]{4}/i')]
    public string $phone_work;
    #[Validate('nullable|string|min:1|max:10')]
    public string $phone_work_extension;
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
        $this->name = $this->first_name . ' ' . $this->last_name;

        $beforeDate = Carbon::create(now())->subtract('15 years and 364 days')->toString();

        $validated = $this->validate([
            'is_admin' => ['required', 'boolean'],
            'is_client' => ['required', 'boolean'],
            'is_employee' => ['required', 'boolean'],
            'is_vendor' => ['required', 'boolean'],
            'active' => ['required', 'boolean'],
            'locked' => ['required', 'boolean'],
            'photo' => ['nullable','image', 'max:5120'],
            'first_name' => ['required', 'string', 'min:1', 'max:50'],
            'last_name' => ['required', 'string', 'min:1', 'max:50'],
            'name' => ['required', 'string', 'min:1', 'max:50'],
            'email' => ['required', 'email:rfc,dns,spoof,filter', 'min:5', 'max:50'],
            'password' => ['required', 'min:10', 'max:255'],
            'verify_password' => ['required', 'min:10', 'max:255'],
            'phone_mobile' => ['nullable', 'string', 'regex:/[0-9]{3}-[0-9]{3}-[0-9]{4}/i'],
            'phone_work' => ['nullable', 'string', 'regex:/[0-9]{3}-[0-9]{3}-[0-9]{4}/i'],
            'phone_work_extension' => ['nullable', 'string', 'max:10'],
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
            $this->phone_mobile = '';
            $this->phone_work = '';
            $this->phone_work_extension = '';
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

<div class="tw-shadow-md tw-rounded-lg tw-p-4">
    <form wire:submit="createUser" class="needs-validation" novalidate autocomplete="off">
        <div class="row g-2 tw-shadow-md tw-rounded-lg tw-p-4">
            <div class="col-lg-6">
                <dl>
                    <dt class="tw-text-lg">Account type</dt>
                    <dt>Admin</dt>
                    <dl>
                        This account type is reserved for system administrators only. Any roles or permissions can be added
                        assigned to the user after creation.
                    </dl>
                    <dt>Client</dt>
                    <dl>
                        Clients only - This will limit the user to the specific client they are assigned to. This will
                        ensure the client only has access to data pertaining to their work orders.
                    </dl>
                    <dt>Employee</dt>
                    <dl>
                        Employees only - This will give the user access to most of the systems features, within their role
                        and permissions set after creation.
                    </dl>
                    <dt>Vendor</dt>
                    <dl>
                        Vendors only - This will limit the user to the specific vendor they are assigned to. This will
                        ensure the vendor only has access to data pertaining to their work orders.
                    </dl>
                </dl>

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
                            <input type="checkbox" id="is_admin" wire:model="is_admin" class="tw-peer tw-relative tw-w-11 tw-h-6 tw-p-px tw-bg-gray-100 tw-border-transparent tw-text-transparent tw-rounded-full tw-cursor-pointer tw-transition-colors tw-ease-in-out tw-duration-200 focus:tw-ring-blue-600 disabled:tw-opacity-50 disabled:tw-pointer-events-none checked:tw-bg-none checked:tw-text-blue-600 checked:tw-border-blue-600 focus:checked:tw-border-blue-600 dark:tw-bg-gray-800 dark:tw-border-gray-700 dark:checked:tw-bg-blue-500 dark:checked:tw-border-blue-500 dark:focus:tw-ring-offset-gray-600 before:tw-inline-block before:tw-size-5 before:tw-bg-white checked:before:tw-bg-blue-200 before:tw-translate-x-0 checked:before:tw-translate-x-full before:tw-rounded-full before:tw-shadow before:tw-transform before:tw-ring-0 before:tw-transition before:tw-ease-in-out before:tw-duration-200 dark:before:tw-bg-gray-400 dark:checked:before:tw-bg-blue-200"
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
                            <span class="peer-checked:tw-text-white tw-text-gray-500 tw-size-5 tw-absolute tw-top-[3px] tw-start-0.5 tw-flex tw-justify-center tw-items-center tw-pointer-events-none tw-transition-colors tw-ease-in-out tw-duration-200">
                            <svg class="tw-flex-shrink-0 tw-size-3" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M18 6 6 18"/><path d="m6 6 12 12"/></svg>
                            </span>
                                <span class="peer-checked:tw-text-blue-600 tw-text-gray-500 tw-size-5 tw-absolute tw-top-[3px] tw-end-0.5 tw-flex tw-justify-center tw-items-center tw-pointer-events-none tw-transition-colors tw-ease-in-out tw-duration-200">
                                <svg class="tw-flex-shrink-0 tw-size-3" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><polyline points="20 6 9 17 4 12"/></svg>
                            </span>
                        </div>
                        <label for="is_admin" class="">Admin</label>
                    </div>

                    <div class="form-check-inline">
                        <div class="tw-relative tw-inline-block">
                            <input type="checkbox" id="is_client" wire:model="is_client" class="tw-peer tw-relative tw-w-11 tw-h-6 tw-p-px tw-bg-gray-100 tw-border-transparent tw-text-transparent tw-rounded-full tw-cursor-pointer tw-transition-colors tw-ease-in-out tw-duration-200 focus:tw-ring-blue-600 disabled:tw-opacity-50 disabled:tw-pointer-events-none checked:tw-bg-none checked:tw-text-blue-600 checked:tw-border-blue-600 focus:checked:tw-border-blue-600 dark:tw-bg-gray-800 dark:tw-border-gray-700 dark:checked:tw-bg-blue-500 dark:checked:tw-border-blue-500 dark:focus:tw-ring-offset-gray-600 before:tw-inline-block before:tw-size-5 before:tw-bg-white checked:before:tw-bg-blue-200 before:tw-translate-x-0 checked:before:tw-translate-x-full before:tw-rounded-full before:tw-shadow before:tw-transform before:tw-ring-0 before:tw-transition before:tw-ease-in-out before:tw-duration-200 dark:before:tw-bg-gray-400 dark:checked:before:tw-bg-blue-200"
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
                            <span class="peer-checked:tw-text-white tw-text-gray-500 tw-size-5 tw-absolute tw-top-[3px] tw-start-0.5 tw-flex tw-justify-center tw-items-center tw-pointer-events-none tw-transition-colors tw-ease-in-out tw-duration-200">
                            <svg class="tw-flex-shrink-0 tw-size-3" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M18 6 6 18"/><path d="m6 6 12 12"/></svg>
                            </span>
                            <span class="peer-checked:tw-text-blue-600 tw-text-gray-500 tw-size-5 tw-absolute tw-top-[3px] tw-end-0.5 tw-flex tw-justify-center tw-items-center tw-pointer-events-none tw-transition-colors tw-ease-in-out tw-duration-200">
                                <svg class="tw-flex-shrink-0 tw-size-3" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><polyline points="20 6 9 17 4 12"/></svg>
                            </span>
                        </div>
                        <label for="is_client" class="">Client</label>
                    </div>

                    <div class="form-check-inline">
                        <div class="tw-relative tw-inline-block">
                            <input type="checkbox" id="is_employee" wire:model="is_employee" class="tw-peer tw-relative tw-w-11 tw-h-6 tw-p-px tw-bg-gray-100 tw-border-transparent tw-text-transparent tw-rounded-full tw-cursor-pointer tw-transition-colors tw-ease-in-out tw-duration-200 focus:tw-ring-blue-600 disabled:tw-opacity-50 disabled:tw-pointer-events-none checked:tw-bg-none checked:tw-text-blue-600 checked:tw-border-blue-600 focus:checked:tw-border-blue-600 dark:tw-bg-gray-800 dark:tw-border-gray-700 dark:checked:tw-bg-blue-500 dark:checked:tw-border-blue-500 dark:focus:tw-ring-offset-gray-600 before:tw-inline-block before:tw-size-5 before:tw-bg-white checked:before:tw-bg-blue-200 before:tw-translate-x-0 checked:before:tw-translate-x-full before:tw-rounded-full before:tw-shadow before:tw-transform before:tw-ring-0 before:tw-transition before:tw-ease-in-out before:tw-duration-200 dark:before:tw-bg-gray-400 dark:checked:before:tw-bg-blue-200"
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
                            <span class="peer-checked:tw-text-white tw-text-gray-500 tw-size-5 tw-absolute tw-top-[3px] tw-start-0.5 tw-flex tw-justify-center tw-items-center tw-pointer-events-none tw-transition-colors tw-ease-in-out tw-duration-200">
                            <svg class="tw-flex-shrink-0 tw-size-3" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M18 6 6 18"/><path d="m6 6 12 12"/></svg>
                            </span>
                            <span class="peer-checked:tw-text-blue-600 tw-text-gray-500 tw-size-5 tw-absolute tw-top-[3px] tw-end-0.5 tw-flex tw-justify-center tw-items-center tw-pointer-events-none tw-transition-colors tw-ease-in-out tw-duration-200">
                                <svg class="tw-flex-shrink-0 tw-size-3" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><polyline points="20 6 9 17 4 12"/></svg>
                            </span>
                        </div>
                        <label for="hs-small-switch-with-icons" class="">Employee</label>
                    </div>

                    <div class="form-check-inline">
                        <div class="tw-relative tw-inline-block">
                            <input type="checkbox" id="is_vendor" wire:model="is_vendor" class="tw-peer tw-relative tw-w-11 tw-h-6 tw-p-px tw-bg-gray-100 tw-border-transparent tw-text-transparent tw-rounded-full tw-cursor-pointer tw-transition-colors tw-ease-in-out tw-duration-200 focus:tw-ring-blue-600 disabled:tw-opacity-50 disabled:tw-pointer-events-none checked:tw-bg-none checked:tw-text-blue-600 checked:tw-border-blue-600 focus:checked:tw-border-blue-600 dark:tw-bg-gray-800 dark:tw-border-gray-700 dark:checked:tw-bg-blue-500 dark:checked:tw-border-blue-500 dark:focus:tw-ring-offset-gray-600 before:tw-inline-block before:tw-size-5 before:tw-bg-white checked:before:tw-bg-blue-200 before:tw-translate-x-0 checked:before:tw-translate-x-full before:tw-rounded-full before:tw-shadow before:tw-transform before:tw-ring-0 before:tw-transition before:tw-ease-in-out before:tw-duration-200 dark:before:tw-bg-gray-400 dark:checked:before:tw-bg-blue-200"
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
                            <span class="peer-checked:tw-text-white tw-text-gray-500 tw-size-5 tw-absolute tw-top-[3px] tw-start-0.5 tw-flex tw-justify-center tw-items-center tw-pointer-events-none tw-transition-colors tw-ease-in-out tw-duration-200">
                            <svg class="tw-flex-shrink-0 tw-size-3" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M18 6 6 18"/><path d="m6 6 12 12"/></svg>
                            </span>
                            <span class="peer-checked:tw-text-blue-600 tw-text-gray-500 tw-size-5 tw-absolute tw-top-[3px] tw-end-0.5 tw-flex tw-justify-center tw-items-center tw-pointer-events-none tw-transition-colors tw-ease-in-out tw-duration-200">
                                <svg class="tw-flex-shrink-0 tw-size-3" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><polyline points="20 6 9 17 4 12"/></svg>
                            </span>
                        </div>
                        <label for="hs-small-switch-with-icons" class="">Vendor</label>
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="row g-2">
                    <div class="col-lg-12 mb-2">
                        <dl>
                            <dt class="tw-text-lg">Account locks</dt>
                            <dt>Active</dt>
                            <dl>
                                The account will be immediate active and ready for use by the user.
                            </dl>
                            <dt>Locked</dt>
                            <dl>
                                This will lock the account from logging in. All the users data will still be available
                                site-wide.
                            </dl>
                        </dl>
                        <!-- Switch/Toggle -->
                        <div class="tw-relative tw-inline-block tw-my-6">
                            <input type="checkbox" id="active" wire:model="active" class="tw-peer tw-relative tw-w-11 tw-h-6 tw-p-px tw-bg-gray-100 tw-border-transparent tw-text-transparent tw-rounded-full tw-cursor-pointer tw-transition-colors tw-ease-in-out tw-duration-200 focus:tw-ring-blue-600 disabled:tw-opacity-50 disabled:tw-pointer-events-none checked:tw-bg-none checked:tw-text-blue-600 checked:tw-border-blue-600 focus:checked:tw-border-blue-600 dark:tw-bg-gray-800 dark:tw-border-gray-700 dark:checked:tw-bg-blue-500 dark:checked:tw-border-blue-500 dark:focus:tw-ring-offset-gray-600 before:tw-inline-block before:tw-size-5 before:tw-bg-white checked:before:tw-bg-blue-200 before:tw-translate-x-0 checked:before:tw-translate-x-full before:tw-rounded-full before:tw-shadow before:tw-transform before:tw-ring-0 before:tw-transition before:tw-ease-in-out before:tw-duration-200 dark:before:tw-bg-gray-400 dark:checked:before:tw-bg-blue-200">
                            <label for="hs-small-switch-with-icons" class="tw-sr-only">switch</label>
                            <span class="peer-checked:tw-text-white tw-text-gray-500 tw-size-5 tw-absolute tw-top-[3px] tw-start-0.5 tw-flex tw-justify-center tw-items-center tw-pointer-events-none tw-transition-colors tw-ease-in-out tw-duration-200">
                                <svg class="tw-flex-shrink-0 tw-size-3" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M18 6 6 18"/><path d="m6 6 12 12"/></svg>
                            </span>
                            <span class="peer-checked:tw-text-blue-600 tw-text-gray-500 tw-size-5 tw-absolute tw-top-[3px] tw-end-0.5 tw-flex tw-justify-center tw-items-center tw-pointer-events-none tw-transition-colors tw-ease-in-out tw-duration-200">
                                <svg class="tw-flex-shrink-0 tw-size-3" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><polyline points="20 6 9 17 4 12"/></svg>
                            </span>
                        </div>
                        <label for="active">Active</label>
                        <!-- End Switch/Toggle -->
                    </div>
                </div>
                <div class="row g-2">
                    <div class="col-lg-12">
                        <!-- Switch/Toggle -->
                        <div class="tw-relative tw-inline-block">
                            <input type="checkbox" id="locked" wire:model="locked" class="tw-peer tw-relative tw-w-11 tw-h-6 tw-p-px tw-bg-gray-100 tw-border-transparent tw-text-transparent tw-rounded-full tw-cursor-pointer tw-transition-colors tw-ease-in-out tw-duration-200 focus:tw-ring-blue-600 disabled:tw-opacity-50 disabled:tw-pointer-events-none checked:tw-bg-none checked:tw-text-blue-600 checked:tw-border-blue-600 focus:checked:tw-border-blue-600 dark:tw-bg-gray-800 dark:tw-border-gray-700 dark:checked:tw-bg-blue-500 dark:checked:tw-border-blue-500 dark:focus:tw-ring-offset-gray-600 before:tw-inline-block before:tw-size-5 before:tw-bg-white checked:before:tw-bg-blue-200 before:tw-translate-x-0 checked:before:tw-translate-x-full before:tw-rounded-full before:tw-shadow before:tw-transform before:tw-ring-0 before:tw-transition before:tw-ease-in-out before:tw-duration-200 dark:before:tw-bg-gray-400 dark:checked:before:tw-bg-blue-200">
                            <label for="hs-small-switch-with-icons" class="tw-sr-only">switch</label>
                            <span class="peer-checked:tw-text-white tw-text-gray-500 tw-size-5 tw-absolute tw-top-[3px] tw-start-0.5 tw-flex tw-justify-center tw-items-center tw-pointer-events-none tw-transition-colors tw-ease-in-out tw-duration-200">
                                <svg class="tw-flex-shrink-0 tw-size-3" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M18 6 6 18"/><path d="m6 6 12 12"/></svg>
                            </span>
                            <span class="peer-checked:tw-text-blue-600 tw-text-gray-500 tw-size-5 tw-absolute tw-top-[3px] tw-end-0.5 tw-flex tw-justify-center tw-items-center tw-pointer-events-none tw-transition-colors tw-ease-in-out tw-duration-200">
                                <svg class="tw-flex-shrink-0 tw-size-3" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><polyline points="20 6 9 17 4 12"/></svg>
                            </span>
                        </div>
                        <label for="locked">Locked</label>
                        <!-- End Switch/Toggle -->
                    </div>
                </div>
            </div>
        </div>

        <div class="row g-2 tw-my-6 tw-shadow-md tw-rounded-lg tw-p-4">
            <div class="col-lg-12">
                <dl>
                    <dt class="tw-text-lg">Basic details</dt>
                    <dt>First and last name</dt>
                    <dl>
                        The first and last name entered here will be used to generate the users display name. If the user has a
                        nickname or preferred name, enter it here.
                    </dl>
                    <dt>Email</dt>
                    <dl>
                        The email entered here will be used to log in to the site.
                    </dl>
                    <dt>Password</dt>
                    <dl>
                        You may assign the user a password here, or the user will be sent a temporary password with their
                        registration email.
                    </dl>
                </dl>
            </div>

            <x-input id="first-name" model="first_name" placeholder="First name" label="First name" />

            <x-input id="last-name" model="last_name" placeholder="Last name" label="Last name" />

            <x-input type="email" id="email" model="email" placeholder="Email" label="Email" />

            <x-input type="password" id="password" model="password" placeholder="Password" label="Password" autocomplete="new-password" />

            <x-input type="password" id="verify-password" model="verify_password" placeholder="Verify password" label="Verify password" />
        </div>

        <div class="row g-2 tw-my-6 tw-shadow-md tw-rounded-lg tw-p-4">
            <div class="col-lg-12">
                <dl>
                    <dt class="tw-text-lg">Phone numbers</dt>
                    <dl>
                        The phone numbers entered here are only for contact methods for the user to allow other users to contact
                        each other. These are optionals.
                    </dl>
                </dl>
            </div>

            <x-input id="phone-mobile" model="phone_mobile" placeholder="Mobile" label="Mobile" />

            <x-input id="phone-work" model="phone_work" placeholder="Work" label="Work" />
        </div>

        <div class="row g-2 tw-my-6 tw-shadow-md tw-rounded-lg tw-p-4">
            <div class="col-lg-12">
                <dl>
                    <dt class="tw-text-lg">Additional information</dt>
                    <dt>Sex</dt>
                    <dl>
                        The sex of the user. This will help determine the default profile picture, as well as how the user is
                        greeted through the site.
                    </dl>
                    <dt>Date of birth</dt>
                    <dl>
                        Due to the policies of this application, no user under the age of 16 may use this app in any way.
                    </dl>
                    <dt>Timezone</dt>
                    <dl>
                        This will be used to show the proper time for the user. All dates and times are entered into the system
                        in UTC, and this will allow them to see times according to their timezones.
                    </dl>
                </dl>
            </div>

            <x-select id="sex" model="sex" label="Sex">
                <option></option>
                <option value="female">Female</option>
                <option value="male">Male</option>
            </x-select>

            <x-input type="date" id="date-of-birth" model="date_of_birth" label="Date of birth" />

            <x-select cols="col-lg-3" id="timezone" model="timezone" label="Timezone">
                <option></option>
                @foreach ($timezones as $tz)
                    <option value="{{ $tz }}">{{ $tz }}</option>
                @endforeach
            </x-select>
        </div>

        <x-submit id="create-user" />
    </form>



</div>
