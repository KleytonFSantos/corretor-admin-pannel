<x-filament-panels::page>
    {{ $this->table }}
    <x-filament-panels::form wire:submit="save">
        {{ $this->form }}
    </x-filament-panels::form>
</x-filament-panels::page>
