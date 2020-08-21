<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>inquire</title>
  </head>
  <body>
    <?php
    //   header("location:http://demo.laravel/demo/index");
    // var_dump($datas);
    // var_dump($datas['id']);
    // exit;
    ?>
@foreach ($datas as $data)
    <p class="id">id: <span>{{ $data['id']}}</span> </p>
    <p class="name">name: <span>{{ $data['name']}}</span></p>
    <p class="pass">pass: <span>{{ $data['pass']}}</span></p>
    <p class="year">year: <span>{{$data['num']}}</span></p>
    <p>
      <a href="http://demo.laravel/demo/edit/{{ $data['id']}}">编辑</a>
      <a href="http://demo.laravel/demo/delete/{{ $data['id']}}">删除</a>
      <a href="http://demo.laravel/demo/index/">首页</a>

    </p>
    <hr>
@endforeach
</body>
</html>
