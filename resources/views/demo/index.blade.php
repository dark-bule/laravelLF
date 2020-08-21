<!doctype html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>index</title>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/css/bootstrap.min.css">
  <script src="https://cdn.bootcss.com/jquery/3.2.1/jquery.min.js"></script>
  <script src="https://cdn.bootcss.com/popper.js/1.12.5/umd/popper.min.js"></script>
  <script src="https://cdn.bootcss.com/bootstrap/4.0.0-beta/js/bootstrap.min.js"></script>
</head>

<body>

  <div class="container">
    <div class="row">
      <div class="col-md-8" style="padding-bottom:  20px">

        <div class="card">
          <div class="card-body">


            <table class="table table-striped table-dark">

              <tbody>
                @foreach ($datas as $data)
                <tr>
                <td style="word-break:break-all; word-wrap:break-all;"  >
                  <p class="id">id: <span>{{ $data['id']}}</span> </p>
                  <p class="name">name: <span>{{ $data['name']}}</span></p>
                  <p class="pass">pass: <span>{{ $data['pass']}}</span></p>
                  <p class="year">year: <span>{{$data['num']}}</span></p>
                </td>
                <p>
                  <td style="width: 100px;">
                    <a class="btn btn-info btn-sm" href="http://demo.laravel/demo/edit/{{ $data['id']}}">编辑</a>
                    <a class="btn btn-danger btn-sm" href="http://demo.laravel/demo/delete/{{ $data['id']}}">删除</a>
                    <a class="btn btn-info btn-sm" href="http://demo.laravel/demo/index/">首页</a>
                  </td>
                </p> 
                </tr>
                <hr>
                @endforeach
              </tbody>
            </table>
          </div>
        </div>
      </div>
    

    <div class="col-md-4">

      <div class="card" style="margin-bottom: 30px;">
        <div class="card-header">欢迎发布留言 </div>
        <div class="card-body">

          <!-- 中间的表单内容 -->
          <form method="post" action="http://demo.laravel/demo/install">
            @csrf
            <input type="text" name="name" placeholder="name"><br>
            <input type="text" name="pass" placeholder="pass"><br>
            <input type="number" name="num" placeholder="number"><br>
            <input class="btn btn-primary" type="submit" onclick="redirect('/demo/index');">
          </form>
        </div>
      </div>
      <div class="card">
        <div class="card-header">
            <p>查询</p>
            
        </div>
        <div class="card-body">
        <form method="post" action="http://demo.laravel/demo/inquire">
            @csrf
            <input type="number" name="idQuery" placeholder="idQuery"><br>
            <input type="text" name="nameQuery" placeholder="nameQuery"><br>
            <input type="text" name="passQuery" placeholder="passQuery"><br>
            <input type="number" name="numQuery" placeholder="numberQuery"><br>
            <input class="btn btn-primary" type="submit">
          </form></div>
        <div class="card-footer"></div>
      </div>
    </div>

  </div>
  </div>





</body>

</html>