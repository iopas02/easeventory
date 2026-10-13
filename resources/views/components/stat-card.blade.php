@props(['label', 'value', 'change' => null, 'trend' => 'up', 'note' => null, 'icon' => null])

<div class="rounded-xl border border-slate-200 bg-white p-5 shadow-sm">
    <div class="flex items-start justify-between">
        <div>
            <p class="text-sm font-medium text-slate-500">{{ $label }}</p>
            <p class="mt-2 text-2xl font-semibold tracking-tight text-slate-900">{{ $value }}</p>
        </div>
        @if ($icon)
            <span class="grid h-10 w-10 place-items-center rounded-lg bg-indigo-50 text-indigo-600">
                <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.6">
                    <path stroke-linecap="round" stroke-linejoin="round" d="{{ $icon }}" />
                </svg>
            </span>
        @endif
    </div>
    @if ($change !== null || $note !== null)
        <div class="mt-3 flex items-center gap-2 text-xs">
            @if ($change !== null)
                <span class="inline-flex items-center gap-1 rounded-full px-2 py-0.5 font-medium {{ $trend === 'up' ? 'bg-emerald-50 text-emerald-700' : 'bg-rose-50 text-rose-700' }}">
                    <svg class="h-3 w-3 {{ $trend === 'up' ? '' : 'rotate-180' }}" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M4.5 15.75l7.5-7.5 7.5 7.5" />
                    </svg>
                    {{ $change }}
                </span>
            @endif
            @if ($note)
                <span class="text-slate-400">{{ $note }}</span>
            @endif
        </div>
    @endif
</div>
