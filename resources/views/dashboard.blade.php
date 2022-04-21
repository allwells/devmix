@extends('layouts.app')

@section('content')
    <div class="d-flex justify-content-center">
        <div class="w-75 d-flex flex-column justify-content-start align-items-center pt-5">
            <div class="px-5 py-3 mt-5 w-100">
                <span class="fw-bolder fs-2 text-light">Dashboard</span>
            </div>
            <div class="d-flex justify-content-between px-5 mt-3">
                <div style="width: 24%;" class="d-flex flex-column">
                    <a style="margin-bottom: 1.05rem; background-color: #090909; border: 1px solid #222;"
                        class="nav-link rounded text-light" href="{{ route('profile') }}" tabindex="-1"
                        aria-disabled="true">
                        <img src="{{ asset('img/profile.svg') }}" width="25" height="25" alt="profile" />
                        <span style="font-size: 14px; margin-left: 0.2rem;" class="text-light fw-bold">Profile</span>
                    </a>

                    <a style="margin-bottom: 1.05rem; background-color: #090909; border: 1px solid #222"
                        class="nav-link rounded text-light" href="{{ route('create') }}" tabindex="-1"
                        aria-disabled="true">
                        <img src="{{ asset('img/create.png') }}" width="25" height="25" alt="profile" />
                        <span style="font-size: 14px; margin-left: 0.2rem;" class="text-light fw-bold">Create Post</span>
                    </a>

                    <form class="rounded"
                        style="margin-bottom: 1.05rem; background-color: #090909; border: 1px solid #222"
                        action="{{ route('logout') }}" method="post">
                        @csrf
                        <button class="w-100 text-start border-0 nav-link bg-transparent text-light" tabindex="-1"
                            type="submit" aria-disabled="true">
                            <img src="{{ asset('img/logout.svg') }}" width="25" height="25" alt="logout" />
                            <span style="font-size: 14px; margin-left: 0.2rem;"
                                class="text-light fw-bold">Logout</span></button>
                    </form>
                </div>
                <div style="width: 74%;" class="d-flex flex-column justify-content-start align-items-center">
                    <div class="d-flex justify-content-between w-100">
                        <div style="background-color: #090909; border: 1px solid #222; width: 48%;"
                            class="d-flex flex-column justify-content-center align-items-center rounded py-3 px-4">
                            <span class="fs-6 text-secondary">
                                Total posts created
                            </span>
                            <span class="fw-bolder fs-2 text-light">
                                {{ $user->posts->count() }}
                            </span>
                        </div>

                        <div style="background-color: #090909; border: 1px solid #222; width: 48%;"
                            class="d-flex flex-column justify-content-center align-items-center rounded py-3 px-4">
                            <span class="fs-6 text-secondary">
                                Total post reactions
                            </span>
                            <span class="fw-bolder fs-2 text-light">
                                {{ $user->receivedLikes->count() }}
                            </span>
                        </div>
                    </div>

                    {{-- USER POSTS --}}
                    <div class="w-100 py-3 pb-5 mb-5">
                        <span class="fw-bold fs-5 text-light">Posts</span>

                        @if ($user->posts->count())
                            @foreach ($user->posts as $post)
                                <x-post :post="$post" />
                            @endforeach


                            {{-- {{ $user->posts->links() }} --}}
                        @else
                            <div class="d-flex flex-column align-items-center">
                                <p class="text-secondary mt-5 text-center fs-5">This is where you can manage your posts, but
                                    you
                                    haven't
                                    written anything yet.</p>
                                <a style="background-color: #162C52; border: 1px solid #384e74; font-size: 14px; width: fit-content;"
                                    class="fw-bold py-2 px-4 rounded text-decoration-none text-light" href="#">Write
                                    your first
                                    post</a>
                            </div>
                        @endif
                    </div>
                </div>
            </div>

        </div>
    </div>
@endsection
