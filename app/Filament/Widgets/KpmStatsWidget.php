<?php

namespace App\Filament\Widgets;

use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class KpmStatsWidget extends BaseWidget
{
    protected static ?int $sort = 1;

    protected static ?string $pollingInterval = '60s';

    protected function getStats(): array
    {
        try {
            $services  = \App\Models\Service::where('is_active', true)->count();
            $documents = \App\Models\Document::where('is_public', true)->count();
            $divDocs   = \App\Models\DivisionDocument::where('is_public', true)->count();
        } catch (\Exception $e) {
            $services = $documents = $divDocs = 0;
        }

        return [
            Stat::make('Layanan Aktif', $services)
                ->description('Divisi tampil di website')
                ->descriptionIcon('heroicon-m-check-circle')
                ->color('warning'),

            Stat::make('Dokumen Resmi', $documents)
                ->description('Akta, SBU, NPWP, NIB')
                ->descriptionIcon('heroicon-m-document-text')
                ->color('success'),

            Stat::make('Dok. Divisi', $divDocs)
                ->description('Portofolio per divisi')
                ->descriptionIcon('heroicon-m-folder-open')
                ->color('info'),
        ];
    }
}