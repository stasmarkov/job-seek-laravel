<!doctype html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport"
        content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Contact us</title>
</head>
<body>
<h1>Hey {{ $user->candidateProfile->first_name }} {{ $user->candidateProfile->last_name }}!</h1>
<ul>
  @foreach($vacancies as $vacancy)
    <li>
      <a href="{{ route('vacancy.show', ['vacancy' => $vacancy->id]) }}" target="_blank">{{ $vacancy->title }}</a>
    </li>
  @endforeach
</ul>
</body>
</html>
