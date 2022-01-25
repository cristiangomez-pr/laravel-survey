@props(['disabled' => false])

<input {{ $disabled ? 'disabled' : '' }} {!! $attributes->merge(['class' => 'focus:ring-2 dark:focus:ring-0 focus:ring-blue-500 focus:outline-none appearance-none w-full text-sm leading-6 text-slate-900 dark:text-slate-100 placeholder-slate-400 rounded-md py-2 px-4 ring-[1.5px] dark:ring-0 ring-slate-200 shadow-sm dark:shadow-none dark:bg-slate-800']) !!}>