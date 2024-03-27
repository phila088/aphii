<?php

use Illuminate\Support\Facades\Password;
use Livewire\Attributes\Layout;
use Livewire\Volt\Component;

new #[Layout('layouts.custom-master')] class extends Component {
    public string $email = '';

    /**
     * Send a password reset link to the provided email address.
     */
    public function sendPasswordResetLink(): void
    {
        $this->validate([
            'email' => ['required', 'string', 'email'],
        ]);

        // We will send the password reset link to this user. Once we have attempted
        // to send the link, we will examine the response then see the message we
        // need to show to the user. Finally, we'll send out a proper response.
        $status = Password::sendResetLink(
            $this->only('email')
        );

        if ($status != Password::RESET_LINK_SENT) {
            $this->addError('email', __($status));

            return;
        }

        $this->reset('email');

        session()->flash('status', __($status));
    }
}; ?>

<div class="row mx-0 authentication bg-white">
    <div class="col-xxl-6 col-xl-7 col-lg-12">
        <div class="row mx-0 justify-content-center align-items-center h-100">
            <div class="col-xxl-6 col-xl-7 col-lg-7 col-md-7 col-sm-8 col-12">
                <div class="p-sm-5 p-0">
                    <p class="h4 fw-semibold mb-2">{{ __('Request password reset link') }}</p>
                    <x-auth-session-status class="mb-4" :status="session('status')"/>

                    <form wire:submit="sendPasswordResetLink">
                        <div class="row mx-0 gy-3 mt-3">
                            <div class="col-xl-12 mt-0 px-0">
                                <label for="email" class="form-label text-default">{{ __('Email') }}</label>
                                <input
                                    name="email"
                                    id="email"
                                    wire:model="email"
                                    type="email"
                                    class="form-control form-control-lg"
                                    placeholder="email"
                                    autocomplete="new-email"
                                >
                                <x-input-error :messages="$errors->get('form.email')" class="tw-text-red-500 mt-2"/>
                            </div>
                        </div>
                        <!-- Email Address -->

                        <div class="col-xl-12 d-grid mt-2  px-0">
                            <button
                                name="submit"
                                id="submit"
                                type="submit"
                                class="btn btn-lg btn-primary"
                            >
                                {{ __('Send password reset email') }}
                            </button>
                        </div>
                        <div class="col-xl-12 d-grid mt-2  px-0">
                            <x-auth-session-status class="mb-4" :status="session('status')" />
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="col-xxl-6 col-xl-5 col-lg-5 d-xl-block d-none px-0">
        <div class="authentication-cover">
            <img src="{{asset('build/assets/images/authentication/2.png')}}" class="authentication1" alt="">
            <img src="{{asset('build/assets/images/authentication/3.png')}}" class="authentication2" alt="">
            <div class="" style="width: 300px;">
                <div class="row justify-content-center g-0">
                    <div class="col-xl-9">
                        <a href="{{url('index')}}"> <img src="{{asset('build/assets/images/brand-logos/logo-full-color-light-trans.svg')}}" alt="" class="authentication-brand cover-dark-logo op-9" style="height:37px;"></a>
                        <div class="text-fixed-white text-start  d-flex align-items-center">
                            <div>
                                <h3 class="fw-semibold op-8 mb-3  text-fixed-white">Request password reset</h3>
                                <p class="mb-5 fw-normal fs-14 op-6">
                                    Amor vincit omnia.
                                </p>
                            </div>
                        </div>
                        <div class="authentication-footer text-end">
                                    <span class="text-fixed-white op-8">
                                        Copyright © <span id="year"><script>document.write(new Date().getFullYear())</script></span>
                                        All rights reserved
                                    </span>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
