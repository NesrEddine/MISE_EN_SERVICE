<x-filament::page>
    <form wire:submit.prevent="register" class="space-y-4">
        {{ $this->form }}
        <x-filament::button type="submit" class="w-full">
            S’inscrire
        </x-filament::button>
        <div class="text-center text-sm text-gray-500">
            Déjà inscrit ?
            <a href="{{ route('filament.admin.auth.login') }}" class="text-primary-600 hover:underline">
                Connexion
            </a>
        </div>
    </form>
</x-filament::page>
