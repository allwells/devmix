@props(['post' => $post])

<div style="background-color: #171717; border: 1px solid #353535; padding: 1rem 1.5rem 0.5rem 1.5rem;"
    class="d-flex flex-column rounded my-3">
    <div class="d-flex flex-column">

        <div class="d-flex justify-content-start">
            {{-- name of user [ owner of post ] --}}
            <a href="{{ route('user.profile', $post->user) }}"
                class="fw-bold text-decoration-underline rounded text-light">{{ $post->user->name }}</a>

            {{-- divides the user's name and the time posted --}}
            <span class="mx-1 text-secondary">-</span>

            {{-- time post was made by user --}}
            <span style="cursor: default; font-size: 12px; padding-top: 0.3rem;"
                class="fw-bold text-secondary">{{ $post->created_at->diffForHumans() }}</span>
        </div>

        {{-- Post content --}}
        <span class="cursor: default; fs-6 text-light">
            {{ $post->body }}
        </span>

    </div>
    <div class="d-flex my-2">

        {{-- Show like or unlike icon if user is signed in --}}
        @auth
            @if (!$post->likedBy(auth()->user()))
                <form class="mr-1 border-0 outline-0" action="{{ route('posts.likes', $post) }}" method="post">
                    @csrf
                    <button
                        style="border: none; box-shadow: none; background-color: transparent; font-size: 12px; margin-right: 0.3rem;"
                        class="btn fw-bold p-0 text-secondary" type="submit"><img src="{{ asset('img/unlike.svg') }}"
                            width="16" height="16" alt="like" /></button>
                </form>
            @else
                <form class="ml-1" action="{{ route('posts.likes', $post) }}" method="post">
                    @csrf
                    @method('DELETE')
                    <button
                        style="border: none; box-shadow: none; background-color: transparent; font-size: 12px; margin-right: 0.3rem;"
                        class="btn fw-bold p-0 text-secondary" type="submit"><img src="{{ asset('img/like.svg') }}"
                            width="16" height="16" alt="unlike" /></button>
                </form>
            @endif
        @endauth

        {{-- Display number of reactions --}}
        <span style="cursor: default; font-size: 12px; padding-top: 0.35rem; margin-right: 0.5rem;"
            class="text-secondary fw-bold">
            {{ $post->likes->count() }} {{ Str::plural('Reaction', $post->likes->count()) }}
        </span>

        {{-- Show comment icon if user is signed in --}}
        @auth
            <form class="ml-1" action="{{ route('post.show', $post) }}" method="post">
                @csrf
                <button style="border: none; box-shadow: none; margin:0 0.5rem; font-size: 12px;"
                    class="btn fw-bold p-0 text-secondary" type="submit"><img src="{{ asset('img/comment.svg') }}"
                        width="16" height="16" alt="comment" /></button>
            </form>
        @endauth

        {{-- Display number of comments --}}
        <span style="cursor: default; font-size: 12px; padding-top: 0.35rem;" class="text-secondary fw-bold">
            {{ $post->comments->count() }} {{ Str::plural('Comment', $post->comments->count()) }}
        </span>

        {{-- Show delete icon if user is signed in --}}
        @auth
            @can('delete', $post)
                <form style="margin-left: 0.2rem;" action="{{ route('posts.destroy', $post) }}" method="post">
                    @csrf
                    @method('DELETE')
                    <button style="border: none; box-shadow: none; margin-right: 0.5rem; font-size: 12px;"
                        class="btn fw-bold p-0 text-secondary" type="submit"><img src="{{ asset('img/delete.svg') }}"
                            width="16" height="16" alt="delete" /></button>
                </form>
            @endcan
        @endauth

    </div>
</div>
