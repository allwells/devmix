@extends('layouts.app')

@section('content')
    <div class="d-flex flex-column justify-content-start align-items-center pb-3">
        <div style="width: 50%;"
            class="d-flex flex-column justify-content-start align-items-center border-secondary py-3 pt-5 mt-5 px-3 mb-4">

            <span class="w-100 text-light fs-5 fw-bold text-capitalize">Lastest post</span>

            @if ($posts->count())
                @foreach ($posts as $post)
                    <x-post :post="$post" />
                @endforeach

                {{ $posts->links() }}
            @else
                <p class="text-secondary my-5 text-center fs-5">There are no posts.</p>
            @endif
        </div>


    </div>
@endsection
