<?php

namespace App\Filament\Admin\Resources\Taxes;

use App\Filament\Admin\Resources\Taxes\Pages\CreateTax;
use App\Filament\Admin\Resources\Taxes\Pages\EditTax;
use App\Filament\Admin\Resources\Taxes\Pages\ListTaxes;
use App\Filament\Admin\Resources\Taxes\Schemas\TaxForm;
use App\Filament\Admin\Resources\Taxes\Tables\TaxesTable;
use App\Models\Tax;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class TaxResource extends Resource
{
    protected static ?string $model = Tax::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::CreditCard;

    protected static ?string $recordTitleAttribute = 'Tax';

    public static function form(Schema $schema): Schema
    {
        return TaxForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return TaxesTable::configure($table);
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
            'index' => ListTaxes::route('/'),
            'create' => CreateTax::route('/create'),
            'edit' => EditTax::route('/{record}/edit'),
        ];
    }
}
