@component('mail::message')
    # Your post was liked

    {{ $liker->name }} liked your post.

    @component('mail::button', ['url' => route('post.show', $post)])
        View Post
    @endcomponent

    Thanks,<br>
    Posty Team
@endcomponent
