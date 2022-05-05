@props(['post' => $post])

<div style="background-color: #090909; border: 1px solid #222; padding: 1rem 1.5rem 0.5rem 1.5rem;"
    class="d-flex w-100 flex-column rounded my-3">
    <div class="d-flex flex-column">

        <div class="d-flex justify-content-start">
            {{-- name of user [ owner of post ] --}}
            <div class="d-flex"></div>
            <a href="{{ route('user.profile', $post->user) }}"
                class="fw-bold text-decoration-underline rounded text-light">{{ $post->user->name }}</a>

            {{-- divides the user's name and the time posted --}}
            <span class="mx-1 text-secondary">-</span>

            {{-- time post was made by user --}}
            <span style="cursor: default; font-size: 12px; padding-top: 0.3rem;"
                class="fw-bold text-secondary">{{ $post->created_at->diffForHumans() }}</span>
        </div>

        {{-- divider - divides the user's name and the post title --}}
        <div style="height: 1px; background-color: #333;" class="w-100 mt-3 mb-4"></div>

        {{-- Post title --}}
        <h2 style="cursor: pointer;" class="fw-bold mb-3">
            <a class="text-light" href="{{ route('posts.show', $post) }}">{{ $post->title }}</a>
        </h2>

        {{-- Post content --}}
        <div style="cursor: default;" class="fs-6 text-light">{!! clean(Str::limit($post->body, 150)) !!}</div>

    </div>


    <div class=" d-flex
            my-2">
        {{-- Show like or unlike icon if user is signed in --}}
        @auth
            @if (!$post->likedBy(auth()->user()))
                <form class="mr-1 border-0 outline-0" action="{{ route('posts.like', $post) }}" method="post">
                    @csrf
                    <button
                        style="border: none; box-shadow: none; background-color: transparent; font-size: 12px; margin-right: 0.3rem;"
                        class="btn fw-bold p-0 text-secondary" type="submit"><img src="{{ asset('img/unlike.svg') }}"
                            width="16" height="16" alt="like" />

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
                            width="16" height="16" alt="unlike" />
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
            <a href="{{ route('posts.show', $post) }}"
                style="border: none; box-shadow: none; margin:0 0.5rem; font-size: 12px;"
                class="ml-1 mt-1 btn fw-bold p-0 text-secondary" type="submit">
                <img src="{{ asset('img/comment.svg') }}" width="16" height="16" alt="comment" />

                <span style="font-size: 12px; padding-top: 0.35rem;" class="text-secondary fw-bold">
                    {{ $post->comments->count() }} {{ Str::plural('Comment', $post->comments->count()) }}
                </span>
            </a>
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
                            width="16" height="16" alt="delete" /> Delete</button>
                </form>
            @endcan
        @endauth

    </div>
</div>
