<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Profile') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">

            @php
                $user = auth()->user();
                $initials = strtoupper(mb_substr($user->prenom ?? '', 0, 1) . mb_substr($user->nom ?? '', 0, 1));
            @endphp

            <div class="bg-white shadow sm:rounded-lg overflow-hidden">

                {{-- Header band with avatar --}}
                <div class="bg-gradient-to-r from-blue-900 to-blue-800 px-6 py-8 sm:px-8">
                    <div class="flex items-center gap-4">
                        <div class="flex-shrink-0 h-16 w-16 rounded-full bg-white/10 border-2 border-white/30 flex items-center justify-center">
                            <span class="text-xl font-semibold text-white tracking-wide">{{ $initials }}</span>
                        </div>
                        <div>
                            <h3 class="text-xl font-semibold text-white">
                                {{ $user->prenom }} {{ $user->nom }}
                            </h3>
                            <p class="text-blue-200 text-sm mt-0.5">
                                {{ $user->centre->nom_centre ?? 'Centre non défini' }}
                            </p>
                        </div>
                    </div>
                </div>

                {{-- Info grid --}}
                <div class="px-6 py-6 sm:px-8">
                    <dl class="grid grid-cols-1 sm:grid-cols-2 gap-x-8 gap-y-5">

                        <div class="flex items-start gap-3">
                            <div class="mt-0.5 h-8 w-8 rounded-md bg-blue-50 flex items-center justify-center flex-shrink-0">
                                <svg class="h-4 w-4 text-blue-800" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 6a3.75 3.75 0 11-7.5 0 3.75 3.75 0 017.5 0zM4.501 20.118a7.5 7.5 0 0114.998 0A17.933 17.933 0 0112 21.75c-2.676 0-5.216-.584-7.499-1.632z" />
                                </svg>
                            </div>
                            <div>
                                <dt class="text-xs font-medium text-gray-700 uppercase tracking-wide">Matricule</dt>
                                <dd class="text-sm font-medium text-gray-900 mt-0.5">{{ $user->matricule }}</dd>
                            </div>
                        </div>

                        <div class="flex items-start gap-3">
                            <div class="mt-0.5 h-8 w-8 rounded-md bg-blue-50 flex items-center justify-center flex-shrink-0">
                                <svg class="h-4 w-4 text-blue-800" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 21h19.5m-18-18v18m10.5-18v18m6-13.5V21M6.75 6.75h.75m-.75 3h.75m-.75 3h.75m3-6h.75m-.75 3h.75m-.75 3h.75M6.75 21v-3.375c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21" />
                                </svg>
                            </div>
                            <div>
                                <dt class="text-xs font-medium text-gray-700 uppercase tracking-wide">Code Bureau</dt>
                                <dd class="text-sm font-medium text-gray-900 mt-0.5">{{ $user->centre->code_bureau ?? 'N/A' }}</dd>
                            </div>
                        </div>

                        <div class="flex items-start gap-3">
                            <div class="mt-0.5 h-8 w-8 rounded-md bg-blue-50 flex items-center justify-center flex-shrink-0">
                                <svg class="h-4 w-4 text-blue-800" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M21.75 6.75v10.5a2.25 2.25 0 01-2.25 2.25h-15a2.25 2.25 0 01-2.25-2.25V6.75m19.5 0A2.25 2.25 0 0019.5 4.5h-15a2.25 2.25 0 00-2.25 2.25m19.5 0v.243a2.25 2.25 0 01-1.07 1.916l-7.5 4.615a2.25 2.25 0 01-2.36 0L3.32 8.91a2.25 2.25 0 01-1.07-1.916V6.75" />
                                </svg>
                            </div>
                            <div>
                                <dt class="text-xs font-medium text-gray-700 uppercase tracking-wide">Email</dt>
                                <dd class="text-sm font-medium text-gray-900 mt-0.5 break-all">{{ $user->email_perso }}</dd>
                            </div>
                        </div>

                        <div class="flex items-start gap-3">
                            <div class="mt-0.5 h-8 w-8 rounded-md bg-blue-50 flex items-center justify-center flex-shrink-0">
                                <svg class="h-4 w-4 text-blue-800" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 6.75c0 8.284 6.716 15 15 15h2.25a2.25 2.25 0 002.25-2.25v-1.372c0-.516-.351-.966-.852-1.091l-4.423-1.106c-.44-.11-.902.055-1.173.417l-.97 1.293c-.282.376-.769.542-1.21.38a12.035 12.035 0 01-7.143-7.143c-.162-.441.004-.928.38-1.21l1.293-.97c.363-.271.527-.734.417-1.173L6.963 3.102a1.125 1.125 0 00-1.091-.852H4.5A2.25 2.25 0 002.25 4.5v2.25z" />
                                </svg>
                            </div>
                            <div>
                                <dt class="text-xs font-medium text-gray-700 uppercase tracking-wide">GSM</dt>
                                <dd class="text-sm font-medium text-gray-900 mt-0.5">{{ $user->gsm }}</dd>
                            </div>
                        </div>

                        <div class="flex items-start gap-3">
                            <div class="mt-0.5 h-8 w-8 rounded-md bg-blue-50 flex items-center justify-center flex-shrink-0">
                                <svg class="h-4 w-4 text-blue-800" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 21h19.5m-18-18v18m10.5-18v18m6-13.5V21M6.75 6.75h.75m-.75 3h.75m-.75 3h.75m3-6h.75m-.75 3h.75m-.75 3h.75" />
                                </svg>
                            </div>
                            <div>
                                <dt class="text-xs font-medium text-gray-700 uppercase tracking-wide">Centre</dt>
                                <dd class="text-sm font-medium text-gray-900 mt-0.5">{{ $user->centre->nom_centre ?? 'N/A' }}</dd>
                            </div>
                        </div>

                        <div class="flex items-start gap-3">
                            <div class="mt-0.5 h-8 w-8 rounded-md bg-blue-50 flex items-center justify-center flex-shrink-0">
                                <svg class="h-4 w-4 text-blue-800" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M15 10.5a3 3 0 11-6 0 3 3 0 016 0z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 10.5c0 7.142-7.5 11.25-7.5 11.25S4.5 17.642 4.5 10.5a7.5 7.5 0 1115 0z" />
                                </svg>
                            </div>
                            <div>
                                <dt class="text-xs font-medium text-gray-700 uppercase tracking-wide">Région</dt>
                                <dd class="text-sm font-medium text-gray-900 mt-0.5">{{ $user->centre->region->libelle_region ?? 'N/A' }}</dd>
                            </div>
                        </div>

                    </dl>
                </div>
            </div>

            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <div class="max-w-xl">
                    @include('profile.partials.update-password-form')
                </div>
            </div>

        </div>
    </div>
</x-app-layout>
