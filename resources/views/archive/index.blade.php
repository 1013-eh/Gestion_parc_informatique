<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Liste des archives') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">

                @if(session('success'))
                    <div class="mb-4 p-4 bg-green-100 text-green-800 rounded">
                        {{ session('success') }}
                    </div>
                @endif

                @if(session('error'))
                    <div class="mb-4 p-4 bg-red-100 text-red-800 rounded">
                        {{ session('error') }}
                    </div>
                @endif

                @if(auth()->user()->isAdmin())
                <a href="{{ route('archive.create') }}"
                   class="inline-block mb-4 px-4 py-2 bg-blue-900 text-white rounded hover:bg-blue-800">
                    {{ __('Ajouter une archive') }}
                </a>
                @endif

                <div class="overflow-hidden rounded-lg border border-gray-200">
                    <table class="min-w-full divide-y divide-gray-200 divide-x divide-gray-200">
                        <thead class="bg-blue-800">
                            <tr class="divide-x divide-blue-700">
                                <th class="px-6 py-3 text-left text-xs font-semibold text-white uppercase tracking-wider">ID</th>
                                <th class="px-6 py-3 text-left text-xs font-semibold text-white uppercase tracking-wider">Num série</th>
                                <th class="px-6 py-3 text-left text-xs font-semibold text-white uppercase tracking-wider">Description</th>
                                <th class="px-6 py-3 text-left text-xs font-semibold text-white uppercase tracking-wider">Date archivage</th>
                                @if(auth()->user()->isAdmin())
                                   <th class="px-6 py-3 text-center text-xs font-semibold text-white uppercase tracking-wider">Action</th>
                                @endif
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-200">
                            @foreach($archives as $archive)
                            <tr class="{{ $loop->even ? 'bg-gray-50' : 'bg-white' }} hover:bg-blue-50 transition-colors divide-x divide-gray-200">
                                <td class="px-6 py-4 text-sm font-medium text-gray-900">{{ $archive->id_archive }}</td>
                                <td class="px-6 py-4 text-sm text-gray-700">{{ $archive->num_serie }}</td>
                                <td class="px-6 py-4 text-sm text-gray-700">{{ $archive->description }}</td>
                                <td class="px-6 py-4 text-sm text-gray-500">{{ $archive->date_archivage }}</td>
                                @if(auth()->user()->isAdmin())
                                   <td class="px-6 py-4 text-sm text-center">
                                       <a href="{{ route('archive.edit', $archive->id_archive) }}"
                                          class="inline-flex items-center justify-center px-4 py-2 bg-blue-500 text-white text-sm font-medium rounded hover:bg-blue-600 transition-colors">
                                           Modifier
                                        </a>
                                    </td>
                                @endif
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

            </div>
        </div>
    </div>
</x-app-layout>