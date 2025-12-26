<?php

namespace App\Filament\Admin\Resources\TaxPayers\Pages;

use App\Filament\Admin\Resources\TaxPayers\TaxPayerResource;
use Filament\Actions\EditAction;
use Filament\Resources\Pages\ViewRecord;

class ViewTaxPayer extends ViewRecord
{
    protected static string $resource = TaxPayerResource::class;

    protected function getHeaderActions(): array
    {
        return [
            EditAction::make(),
        ];
    }
}
