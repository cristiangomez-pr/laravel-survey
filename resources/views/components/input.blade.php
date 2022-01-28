@props(['disabled' => false])

<input {{ $disabled ? 'disabled' : '' }} {!! $attributes->merge(['class' => '
    mt-1
    block
    w-full
    rounded-md
    bg-slate-100
    border-transparent
    focus:border-slate-300 focus:bg-white focus:ring-0
']) !!}>