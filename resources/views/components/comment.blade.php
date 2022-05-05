@props(['post' => $post, 'comments' => $comments, 'reply' => $reply])

<div style="background-color: #090909; border: 1px solid #222;" class="d-flex flex-column rounded my-2 py-2 px-3">

    <div class="d-flex justify-content-start">
        {{-- name of user [ owner of comment ] --}}
        <a href="{{ route('user.profile', $reply->user) }}"
            class="fw-bold text-decoration-underline rounded text-light">{{ $reply->user->name }}</a>

        {{-- divides the user's name and the time posted --}}
        <span class="mx-1 text-secondary">-</span>

        {{-- time post was made by user --}}
        <span style="cursor: default; font-size: 12px; padding-top: 0.3rem;"
            class="fw-bold text-secondary">{{ $reply->created_at->diffForHumans() }}</span>
    </div>

    {{-- Post content --}}
    <span class="cursor: default; fs-6 text-light mt-2">
        {{ $reply->comments }}
    </span>

    {{-- COMMENT BOTTOM SECTION - LIKES AND DELETE --}}
    <div class=" d-flex my-2">
        {{-- Show like or unlike icon if user is signed in --}}
        @auth

            @if (!$reply->likedBy(auth()->user()))
                <form class="mr-1 border-0 outline-0" action="{{ route('posts.like.comment', $reply) }}" method="post">
                    @csrf
                    <button
                        style="border: none; box-shadow: none; background-color: transparent; font-size: 12px; margin-right: 0.3rem;"
                        class="btn fw-bold p-0 text-secondary" type="submit"><img src="{{ asset('img/unlike.svg') }}"
                            width="16" height="16" alt="like" />

                        <span style="font-size: 12px; padding-top: 0.35rem; margin-right: 0.5rem;"
                            class="text-secondary fw-bold">
                            {{ $reply->likes->count() }}
                            {{ Str::plural('Reaction', $reply->likes->count()) }}
                        </span>
                    </button>
                </form>
            @else
                <form class="ml-1" action="{{ route('posts.unlike.comment', $reply) }}" method="post">
                    @csrf
                    @method('DELETE')
                    <button
                        style="border: none; box-shadow: none; background-color: transparent; font-size: 12px; margin-right: 0.3rem;"
                        class="btn fw-bold p-0 text-secondary" type="submit"><img src="{{ asset('img/like.svg') }}"
                            width="16" height="16" alt="unlike" />
                        <span style="font-size: 12px; padding-top: 0.35rem; margin-right: 0.5rem;"
                            class="text-secondary fw-bold">
                            {{ $reply->likes->count() }}
                            {{ Str::plural('Reaction', $reply->likes->count()) }}
                        </span>
                    </button>
                </form>
            @endif
        @endauth

        @guest
            {{-- Display number of reactions --}}
            <span style="cursor: default; font-size: 12px; padding-top: 0.35rem; margin-right: 0.5rem;"
                class="text-secondary fw-bold">
                {{ $reply->likes->count() }}
                {{ Str::plural('Reaction', $reply->likes->count()) }}
            </span>
        @endguest

        {{-- Show delete icon if user is signed in --}}
        @auth
            @can('delete', $comments)
                <form style="margin-left: 0.2rem;" action="{{ route('posts.comment', $reply) }}" method="post">
                    @csrf
                    @method('DELETE')
                    <button style="border: none; box-shadow: none; margin-right: 0.5rem; font-size: 12px;"
                        class="btn fw-bold p-0 text-secondary" type="submit"><img src="{{ asset('img/delete.svg') }}"
                            width="16" height="16" alt="delete" />
                        Delete</button>
                </form>
            @endcan
        @endauth

    </div>
</div>
