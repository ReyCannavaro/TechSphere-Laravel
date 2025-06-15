<?php

namespace App\Filament\Resources;

use App\Filament\Resources\GadgetResource\Pages;
use App\Models\Gadget; // Pastikan menggunakan model Gadget Anda
use App\Models\Category; // Import model Category untuk dropdown
use App\Models\Rating; // Import model Rating untuk menghitung rata-rata

use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

use Illuminate\Support\Str; // Untuk Str::slug
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Database\Query\JoinClause; // Untuk join average rating

class GadgetResource extends Resource
{
    protected static ?string $model = Gadget::class;

    protected static ?string $navigationLabel = 'Gadget';
    protected static ?string $pluralModelLabel = 'Gadget';
    protected static ?string $navigationIcon = 'heroicon-o-device-phone-mobile';

    protected static ?string $navigationGroup = 'Manajemen Konten';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Group::make()
                    ->schema([
                        Forms\Components\Section::make('Detail Gadget')
                            ->schema([
                                Forms\Components\TextInput::make('name')
                                    ->label('Nama Gadget') // Tambah label
                                    ->required()
                                    ->maxLength(255)
                                    ->unique(ignoreRecord: true) // Pastikan nama unik
                                    ->live(onBlur: true)
                                    ->afterStateUpdated(fn (string $operation, $state, Forms\Set $set) => ($operation === 'create' && $state) ? $set('slug', Str::slug($state)) : null),
                                Forms\Components\TextInput::make('slug')
                                    ->label('Slug') // Tambah label
                                    ->required()
                                    ->maxLength(255)
                                    ->unique(ignoreRecord: true)
                                    ->helperText('Slug akan otomatis dibuat dari Nama Gadget. Pastikan unik.'),
                                Forms\Components\RichEditor::make('description')
                                    ->label('Deskripsi Lengkap')
                                    ->columnSpanFull()
                                    // PERBAIKAN UTAMA: Hapus metode toolbar() yang sudah usang.
                                    // Gunakan toolbarButtons() jika ingin kustomisasi,
                                    // atau cukup hapus baris ini untuk toolbar default Filament v3+.
                                    // Saya memilih untuk menggunakan toolbarButtons dengan opsi umum.
                                    ->toolbarButtons([
                                        'blockquote',
                                        'bold',
                                        'bulletList',
                                        'codeBlock', // Jika Anda mengizinkan blok kode
                                        'h1',
                                        'h2',
                                        'italic',
                                        'link',
                                        'orderedList',
                                        'redo',
                                        'strike',
                                        'underline',
                                        'undo',
                                        // 'media', // Hanya tambahkan ini jika Anda menginstal plugin media Filament
                                    ])
                                    ->nullable(),
                            ])->columns(2), // Ini akan membuat 2 kolom di dalam section "Detail Gadget"

                        Forms\Components\Section::make('Informasi Tambahan')
                            ->schema([
                                Forms\Components\TextInput::make('tahun_keluaran')
                                    ->label('Tahun Keluaran')
                                    ->numeric()
                                    ->minValue(1900) // Batas tahun awal
                                    ->maxValue(date('Y') + 1) // Sampai tahun depan (untuk antisipasi)
                                    ->placeholder('Misal: 2023')
                                    ->nullable(),
                                Forms\Components\TextInput::make('harga')
                                    ->label('Harga')
                                    ->numeric()
                                    ->required()
                                    ->prefix('Rp')
                                    ->rules(['regex:/^\d{1,10}(\.\d{1,2})?$/']) // Pastikan format harga benar
                                    ->step(0.01)
                                    ->minValue(0),
                            ])->columns(2), // Ini juga akan membuat 2 kolom di dalam section "Informasi Tambahan"
                    ])->columnSpan(2), // Group ini mengambil 2 dari 3 kolom utama

                Forms\Components\Group::make()
                    ->schema([
                        Forms\Components\Section::make('Gambar Gadget')
                            ->schema([
                                Forms\Components\FileUpload::make('image')
                                    ->label('Gambar Utama')
                                    ->image()
                                    ->directory('gadget-images')
                                    ->disk('public')
                                    ->visibility('public')
                                    ->imageEditor()
                                    ->imageEditorAspectRatios([
                                        '16:9', '4:3', '1:1',
                                    ])
                                    ->nullable()
                                    ->helperText('Upload gambar utama gadget (Max 2MB).'),
                                // Jika ada kolom gallery_images di migrasi Anda dan sudah setup Spatie Media Library atau custom array
                                // Maka tambahkan ini:
                                /*
                                Forms\Components\FileUpload::make('gallery_images')
                                     ->label('Gambar Galeri')
                                     ->multiple()
                                     ->image()
                                     ->directory('gadget-gallery')
                                     ->disk('public')
                                     ->visibility('public')
                                     ->imageEditor()
                                     ->imageEditorAspectRatios([
                                         '16:9', '4:3', '1:1'
                                     ])
                                     ->nullable()
                                     ->helperText('Upload gambar tambahan untuk galeri gadget (Max 5MB per gambar).')
                                */
                            ]),

                        Forms\Components\Section::make('Status & Kategori')
                            ->schema([
                                Forms\Components\Toggle::make('is_featured')
                                    ->label('Tampilkan sebagai Unggulan?')
                                    ->helperText('Aktifkan untuk menampilkan gadget ini di bagian unggulan.')
                                    ->default(false),
                                Forms\Components\Select::make('category_id')
                                    ->label('Kategori')
                                    ->required()
                                    ->relationship('category', 'name')
                                    ->searchable()
                                    ->preload()
                                    ->createOptionForm([
                                        Forms\Components\TextInput::make('name')->required()->unique(),
                                        Forms\Components\TextInput::make('slug')
                                            ->required()
                                            ->unique()
                                            ->dehydrateStateUsing(fn ($state) => Str::slug($state))
                                            ->helperText('Slug akan otomatis dibuat. Pastikan unik.'),
                                    ])
                                    ->helperText('Pilih kategori yang sesuai untuk gadget ini.'),
                            ]),

                        Forms\Components\Section::make('Spesifikasi Teknis')
                            ->schema([
                                Forms\Components\KeyValue::make('specifications')
                                    ->keyLabel('Nama Spesifikasi (e.g., RAM)')
                                    ->valueLabel('Nilai (e.g., 8GB)')
                                    ->addActionLabel('Tambah Spesifikasi')
                                    ->nullable()
                                    ->helperText('Tambahkan spesifikasi teknis penting dalam format Pasangan Kunci-Nilai. Disimpan sebagai JSON.'),
                            ]),
                    ])->columnSpan(1), // Group ini mengambil 1 dari 3 kolom utama
            ])->columns(3); // Total kolom utama layout
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\ImageColumn::make('image')
                    ->label('Gambar')
                    ->square()
                    ->width(80)
                    ->height(80)
                    ->circular(),
                Tables\Columns\TextColumn::make('name')
                    ->label('Nama Gadget')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('category.name')
                    ->label('Kategori')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('tahun_keluaran')
                    ->label('Tahun')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('harga')
                    ->label('Harga')
                    ->money('IDR') // Format mata uang Rupiah
                    ->sortable(),
                Tables\Columns\IconColumn::make('is_featured')
                    ->label('Unggulan')
                    ->boolean()
                    ->sortable(),
                Tables\Columns\TextColumn::make('average_rating') // Tambahkan kolom untuk rata-rata rating
                    ->label('Rating Rata-rata')
                    ->badge()
                    ->color(fn (?string $state): string => match (true) { // Menggunakan match true untuk rentang nilai
                        $state >= 4.0 => 'success',
                        $state >= 3.0 => 'info',
                        $state >= 2.0 => 'warning',
                        $state < 2.0 && $state !== null => 'danger',
                        default => 'gray', // Jika null (belum ada rating)
                    })
                    ->getStateUsing(fn (Gadget $record): ?string => number_format($record->average_rating, 1) ?: null) // Format ke 1 desimal
                    ->sortable(query: function (Builder $query, string $direction): Builder {
                        return $query->orderBy(
                            Rating::selectRaw('avg(rating)')->whereColumn('gadget_id', 'gadgets.id'),
                            $direction
                        );
                    }),
                Tables\Columns\TextColumn::make('ratings_count') // Tambahkan kolom jumlah rating
                    ->label('Jumlah Rating')
                    ->counts('ratings') // Menghitung jumlah rating dari relasi
                    ->sortable(),
                Tables\Columns\TextColumn::make('created_at')
                    ->label('Dibuat Pada')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('category_id')
                    ->label('Filter Kategori')
                    ->relationship('category', 'name')
                    ->searchable()
                    ->preload(),
                Tables\Filters\TernaryFilter::make('is_featured')
                    ->label('Status Unggulan')
                    ->trueLabel('Unggulan')
                    ->falseLabel('Bukan Unggulan')
                    ->indicator('Status'),
                Tables\Filters\Filter::make('rating_range')
                    ->form([
                        Forms\Components\Select::make('min_rating')
                            ->label('Rating Minimal')
                            ->options([
                                1 => '1 Bintang',
                                2 => '2 Bintang',
                                3 => '3 Bintang',
                                4 => '4 Bintang',
                                5 => '5 Bintang',
                            ])
                            ->placeholder('Pilih rating minimal'),
                    ])
                    ->query(function (Builder $query, array $data): Builder {
                        return $query
                            ->when(
                                $data['min_rating'],
                                fn (Builder $query, $minRating): Builder => $query->whereHas('ratings', function ($query) use ($minRating) {
                                    $query->selectRaw('AVG(rating) as avg_rating')
                                          ->groupBy('gadget_id')
                                          ->havingRaw('AVG(rating) >= ?', [$minRating]);
                                })
                            );
                    }),
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [

        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListGadgets::route('/'),
            'create' => Pages\CreateGadget::route('/create'),
            'edit' => Pages\EditGadget::route('/{record}/edit'),
            'view' => Pages\ViewGadget::route('/{record}'),
        ];
    }

    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()
            ->withoutGlobalScopes([
                SoftDeletingScope::class,
            ])
            // Tambahkan eager loading untuk relasi rating agar average_rating bisa dihitung
            ->withAvg('ratings', 'rating')
            ->withCount('ratings');
    }
}