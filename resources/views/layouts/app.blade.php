<!-- Stored in resources/views/layouts/app.blade.php -->
<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <title>App Name - @yield('title')</title>
    
  </head>
  <body>
      @section('sidebar')
      This is the master sidebar.
      <h1 class="display-4">Hello, world!</h1>
      <p class="lead">Это простой пример блока с компонентом в стиле jumbotron для привлечения дополнительного внимания к содержанию или информации.</p>
      <hr class="my-4">
      <p>Использются служебные классы для типографики и расстояния содержимого в контейнере большего размера.</p>
      <p class="lead">
        <a class="btn btn-primary btn-lg" href="#" role="button">Learn more</a>
      </p>
      @show
      <div class="container">
            @yield('content')
      </div>
  </body>
</html>