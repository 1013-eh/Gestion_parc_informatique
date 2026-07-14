<x-guest-layout>
    <h2 class="font-semibold text-xl text-gray-800 mb-4">Changer votre mot de passe</h2>

    <form action="{{ route('change.password.update') }}" method="POST">
        @csrf

        <div class="mb-4">
            <label class="block text-gray-700 font-semibold mb-2">Nouveau mot de passe</label>
            <input type="password" name="password"
                class="w-full border border-gray-300 rounded px-3 py-2" required>
            @error('password')
            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div class="mb-4">
            <label class="block text-gray-700 font-semibold mb-2">Confirmer le mot de passe</label>
            <input type="password" name="password_confirmation"
                class="w-full border border-gray-300 rounded px-3 py-2" required>
        </div>

        <button type="submit"
            class="w-full bg-blue-700 hover:bg-blue-800 text-white font-bold py-2 px-6 rounded">
            Enregistrer
        </button>
    </form>
</x-guest-layout>