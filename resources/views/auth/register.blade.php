<x-layout>
  <x-base.page-heading>{{ __('Register') }}</x-base.page-heading>
  <div>
    <x-forms.form method="POST" action="{{ route('register.action') }}" enctype="multipart/form-data">
      <x-forms.input name="name" label="{{ __('Username') }}" />
      <x-forms.input name="email" label="{{ __('Email') }}" type="email" />
      <x-forms.input name="password" label="{{ __('Password') }}" type="password" />
      <x-forms.input name="password_confirmation" label="{{ __('Confirm Password') }}" type="password" />

      <x-forms.divider />

      <x-forms.input name="employer" label="{{ __('Employer Name') }}" />
      <x-forms.input name="logo" label="{{ __('Logo') }}" type="file"/>

      <x-forms.divider />
      <p>{{ __('Have an account? Log-in') }} <a href="{{ route('login') }}" class="text-blue-500">here</a>.</p>
      <x-forms.divider />

      <x-forms.button>{{ __('Create account' )}}</x-forms.button>
    </x-forms.form>
  </div>
</x-layout>
