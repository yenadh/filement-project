<table class="min-w-full divide-y divide-gray-200">
    <thead class="bg-gray-50">
        <tr>
            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                Module Name
            </th>
            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                Created At
            </th>
        </tr>
    </thead>
    <tbody class="bg-white divide-y divide-gray-200">
        @foreach (\App\Models\Module::all() as $module)
            <tr>
                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                    {{ $module->name }}
                </td>
                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                    {{ $module->created_at ? $module->created_at->format('Y-m-d H:i') : 'N/A' }}
                </td>
            </tr>
        @endforeach
    </tbody>
</table>




{{-- <x-filament::widgets :widgets="[\App\Filament\Livewire\Module\ListModules::class]" :columns="1" :data="$widgetData" /> --}}
