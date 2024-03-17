<?php

use App\Providers\RouteServiceProvider;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;
use Livewire\Attributes\Layout;
use Livewire\Volt\Component;

new #[Layout('layouts.custom-master')] class extends Component {
    public string $password = '';

    /**
     * Confirm the current user's password.
     */
    public function confirmPassword(): void
    {
        $this->validate([
            'password' => ['required', 'string'],
        ]);

        if (!Auth::guard('web')->validate([
            'email' => Auth::user()->email,
            'password' => $this->password,
        ])) {
            throw ValidationException::withMessages([
                'password' => __('auth.password'),
            ]);
        }

        session(['auth.password_confirmed_at' => time()]);

        $this->redirectIntended(default: RouteServiceProvider::HOME);
    }
}; ?>
<div class="row authentication mx-0">
    <div class="col-xxl-6 col-xl-7 col-lg-12">
        <div class="row mx-0 justify-content-center align-items-center h-100">
            <div class="col-xxl-6 col-xl-7 col-lg-7 col-md-7 col-sm-8 col-12">
                <div class="p-sm-5 p-0">
                    <p class="h5 fw-semibold mb-2">Lock Screen</p>
                    <p class="mb-3 text-muted op-7 fw-normal">Hello {{ auth()->user()->first_name }}!</p>
                    <div class="d-flex align-items-center mb-4">
                        <div class="lh-1">
                            <span class="avatar avatar-md avatar-rounded">
                                @if(!empty(auth()->user()->profile_picture_path))
                                    <img alt="avatar" src="{{ asset(auth()->user()->profile_picture_path) }}">
                                @else
                                    <img
                                        alt="avatar"
                                        src="https://ui-avatars.com/api/?name={{ str_replace(' ', '+', auth()->user()->name) }}&background=0D8ABC&color=fff&size=128&rounded=true&bold=true&format=svg" />
                                @endif
                            </span>
                        </div>
                        <div class="ms-3">
                            <p class="mb-0 fw-semibold text-dark">{{ auth()->user()->email }}</p>
                        </div>
                    </div>
                    <div class="row mx-0 gy-3">
                        <form wire:submit="confirmPassword">
                            <div class="col-xl-12 mb-3 px-0">
                                <label for="password" class="form-label text-default">Password</label>
                                <div class="input-group">
                                    <input
                                        name="password"
                                        id="password"
                                        wire:model="password"
                                        type="password"
                                        class="form-control form-control-lg"
                                        placeholder="password"
                                        required autocomplete="current-password"
                                    >

                                </div>
                            </div>
                            <x-input-error :messages="$errors->get('password')" class="mt-2"/>
                            <div class="col-xl-12 d-grid mt-2 px-0">
                                <button type="submit" class="btn btn-lg btn-primary">Unlock</button>
                            </div>
                        </form>
                    </div>
                    <div class="text-center">
                        <p class="mb-0 fs-12 text-muted mt-4">Try unlock with different methods <a class="text-success" href="javascript:void(0);"><u>Finger print</u></a> / <a class="text-success" href="javascript:void(0);"><u>Face Id</u></a></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-xxl-6 col-xl-5 col-lg-5 d-xl-block d-none px-0">
        <div class="authentication-cover">
            <img src="{{asset('build/assets/images/authentication/2.png')}}" class="authentication1" alt="">
            <img src="{{asset('build/assets/images/authentication/3.png')}}" class="authentication2" alt="">
            <div class="">
                <div class="row justify-content-center g-0">
                    <div class="col-xl-9">
                        <a href="{{url('index')}}"> <img src="{{asset('build/assets/images/brand-logos/logo-full-color-light-trans.svg')}}" alt="" class="authentication-brand cover-dark-logo op-9" style="height:37px;"></a>
                        <div class="text-fixed-white text-start  d-flex align-items-center">
                            <div>
                                <h3 class="fw-semibold op-8 mb-3 text-fixed-white">Lockscreen</h3>
                                <p class="mb-5 fw-normal fs-14 op-6"> Veni, Vidi, Vici</p>
                            </div>
                        </div>
                        <div class="authentication-footer text-end">
                            <span class="text-fixed-white op-8">
                                Copyright © <span id="year"><script>document.write(new Date().getFullYear())</script></span>
                                <a href="javascript:void(0);" class=" text-fixed-white fw-semibold">Aphii</a>.
                                All rights reserved
                            </span>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
