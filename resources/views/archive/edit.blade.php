<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __("Modifier l'archive") }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-2xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">

                @if($errors->any())
                    <div class="mb-4 p-4 bg-red-100 text-red-800 rounded">
                        <ul class="list-disc list-inside">
                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form action="{{ route('archive.update', $archive->id_archive) }}" method="POST" class="space-y-4">
                    @csrf
                    @method('PUT')

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">
                            Num série
                        </label>
                        <input type="text" name="num_serie" value="{{ old('num_serie', $archive->num_serie) }}"
                               class="w-full border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring-blue-500">
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">
                            Description
                        </label>
                        <input type="text" name="description" value="{{ old('description', $archive->description) }}"
                               class="w-full border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring-blue-500">
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">
                            État du matériel
                        </label>
                        <select name="etat"
                                class="w-full border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring-blue-500">
                            @php
                                $currentEtat = old('etat', $materiel->etat ?? 'ARCHIVE');
                            @endphp
                            <option value="ARCHIVE" {{ $currentEtat === 'ARCHIVE' ? 'selected' : '' }}>
                                ARCHIVE (rester archivé)
                            </option>
                            <option value="BON" {{ $currentEtat === 'BON' ? 'selected' : '' }}>
                                BON (remettre en service)
                            </option>
                            <option value="EN_PANNE" {{ $currentEtat === 'EN_PANNE' ? 'selected' : '' }}>
                                EN_PANNE (remettre en service)
                            </option>
                            <option value="HORS_USAGE" {{ $currentEtat === 'HORS_USAGE' ? 'selected' : '' }}>
                                HORS_USAGE (remettre en service)
                            </option>
                        </select>
                        <p class="mt-1 text-xs text-gray-500">
                            Choisir un état autre que ARCHIVE renverra ce matériel dans la liste des matériels et supprimera cette archive.
                        </p>
                    </div>

                    <div class="flex items-center gap-4 pt-2">
                        <button type="submit"
                                class="px-4 py-2 bg-blue-900 text-white rounded hover:bg-blue-800">
                            {{ __('Enregistrer') }}
                        </button>

                        <a href="{{ route('archive.index') }}" class="text-gray-600 hover:underline">
                            {{ __('Retour à la liste') }}
                        </a>
                    </div>
                </form>

            </div>
        </div>
    </div>
</x-app-layout>