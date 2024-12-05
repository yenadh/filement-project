<?php

namespace App\Livewire;

use App\Filament\Resources\ModuleResource;
use App\Models\Module;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Tables;
use Filament\Tables\Actions\EditAction;
use Filament\Tables\Actions\ViewAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Filament\Widgets\TableWidget as BaseWidget;

class ModelTable extends BaseWidget
{
    protected static ?string $model = Module::class;

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('name')
                    ->required()
                    ->maxLength(255),
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->query(ModuleResource::getEloquentQuery())
            ->defaultPaginationPageOption(5)
            ->defaultSort('created_at', 'desc')
            ->columns([
                TextColumn::make('name')->label('Module Name'),
                TextColumn::make('created_at')->label('Created At')->dateTime(),
            ])
            ->actions([
                EditAction::make(),
                ViewAction::make()
            ]);
    }
}
