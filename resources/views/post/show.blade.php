@extends('layouts.app')

@section('content')
    <div class="d-flex justify-content-center align-items-start py-5">
        <div class="rounded py-3 mt-5 w-50 px-3">
            <div style="background-color: #333; height: 1px;" class="my-3 w-100"></div>

            <a href="{{ route('user.profile', $post->user) }}"
                class="text-light p-2 rounded fs-4 fw-bold">{{ $post->user->name }}</a>

            {{-- divides the user's name and the time posted --}}
            <span class="mx-1 text-secondary">-</span>

            {{-- time post was made by user --}}
            <span style="cursor: default; font-size: 12px; padding-top: 0.3rem;"
                class="fw-bold text-secondary">{{ $post->created_at->diffForHumans() }}</span>

            <br>
            <div style="background-color: #333; height: 1px;" class="mt-3 mb-4 w-100"></div>

            {{-- Post title --}}
            <h2 class="text-light fw-bold mb-4">{{ $post->title }}</h2>

            {{-- Post content --}}
            <span class="text-light fs-5">{!! clean($post->body) !!}</span>


            <div style="background-color: #333; height: 1px;" class="mt-3 w-100"></div>


            <div class="d-flex my-2">

                {{-- Show like or unlike icon if user is signed in --}}
                @auth
                    @if (!$post->likedBy(auth()->user()))
                        <form class="mr-1 border-0 outline-0" action="{{ route('posts.like', $post) }}" method="post">
                            @csrf
                            <button
                                style="border: none; box-shadow: none; background-color: transparent; font-size: 12px; margin-right: 0.3rem;"
                                class="btn fw-bold p-0 text-secondary" type="submit"><img src="{{ asset('img/unlike.svg') }}"
                                    width="20" height="20" alt="like" />

                                <span style="font-size: 12px; padding-top: 0.35rem; margin-right: 0.5rem;"
                                    class="text-secondary fw-bold">
                                    {{ $post->likes->count() }} {{ Str::plural('Reaction', $post->likes->count()) }}
                                </span>
                            </button>
                        </form>
                    @else
                        <form class="ml-1" action="{{ route('posts.unlike', $post) }}" method="post">
                            @csrf
                            @method('DELETE')
                            <button
                                style="border: none; box-shadow: none; background-color: transparent; font-size: 12px; margin-right: 0.3rem;"
                                class="btn fw-bold p-0 text-secondary" type="submit"><img src="{{ asset('img/like.svg') }}"
                                    width="20" height="20" alt="unlike" />
                                <span style="font-size: 12px; padding-top: 0.35rem; margin-right: 0.5rem;"
                                    class="text-secondary fw-bold">
                                    {{ $post->likes->count() }} {{ Str::plural('Reaction', $post->likes->count()) }}
                                </span>
                            </button>
                        </form>
                    @endif
                @endauth

                @guest
                    {{-- Display number of reactions --}}
                    <span style="cursor: default; font-size: 12px; padding-top: 0.35rem; margin-right: 0.5rem;"
                        class="text-secondary fw-bold">
                        {{ $post->likes->count() }} {{ Str::plural('Reaction', $post->likes->count()) }}
                    </span>
                @endguest

                {{-- Show comment icon if user is signed in --}}
                @auth
                    <span style="cursor: default; border: none; box-shadow: none; margin:0 0.5rem; font-size: 12px;"
                        class="mt-1 btn fw-bold p-0 text-secondary" type="submit">
                        <img src="{{ asset('img/comment.svg') }}" width="20" height="20" alt="comment" />

                        <span style="font-size: 12px; padding-top: 0.35rem;" class="text-secondary fw-bold">
                            {{ $post->comments->count() }} {{ Str::plural('Comment', $post->comments->count()) }}
                        </span>
                    </span>
                @endauth

                @guest
                    {{-- Display number of comments --}}
                    <span style="cursor: default; font-size: 12px; padding-top: 0.35rem;" class="text-secondary fw-bold">
                        {{ $post->comments->count() }} {{ Str::plural('Comment', $post->comments->count()) }}
                    </span>
                @endguest

                {{-- Show delete icon if user is signed in --}}
                @auth
                    @can('delete', $post)
                        <form style="margin-left: 0.2rem;" action="{{ route('posts.destroy', $post) }}" method="post">
                            @csrf
                            @method('DELETE')
                            <button style="border: none; box-shadow: none; margin-right: 0.5rem; font-size: 12px;"
                                class="btn fw-bold p-0 text-secondary" type="submit"><img src="{{ asset('img/delete.svg') }}"
                                    width="20" height="20" alt="delete" /> Delete</button>
                        </form>
                    @endcan
                @endauth

            </div>


            <div style="background-color: #333; height: 1px;" class="mt-3 w-100"></div>


            <div style="" class="d-flex flex-column justify-content-center w-100 rounded">
                <span class="text-light fw-bold fs-4 my-3">Comments ({{ $post->comments->count() }})</span>
                @if ($post->count())
                    @foreach ($post->comments as $reply)
                        <x-comment :post="$post" :comments="$comments" :reply="$reply" />
                    @endforeach
                @endif
            </div>

            {{-- COMMENT FORM --}}
            @auth
                <form style="border-top: 1px solid #222; border-bottom: 1px solid #222; padding: 1rem 0;"
                    class="my-3 d-flex justify-content-center w-100 border-secondary @error('comments') border border-danger @enderror"
                    action="{{ route('posts.comment', $post) }}" method="post" id="comments">
                    @csrf

                    {{-- post text area --}}
                    <div style="width: 85%;" class="d-flex flex-column">
                        <input style="background-color: transparent; border: none; box-shadow: none;" name="comments"
                            class="form-control text-light" id="comments" placeholder="Add a comment..." />

                    </div>

                    {{-- Post button --}}
                    <div style="width: 15%;">
                        <input name="submit" id="submit" type="submit" value="Post" aria-label=".form-control-lg example"
                            style="background-color: #000000; border: none; box-shadow: none; height: 100%; font-size: 14px;"
                            class="form-control box-shadow: none; form-control-md text-light fw-bold" />
                    </div>
                </form>
                @error('comments')
                    <div class="text-danger fs-6">
                        {{ $message }}
                    </div>
                @enderror
            @endauth

        </div>
    </div>
@endsection
