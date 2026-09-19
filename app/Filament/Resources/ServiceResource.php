<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ServiceResource\Pages;
use App\Models\Service;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Table;
use Illuminate\Support\Str;

class ServiceResource extends Resource
{
    protected static ?string $model = Service::class;

    protected static ?string $navigationIcon   = 'heroicon-o-briefcase';
    protected static ?string $navigationLabel  = 'Layanan & Divisi';
    protected static ?string $navigationGroup  = 'Konten Website';
    protected static ?int    $navigationSort   = 1;
    protected static ?string $modelLabel       = 'Layanan';
    protected static ?string $pluralModelLabel = 'Layanan & Divisi';

    public static function form(Form $form): Form
    {
        return $form->schema([

            Forms\Components\Section::make('Informasi Layanan')
                ->schema([
                    Forms\Components\TextInput::make('name')
                        ->label('Nama Layanan')
                        ->required()
                        ->maxLength(100)
                        ->live(onBlur: true)
                        ->afterStateUpdated(fn ($state, callable $set) =>
                            $set('slug', Str::slug($state))
                        ),

                    Forms\Components\TextInput::make('slug')
                        ->label('Slug URL')
                        ->required()
                        ->unique(ignoreRecord: true)
                        ->maxLength(120)
                        ->helperText('Otomatis terisi. Jangan ubah jika tidak perlu.'),

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

                    Forms\Components\TextInput::make('tagline')
                        ->label('Tagline')
                        ->maxLength(100)
                        ->placeholder('contoh: Konstruksi berkualitas internasional'),

                    Forms\Components\TextInput::make('sort_order')
                        ->label('Urutan Tampil')
                        ->numeric()
                        ->default(0),

                    Forms\Components\Toggle::make('is_active')
                        ->label('Aktif / Tampilkan')
                        ->default(true),
                ])->columns(2),

            Forms\Components\Section::make('Deskripsi')
                ->schema([
                    Forms\Components\Textarea::make('short_description')
                        ->label('Deskripsi Singkat')
                        ->required()
                        ->rows(3)
                        ->maxLength(500)
                        ->helperText('Tampil di card layanan (maks 500 karakter)'),

                    Forms\Components\RichEditor::make('full_description')
                        ->label('Deskripsi Lengkap')
                        ->toolbarButtons([
                            'bold', 'italic', 'bulletList', 'orderedList', 'h3', 'undo', 'redo',
                        ])
                        ->helperText('Tampil di accordion detail layanan'),
                ]),

            Forms\Components\Section::make('Sub-Layanan')
                ->description('Tambahkan poin-poin detail layanan yang dikerjakan divisi ini')
                ->schema([
                    Forms\Components\Repeater::make('sub_services')
                        ->label('')
                        ->schema([
                            Forms\Components\TextInput::make('name')
                                ->label('Nama Sub-Layanan')
                                ->required()
                                ->placeholder('contoh: Pembuatan Gardu Induk'),
                            Forms\Components\Textarea::make('description')
                                ->label('Keterangan')
                                ->rows(2)
                                ->placeholder('Deskripsi singkat...'),
                        ])
                        ->columns(2)
                        ->addActionLabel('+ Tambah Sub-Layanan')
                        ->reorderable()
                        ->collapsible()
                        ->defaultItems(0)
                        ->maxItems(20),
                ]),

            Forms\Components\Section::make('Media')
                ->schema([
                    Forms\Components\FileUpload::make('logo')
                        ->label('Logo Divisi')
                        ->image()
                        ->directory('services/logos')
                        ->maxSize(2048)
                        ->helperText('Logo divisi. PNG transparan. Maks 2MB.'),

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

                ImageColumn::make('logo')
                    ->label('Logo')
                    ->width(40)
                    ->height(40)
                    ->defaultImageUrl(asset('images/kpm-logo.png')),

                TextColumn::make('name')
                    ->label('Nama Layanan')
                    ->searchable()
                    ->sortable(),

                TextColumn::make('division')
                    ->label('Divisi')
                    ->badge()
                    ->formatStateUsing(fn ($state) => match ($state) {
                        'construction' => 'Construction',
                        'engineering'  => 'Engineering',
                        'rd'           => 'R & D',
                        'farm'         => 'Farm',
                        'procurement'  => 'Procurement',
                        default        => $state,
                    })
                    ->color('primary'),

                TextColumn::make('sub_services')
                    ->label('Sub-Layanan')
                    ->formatStateUsing(fn ($state) => is_array($state) ? count($state) . ' item' : '—')
                    ->color('gray'),

                IconColumn::make('is_active')
                    ->label('Aktif')
                    ->boolean(),

                TextColumn::make('updated_at')
                    ->label('Diperbarui')
                    ->since()
                    ->sortable(),
            ])
            ->defaultSort('sort_order')
            ->reorderable('sort_order')
            ->filters([
                Tables\Filters\SelectFilter::make('division')
                    ->label('Filter Divisi')
                    ->options([
                        'construction' => 'Construction',
                        'engineering'  => 'Engineering',
                        'rd'           => 'R & D',
                        'farm'         => 'Farm',
                        'procurement'  => 'Procurement',
                    ]),
                Tables\Filters\TernaryFilter::make('is_active')
                    ->label('Status')
                    ->trueLabel('Aktif')
                    ->falseLabel('Nonaktif'),
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
            ->emptyStateHeading('Belum ada layanan')
            ->emptyStateIcon('heroicon-o-briefcase');
    }

    public static function getPages(): array
    {
        return [
            'index'  => Pages\ListServices::route('/'),
            'create' => Pages\CreateService::route('/create'),
            'edit'   => Pages\EditService::route('/{record}/edit'),
        ];
    }
}
