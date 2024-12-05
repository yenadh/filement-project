<?php

namespace App\Livewire\Module;

use App\Models\Module;
use App\Models\Subject;
use Filament\Forms\Components\Hidden;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Forms\Form;
use Filament\Tables;
use Filament\Tables\Actions\BulkAction;
use Filament\Tables\Concerns\InteractsWithTable;
use Filament\Tables\Contracts\HasTable;
use Filament\Tables\Table;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Log;

class ListModules extends Component implements HasForms, HasTable
{
    use InteractsWithForms;
    use InteractsWithTable;

    protected static ?string $model = Module::class;

    public $subjectId;

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
        $subjectId = $this->subjectId;
        return $table
            ->query(Module::query())
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->searchable(),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\ViewAction::make()
            ])
            ->bulkActions([
                BulkAction::make('Add To Subject')
                    ->action(function (Collection $records) {
                        $subjectId = $this->subjectId;
                        $insertData = $records->map(function ($record) use ($subjectId) {
                            return [
                                'module_id' => $record->module_id,
                                'subject_id' => $subjectId,
                                'created_at' => now(),
                                'updated_at' => now(),
                            ];
                        })->toArray();

                        DB::table('subject_modules')->insert($insertData);
                    })
                    ->color('warning')
                    ->icon('heroicon-o-plus')
                    ->requiresConfirmation()
                    ->deselectRecordsAfterCompletion()

            ])
            ->checkIfRecordIsSelectableUsing(function ($record) use ($subjectId) {
                $selectableModuleIds = Module::query()
                    ->leftJoin('subject_modules', function ($join) use ($subjectId) {
                        $join->on('modules.module_id', '=', 'subject_modules.module_id')
                            ->where('subject_modules.subject_id', '=', $subjectId);
                    })
                    ->whereNull('subject_modules.module_id')
                    ->pluck('modules.module_id')
                    ->toArray();
                return in_array($record->module_id, $selectableModuleIds);
            })
            ->paginated(false)
            ->defaultPaginationPageOption(10);
    }

    public function render(): View
    {
        return view('livewire.module.list-modules');
    }

    public function mount($subjectId)
    {
        $this->subjectId = $subjectId;
    }
}
