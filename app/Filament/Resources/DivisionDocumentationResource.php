<?php

namespace App\Filament\Resources;

use App\Filament\Resources\DivisionDocumentationResource\Pages;
use App\Models\DivisionDocument;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Table;

class DivisionDocumentationResource extends Resource
{
    protected static ?string $model = DivisionDocument::class;

    protected static ?string $navigationIcon   = 'heroicon-o-photo';
    protected static ?string $navigationLabel  = 'Dokumentasi Divisi';
    protected static ?string $navigationGroup  = 'Konten Website';
    protected static ?int    $navigationSort   = 3;
    protected static ?string $modelLabel       = 'Dokumentasi Divisi';
    protected static ?string $pluralModelLabel = 'Dokumentasi per Divisi';

    public static function form(Form $form): Form
    {
        return $form->schema([

            Forms\Components\Section::make('Informasi Dokumentasi')
                ->schema([
                    Forms\Components\Select::make('division')
                        ->label('Divisi')
                        ->required()
                        ->options([
                            'construction' => 'KPM Construction',
                            'engineering'  => 'KPM Engineering',
                            'rd'           => 'KPM Research & Development',
                            'farm'         => 'KPM Farm',
                            'procurement'  => 'KPM Procurement',
                        ]),

                    Forms\Components\TextInput::make('name')
                        ->label('Judul Dokumentasi / Kegiatan')
                        ->required()
                        ->maxLength(255)
                        ->placeholder('contoh: Dokumentasi Proyek Gedung A 2024'),

                    Forms\Components\Textarea::make('description')
                        ->label('Keterangan')
                        ->rows(3)
                        ->maxLength(500)
                        ->placeholder('Deskripsi singkat kegiatan atau dokumentasi ini...'),

                    Forms\Components\TextInput::make('sort_order')
                        ->label('Urutan Tampil')
                        ->numeric()
                        ->default(0),

                    Forms\Components\Toggle::make('is_public')
                        ->label('Tampilkan di Website')
                        ->default(true),
                ])->columns(2),

            Forms\Components\Section::make('Upload Foto Kegiatan')
                ->description('Upload foto-foto dokumentasi kegiatan divisi. Dapat upload lebih dari 5 foto. Format: JPG, PNG, WEBP. Maks 10MB/foto.')
                ->schema([
                    Forms\Components\FileUpload::make('file_paths')
                        ->label('Foto Dokumentasi')
                        ->required()
                        ->multiple()
                        ->image()
                        ->directory('division-documentation')
                        ->acceptedFileTypes([
                            'image/jpeg',
                            'image/jpg',
                            'image/png',
                            'image/webp',
                        ])
                        ->maxSize(10240)   // 10 MB per file
                        ->maxFiles(50)     // hingga 50 foto
                        ->minFiles(1)
                        ->reorderable()
                        ->imageEditor()
                        ->imageEditorAspectRatios([null, '16:9', '4:3', '1:1'])
                        ->panelLayout('grid')
                        ->uploadingMessage('Mengupload foto...')
                        ->helperText('Upload hingga 50 foto kegiatan. Seret untuk mengubah urutan.'),
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

                TextColumn::make('division')
                    ->label('Divisi')
                    ->badge()
                    ->formatStateUsing(fn ($state) => match ($state) {
                        'construction' => 'Construction',
                        'engineering'  => 'Engineering',
                        'rd'           => 'R & D',
                        'farm'         => 'Farm',
                        'procurement'  => 'Procurement',
                        default        => ucfirst((string) $state),
                    })
                    ->color(fn ($state) => match ($state) {
                        'construction' => 'warning',
                        'engineering'  => 'primary',
                        'rd'           => 'success',
                        'farm'         => 'info',
                        'procurement'  => 'danger',
                        default        => 'gray',
                    }),

                TextColumn::make('name')
                    ->label('Judul Dokumentasi')
                    ->searchable()
                    ->sortable()
                    ->wrap(),

                TextColumn::make('description')
                    ->label('Keterangan')
                    ->limit(50)
                    ->color('gray'),

                // Preview thumbnail foto pertama
                Tables\Columns\ImageColumn::make('cover_image')
                    ->label('Cover')
                    ->getStateUsing(function ($record) {
                        $paths = $record->file_paths;
                        if (is_array($paths) && count($paths) > 0) {
                            return $paths[0];
                        }
                        return null;
                    })
                    ->disk('public')
                    ->height(48)
                    ->width(72)
                    ->extraImgAttributes(['class' => 'object-cover rounded']),

                TextColumn::make('file_paths')
                    ->label('Jumlah Foto')
                    ->formatStateUsing(fn ($state) => is_array($state) ? count($state) . ' foto' : '1 foto')
                    ->badge()
                    ->color('success'),

                IconColumn::make('is_public')
                    ->label('Publik')
                    ->boolean(),

                TextColumn::make('created_at')
                    ->label('Ditambahkan')
                    ->date('d M Y')
                    ->sortable(),
            ])
            ->defaultSort('sort_order')
            ->filters([
                Tables\Filters\SelectFilter::make('division')
                    ->label('Filter Divisi')
                    ->options([
                        'construction' => 'KPM Construction',
                        'engineering'  => 'KPM Engineering',
                        'rd'           => 'KPM Research & Development',
                        'farm'         => 'KPM Farm',
                        'procurement'  => 'KPM Procurement',
                    ]),
                Tables\Filters\TernaryFilter::make('is_public')
                    ->label('Status')
                    ->trueLabel('Publik')
                    ->falseLabel('Tersembunyi'),
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
            ->groups([
                Tables\Grouping\Group::make('division')
                    ->label('Divisi')
                    ->getTitleFromRecordUsing(fn ($record) => $record->division_label)
                    ->collapsible(),
            ])
            ->defaultGroup('division')
            ->emptyStateHeading('Belum ada dokumentasi divisi')
            ->emptyStateDescription('Tambahkan foto kegiatan dan dokumentasi untuk setiap divisi KPM.')
            ->emptyStateIcon('heroicon-o-photo');
    }

    public static function getPages(): array
    {
        return [
            'index'  => Pages\ListDivisionDocumentations::route('/'),
            'create' => Pages\CreateDivisionDocumentation::route('/create'),
            'edit'   => Pages\EditDivisionDocumentation::route('/{record}/edit'),
        ];
    }
}