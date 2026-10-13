@props(['tone' => 'slate'])

@php
    $tones = [
        'emerald' => 'bg-emerald-50 text-emerald-700',
        'amber' => 'bg-amber-50 text-amber-700',
        'rose' => 'bg-rose-50 text-rose-700',
        'sky' => 'bg-sky-50 text-sky-700',
        'indigo' => 'bg-indigo-50 text-indigo-700',
        'slate' => 'bg-slate-100 text-slate-600',
    ];
@endphp

<span {{ $attributes->merge(['class' => 'inline-flex rounded-full px-2.5 py-1 text-xs font-medium '.($tones[$tone] ?? $tones['slate'])]) }}>
    {{ $slot }}
</span>
