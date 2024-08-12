<x-layout>
  <x-base.page-heading>{{ __('Login') }}</x-base.page-heading>
  <div>
    <x-forms.form method="POST" action="{{ route('login.action') }}">
      <x-forms.input name="email" label="{{ __('Email') }}" type="email" />
      <x-forms.input name="password" label="{{ __('Password') }}" type="password" />

      <x-forms.divider />
      <p>{{ __('Do not have an account? Register') }} <a href="{{ route('register') }}" class="text-blue-500">here</a>.</p>
      <x-forms.divider />

      <x-forms.button>{{ __('Log In' )}}</x-forms.button>
    </x-forms.form>
  </div>
</x-layout>
