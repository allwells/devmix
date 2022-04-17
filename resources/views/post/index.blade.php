@extends('layouts.app')

@section('content')
    <div class="d-flex flex-column justify-content-start align-items-center pb-5">

        <div style="width: 60%;" class="bg-light rounded py-3 mt-5 px-3 mb-5">
            @auth
                <form action="{{ route('posts') }}" method="post">
                    @csrf

                    {{-- post text area --}}
                    <div class="d-flex flex-column mt-3">
                        <textarea name="body" class="form-control @error('body') border border-danger @enderror" id="body"
                            placeholder="Post something..." rows="6"></textarea>

                        @error('body')
                            <div class="text-danger fs-6">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    {{-- Post button --}}
                    <div style="width: fit-content;" class="mt-3">
                        <input name="submit" id="submit" type="submit" value="Post" aria-label=".form-control-lg example"
                            style="font-size: 14px; margin-top: 1.3rem; padding: 8px 20px;"
                            class="form-control form-control-md bg-primary text-light fw-bold" />
                    </div>
                </form>
            @endauth


            @if ($posts->count())
                @foreach ($posts as $post)
                    <div class="d-flex flex-column py-3">
                        <div class="d-flex justify-content-start">
                            <span class="fw-bold text-dark">{{ $post->user->name }}</span>
                            <span style="font-size: 15px;"
                                class="mx-2 text-secondary">{{ $post->created_at->diffForHumans() }}</span>
                        </div>
                        <span class="fs-6 text-dark">
                            {{ $post->body }}
                        </span>
                    </div>
                    <div class="d-flex">
                        @if (!$post->likedBy(auth()->user()))
                            <form class="mr-1 border-0 outline-0" action="{{ route('posts.likes', $post) }}"
                                method="post">
                                @csrf
                                <button style="margin-right: 1rem;" class="btn p-0 bg-light text-primary"
                                    type="submit">Like</button>
                            </form>
                        @else
                            <form class="ml-1" action="{{ route('posts.likes', $post) }}" method="post">
                                @csrf
                                @method('DELETE')
                                <button style="margin-right: 0.5rem;" class="btn p-0 bg-light text-primary"
                                    type="submit">Unlike</button>
                            </form>
                        @endif
                        <span style="font-size: 15px; padding-top: 0.2rem;"
                            class="text-secondary">{{ $post->likes->count() }}
                            {{ Str::plural('like', $post->likes->count()) }}</span>
                    </div>
                @endforeach

                {{ $posts->links() }}
            @else
                <p class="text-secondary my-5 text-center fs-5">There are no posts.</p>
            @endif
        </div>


    </div>
@endsection
