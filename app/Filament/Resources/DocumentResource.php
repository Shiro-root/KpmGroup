<?php

namespace App\Filament\Resources;

use App\Filament\Resources\DocumentResource\Pages;
use App\Models\Document;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class DocumentResource extends Resource
{
    protected static ?string $model = Document::class;

    protected static ?string $navigationIcon   = 'heroicon-o-document-text';
    protected static ?string $navigationLabel  = 'Dokumen Resmi';
    protected static ?string $navigationGroup  = 'Konten Website';
    protected static ?int    $navigationSort   = 2;
    protected static ?string $modelLabel       = 'Dokumen';
    protected static ?string $pluralModelLabel = 'Dokumen Resmi';

    public static function form(Form $form): Form
    {
        return $form->schema([

            Forms\Components\Section::make('Informasi Dokumen')
                ->schema([
                    Forms\Components\TextInput::make('name')
                        ->label('Nama Dokumen')
                        ->required()
                        ->maxLength(255)
                        ->placeholder('contoh: Akta Notaris No. 001')
                        ->columnSpan(2),

                    Forms\Components\Select::make('category')
                        ->label('Kategori')
                        ->required()
                        ->options([
                            'akta_notaris' => 'Akta Notaris',
                            'sbu'          => 'SBU (Sertifikat Badan Usaha)',
                            'npwp'         => 'NPWP',
                            'nib'          => 'NIB (Nomor Induk Berusaha)',
                            'siup'         => 'SIUP',
                            'tdp'          => 'TDP',
                            'other'        => 'Lainnya',
                        ]),

                    Forms\Components\TextInput::make('sort_order')
                        ->label('Urutan Tampil')
                        ->numeric()
                        ->default(0)
                        ->helperText('Angka lebih kecil = tampil lebih awal'),

                    Forms\Components\Toggle::make('is_public')
                        ->label('Tampilkan di Website')
                        ->default(true)
                        ->columnSpan(2),
                ])->columns(2),

            Forms\Components\Section::make('Upload File')
                ->schema([
                    Forms\Components\FileUpload::make('file_path')
                        ->label('File Dokumen')
                        ->required()
                        ->directory('documents')
                        ->acceptedFileTypes([
                            'application/pdf',
                            'image/jpeg',
                            'image/jpg',
                            'image/png',
                        ])
                        ->maxSize(10240)
                        ->helperText('Format: PDF, JPG, PNG. Maks 10MB.')
                        ->downloadable()
                        ->openable()
                        ->afterStateUpdated(function ($state, callable $set) {
                            if ($state) {
                                $file = is_array($state) ? array_key_first($state) : $state;
                                $ext  = strtolower(pathinfo((string) $file, PATHINFO_EXTENSION));
                                $set('file_type', $ext === 'pdf' ? 'pdf' : ($ext === 'png' ? 'png' : 'jpg'));
                            }
                        }),

                    Forms\Components\Hidden::make('file_type')->default('pdf'),
                ]),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('sort_order')
                    ->label('#')
                    ->sortable()
                    ->width(50),

                TextColumn::make('name')
                    ->label('Nama Dokumen')
                    ->searchable()
                    ->sortable()
                    ->wrap(),

                TextColumn::make('category')
                    ->label('Kategori')
                    ->badge()
                    ->formatStateUsing(fn (string $state): string => match ($state) {
                        'akta_notaris' => 'Akta Notaris',
                        'sbu'          => 'SBU',
                        'npwp'         => 'NPWP',
                        'nib'          => 'NIB',
                        default        => ucfirst(str_replace('_', ' ', $state)),
                    })
                    ->color('warning'),

                TextColumn::make('file_type')
                    ->label('Tipe')
                    ->badge()
                    ->formatStateUsing(fn ($state) => strtoupper((string) $state))
                    ->color(fn ($state) => match ($state) {
                        'pdf'   => 'danger',
                        'png'   => 'info',
                        default => 'warning',
                    }),

                Tables\Columns\IconColumn::make('is_public')
                    ->label('Publik')
                    ->boolean(),

                TextColumn::make('created_at')
                    ->label('Ditambahkan')
                    ->date('d M Y')
                    ->sortable(),
            ])
            ->defaultSort('sort_order')
            ->reorderable('sort_order')
            ->filters([
                Tables\Filters\TernaryFilter::make('is_public')
                    ->label('Status Tampil')
                    ->trueLabel('Publik')
                    ->falseLabel('Tersembunyi'),

                Tables\Filters\SelectFilter::make('category')
                    ->label('Kategori')
                    ->options([
                        'akta_notaris' => 'Akta Notaris',
                        'sbu'          => 'SBU',
                        'npwp'         => 'NPWP',
                        'nib'          => 'NIB',
                    ]),
            ])
            ->actions([
                Tables\Actions\EditAction::make()->label('Edit'),
                Tables\Actions\DeleteAction::make()->label('Hapus'),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ])
            ->emptyStateHeading('Belum ada dokumen')
            ->emptyStateDescription('Tambahkan Akta Notaris, SBU, atau dokumen resmi lainnya.')
            ->emptyStateIcon('heroicon-o-document-text');
    }

    public static function getPages(): array
    {
        return [
            'index'  => Pages\ListDocuments::route('/'),
            'create' => Pages\CreateDocument::route('/create'),
            'edit'   => Pages\EditDocument::route('/{record}/edit'),
        ];
    }
}
