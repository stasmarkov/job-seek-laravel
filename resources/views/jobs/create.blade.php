<x-layout>
  <x-base.page-heading>{{ __('Crate Job') }}</x-base.page-heading>

  <x-forms.form action="{{ route('job.store') }}" method="POST">
    <x-forms.input label="Title" name="title" placeholder="Laravel Developer" />
    <x-forms.input label="Salary" name="salary" placeholder="$60,000 USD" />
    <x-forms.input label="Location" name="location" placeholder="Port City, Lutsk" />

    <x-forms.select label="Schedule" name="schedule">
      <option value="Part-Time">Part Time</option>
      <option value="Full-Time">Full Time</option>
    </x-forms.select>

    <x-forms.input label="URL" name="url" placeholder="https://acme.com/jobs.ceo-wanted" />
    <x-forms.checkbox label="Featured (Costs Extra)" name="featured" />

    <x-forms.input label="Tags (Comma separated)" name="tags" placeholder="laravel, symfony, education" />
    <x-forms.divider />
    <x-forms.input name="description" label="Description" />
    <x-forms.divider />
    <x-forms.button>{{ __('Create') }}</x-forms.button>
  </x-forms.form>
</x-layout>
