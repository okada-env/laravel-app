<!DOCTYPE html>
<html lang="ja" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>企業一覧ページです</title>
  </head>
  <body>
    <h1>企業一覧ページ</h1>

    <ul>
        @foreach ($companies as $company)
            <li>{{ $company -> name}}</li>
        @endforeach
    </ul>

  </body>
</html>
