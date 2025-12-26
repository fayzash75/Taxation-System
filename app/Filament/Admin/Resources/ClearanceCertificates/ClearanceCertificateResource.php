<?php

namespace App\Filament\Admin\Resources\ClearanceCertificates;

use App\Filament\Admin\Resources\ClearanceCertificates\Pages\CreateClearanceCertificate;
use App\Filament\Admin\Resources\ClearanceCertificates\Pages\EditClearanceCertificate;
use App\Filament\Admin\Resources\ClearanceCertificates\Pages\ListClearanceCertificates;
use App\Filament\Admin\Resources\ClearanceCertificates\Schemas\ClearanceCertificateForm;
use App\Filament\Admin\Resources\ClearanceCertificates\Tables\ClearanceCertificatesTable;
use App\Models\ClearanceCertificate;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class ClearanceCertificateResource extends Resource
{
    protected static ?string $model = ClearanceCertificate::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::ClipboardDocumentCheck;

    protected static ?string $recordTitleAttribute = 'Certificate';

    public static function form(Schema $schema): Schema
    {
        return ClearanceCertificateForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return ClearanceCertificatesTable::configure($table);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListClearanceCertificates::route('/'),
            'create' => CreateClearanceCertificate::route('/create'),
            'edit' => EditClearanceCertificate::route('/{record}/edit'),
        ];
    }
    
}