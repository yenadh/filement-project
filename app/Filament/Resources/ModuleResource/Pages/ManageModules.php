<?php

namespace App\Filament\Resources\ModuleResource\Pages;

use App\Filament\Resources\ModuleResource;
use Filament\Resources\Pages\Page;
use Filament\Tables;
use Filament\Tables\Contracts\HasTable;
use Filament\Tables\Table;

class ManageModules extends Page
{
    use Tables\Concerns\InteractsWithTable;
    protected static string $resource = ModuleResource::class;

    protected static string $view = 'filament.resources.module-resource.pages.manage-modules';

    // Step 4: Define the table query
    protected function getTableQuery()
    {
        return \App\Models\Module::query(); // Replace with your model
    }

    // Step 5: Define table columns
    protected function getTableColumns(): array
    {
        return [
            Tables\Columns\TextColumn::make('name')->label('Module Name'),
        ];
    }
}
