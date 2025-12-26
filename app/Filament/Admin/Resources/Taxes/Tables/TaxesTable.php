<?php

namespace App\Filament\Admin\Resources\Taxes\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Forms\Components\Select;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\Filter;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;

class TaxesTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('taxPayer.name')
                    ->sortable()
                    ->searchable(),
                TextColumn::make('type')
                    ->badge()
                    ->color(fn ($state) => match ($state) {
                        'income' => 'info',
                        'vat' => 'success',
                        'corporate' => 'warning',
                        default => 'gray',
                    })
                    ->searchable(),
                TextColumn::make('amount')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('paid_amount')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('remaining_amount')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('due_date')
                    ->date()
                    ->sortable(),
                TextColumn::make('status')
                    ->badge()
                    ->color(fn ($state) => match ($state) {
                        'paid' => 'success',
                        'partially_paid' => 'warning',
                        'pending' => 'danger',
                         default  => 'gray',
                    }),
                TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                SelectFilter::make('tax_payer_id')
                    ->relationship('taxPayer', 'name')
                    ->searchable()
                    ->preload(),
                SelectFilter::make('type')
                    ->label('نوع الضريبة')
                    ->options([
                        'real profit' => 'ضريبة الدخل',
                        'salary' => ' ضريبة الرواتب والاجور ', 
                        'Good&service' => ' انفاق استهلاكي',
                        'other' => 'أخرى',
                    ]),
                SelectFilter::make('status')
                    ->label('الحالة')
                    ->options([
                        'pending' => 'غير مسدد',
                        'partially_paid' => 'مدفوع جزئياً',
                        'paid' => 'مسدد',
                    ]),
                Filter::make('overdue')
                    ->label('متأخرة')
                    ->query(fn ($query) => $query->where('due_date', '<', now())->where('status', '!=', 'paid')),
            ])
            ->recordActions([
                EditAction::make(), 
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}