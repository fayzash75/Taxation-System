<?php

namespace App\Filament\Admin\Resources\TaxPayers\Pages;

use App\Filament\Admin\Resources\TaxPayers\TaxPayerResource;
use Filament\Resources\Pages\CreateRecord;

class CreateTaxPayer extends CreateRecord
{
    protected static string $resource = TaxPayerResource::class;
}
