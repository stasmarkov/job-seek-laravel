@props(['job'])

<x-base.panel class="flex flex-col text-center">
  <div class="self-start text-sm">{{ $job->employer->name }}</div>

  <div class="py-8">
    <h3 class="group-hover:text-blue-600 text-xl text-bold transition-colors duration-300">
      <a href="{{ $job->url }}" target="_blank">
        {{ $job->title }}
      </a>
    </h3>
    <p class="text-sm mt-4">{{ $job->schedule }} - {{ $job->salary }}</p>
  </div>

  <div class="flex justify-between items-center mt-auto">
    <div>
      @foreach ($job->tags as $tag)
        <x-base.tag size="small" :$tag />
      @endforeach
    </div>

    <x-employer.logo :width="42" :employer="$job->employer" />
  </div>
</x-base.panel>
