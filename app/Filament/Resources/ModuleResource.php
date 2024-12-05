<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ModuleResource\Pages;
use App\Filament\Resources\ModuleResource\RelationManagers;
use App\Livewire\ModelTable;
use App\Models\Module;
use Filament\Forms;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Concerns\InteractsWithTable;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Contracts\View\View;
use Filament\Tables\Actions\Action;
use Filament\Forms\Components\Placeholder;
use Filament\Infolists\Components\Livewire;
use Filament\Infolists\Components\TextEntry;
use Filament\Infolists\Infolist;
use Filament\Widgets\Widget;

class ModuleResource extends Resource
{

    use InteractsWithTable;
    use InteractsWithForms;
    protected static ?string $model = Module::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('name')
                    ->required()
                    ->maxLength(255),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->query(Module::query())
            ->columns([
                Tables\Columns\TextColumn::make('name')->label('Module Name'),
                Tables\Columns\TextColumn::make('created_at')->label('Created At')->dateTime(),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\ViewAction::make(),
                Action::make('assignModules')
                    ->label('Assign Modules')
                    ->icon('heroicon-o-plus')
                    ->modalHeading('Modules')
                    ->form([
                        Placeholder::make('modulesTable')
                            ->label('')
                            ->content(fn() => view('livewire.module.list-modules')),
                    ]),
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
            ]);
    }

    public static function infolist(Infolist $infolist): Infolist
    {
        return $infolist
            ->schema([

                TextEntry::make('module_id')
                    ->label('Module ID'),
                TextEntry::make('name')
                    ->label('Module Name'),
                TextEntry::make('created_at')
                    ->label('Module Name'),
                Livewire::make(ModelTable::class)
                    ->label('Model Table Widget'),

            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    protected function getHeaderWidgets(): array
    {
        return [
            ModelTable::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListModules::route('/'),
            // 'create' => Pages\CreateModule::route('/create'),
            // 'edit' => Pages\EditModule::route('/{record}/edit'),
            // 'view' => Pages\ViewModules::route('/{record}'),
        ];
    }
}
