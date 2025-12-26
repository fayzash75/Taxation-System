<?php

namespace App\Filament\Admin\Resources\TaxPayers\Schemas;

use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;

class TaxPayerForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('tax_number')
                    ->required(),
                TextInput::make('name')
                    ->required(),
                TextInput::make('phone')
                    ->tel()
                    ->default(null),
                TextInput::make('email')
                    ->label('Email address')
                    ->email()
                    ->default(null),
                Textarea::make('address')
                    ->default(null),
                TextInput::make('commercial_registration')
                ->required()    
                ->default(null),
                TextInput::make('total_debt')
                    ->required()
                    ->numeric()
                    ->prefix('SYR')
                    ->default(0.0),
                TextInput::make('total_paid')
                    ->required()
                    ->numeric()
                    ->prefix('SYR')
                    ->default(0.0),
                Toggle::make('is_active')
                    ->required(),
            ]);
    }
}
