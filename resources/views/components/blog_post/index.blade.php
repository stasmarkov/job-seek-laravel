@props(['blog_post'])

<article class="p-4 rounded-2xl bg-white/10">
  <div class="flex">
    <h2 class="text-2xl"><a
        class="hover:text-blue-500"
        href="{{ route('blog_post.show', ['blog_post' => $blog_post]) }}">
        {{ $blog_post->title . ' ' . $blog_post->id }}
      </a> </h2>
  </div>
  <div class="mt-auto flex justify-between">
    <p class="text-sm">{{ __('Author: ') }} <span class="text-blue-500">{{ $blog_post->user->name }}</span></p>
    <p class="text-sm">{{ __('Likes: ') }} <span class="text-blue-500">{{ count($blog_post->likes) }}</span>  </p>
  </div>
</article>
