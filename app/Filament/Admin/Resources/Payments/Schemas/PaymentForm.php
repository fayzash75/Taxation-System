<?php

namespace App\Filament\Admin\Resources\Payments\Schemas;

use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Schemas\Schema;

class PaymentForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Select::make('tax_payer_id')
                    ->relationship('taxPayer', 'name')
                    ->searchable()
                    ->preload()
                    ->live()
                    ->required(),
                Select::make('tax_id')
                    ->required()
                    ->relationship('tax', 'type')
                        ->options([
                        'real profit' => 'ضريبة الدخل',
                        'salary' => ' ضريبة الرواتب والاجور ', 
                        'Good&service' => ' انفاق استهلاكي',
                        'other' => 'أخرى',
                    ])
                    ->searchable() 
                    ->live(),
                TextInput::make('amount')
                    ->required()
                    ->numeric()
                    ->live(),
                Select::make('payment_method')
                    ->required()
                    ->options([
                        'cash' => 'نقداً',
                        'bank_transfer' => 'حوالة مصرفية',
                         'check' => 'شيك',
                    ]),
                TextInput::make('receipt_no')
                    ->default(null)
                    ->prefix('REC-'),
                DatePicker::make('payment_date')
                    ->required(),
                Textarea::make('notes')
                    ->default(null)
                    ->columnSpanFull(),
            ]);
    }
}
