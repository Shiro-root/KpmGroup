<?php
// ─── FILE: app/Filament/Resources/DivisionDocumentationResource/Pages/EditDivisionDocumentation.php

namespace App\Filament\Resources\DivisionDocumentationResource\Pages;

use App\Filament\Resources\DivisionDocumentationResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditDivisionDocumentation extends EditRecord
{
    protected static string $resource = DivisionDocumentationResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }

    protected function getSavedNotificationTitle(): ?string
    {
        return 'Dokumentasi berhasil diperbarui';
    }
}