<?php

use App\Models\User;
use Livewire\Volt\Component;
use Livewire\Attributes\Validate;

new class extends Component {
    public User $user;

    #[Validate('required|boolean')]
    public bool $is_admin = false;
    #[Validate('required|boolean')]
    public bool $is_client = false;
    #[Validate('required|boolean')]
    public bool $is_employee = false;
    #[Validate('required|boolean')]
    public bool $is_vendor = false;
    #[Validate('required|email:rfc,dns,spoof,filter')]
    public string $email = '';

    public function mount(): void
    {
        $this->is_admin = $this->user->is_admin;
        $this->is_client = $this->user->is_client;
        $this->is_employee = $this->user->is_employee;
        $this->is_vendor = $this->user->is_vendor;
        $this->email = $this->user->email;
    }

    public function updateUser(): void
    {
        $validated = $this->validate();

        $this->user->update($validated);

        $this->dispatch('user-updated');
    }

    public function cancel(): void
    {
        $this->dispatch('user-edit-canceled');
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
    <form wire:submit="updateUser" class="needs-validation" novalidate autocomplete="off">
        <div class="card">
            <div class="card-header">
                <h2>Edit user</h2>
            </div>
            <div class="card-body">
                <div class="row g-2">
                    <div class="col-lg-12">
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
                                    is_admin: $wire.is_admin,
                                    is_client: $wire.is_client,
                                    is_employee: $wire.is_employee,
                                    is_vendor: $wire.is_vendor
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
                                             height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"
                                             stroke-linecap="round" stroke-linejoin="round"><path d="M18 6 6 18"/><path
                                                d="m6 6 12 12"/></svg>
                                        </span>
                                    <span
                                        class="peer-checked:tw-text-blue-600 tw-text-gray-500 tw-size-5 tw-absolute tw-top-[3px] tw-end-0.5 tw-flex tw-justify-center tw-items-center tw-pointer-events-none tw-transition-colors tw-ease-in-out tw-duration-200">
                                            <svg class="tw-flex-shrink-0 tw-size-3" xmlns="http://www.w3.org/2000/svg" width="24"
                                                 height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor"
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
                                             height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"
                                             stroke-linecap="round" stroke-linejoin="round"><path d="M18 6 6 18"/><path
                                                d="m6 6 12 12"/></svg>
                                        </span>
                                    <span
                                        class="peer-checked:tw-text-blue-600 tw-text-gray-500 tw-size-5 tw-absolute tw-top-[3px] tw-end-0.5 tw-flex tw-justify-center tw-items-center tw-pointer-events-none tw-transition-colors tw-ease-in-out tw-duration-200">
                                            <svg class="tw-flex-shrink-0 tw-size-3" xmlns="http://www.w3.org/2000/svg" width="24"
                                                 height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor"
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
                                             height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"
                                             stroke-linecap="round" stroke-linejoin="round"><path d="M18 6 6 18"/><path
                                                d="m6 6 12 12"/></svg>
                                        </span>
                                    <span
                                        class="peer-checked:tw-text-blue-600 tw-text-gray-500 tw-size-5 tw-absolute tw-top-[3px] tw-end-0.5 tw-flex tw-justify-center tw-items-center tw-pointer-events-none tw-transition-colors tw-ease-in-out tw-duration-200">
                                            <svg class="tw-flex-shrink-0 tw-size-3" xmlns="http://www.w3.org/2000/svg" width="24"
                                                 height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor"
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
                                             height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"
                                             stroke-linecap="round" stroke-linejoin="round"><path d="M18 6 6 18"/><path
                                                d="m6 6 12 12"/></svg>
                                        </span>
                                    <span
                                        class="peer-checked:tw-text-blue-600 tw-text-gray-500 tw-size-5 tw-absolute tw-top-[3px] tw-end-0.5 tw-flex tw-justify-center tw-items-center tw-pointer-events-none tw-transition-colors tw-ease-in-out tw-duration-200">
                                            <svg class="tw-flex-shrink-0 tw-size-3" xmlns="http://www.w3.org/2000/svg" width="24"
                                                 height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                 stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><polyline
                                                    points="20 6 9 17 4 12"/></svg>
                                        </span>
                                </div>
                                <label for="hs-small-switch-with-icons" class="">Vendor</label>
                            </div>
                        </div>
                    </div>
                    <dl>
                        <dt>Edit user</dt>
                        <dl>
                            You can edit the user email, and account type. All other user details can be edited by the user.
                        </dl>
                    </dl>

                    <x-input cols="col-lg-3" id="email" model="email" label="Email"/>
                </div>
            </div>
            <div class="card-footer">
                <x-submit-cancel id="user-edit-cancel"/>
            </div>
        </div>
    </form>
</div>
