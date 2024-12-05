<?php

namespace App\Filament\Resources\SubjectResource\RelationManagers;

use App\Livewire\ModelTable;
use App\Models\SubjectModule;
use Filament\Forms;
use Filament\Forms\Components\Placeholder;
use Filament\Forms\Components\Select;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Actions\Action;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\HtmlString;

class SubjectModuleRelationManager extends RelationManager
{
    protected static string $relationship = 'subjectModules'; // Use 'modules' relationship from Subject model

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Select::make('module_id')
                    ->label('Module Name')
                    ->options(
                        \App\Models\Module::query()
                            ->orderBy('name')
                            ->pluck('name', 'module_id')
                            ->toArray()
                    )
                    ->multiple()
                    ->required()
            ]);
    }

    public function table(Table $table): Table
    {
        $subjectId = $this->ownerRecord->subject_id;
        return $table

            ->query(
                SubjectModule::query()
                    ->select(
                        'subject_modules.id',
                        'subject_modules.subject_id',
                        'subjects.name AS subjectName',
                        'subject_modules.module_id',
                        'modules.name AS moduleName',
                        'subject_modules.created_at',
                        'subject_modules.updated_at'
                    )
                    ->join('subjects', 'subject_modules.subject_id', '=', 'subjects.subject_id')
                    ->join('modules', 'subject_modules.module_id', '=', 'modules.module_id')
                    ->where('subject_modules.subject_id', '=', $subjectId)
            )
            ->columns([
                Tables\Columns\TextColumn::make('module.name')
                    ->label('Module Name'),
                Tables\Columns\TextColumn::make('subject.name')
                    ->label('Subject Name'),
            ])
            ->headerActions([
                Tables\Actions\CreateAction::make(),
            ])
            ->actions([
                Tables\Actions\DeleteAction::make(),
            ])
            ->headerActions([
                Action::make('assignModules')
                    ->label("Assign Modules")
                    ->icon("heroicon-o-plus")
                    ->modalHeading('Add Module')
                    ->closeModalByClickingAway(false)
                    ->modalCancelAction(false)
                    ->modalSubmitAction(false)
                    ->modalAutofocus(false)
                    ->modalContent(function () {
                        $subjectId = $this->ownerRecord->subject_id;
                        return view('tables.module-table', [
                            'subjectId' => $subjectId,
                        ]);
                    })
            ])


            // ->headerActions([
            //     // Action::make('assignModules')
            //     //     ->label('Assign Modules')
            //     //     ->icon('heroicon-o-plus')
            //     //     ->modalHeading('Modules')
            //     //     ->form([
            //     //         Placeholder::make('modulesTable')
            //     //             ->label('')
            //     //             ->content(fn() => view('tables.module-table')->render()),
            //     //     ])
            //     // // ->modalContent(fn() => view('tables.module-table')->render()),
            //     // Action::make('details')
            //     //     ->action(fn() => $this->record->someAction())
            //     //     ->modalContent(view('filament.resources.livewire.modelTable'))
            // ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
            ]);
    }
}
