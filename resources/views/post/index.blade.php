@extends('layouts.app')

@section('content')
    <div class="d-flex flex-column justify-content-start align-items-center pb-5">
        @auth
            <div class="bg-light rounded py-3 mt-5 w-50 px-3 mb-5">
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
                            class="form-control form-control-md bg-dark text-light fw-bold" />
                    </div>
                </form>
            </div>
        @endauth
        <div class="border rounded">
            @if ($posts->count())
                @foreach ($posts as $post)
                    <div style="min-width: 50%;" class="d-flex flex-column bg-light rounded px-4 py-4 mb-3">
                        <div class="d-flex justify-content-start">
                            <span class="fw-bold">{{ $post->user->name }}</span>
                            <span class="mx-2 text-secondary">{{ $post->created_at->diffForHumans() }}</span>
                        </div>
                        <span class="fs-6">
                            {{ $post->body }}
                        </span>
                    </div>
                @endforeach

                {{ $posts->links() }}
                elseif($page_no > 4 && $page_no < $total_no_of_pages - 4) { <li><a href='?page_no=1'>1</a></li>";
                    <li><a href='?page_no=2'>2</a></li>";
                    <li><a>...</a></li>";
                    @for ($counter = $page_no - $adjacents; $counter <= $page_no + $adjacents; $counter++) {
                        @if ($counter == $page_no)
                            {
                            <li class='active'><a>$counter</a></li>";
                        @else
                            <li><a href='?page_no=$counter'>$counter</a></li>";
                        @endif
                        <li><a>...</a></li>";
                        <li><a href='?page_no=$second_last'>$second_last</a></li>";
                        <li><a href='?page_no=$total_no_of_pages'>$total_no_of_pages</a></li>";
                        }
                    @else
                        <p class="text-secondary fs-4">There are no posts.</p>
                    @endif

        </div>

    </div>
@endsection
