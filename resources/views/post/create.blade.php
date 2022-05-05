@extends('layouts.app')

@section('content')
    <div class="w-100 d-flex flex-column justify-content-start align-items-center py-3 mb-5">
        <div class="px-5 py-3 mt-5 w-75">
            <span class="fw-bolder fs-3 text-light">Create Post</span>
        </div>
        <form class="w-75 px-5 d-flex flex-column justify-content-center align-items-center" action="{{ route('create') }}"
            method="post">
            @csrf

            <div style="min-height: 26rem; background-color: #111; border: 1px solid #222;"
                class="w-100 d-flex rounded-2 flex-column">
                {{-- post title --}}
                <div class="w-100 mb-2 px-5">
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
                <div class="w-100">
                    <input type="hidden" name="body" class="@error('body') border border-danger @enderror" id="body"></input>
                    <trix-editor x-data="{
                        upload(event) {
                            const data = new FormData();

                            data.append('attachment', event.attachment.file);

                            windows.axios.post('/attachments', data, {

                                onUploadProgress(progressEvent) {
                                    event.attachment.setUploadProgress(progressEvent.loaded / progressEvent.total * 100);
                                },

                            }).then(({ data }) => {
                                event.attachment.setAttribute({ url: data.image_url, });
                            });

                        }
                    }" x-on:trix-attachment-add="upload"
                        placeholder="Write your post content here..." class="text-light" input="body">
                    </trix-editor>


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
    <script src="{{ asset('js/trix.js') }}"></script>
    <script src="{{ asset('js/trix-core.js') }}"></script>
@endsection
