<?php

namespace App\Filament\Resources;

use App\Filament\Resources\RatingResource\Pages;
use App\Filament\Resources\RatingResource\RelationManagers;
use App\Models\Rating; // Pastikan model Rating sudah di-import
use App\Models\User;   // Import model User
use App\Models\Gadget; // Import model Gadget

use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class RatingResource extends Resource
{
    protected static ?string $model = Rating::class;

    protected static ?string $navigationIcon = 'heroicon-o-star'; // Icon bintang
    protected static ?string $navigationLabel = 'Rating'; // Label di navigasi
    protected static ?string $pluralModelLabel = 'Rating'; // Label jamak
    protected static ?string $navigationGroup = 'Manajemen Konten'; // Kelompokkan dengan Gadget & Kategori

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('user_id')
                    ->label('User')
                    ->relationship('user', 'name') // Relasi ke nama user
                    ->searchable()
                    ->preload()
                    ->required()
                    ->helperText('Pilih user yang memberikan rating.'),

                Forms\Components\Select::make('gadget_id')
                    ->label('Gadget')
                    ->relationship('gadget', 'name') // Relasi ke nama gadget
                    ->searchable()
                    ->preload()
                    ->required()
                    ->helperText('Pilih gadget yang di-rating.'),

                Forms\Components\Select::make('rating')
                    ->label('Nilai Rating')
                    ->options([
                        1 => '1 Bintang',
                        2 => '2 Bintang',
                        3 => '3 Bintang',
                        4 => '4 Bintang',
                        5 => '5 Bintang',
                    ])
                    ->required()
                    ->default(1) // Nilai default
                    ->helperText('Berikan nilai rating (1-5 bintang).'),

                Forms\Components\Textarea::make('comment')
                    ->label('Komentar')
                    ->maxLength(65535) // Ukuran TEXT di database
                    ->nullable()
                    ->columnSpanFull() // Menggunakan lebar penuh
                    ->helperText('Tambahkan komentar terkait rating (opsional).'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('user.name')
                    ->label('User')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('gadget.name')
                    ->label('Gadget')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('rating')
                    ->label('Rating')
                    ->badge() // Tampilkan sebagai badge
                    ->color(fn (int $state): string => match ($state) {
                        1 => 'danger',
                        2 => 'warning',
                        3 => 'info',
                        4 => 'success',
                        5 => 'success',
                        default => 'gray', // Jika ada nilai rating di luar 1-5
                    })
                    ->sortable(),
                Tables\Columns\TextColumn::make('comment')
                    ->label('Komentar')
                    ->limit(50) // Batasi tampilan komentar
                    ->tooltip(function (Tables\Columns\TextColumn $column): ?string {
                        $state = $column->getState();
                        if (strlen($state) <= $column->getLimit()) {
                            return null;
                        }
                        return $state;
                    })
                    ->toggleable(isToggledHiddenByDefault: true), // Sembunyikan secara default
                Tables\Columns\TextColumn::make('created_at')
                    ->label('Dibuat Pada')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
                    ->label('Diperbarui Pada')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('rating')
                    ->label('Filter Rating')
                    ->options([
                        1 => '1 Bintang',
                        2 => '2 Bintang',
                        3 => '3 Bintang',
                        4 => '4 Bintang',
                        5 => '5 Bintang',
                    ]),
                Tables\Filters\SelectFilter::make('gadget_id')
                    ->label('Filter Gadget')
                    ->relationship('gadget', 'name')
                    ->searchable()
                    ->preload(),
                Tables\Filters\SelectFilter::make('user_id')
                    ->label('Filter User')
                    ->relationship('user', 'name')
                    ->searchable()
                    ->preload(),
            ])
            ->actions([
                Tables\Actions\ViewAction::make(), // Tambahkan aksi View
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
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListRatings::route('/'),
            'create' => Pages\CreateRating::route('/create'),
            'edit' => Pages\EditRating::route('/{record}/edit'),
            'view' => Pages\ViewRating::route('/{record}'), // Jika Anda ingin halaman detail view
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