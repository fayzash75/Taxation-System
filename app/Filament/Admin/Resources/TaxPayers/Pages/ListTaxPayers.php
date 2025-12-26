<?php

namespace App\Filament\Admin\Resources\TaxPayers\Pages;

use App\Filament\Admin\Resources\TaxPayers\TaxPayerResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListTaxPayers extends ListRecords
{
    protected static string $resource = TaxPayerResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
