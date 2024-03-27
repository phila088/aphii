<?php

use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;
use Illuminate\Validation\Rules;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Locked;
use Livewire\Volt\Component;

new #[Layout('layouts.custom-master')] class extends Component {
    #[Locked]
    public string $token = '';
    public string $email = '';
    public string $password = '';
    public string $password_confirmation = '';

    /**
     * Mount the component.
     */
    public function mount(string $token): void
    {
        $this->token = $token;

        $this->email = request()->string('email');
    }

    /**
     * Reset the password for the given user.
     */
    public function resetPassword(): void
    {
        $this->validate([
            'token' => ['required'],
            'email' => ['required', 'string', 'email'],
            'password' => ['required', 'string', 'confirmed', Rules\Password::defaults()],
        ]);

        // Here we will attempt to reset the user's password. If it is successful we
        // will update the password on an actual user model and persist it to the
        // database. Otherwise we will parse the error and return the response.
        $status = Password::reset(
            $this->only('email', 'password', 'password_confirmation', 'token'),
            function ($user) {
                $user->forceFill([
                    'password' => Hash::make($this->password),
                    'remember_token' => Str::random(60),
                ])->save();

                event(new PasswordReset($user));
            }
        );

        // If the password was successfully reset, we will redirect the user back to
        // the application's home authenticated view. If there is an error we can
        // redirect them back to where they came from with their error message.
        if ($status != Password::PASSWORD_RESET) {
            $this->addError('email', __($status));

            return;
        }

        Session::flash('status', __($status));

        $this->redirectRoute('login');
    }
}; ?>

<div class="row mx-0 authentication bg-white">
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <div class="col-xxl-6 col-xl-7 col-lg-12">
        <div class="row mx-0 justify-content-center align-items-center h-100">
            <div class="col-xxl-6 col-xl-7 col-lg-7 col-md-7 col-sm-8 col-12">
                <div class="p-sm-5 p-0">
                    <p class="h4 fw-semibold mb-2">{{ __('Reset password') }}</p>
                    <p class="mb-3 text-muted op-7 fw-normal">{{ __('Welcome back') }}!</p>
                    <form wire:submit="resetPassword">
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
                            <x-input-error :messages="$errors->get('email')" class="tw-text-red-500 mt-2"/>
                        </div>

                        <div class="col-xl-12 mb-3  px-0">
                            <label for="password" class="form-label text-default d-block">
                                {{ __('Password') }}
                            </label>
                            <div class="input-group">
                                <input
                                    name="password"
                                    id="password"
                                    wire:model="password"
                                    type="password"
                                    class="form-control form-control-lg"
                                    placeholder="password"
                                />
                            </div>
                            <x-input-error :messages="$errors->get('password')" class="mt-2"/>
                        </div>
                        <!-- Password -->

                        <div class="col-xl-12 mb-3  px-0">
                            <label for="password_confirmation" class="form-label text-default d-block">
                                {{ __('Password') }}
                            </label>
                            <div class="input-group">
                                <input
                                    name="password_confirmation"
                                    id="password_confirmation"
                                    wire:model="password_confirmation"
                                    type="password"
                                    class="form-control form-control-lg"
                                    placeholder="password"
                                />
                            </div>
                            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2"/>
                        </div>

                        <!-- Confirm Password -->

                        <div class="col-xl-12 d-grid mt-2  px-0">
                            <button
                                name="submit"
                                id="submit"
                                type="submit"
                                class="btn btn-lg btn-primary"
                            >
                                {{ __('Sign In') }}
                            </button>
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
                                <h3 class="fw-semibold op-8 mb-3  text-fixed-white">Reset password</h3>
                                <p class="mb-5 fw-normal fs-14 op-6">
                                    Non ducor, duco.
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
