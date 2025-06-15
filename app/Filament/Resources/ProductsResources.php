<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ProductResource\Pages;
use App\Models\Product;
use App\Models\Category; // Import model Category
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Support\Str; // Untuk Str::slug
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class ProductResource extends Resource
{
    protected static ?string $model = Product::class;

    protected static ?string $navigationIcon = 'heroicon-o-cube'; // Ikon untuk produk

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Group::make() // Menggunakan Group untuk tata letak lebih rapi
                    ->schema([
                        Forms\Components\Section::make('Detail Produk')
                            ->schema([
                                Forms\Components\TextInput::make('name')
                                    ->required()
                                    ->maxLength(255)
                                    ->live(onBlur: true)
                                    ->afterStateUpdated(fn (string $operation, $state, Forms\Set $set) => $operation === 'create' ? $set('slug', Str::slug($state)) : null),
                                Forms\Components\TextInput::make('slug')
                                    ->required()
                                    ->maxLength(255)
                                    ->unique(ignoreRecord: true),
                                Forms\Components\RichEditor::make('description') // Rich text editor untuk deskripsi
                                    ->columnSpanFull() // Mengambil seluruh lebar kolom
                                    ->nullable(),
                                Forms\Components\TextInput::make('brand')
                                    ->nullable()
                                    ->maxLength(255),
                                Forms\Components\FileUpload::make('image') // Untuk upload gambar
                                    ->image() // Hanya menerima gambar
                                    ->directory('product-images') // Simpan di storage/app/public/product-images
                                    ->preserveFilenames() // Pertahankan nama file asli
                                    ->disk('public') // Gunakan disk 'public' (pastikan Anda sudah menjalankan php artisan storage:link)
                                    ->nullable(),
                            ])->columns(2), // Dua kolom dalam satu Section

                        Forms\Components\Section::make('Harga & Stok')
                            ->schema([
                                Forms\Components\TextInput::make('price')
                                    ->numeric()
                                    ->required()
                                    ->prefix('Rp')
                                    ->rules(['regex:/^\d{1,10}(\.\d{1,2})?$/']), // Validasi format uang
                                Forms\Components\TextInput::make('stock')
                                    ->numeric()
                                    ->required()
                                    ->default(0),
                            ])->columns(2),
                    ])->columnSpan(2), // Group ini mengambil 2 kolom dari 3 total

                Forms\Components\Group::make()
                    ->schema([
                        Forms\Components\Section::make('Status & Kategori')
                            ->schema([
                                Forms\Components\Toggle::make('is_published') // Toggle untuk status publikasi
                                    ->label('Published')
                                    ->helperText('Set to true to make this product visible on the website.')
                                    ->default(true),
                                Forms\Components\Select::make('category_id') // Dropdown untuk memilih kategori
                                    ->required()
                                    ->relationship('category', 'name') // Mengambil data dari relasi 'category' dan menampilkan 'name'
                                    ->searchable()
                                    ->preload(), // Memuat semua kategori di awal
                            ]),
                        Forms\Components\Section::make('Spesifikasi (JSON)')
                            ->schema([
                                Forms\Components\KeyValue::make('specifications') // Untuk input spesifikasi dalam format key-value
                                    ->keyLabel('Nama Spesifikasi')
                                    ->valueLabel('Nilai')
                                    ->addActionLabel('Tambah Spesifikasi')
                                    ->nullable(),
                            ])
                    ])->columnSpan(1), // Group ini mengambil 1 kolom
            ])->columns(3); // Total 3 kolom untuk layout utama form
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\ImageColumn::make('image') // Menampilkan gambar produk
                    ->square() // Membuat gambar persegi
                    ->width(80)
                    ->height(80),
                Tables\Columns\TextColumn::make('name')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('category.name') // Menampilkan nama kategori dari relasi
                    ->label('Category')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('brand')
                    ->searchable()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: false),
                Tables\Columns\TextColumn::make('price')
                    ->money('IDR') // Format sebagai mata uang IDR
                    ->sortable(),
                Tables\Columns\TextColumn::make('stock')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\IconColumn::make('is_published') // Menampilkan ikon berdasarkan boolean
                    ->label('Published')
                    ->boolean(),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('category_id') // Filter berdasarkan kategori
                    ->relationship('category', 'name')
                    ->label('Filter by Category'),
                Tables\Filters\TernaryFilter::make('is_published') // Filter berdasarkan status publikasi
                    ->label('Published Status')
                    ->trueLabel('Published')
                    ->falseLabel('Not Published')
                    ->indicator('Published'),
            ])
            ->actions([
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
            // Tambahkan Relation Managers di sini jika ada, misalnya untuk ulasan terkait produk
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListProducts::route('/'),
            'create' => Pages\CreateProduct::route('/create'),
            'edit' => Pages\EditProduct::route('/{record}/edit'),
        ];
    }

    // Fungsi untuk relasi category (pastikan ada di model Product)
    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()->withoutGlobalScopes([
            SoftDeletingScope::class,
        ]);
    }
}