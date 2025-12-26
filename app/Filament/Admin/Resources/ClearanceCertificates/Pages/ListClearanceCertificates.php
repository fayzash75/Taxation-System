<?php

namespace App\Filament\Admin\Resources\ClearanceCertificates\Pages;

use App\Filament\Admin\Resources\ClearanceCertificates\ClearanceCertificateResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListClearanceCertificates extends ListRecords
{
    protected static string $resource = ClearanceCertificateResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
