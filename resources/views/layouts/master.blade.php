<!doctype html>
<html lang="ja">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="author" content="0gravity000">
    <!-- <link rel="icon" href="../../../../favicon.ico"> -->
    <meta name="discription" content="YouTubeゲーム動画の配信やゲーム情報などを記載したサイトです">
    <meta name="keywords" content="YouTube ゲーム, YouTube 動画 ゲーム, ゲーム おすすめ, ゲーム レビュー">
    <script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>

    <title>Game Chat</title>

    <!-- Bootstrap core CSS -->

    <!-- Custom styles for this template -->
    <link href="./css/starter-template.css" rel="stylesheet">
  </head>

  <body>
     @include('layouts.nav')
    <main role="main" class="container-fluid">
    <div class="row">
      <div class="col-sm-3">
        @yield('sidebar_left')
      </div>
      <div class="col">
        @yield('content')
      </div>
      <div class="col-sm-3">
        @include('layouts.sidebar_right')
      </div>
    </div>
    </main><!-- /.container-fluid -->

    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" integrity="sha384-WskhaSGFgHYWDcbwN70/dfYBj47jz9qbsMId/iRN3ewGhXQFZCSftd1LZCfmhktB" crossorigin="anonymous">
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js" integrity="sha384-smHYKdLADwkXOn1EmN1qk/HfnUcbVRZyYmZ4qpPea6sjB/pTJ0euyQp0Mk8ck+5T" crossorigin="anonymous"></script>

  </body>
</html>
