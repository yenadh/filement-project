<?php

namespace App\Filament\Resources\BrandResource\Pages;

use App\Filament\Resources\BrandResource;
use Filament\Actions;
use Filament\Notifications\Notification;
use Filament\Resources\Pages\ListRecords;

class ListBrands extends ListRecords
{
    protected static string $resource = BrandResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make()
                ->requiresConfirmation()
                ->successNotification(
                    Notification::make()
                        ->success()
                        ->title('User registered')
                        ->body('The user has been created successfully.'),
                ),
        ];
    }
}
