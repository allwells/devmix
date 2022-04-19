@extends('layouts.app')

@section('content')
    <div class="d-flex flex-column justify-content-start align-items-center pb-5 pt-5">

        <div style="width: 60%;" class="my-5">

            <div class="d-flex flex-column">
                <h1 class="text-light">{{ $user->name }}</h1>
                <span style="font-size: 13px;" class="text-secondary">
                    Posts Published: {{ $posts->count() }}
                </span>
                <span style="font-size: 13px;" class="text-secondary">
                    Likes received: {{ $user->receivedLikes->count() }}
                </span>
            </div>

            <div class="rounded py-3 mt-4">
                @if ($posts->count())
                    @foreach ($posts as $post)
                        <x-post :post="$post" />
                    @endforeach


                    {{ $posts->links() }}
                @else
                    <p class="text-secondary my-5 text-center fs-5">{{ $user->name }} does not have any posts.</p>
                @endif
            </div>
        </div>


    </div>
@endsection
