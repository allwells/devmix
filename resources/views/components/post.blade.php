@props(['post' => $post])

<div class="d-flex flex-column py-3">
    <div class="d-flex justify-content-start">
        <a href="{{ route('users.posts', $post->user) }}"
            class="fw-bold text-decoration-none text-dark">{{ $post->user->name }}</a>
        <span style="font-size: 15px;" class="mx-2 text-secondary">{{ $post->created_at->diffForHumans() }}</span>
    </div>
    <span class="fs-6 text-dark">
        {{ $post->body }}
    </span>
</div>
<div class="d-flex">
    @auth
        @if (!$post->likedBy(auth()->user()))
            <form class="mr-1 border-0 outline-0" action="{{ route('posts.likes', $post) }}" method="post">
                @csrf
                <button style="margin-right: 1rem;" class="btn p-0 bg-light text-primary" type="submit">Like</button>
            </form>
        @else
            <form class="ml-1" action="{{ route('posts.likes', $post) }}" method="post">
                @csrf
                @method('DELETE')
                <button style="margin-right: 0.5rem;" class="btn p-0 bg-light text-primary" type="submit">Unlike</button>
            </form>
        @endif

        @can('delete', $post)
            <form class="ml-1" action="{{ route('posts.destroy', $post) }}" method="post">
                @csrf
                @method('DELETE')
                <button style="margin-right: 0.5rem;" class="btn p-0 bg-light text-primary" type="submit">Delete</button>
            </form>
        @endcan
    @endauth

    <span style="font-size: 15px; padding-top: 0.2rem;" class="text-secondary">{{ $post->likes->count() }}
        {{ Str::plural('like', $post->likes->count()) }}</span>
</div>
