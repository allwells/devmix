@extends('layouts.app')

@section('content')
    <div style="min-height: 100vh;" class="w-100 d-flex flex-column justify-content-start align-items-center py-5">
        <div class="py-4 mt-5 w-75">
            <span class="fw-bolder fs-2 text-light">Create Post</span>
        </div>
        <form class="w-75 px-5 d-flex flex-column justify-content-center align-items-center" action="{{ route('posts') }}"
            method="post">
            @csrf

            <div style="background-color: #111; border: 1px solid #222;" class="w-100 d-flex rounded-2 flex-column">
                {{-- post title --}}
                <div class="w-100 mb-2 px-4">
                    <input style="background-color: #111; border: none; box-shadow: none;" name="title"
                        class="form-control text-light py-4 fw-bolder fs-2 @error('title') border border-danger @enderror"
                        id="title" placeholder="Post title here..." />

                    @error('title')
                        <div class="text-danger fs-6">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                {{-- post content --}}
                <div class="w-100 pb-5">
                    <div style="background-color: transparent;" name="body"
                        class="cke_editable @error('body') border border-danger @enderror" id="body"></div>

                    @error('body')
                        <div class="text-danger fs-6">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

            </div>

            {{-- Post button --}}
            <div style="width: fit-content; margin-top: 1.3rem;" class="w-100 mt-3">
                <input name="submit" id="submit" type="submit" value="Publish" aria-label=".form-control-lg example"
                    style="background-color: #000000; width: fit-content; border: 1px solid #555; font-size: 14px;  padding: 10px 30px;"
                    class="form-control box-shadow: none; form-control-md text-light fw-bold" />
            </div>

        </form>
    </div>
@endsection

@section('scripts')
    <script src="{{ asset('ckeditor/ckeditor.js') }}"></script>
    <script>
        CKEDITOR.replace('body');
    </script>
@endsection
