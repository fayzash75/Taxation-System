<?php

namespace App\Filament\Admin\Resources\ClearanceCertificates\Tables;

use App\Models\ClearanceCertificate;
use App\Models\TaxPayer;
use Filament\Actions\Action;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\TernaryFilter;
use Filament\Tables\Table;
use Illuminate\Support\Facades\Storage;

class ClearanceCertificatesTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('taxPayer.name')
                    ->searchable(),
                TextColumn::make('certificate_number')
                    ->searchable(),
                TextColumn::make('issue_date')
                    ->date()
                    ->sortable() ,
                TextColumn::make('valid_until')
                    ->date()
                    ->sortable(),
                IconColumn::make('is_valid')
                    ->boolean(),
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
                  TernaryFilter::make('is_valid'),
            ])
            ->recordActions([
                EditAction::make(),
                Action::make('print')
                    ->label('طباعة')
                    ->icon('heroicon-o-printer')
                    ->color('warning')
                    ->url(fn (ClearanceCertificate $record) => 
                        route('certificates.print', $record))
                    ->openUrlInNewTab(),
                
                Action::make('view')
                    ->label('عرض')
                    ->icon('heroicon-o-eye')
                    ->color('info')
                    ->url(fn (ClearanceCertificate $record) => 
                        route('certificates.view', $record))
                    ->openUrlInNewTab(),
            ])

            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }

}