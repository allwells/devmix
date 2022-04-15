@extends('layouts.app')

@section('content')
    <div class="d-flex justify-content-center align-items-start">
        <div class="bg-light rounded py-3 mt-5 w-50 px-3">
            <form action="{{ route('posts') }}" method="post">
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
                        class="form-control form-control-md bg-dark text-light fw-bold" />
                </div>
            </form>
        </div>
    </div>
@endsection
