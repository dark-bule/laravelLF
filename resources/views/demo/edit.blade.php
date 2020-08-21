<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>edit</title>
  </head>
  <body>
    <form method="post" action="http://demo.laravel/demo/update/{{$data['id']}}">
      @csrf
      <input type="text" name="name" placeholder="{{$data['name']}}"><br>
      <input type="text" name="pass" placeholder="{{$data['pass']}}"><br>
      <input type="number" name="num" placeholder="{{$data['num']}}"><br>
      <input type="submit" >
    </form>
</html>