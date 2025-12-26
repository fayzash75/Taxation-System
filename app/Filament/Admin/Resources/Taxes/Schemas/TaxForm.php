<?php

namespace App\Filament\Admin\Resources\Taxes\Schemas;

use App\Models\Tax;
use App\Models\TaxPayer;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Utilities\Get;
use Filament\Schemas\Components\Utilities\Set;
use Filament\Schemas\Schema;

class TaxForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Select::make('tax_payer_id')
                    ->required()
                    ->relationship('taxPayer', 'name')
                    ->searchable()
                    ->preload()
                    ->afterStateUpdated(function ($state, Set $set) {
                        $taxPayer = TaxPayer::find($state);
                        $set('amount', $taxPayer?->total_debt ?? 0);
                    })
                    ->live(),
                Select::make('type')
                    ->options([
                        'real profit' => 'ضريبة الدخل',
                        'salary' => ' ضريبة الرواتب والاجور ', 
                        'Good&service' => ' انفاق استهلاكي',
                        'other' => 'أخرى',
                    ])
                    ->required(),
                TextInput::make('amount')
                    ->required()
                    ->live()
                    ->numeric()
                    ->prefix('SYR')
                    ->default(0.0),
                TextInput::make('paid_amount')
                    ->required()
                    ->numeric()
                    ->live()
                    ->prefix('SYR')
                    ->default(0.0),
                TextInput::make('remaining_amount')
                    ->numeric()
                    ->disabled()
                    ->dehydrated(false)
                    ->live()
                    ->prefix('SYR')
                    ->default(0.0)
                    ->hidden(fn(?Tax $record) => $record?->some_field == 'value')
                    // ->afterStateHydrated(function (TextInput $component, $state, Tax $record) {
                    //     $component->state($record->amount - $record->paid_amount);
                    // })
                    ->afterStateUpdated(function ($state, Set $set, Get $get) {
                        $set('remaining_amount', $get('amount') - $get('paid_amount'));
                    }),
                DatePicker::make('due_date')
                    ->required(),
                TextInput::make('status')
                    ->required()
                    ->default('pending'),
                Textarea::make('description')
                    ->default(null)
                    ->columnSpanFull(),
            ]);
    }
}
