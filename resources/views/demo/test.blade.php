<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>add</title>
  </head>
  <body>
    <form method="post" action="http://demo.laravel.localhost/demo/install">
      @csrf
      <input type="text" name="name" placeholder="name"><br>
      <input type="text" name="pass" placeholder="pass"><br>
      <input type="number" name="num" placeholder="number"><br>
      <input type="submit" >
    </form>


</html>
