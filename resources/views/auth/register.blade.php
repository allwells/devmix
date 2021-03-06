@extends('layouts.app')

@section('content')
    <div style="padding: 6rem 0;" class="d-flex flex-column justify-content-start align-items-center">
        <div style="width: 40%; background-color: #171717; border: 1px solid #333;" class="rounded py-3 px-3">
            <h2 class="fs-3 fw-bold text-light">Register</h2>
            <form class="mt-3" action="{{ route('register') }}" method="post">
                @csrf
                <div class="d-flex flex-column">
                    <label for="name" style="font-size: 15px;" class="text-light fw-bold mb-2 mx-1">Name</label>
                    <input
                        style="background-color: #222; border: 1px solid #333; font-size: 14px; padding-top: 13px; padding-bottom: 13px;"
                        class="text-light form-control form-control-md @error('name') border border-danger @enderror"
                        name="name" id="name" type="text" placeholder="Your name" aria-label=".form-control-lg example"
                        value="{{ old('name') }}" />

                    @error('name')
                        <div class="text-danger fs-6">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <div class="d-flex flex-column mt-3">
                    <label for="username" style="font-size: 15px;" class="text-light fw-bold mb-2 mx-1">Username</label>
                    <input
                        style="background-color: #222; border: 1px solid #333; font-size: 14px; padding-top: 13px; padding-bottom: 13px;"
                        class="text-light form-control form-control-md @error('username') border border-danger @enderror"
                        name="username" id="username" type="text" placeholder="Your username"
                        aria-label=".form-control-lg example" value="{{ old('username') }}" />

                    @error('username')
                        <div class="text-danger fs-6">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <div class="d-flex flex-column mt-3">
                    <label for="email" style="font-size: 15px;" class="text-light fw-bold mb-2 mx-1">Email</label>
                    <input
                        style="background-color: #222; border: 1px solid #333; font-size: 14px; padding-top: 13px; padding-bottom: 13px;"
                        class="text-light form-control form-control-md @error('email') border border-danger @enderror"
                        name="email" id="email" type="email" placeholder="Your email" aria-label=".form-control-lg example"
                        value="{{ old('email') }}" />

                    @error('email')
                        <div class="text-danger fs-6">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <div class="d-flex flex-column mt-3">
                    <label for="password" style="font-size: 15px;" class="text-light fw-bold mb-2 mx-1">Password</label>
                    <input
                        style="background-color: #222; border: 1px solid #333; font-size: 14px; padding-top: 13px; padding-bottom: 13px;"
                        class="text-light form-control form-control-md @error('password') border border-danger @enderror"
                        name="password" id="password" type="password" placeholder="Choose a password"
                        aria-label=".form-control-lg example" />

                    @error('password')
                        <div class="text-danger fs-6">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <div class="d-flex flex-column mt-3">
                    <label for="password_confirmation" style="font-size: 15px;" class="text-light fw-bold mb-2 mx-1">Confirm
                        Password</label>
                    <input
                        style="background-color: #222; border: 1px solid #333; font-size: 14px; padding-top: 13px; padding-bottom: 13px;"
                        class="text-light form-control form-control-md @error('password_confirmation') border border-danger @enderror"
                        name="password_confirmation" id="password_confirmation" type="password"
                        placeholder="Repeat your password" aria-label=".form-control-lg example" />
                </div>

                <div class="d-flex flex-column mt-3">
                    <input name="submit" id="submit" type="submit" value="Register" aria-label=".form-control-lg example"
                        style="background-color: #070707; border: 1px solid #333; font-size: 14px; padding-top: 13px; padding-bottom: 13px;"
                        class="form-control form-control-md text-light fw-bold" />
                </div>
            </form>
        </div>
    </div>
@endsection
