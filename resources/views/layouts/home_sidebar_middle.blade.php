<div>
  <div class="sidebar-module">
    <h4>キャラクター</h4>
    @foreach($charactors as $charactor)
      <span>
        <a href="/posts/tags/{{ $charactor->name }}">{{ $charactor->name }}</a>
      </span>
    @endforeach
  </div>
</div>
