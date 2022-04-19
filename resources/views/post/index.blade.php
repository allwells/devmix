@extends('layouts.app')

@section('content')
    <div class="d-flex flex-column justify-content-start align-items-center pb-3">

        <div style="width: 60%; background-color: #000;" class="rounded  border-secondary py-3 pt-5 mt-5 px-3 mb-4">
            @auth
                <form class="my-3" action="{{ route('explore') }}" method="post">
                    @csrf

                    {{-- post text area --}}
                    <div class="d-flex flex-column mt-3">
                        <textarea style="background-color: #171717; border: none; box-shadow: none;" name="body"
                            class="form-control text-light @error('body') border border-danger @enderror" id="body"
                            placeholder="Post something..." rows="6"></textarea>

                        @error('body')
                            <div class="text-danger fs-6">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    {{-- Post button --}}
                    <div style="width: fit-content;" class="mt-3">
                        <input name="submit" id="submit" type="submit" value="Publish" aria-label=".form-control-lg example"
                            style="background-color: #000000; border: 1px solid #555; font-size: 14px; margin-top: 1.3rem; padding: 3px 12px;"
                            class="form-control box-shadow: none; form-control-md text-light fw-bold" />
                    </div>
                </form>
            @endauth

            <span class="text-light fs-5 fw-bold text-capitalize">Lastest post</span>


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
