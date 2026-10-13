@php($user = $user ?? null)

<div class="grid grid-cols-1 gap-5 sm:grid-cols-2">
    <div class="sm:col-span-2">
        <label for="store_name" class="block text-sm font-medium text-slate-700">Organization / Store name</label>
        <input id="store_name" name="store_name" type="text" required
               value="{{ old('store_name', $user?->tenant?->name) }}"
               class="mt-2 block w-full rounded-lg border border-slate-300 bg-white px-3.5 py-2.5 text-sm shadow-sm outline-none transition placeholder:text-slate-400 focus:border-indigo-500 focus:ring-2 focus:ring-indigo-500/30"
               placeholder="RJBR Auto Supply">
        <p class="mt-1 text-xs text-slate-400">The tenant is matched by the email domain. Two users sharing a domain belong to the same store.</p>
    </div>

    <div>
        <label for="name" class="block text-sm font-medium text-slate-700">Full name</label>
        <input id="name" name="name" type="text" required
               value="{{ old('name', $user?->name) }}"
               class="mt-2 block w-full rounded-lg border border-slate-300 bg-white px-3.5 py-2.5 text-sm shadow-sm outline-none transition placeholder:text-slate-400 focus:border-indigo-500 focus:ring-2 focus:ring-indigo-500/30"
               placeholder="Juan Dela Cruz">
    </div>

    <div>
        <label for="email" class="block text-sm font-medium text-slate-700">Email address</label>
        <input id="email" name="email" type="email" required
               value="{{ old('email', $user?->email) }}"
               class="mt-2 block w-full rounded-lg border border-slate-300 bg-white px-3.5 py-2.5 text-sm shadow-sm outline-none transition placeholder:text-slate-400 focus:border-indigo-500 focus:ring-2 focus:ring-indigo-500/30"
               placeholder="admin@example.com">
    </div>

    <div class="sm:col-span-2">
        <label for="password" class="block text-sm font-medium text-slate-700">
            Password
            @if ($user)<span class="font-normal text-slate-400">(leave blank to keep current)</span>@endif
        </label>
        <input id="password" name="password" type="password" {{ $user ? '' : 'required' }} autocomplete="new-password"
               class="mt-2 block w-full rounded-lg border border-slate-300 bg-white px-3.5 py-2.5 text-sm shadow-sm outline-none transition placeholder:text-slate-400 focus:border-indigo-500 focus:ring-2 focus:ring-indigo-500/30"
               placeholder="••••••••">
    </div>
</div>
