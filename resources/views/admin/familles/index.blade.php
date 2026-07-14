<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">

            @if(auth()->user()->centre->type_consultation === 'ADMIN')

            <a href="{{ route('admin.familles.create') }}"
                class="bg-blue-700 hover:bg-blue-800 text-white font-bold py-2 px-4 rounded">
                + Ajouter une famille
            </a>

            <a href="{{ route('admin.sous_familles.create') }}"
                class="bg-blue-700 hover:bg-blue-800 text-white font-bold py-2 px-4 rounded">
                + Ajouter une sous famille
            </a>

            <a href="{{ route('admin.marques.create') }}"
                class="bg-blue-700 hover:bg-blue-800 text-white font-bold py-2 px-4 rounded">
                + Ajouter une marque
            </a>

            <a href="{{ route('admin.modeles.create') }}"
                class="bg-blue-700 hover:bg-blue-800 text-white font-bold py-2 px-4 rounded">
                + Ajouter un modèle
            </a>

            @endif

        </div>
    </x-slot>

    <div class="py-6 px-6">

        @foreach($familles as $famille)

        <div x-data="{ open: false }" class="bg-white shadow rounded-lg mb-4">

            {{-- Famille --}}
            <div @click="open = !open"
                class="flex justify-between items-center px-4 py-3 cursor-pointer hover:bg-gray-50 rounded-t-lg">

                <div class="flex items-center gap-2">

                    <svg class="w-5 h-5 text-blue-700 transition-transform duration-200"
                        :class="{ 'rotate-90': open }"
                        fill="none"
                        stroke="currentColor"
                        viewBox="0 0 24 24">
                        <path stroke-linecap="round"
                            stroke-linejoin="round"
                            stroke-width="2"
                            d="M9 5l7 7-7 7" />
                    </svg>

                    <span class="font-bold text-blue-700 text-lg">
                        {{ $famille->nom_famille }}
                    </span>

                </div>

                @if(auth()->user()->centre->type_consultation === 'ADMIN')
                <a href="{{ route('admin.familles.edit', $famille->id_famille) }}"
                    @click.stop
                    class="bg-blue-600 hover:bg-blue-700 text-white text-sm py-1 px-3 rounded">
                    Modifier
                </a>
                @endif

            </div>

            <div x-show="open" x-transition>

                @foreach($famille->sousFamilles as $sousFamille)

                <div x-data="{ openSous: false }">

                    {{-- Sous-famille --}}
                    <div @click="openSous = !openSous"
                        class="ml-8 flex justify-between items-center px-4 py-2 cursor-pointer hover:bg-gray-50">

                        <div class="flex items-center gap-2">

                            <svg class="w-4 h-4 text-gray-600 transition-transform duration-200"
                                :class="{ 'rotate-90': openSous }"
                                fill="none"
                                stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round"
                                    stroke-linejoin="round"
                                    stroke-width="2"
                                    d="M9 5l7 7-7 7" />
                            </svg>

                            <span class="text-gray-700">
                                {{ $sousFamille->nom_sous_famille }}
                            </span>

                        </div>

                        @if(auth()->user()->centre->type_consultation === 'ADMIN')
                        <a href="{{ route('admin.sous_familles.edit', $sousFamille->id_sous_famille) }}"
                            @click.stop
                            class="bg-gray-500 hover:bg-gray-600 text-white text-sm py-1 px-3 rounded">
                            Modifier
                        </a>
                        @endif

                    </div>

                    <div x-show="openSous" x-transition>

                        @foreach($sousFamille->marques as $marque)

                        <div x-data="{ openMarque: false }">

                            {{-- Marque --}}
                            <div @click="openMarque = !openMarque"
                                class="ml-16 flex justify-between items-center px-4 py-2 cursor-pointer hover:bg-gray-50">

                                <div class="flex items-center gap-2">

                                    <svg class="w-4 h-4 text-gray-500 transition-transform duration-200"
                                        :class="{ 'rotate-90': openMarque }"
                                        fill="none"
                                        stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round"
                                            stroke-linejoin="round"
                                            stroke-width="2"
                                            d="M9 5l7 7-7 7" />
                                    </svg>

                                    <span class="text-gray-600">
                                        {{ $marque->nom_marque }}
                                    </span>

                                </div>

                                @if(auth()->user()->centre->type_consultation === 'ADMIN')
                                <a href="{{ route('admin.marques.edit', $marque->id_marque) }}"
                                    @click.stop
                                    class="bg-gray-400 hover:bg-gray-500 text-white text-sm py-1 px-3 rounded">
                                    Modifier
                                </a>
                                @endif

                            </div>

                            <div x-show="openMarque" x-transition>

                                @foreach($marque->modeles as $modele)

                                {{-- Modèle --}}
                                <div class="ml-24 flex justify-between items-center px-4 py-2 hover:bg-gray-50">

                                    <div class="flex items-center gap-2">
                                        <span class="w-2 h-2 rounded-full bg-gray-400"></span>

                                        <span class="text-gray-500">
                                            {{ $modele->nom_modele }}
                                        </span>
                                    </div>

                                    @if(auth()->user()->centre->type_consultation === 'ADMIN')
                                    <a href="{{ route('admin.modeles.edit', $modele->id_modele) }}"
                                        class="bg-gray-300 hover:bg-gray-400 text-gray-700 text-sm py-1 px-3 rounded">
                                        Modifier
                                    </a>
                                    @endif

                                </div>

                                @endforeach

                            </div>

                        </div>

                        @endforeach

                    </div>

                </div>

                @endforeach

            </div>

        </div>

        @endforeach

    </div>

</x-app-layout>