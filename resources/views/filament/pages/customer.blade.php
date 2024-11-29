<x-filament-panels::page>
    <x-filament::modal>
        <x-slot name="trigger">
            <x-filament::button>
                Open modal
            </x-filament::button>
        </x-slot>

        <x-slot name="heading">
            Modal heading
        </x-slot>
        <x-filament::tabs label="Content tabs">
            <x-filament::tabs.item>
                Tab 1
            </x-filament::tabs.item>

            <x-filament::tabs.item>
                Tab 2
            </x-filament::tabs.item>

            <x-filament::tabs.item>
                Tab 3
            </x-filament::tabs.item>
        </x-filament::tabs>
    </x-filament::modal>
</x-filament-panels::page>
