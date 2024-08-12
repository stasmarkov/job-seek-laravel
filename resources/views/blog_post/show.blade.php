<x-layout>
  <article class>
    <x-base.model_basic>
      <x-base.page-heading>{{ $blog_post->title }}</x-base.page-heading>
      <x-forms.divider />
      <div class="flex align-middle justify-between space-x-2">
        <div>
          <p>Authored On: <span class="italic">{{ $blog_post->created_at->toString() }}</span></p>
        </div>
        <div class="flex gap-2">
          <p>{{ __('Author:') }}</p>
          <p class="italic"><a class=" hover:text-blue-500" href="#">{{ $blog_post->user->name }}</a></p>
        </div>
      </div>
      <x-forms.divider />
      <p class="text-lg">{{ $blog_post->body }}</p>
    </x-base.model_basic>
  </article>
</x-layout>
