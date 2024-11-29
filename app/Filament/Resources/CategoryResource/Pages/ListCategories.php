<?php

namespace App\Filament\Resources\CategoryResource\Pages;

use App\Filament\Resources\CategoryResource;
use App\Livewire\CustomTextWidget;
use Faker\Core\Color;
use Filament\Actions;
use Filament\Actions\Action;
use Filament\Resources\Pages\ListRecords;
use Filament\Support\Colors\Color as ColorsColor;
use Spatie\Color\Rgb;

class ListCategories extends ListRecords
{
    protected static string $resource = CategoryResource::class;

    // protected function getHeaderActions(): array
    // {
    //     return [
    //         //Actions\CreateAction::make(),
    //     ];
    // }



    protected function getHeaderActions(): array
    {
        return [
            Action::make('custom-text')
                ->label('1234567')

                ->color(
                    ColorsColor::hex(
                        Rgb::fromString('rgb(' . CustomColors::Gray[900] . ')')->toHex()
                    )
                ),
        ];
    }

    protected function getHeaderWidgets(): array
    {
        return [
            CustomTextWidget::class,
        ];
    }
}

class CustomColors
{
    public const Gray = [
        900 => '59,59,59',
    ];
}
