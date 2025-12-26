<?php

namespace App\Filament\Widgets;

use App\Models\TaxPayer;
use App\Models\Tax;
use App\Models\Payment;
use App\Models\ClearanceCertificate;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class StatsOverview extends BaseWidget
{
    protected function getStats(): array
    {
        return [
            Stat::make('عدد المكلفين', TaxPayer::count())
                ->description('إجمالي المكلفين المسجلين')
                ->descriptionIcon('heroicon-m-user-group')
                ->color('primary')
                ->chart([7, 2, 10, 3, 15, 4, 17]),
            
            Stat::make('براءات الذمة', ClearanceCertificate::where('is_valid', true)->count())
                ->description('براءات الذمة النشطة')
                ->descriptionIcon('heroicon-m-document-check')
                ->color('success'),
            
            Stat::make('إجمالي الديون', number_format(TaxPayer::sum('total_debt'), 2) . ' ل.س')
                ->description('مجموع الديون المستحقة')
                ->descriptionIcon('heroicon-m-currency-dollar')
                ->color('danger'),
            
            Stat::make('إجمالي المدفوعات', number_format(Payment::sum('amount'), 2) . ' ل.س')
                ->description('مجموع المبالغ المدفوعة')
                ->descriptionIcon('heroicon-m-banknotes')
                ->color('success'),
            
            Stat::make('الضرائب النشطة', Tax::where('status', 'pending')->count())
                ->description('ضرائب قيد المعالجة')
                ->descriptionIcon('heroicon-m-clock')
                ->color('warning'),
            
            Stat::make('متوسط الدين للمكلف', number_format(TaxPayer::avg('total_debt') ?? 0, 2) . ' ل.س')
                ->description('متوسط الدين')
                ->descriptionIcon('heroicon-m-chart-bar')
                ->color('info'),
        ];
    }
}
