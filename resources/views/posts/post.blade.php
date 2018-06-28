<div class="blog-post">
  <link href="../../css/starter-template.css" rel="stylesheet">
  <h2 class="blog-post-title">
    <a href="/posts/{{ $post->id }}">
      {{ $post->title}}
    </a>
  </h2>
  @if (Auth::check())
    <a href="/posts/update/{{ $post->id }}">編集する</a>
  @endif
  <p class="blog-post-meta">
    {{ $post->user->name }} on
    {{ $post->created_at->toFormattedDateString() }}
  </p>

</div><!-- /.blog-post -->
