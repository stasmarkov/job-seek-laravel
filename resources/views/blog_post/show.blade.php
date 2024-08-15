<x-layout>
  <article class>
    <x-base.model_basic>
      <x-base.page-heading>{{ $blog_post->title }}</x-base.page-heading>
      <x-forms.divider />
      <div class="flex align-middle justify-between space-x-2">
          <p class="flex gap-2 font-light"><span class="text-gray-300">{{ __('Authored On:') }}</span><span class="italic">{{ $blog_post->created_at->toString() }}</span></p>
          <p class="italic flex gap-2 font-light"><span class="text-gray-300">{{ __('Author:') }}</span><a class="hover:text-blue-500" href="#">{{ $blog_post->user->email }}</a></p>
      </div>
      <x-forms.divider />
      <p class="text-lg font-extralight">{{ $blog_post->body }}</p>
    </x-base.model_basic>
  </article>
</x-layout>
