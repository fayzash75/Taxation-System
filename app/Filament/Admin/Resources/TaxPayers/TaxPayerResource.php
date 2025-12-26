<?php

namespace App\Filament\Admin\Resources\TaxPayers;

use App\Filament\Admin\Resources\TaxPayers\Pages\CreateTaxPayer;
use App\Filament\Admin\Resources\TaxPayers\Pages\EditTaxPayer;
use App\Filament\Admin\Resources\TaxPayers\Pages\ListTaxPayers;
use App\Filament\Admin\Resources\TaxPayers\Pages\ViewTaxPayer;
use App\Filament\Admin\Resources\TaxPayers\Schemas\TaxPayerForm;
use App\Filament\Admin\Resources\TaxPayers\Schemas\TaxPayerInfolist;
use App\Filament\Admin\Resources\TaxPayers\Tables\TaxPayersTable;
use App\Models\TaxPayer;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use RelationManagers;

class TaxPayerResource extends Resource
{
    protected static ?string $model = TaxPayer::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedUsers;

    protected static ?string $recordTitleAttribute = 'Taxpayer';

    public static function form(Schema $schema): Schema
    {
        return TaxPayerForm::configure($schema);
    }

    public static function infolist(Schema $schema): Schema
    {
        return TaxPayerInfolist::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return TaxPayersTable::configure($table);
    }

    public static function getRelations(): array
    {
            return [
            // TaxesRelationManager::class,
            // PaymentsRelationManager::class,
            // ClearanceCertificateRelationManager::class,
        ];
        
    }

    public static function getPages(): array
    {
        return [
            'index' => ListTaxPayers::route('/'),
            'create' => CreateTaxPayer::route('/create'),
            'view' => ViewTaxPayer::route('/{record}'),
            'edit' => EditTaxPayer::route('/{record}/edit'),
        ];
    }
}