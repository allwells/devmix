@extends('layouts.app')

@section('content')
    <div class="d-flex vh-100 justify-content-center align-items-center">
        <div style="width: 35%; margin-top: 3rem; background-color: #171717; border: 1px solid #333;"
            class="rounded py-4 px-3">
            <span class="fs-3 fw-bold text-light">Login</span>
            <form class="mt-3" action="{{ route('login') }}" method="post">
                @csrf

                @if (session('status'))
                    <div class="text-light mb-3 text-center bg-danger py-3 rounded fs-6">
                        {{ session('status') }}
                    </div>
                @endif

                {{-- email input field --}}
                <div class="d-flex flex-column mt-3">
                    {{-- email label --}}
                    <label for="email" style="font-size: 15px;" class="fw-bold mb-2 text-light">Email</label>

                    {{-- email input --}}
                    <input
                        style="box-shadow: none; border: none; font-size: 14px; padding-top: 13px; padding-bottom: 13px; background-color: #222; border: 1px solid #333;"
                        class="text-light form-control form-control-md @error('email') border border-danger @enderror"
                        name="email" id="email" type="email" placeholder="Your email" aria-label=".form-control-lg example"
                        value="{{ old('email') }}" />

                    @error('email')
                        <div class="text-danger fs-6">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                {{-- Password input field --}}
                <div class="d-flex flex-column mt-3">
                    {{-- password label --}}
                    <label for="password" style="font-size: 15px;" class="fw-bold mb-2 text-light">Password</label>

                    {{-- password input --}}
                    <input
                        style="box-shadow: none; border: none; font-size: 14px; padding-top: 13px; padding-bottom: 13px; background-color: #222; border: 1px solid #333;"
                        class="text-light form-control form-control-md @error('password') border border-danger @enderror"
                        name="password" id="password" type="password" placeholder="Choose a password"
                        aria-label=".form-control-lg example" />

                    @error('password')
                        <div class="text-danger fs-6">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                {{-- Remember me check box --}}
                <div class="form-check mt-2">
                    <input class="form-check-input" name="remember" type="checkbox" id="remember" />
                    <label class="form-check-label text-light" for="remember">Remember me</label>
                </div>

                {{-- login button --}}
                <div class="d-flex flex-column mt-3">
                    <input name="submit" id="submit" type="submit" value="Login" aria-label=".form-control-lg example"
                        style="font-size: 14px; padding-top: 13px; padding-bottom: 13px; background-color: #222; border: 1px solid #333; background-color: #000;"
                        class="form-control form-control-md text-light fw-bold" />
                </div>
            </form>
        </div>
    </div>
@endsection
