<?php

namespace App\Filament\Admin\Resources\ClearanceCertificates\Schemas;

use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;
use Filament\Tables\Columns\IconColumn;

class ClearanceCertificateForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Select::make('tax_payer_id')
                    ->relationship('taxPayer', 'name')
                    ->required()
                    ->disabled(fn ($operation )=> $operation=== 'edit')
                    ->validationMessages([ 'required'=>'يرجى اختيار مكلف']),
                TextInput::make('certificate_number')
                    ->required()
                    ->unique(),
                DatePicker::make('issue_date')
                    ->required(),
                DatePicker::make('valid_until')
                    ->required(),
                Textarea::make('notes')
                    ->default(null)
                    ->columnSpanFull(),
                IconColumn::make('is_valid')
                     //->required()
                     ->color(fn ($state): string => $state ? 'success' : 'danger'),
            ]);
    }
}
