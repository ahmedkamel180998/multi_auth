@extends('frontend.auth.master')

@section('title', 'Reset Password')

@section('content')
    <!-- Content -->
    <div class="container-xxl">
        <div class="authentication-wrapper authentication-basic container-p-y">
            <div class="authentication-inner py-4">
                <!-- Reset Password -->
                <div class="card">
                    <div class="card-body">
                        @include('frontend.partials.logo')

                        <h4 class="mb-2">Reset Password</h4>
                        <p class="mb-4">Enter your credentials to reset your password</p>

                        <form id="formAuthentication" class="mb-3" action="{{ route('password.store') }}" method="POST">
                            @csrf

                            <!-- Password Reset Token -->
                            <input type="hidden" name="token" value="{{ $request->route('token') }}">

                            <!-- Email Address -->
                            <div class="mb-3">
                                <label for="email" class="form-label">Email</label>
                                <input
                                        type="email"
                                        class="form-control"
                                        id="email"
                                        name="email"
                                        value="{{ $request->email }}"
                                        placeholder="Enter your email"
                                        required
                                        autofocus
                                />
                                <x-input-error :messages="$errors->get('email')" class="mt-2"/>
                            </div>

                            <!-- Password -->
                            <div class="mb-3 form-password-toggle">
                                <label class="form-label" for="password">Password</label>
                                <div class="input-group input-group-merge">
                                    <input
                                            type="password"
                                            id="password"
                                            class="form-control"
                                            name="password"
                                            placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;"
                                            autocomplete="new-password"
                                            required aria-describedby="password"
                                    />
                                    <span class="input-group-text cursor-pointer"><i class="bx bx-hide"></i></span>
                                    <x-input-error :messages="$errors->get('password')" class="mt-2"/>
                                </div>
                            </div>

                            <!-- Confirm Password -->
                            <div class="mb-3 form-password-toggle">
                                <label class="form-label" for="password_confirmation">Confirm Password</label>
                                <div class="input-group input-group-merge">
                                    <input
                                            type="password"
                                            id="password_confirmation"
                                            class="form-control"
                                            name="password_confirmation"
                                            placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;"
                                            aria-describedby="password_confirmation"
                                            required autocomplete="new-password"
                                    />
                                    <span class="input-group-text cursor-pointer"><i class="bx bx-hide"></i></span>
                                    <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2"/>
                                </div>
                            </div>
                            <button class="btn btn-primary d-grid w-100">Reset Password</button>
                        </form>
                    </div>
                </div>
                <!-- Reset Password -->
            </div>
        </div>
    </div>
    <!-- Content -->
@endsection