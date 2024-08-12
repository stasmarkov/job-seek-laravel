<x-layout>
  <x-base.page-heading>Blogs</x-base.page-heading>
  <div class="space-y-3">
    @foreach ($blog_posts as $blog_post)
      <x-blog_post.index :$blog_post />
    @endforeach
  </div>
</x-layout>
