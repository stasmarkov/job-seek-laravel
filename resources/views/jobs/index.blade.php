<x-layout>
  <div class="space-y-10">

    <section class="text-center pt-6">
      <h1 class="font-bold text-4xl">Let's Find Your NExt Job</h1>
      <x-forms.form action="{{ route('search') }}" class="mt-6">
        <x-forms.input :label="FALSE" type="text" name="q" placeholder="Web Developer..."/>
      </x-forms.form>
    </section>

    <section class="pt-10">
      <x-base.section-heading>Feature Jobs</x-base.section-heading>

      <div class="grid lg:grid-cols-3 gap-8 mt-6">
        @foreach($featuredJobs as $job)
          <x-job.card :$job />
        @endforeach
      </div>
    </section>

    <section>
      <x-base.section-heading>Tags</x-base.section-heading>
      <div class="mt-6 space-x-3 flex">
        @foreach ($tags as $tag)
          <x-base.tag size="base" :$tag />
        @endforeach
      </div>
    </section>

    <section class="mt-6 space-y-6">
      <x-base.section-heading>Recent Jobs</x-base.section-heading>
      @foreach($jobs as $job)
        <x-job.card-wide :$job />
      @endforeach
    </section>
  </div>
</x-layout>
