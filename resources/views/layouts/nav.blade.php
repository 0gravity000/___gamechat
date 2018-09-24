<nav class="navbar navbar-expand-md navbar-dark fixed-top" style="background-color: #dc3545;">
  <a class="navbar-brand" href="/">Game Chat</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarsExampleDefault" aria-controls="navbarsExampleDefault" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarsExampleDefault">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item dropdown active">
        <a class="nav-link dropdown-toggle" href="https://example.com" id="dropdown01" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">ゲーム</a>
        <div class="dropdown-menu" aria-labelledby="dropdown01">
          <a class="dropdown-item" href="/home/amazon">Amazonで人気のゲーム</a>
          <a class="dropdown-item" href="/home/favorite">お気に入りのゲーム</a>
        </div>
      </li>
      @if (Auth::check())
        <li class="nav-item dropdown active">
          <a class="nav-link dropdown-toggle" href="https://example.com" id="dropdown01" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">{{ Auth::user()->name }}</a>
          <div class="dropdown-menu" aria-labelledby="dropdown01">
        @if (Auth::user()->id == 1)
            <a class="dropdown-item" href="/admin/api">API Keyの登録</a>
            <a class="dropdown-item" href="/admin">ゲーム一覧の取得</a>
            <a class="dropdown-item" href="/admin/gamealias">ゲーム別名の登録</a>
        @endif
            <a class="dropdown-item" href="/logout">Logout</a>
          </div>
        </li>
      @endif

      <li class="nav-item dropdown active">
        <a class="nav-link dropdown-toggle" href="https://example.com" id="dropdown01" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">記事</a>
        <div class="dropdown-menu" aria-labelledby="dropdown01">
          <a class="dropdown-item" href="/articles/Windows10_PC_Fate_Stay_night">Windows10でPC版 Fate/Stay nightを実行する</a>
        </div>
      </li>

    </ul>
  </div>


</nav>
