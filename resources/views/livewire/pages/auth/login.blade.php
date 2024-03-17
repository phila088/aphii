<?php

use App\Livewire\Forms\LoginForm;
use App\Providers\RouteServiceProvider;
use Illuminate\Support\Facades\Session;
use Livewire\Attributes\Layout;
use Livewire\Volt\Component;

new #[Layout('layouts.custom-master')] class extends Component {
    public LoginForm $form;

    /**
     * Handle an incoming authentication request.
     */
    public function login(): void
    {
        $this->validate();

        $this->form->authenticate();

        Session::regenerate();

        $this->redirectIntended(default: RouteServiceProvider::HOME);
    }
}; ?>




<div class="row mx-0 authentication bg-white">
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <div class="col-xxl-6 col-xl-7 col-lg-12">
        <div class="row mx-0 justify-content-center align-items-center h-100">
            <div class="col-xxl-6 col-xl-7 col-lg-7 col-md-7 col-sm-8 col-12">
                <div class="p-sm-5 p-0">
                    <p class="h4 fw-semibold mb-2">{{ __('Sign In') }}</p>
                    <p class="mb-3 text-muted op-7 fw-normal">{{ __('Welcome back') }}!</p>
                    <form wire:submit="login">
                        <div class="row mx-0 gy-3 mt-3">
                            <div class="col-xl-12 mt-0 px-0">
                                <label for="email" class="form-label text-default">{{ __('Email') }}</label>
                                <input
                                    name="email"
                                    id="email"
                                    wire:model="form.email"
                                    type="text"
                                    class="form-control form-control-lg"
                                    placeholder="email"
                                >
                                <x-input-error :messages="$errors->get('form.email')" class="mt-2"/>
                            </div>
                            <div class="col-xl-12 mb-3  px-0">
                                <label for="password" class="form-label text-default d-block">
                                    {{ __('Password') }}
                                    <a href="{{ route('password.request') }}" class="float-end text-primary">Forget password ?</a>
                                </label>
                                <div class="input-group">
                                    <input
                                        name="password"
                                        id="password"
                                        wire:model="form.password"
                                        type="password"
                                        class="form-control form-control-lg"
                                        placeholder="password"
                                    />
                                </div>
                                <x-input-error :messages="$errors->get('form.password')" class="mt-2"/>
                                <div class="mt-2">
                                    <div class="form-check">
                                        <input
                                            name="remember"
                                            id="remember"
                                            wire:model="form.remember"
                                            class="form-check-input"
                                            type="checkbox"
                                        >
                                        <label class="form-check-label text-muted fw-normal" for="remember">
                                            Remember password ?
                                        </label>
                                    </div>
                                </div>
                            </div>
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
                                <h3 class="fw-semibold op-8 mb-3  text-fixed-white">Sign In</h3>
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
