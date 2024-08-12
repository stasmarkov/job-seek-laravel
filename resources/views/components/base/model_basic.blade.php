@php
  $default_classes = 'p-4 bg-white/5 rounded-xl border border-transparent pt-8';
@endphp

<div {{ $attributes(['class' => $default_classes]) }}>
  {{ $slot }}
</div>
