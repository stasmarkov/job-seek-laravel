<!doctype html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport"
        content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Pixel Position</title>
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Hanken+Grotesk:ital,wght@0,100..600;1,100..600&family=Lato:wght@400;700&display=swap" rel="stylesheet">
  @vite(['resources/js/app.js', 'resources/css/app.css'])
</head>
<body class="bg-black text-white font-hanken-grotesk pb-20">

<div class="px-10">
  <nav class="flex justify-between items-center py-4 border-b border-white/10">
    <div><a href="{{ route('homepage') }}"><img src="{{ Vite::asset('resources/images/logo.svg') }}" alt=""></a></div>
    <div class="space-x-6 font-bold">
      <a href="{{ route('search', ['q' => '_all']) }}">Jobs</a>
      <a href="{{ route('blog_post.index') }}">Blog</a>
      <a href="#">Careers</a>
      <a href="#">Salaries</a>
      <a href="#">Companies</a>
    </div>
    <div class="space-x-6 font-bold flex">
      @auth
        <a href="{{ route('job.create') }}">Post a job</a>

        <form action="{{ route('logout') }}" method="POST">
          @csrf
          @method('DELETE')
          <button>Log out</button>
        </form>
      @endauth

      @guest
        <a href="{{ route('login') }}">{{ __('Log In') }}</a>
        <a href="{{ route('register') }}">{{ __('Sign Up') }}</a>
      @endguest
    </div>
  </nav>
  <main class="mt-10 max-w-[990px] mx-auto">
    {{ $slot }}
  </main>
</div>
</body>
</html>
