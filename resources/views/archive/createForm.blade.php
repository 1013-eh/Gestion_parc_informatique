<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Ajouter une archive') }}
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

                <div class="mb-6 p-4 bg-gray-50 rounded border border-gray-200 space-y-1">
                    <p><span class="font-medium">N° Série :</span> {{ $materiel->num_serie }}</p>
                    <p><span class="font-medium">Marque :</span> {{ $materiel->modele?->marque?->nom_marque ?? 'N/A' }}</p>
                    <p><span class="font-medium">Modèle :</span> {{ $materiel->modele?->nom_modele ?? 'N/A' }}</p>
                </div>

                <form action="{{ route('archive.store') }}" method="POST" class="space-y-4">
                    @csrf
                    <input type="hidden" name="num_serie" value="{{ $materiel->num_serie }}">

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">
                            Description
                        </label>
                        <input type="text" name="description" value="{{ old('description') }}"
                               class="w-full border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring-blue-500">
                    </div>

                    <div class="flex items-center gap-4 pt-2">
                        <button type="submit"
                                class="px-4 py-2 bg-blue-900 text-white rounded hover:bg-blue-800">
                            {{ __('Ajouter') }}
                        </button>

                        <a href="{{ route('archive.create') }}" class="text-gray-600 hover:underline">
                            {{ __('Annuler') }}
                        </a>
                    </div>
                </form>

            </div>
        </div>
    </div>
</x-app-layout>