<?php

namespace App\Filament\Resources\OrderResource\Pages;

use App\Filament\Resources\OrderResource;
use Filament\Actions;
use Filament\Forms\Components\Tabs\Tab;
use Filament\Pages\Page;
use Filament\Resources\Pages\ViewRecord;
use App\Livewire\CustomTextWidget as LivewireCustomTextWidget;

class ViewOrder extends ViewRecord
{
    protected static string $resource = OrderResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\EditAction::make(),
        ];
    }

    protected function getHeaderWidgets(): array
    {
        return [
            LivewireCustomTextWidget::class,
        ];
    }
}
