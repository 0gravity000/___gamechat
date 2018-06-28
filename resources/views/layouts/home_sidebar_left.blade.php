<div>
  <div class="sidebar-module">
    <h4>ゲーム</h4>
    @foreach($games as $game)
      <span>
        <a href="/posts/tags/{{ $game->title }}">{{ $game->title }}</a>
      </span>
    @endforeach
  </div>
</div>
