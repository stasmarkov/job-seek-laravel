@props(['tag', 'size' => 'base'])

@php
  $classes = 'bg-white/10 px-3 py-1 rounded-2xl text-2xs font-bold hover:bg-white/25 transition-colors duration-300';
  if ($size === 'base') {
    $classes .= ' px-5 py-1 text-sm';
  }
  elseif ($size === 'small') {
    $classes .= ' px-3 py-1 text-2xs';
  }
@endphp

<a href="{{ route('tag.index', ['tag' => $tag]) }}" {{ $attributes->merge(['class' => $classes]) }}>{{ $tag->name }}</a>
