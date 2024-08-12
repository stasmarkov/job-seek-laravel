<!doctype html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport"
        content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Pixel Position</title>
  @vite(['resources/js/app.js']);
</head>
<body>

<div>
  <nav>
    <div><a href="{{ route('homepage') }}"><img src="{{ Vite::asset('resources/images/logo.svg') }}" alt=""></a></div>
    <div>
      <a href="#">Jobs</a>
      <a href="#">Careers</a>
      <a href="#">Salaries</a>
      <a href="#">Companies</a>
    </div>
    <div><a href="#">Post a job</a></div>
  </nav>
  <main>
    {{ $slot }}
  </main>
</div>
</body>
</html>
