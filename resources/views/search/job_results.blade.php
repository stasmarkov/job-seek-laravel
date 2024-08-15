<x-layout>
  <x-base.page-heading>{{ __('Search results') }}</x-base.page-heading>

  <div class="space-y-3">
    @if (count($results) > 0)
      @foreach($results as $result)
        <x-job.card-wide :job="$result"/>
      @endforeach

      <div class="pager mt-4">
        {{ $results->links() }}
      </div>
    @else
      <div class="text-xl text-center">
        {{ __('Oops! No results found :\'(') }}
      </div>
    @endif
  </div>
</x-layout>
