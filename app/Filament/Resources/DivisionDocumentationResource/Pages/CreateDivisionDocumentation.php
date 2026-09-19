<?php
// ─── FILE: app/Filament/Resources/DivisionDocumentationResource/Pages/CreateDivisionDocumentation.php

namespace App\Filament\Resources\DivisionDocumentationResource\Pages;

use App\Filament\Resources\DivisionDocumentationResource;
use Filament\Resources\Pages\CreateRecord;

class CreateDivisionDocumentation extends CreateRecord
{
    protected static string $resource = DivisionDocumentationResource::class;

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }

    protected function getCreatedNotificationTitle(): ?string
    {
        return 'Dokumentasi berhasil ditambahkan';
    }
}