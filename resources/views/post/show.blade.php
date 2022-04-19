@extends('layouts.app')

@section('content')
    <div class="d-flex justify-content-center align-items-start pt-5">
        <div class="rounded py-3 mt-5 w-50 px-3">
            <span class="text-light fs-4">{{ $post->body }}</span>
            @auth
                <form style="border-top: 1px solid #888; border-bottom: 1px solid #888; padding: 1rem 0;"
                    class="my-3 d-flex justify-content-center w-100 border-secondary" action="{{ route('explore') }}"
                    method="post">
                    @csrf

                    {{-- post text area --}}
                    <div style="width: 85%;" class="d-flex flex-column">
                        <input style="background-color: transparent; border: none; box-shadow: none;" name="comment"
                            class="form-control text-light @error('comment') border border-danger @enderror" id="comment"
                            placeholder="Add a comment..." />

                        @error('comment')
                            <div class="text-danger fs-6">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    {{-- Post button --}}
                    <div style="width: 15%;">
                        <input name="submit" id="submit" type="submit" value="Post" aria-label=".form-control-lg example"
                            style="background-color: #000000; border: none; box-shadow: none; height: 100%; font-size: 14px;"
                            class="form-control box-shadow: none; form-control-md text-light fw-bold" />
                    </div>
                </form>
            @endauth
            <div class="d-flex border w-100 rounded">


                @if ($post->count())
                    @foreach ($post as $posts)
                        <span>{{ $posts->comments }}</span>
                    @endforeach
                @endif
            </div>
        </div>
    </div>
@endsection
