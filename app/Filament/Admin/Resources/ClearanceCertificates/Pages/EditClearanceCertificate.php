<?php

namespace App\Filament\Admin\Resources\ClearanceCertificates\Pages;

use App\Filament\Admin\Resources\ClearanceCertificates\ClearanceCertificateResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditClearanceCertificate extends EditRecord
{
    protected static string $resource = ClearanceCertificateResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
