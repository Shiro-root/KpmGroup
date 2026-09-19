<?php
// app/Filament/Resources/DivisionDocumentationResource/Pages/ListDivisionDocumentations.php
 
namespace App\Filament\Resources\DivisionDocumentationResource\Pages;
 
use App\Filament\Resources\DivisionDocumentationResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;
 
class ListDivisionDocumentations extends ListRecords
{
    protected static string $resource = DivisionDocumentationResource::class;
 
    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make()
                ->label('Tambah Dokumentasi'),
        ];
    }
}