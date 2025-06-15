<?php

namespace App\Filament\Resources;

use App\Filament\Resources\CategoryResource\Pages;
use App\Filament\Resources\CategoryResource\RelationManagers;
use App\Models\Category; // Pastikan model Category sudah di-import

use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Str; // Untuk Str::slug

class CategoryResource extends Resource
{
    protected static ?string $model = Category::class;

    protected static ?string $navigationIcon = 'heroicon-o-tag';
    protected static ?string $navigationLabel = 'Kategori'; // Label di navigasi
    protected static ?string $pluralModelLabel = 'Kategori'; // Label jamak
    protected static ?string $navigationGroup = 'Manajemen Konten'; // Kelompokkan dengan Gadget

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('name')
                    ->label('Nama Kategori')
                    ->required()
                    ->maxLength(255)
                    ->unique(ignoreRecord: true) // Pastikan nama kategori unik
                    ->live(onBlur: true) // Update slug secara langsung
                    ->afterStateUpdated(fn (string $operation, $state, Forms\Set $set) => ($operation === 'create' && $state) ? $set('slug', Str::slug($state)) : null)
                    ->columnSpanFull(), // Menggunakan lebar penuh

                Forms\Components\TextInput::make('slug')
                    ->label('Slug')
                    ->required()
                    ->maxLength(255)
                    ->unique(ignoreRecord: true) // Pastikan slug unik
                    ->helperText('Slug akan otomatis dibuat dari Nama Kategori. Pastikan unik.'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->label('Nama Kategori')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('slug')
                    ->label('Slug')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('created_at')
                    ->label('Dibuat Pada')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true), // Sembunyikan secara default
            ])
            ->filters([
                // Tambahkan filter jika diperlukan, misal filter berdasarkan jumlah gadget
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
            // Jika Anda ingin melihat gadget yang terkait dengan kategori ini dari halaman kategori,
            // Anda bisa membuat RelationManager di sini.
            // Contoh: RelationManagers\GadgetsRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListCategories::route('/'),
            'create' => Pages\CreateCategory::route('/create'),
            'edit' => Pages\EditCategory::route('/{record}/edit'),
            // 'view' => Pages\ViewCategory::route('/{record}'), // Opsional, jika ingin halaman view terpisah
        ];
    }

    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()
            ->withoutGlobalScopes([
                SoftDeletingScope::class,
            ]);
    }
}