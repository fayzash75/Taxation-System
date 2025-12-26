<?php

namespace App\Filament\Admin\Resources\TaxPayers\Pages;

use App\Filament\Admin\Resources\TaxPayers\TaxPayerResource;
use Filament\Actions\DeleteAction;
use Filament\Actions\ViewAction;
use Filament\Resources\Pages\EditRecord;

class EditTaxPayer extends EditRecord
{
    protected static string $resource = TaxPayerResource::class;

    protected function getHeaderActions(): array
    {
        return [
            ViewAction::make(),
            DeleteAction::make(),
        ];
    }
}
