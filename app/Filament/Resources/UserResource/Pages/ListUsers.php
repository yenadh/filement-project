<?php

namespace App\Filament\Resources\UserResource\Pages;

use App\Filament\Resources\OrderResource;
use App\Filament\Resources\UserResource;
use App\Models\Order;
use App\Models\User;
use Filament\Actions;
use Filament\Actions\Action;
use Filament\Infolists\Components\Tabs\Tab;
use Filament\Resources\Pages\ListRecords;

class ListUsers extends ListRecords
{
    protected static string $resource = UserResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
            Action::make('View order')
                ->color('info')
                ->icon('heroicon-o-eye'),
        ];
    }
}
