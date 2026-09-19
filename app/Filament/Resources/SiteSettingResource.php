<?php

namespace App\Filament\Resources;

use App\Filament\Resources\SiteSettingResource\Pages;
use App\Models\SiteSetting;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables\Table;

class SiteSettingResource extends Resource
{
    protected static ?string $model = SiteSetting::class;

    protected static ?string $navigationIcon   = 'heroicon-o-cog-6-tooth';
    protected static ?string $navigationLabel  = 'Pengaturan Halaman';
    protected static ?string $navigationGroup  = 'Pengaturan';
    protected static ?int    $navigationSort   = 10;
    protected static ?string $modelLabel       = 'Pengaturan';
    protected static ?string $pluralModelLabel = 'Pengaturan Halaman';

    public static function form(Form $form): Form
    {
        return $form->schema([]);
    }

    public static function table(Table $table): Table
    {
        return $table->columns([]);
    }

    public static function canCreate(): bool
    {
        return false;
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ManageSettings::route('/'),
        ];
    }
}
