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
                    <x-post :post="$post" />
                @endforeach

                {{ $posts->links() }}
            @else
                <p class="text-secondary my-5 text-center fs-5">There are no posts.</p>
            @endif
        </div>


    </div>
@endsection
