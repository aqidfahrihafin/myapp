<?php

namespace App\Filament\Resources;

use App\Filament\Resources\AlumniResource\Pages;
use App\Models\Santri;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Actions\ViewAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;

class AlumniResource extends Resource
{
    protected static ?string $model = Santri::class;

    protected static ?string $navigationIcon = 'heroicon-o-user-minus';
    protected static ?string $navigationLabel = 'Data Alumni';
    protected static ?string $navigationGroup = 'Data Master';
    protected static ?int $navigationSort = 22;

    public static function getNavigationBadge(): ?string
    {
        return static::getModel()::where('status_santri', 'alumni')->count();
    }

    public static function form(Form $form): Form
    {
        return $form->schema([]);
    }

    // Pastikan hanya menampilkan santri dengan status 'alumni'
    public static function query(): Builder
    {
        $alukmni = getModel()::where('status_santri', 'alumni');
    }

    public static function table(Table $alumni): Table
    {
        return $alumni
            ->columns([
                Tables\Columns\TextColumn::make('nama')
                    ->sortable()
                    ->searchable()
                    ->label('Nama Santri'),
                Tables\Columns\TextColumn::make('nis')
                    ->searchable()
                    ->label('NIS'),
                Tables\Columns\TextColumn::make('no_kk')
                    ->searchable()
                    ->toggleable()
                    ->label('No KK'),
                Tables\Columns\TextColumn::make('nik')
                    ->searchable()
                    ->toggleable()
                    ->label('NIK'),
                Tables\Columns\TextColumn::make('tempat_lahir')
                    ->label('Tempat Lahir'),
                Tables\Columns\TextColumn::make('tanggal_lahir')
                    ->label('Tanggal Lahir'),
                Tables\Columns\TextColumn::make('jenis_kelamin')
                    ->toggleable()
                    ->label('Jenis Kelamin'),
                Tables\Columns\TextColumn::make('alamat')
                    ->searchable()
                    ->toggleable()
                    ->label('Alamat'),
                Tables\Columns\TextColumn::make('status_santri')
                    ->label('Status Santri')
                    ->badge()
                    ->color(function (string $state): string {
                        return match ($state) {
                            'aktif' => 'success',
                            'non-aktif' => 'danger',
                            'alumni' => 'warning',
                        };
                    }),
            ])
            ->filters([
                // Anda bisa menambahkan filter lainnya jika diperlukan
            ])
            ->actions([
                ViewAction::make(),
            ])
            ->bulkActions([
                // Tidak ada bulk actions
            ]);
    }

    public static function canCreate(): bool
    {
        return false; // Menonaktifkan pembuatan data baru
    }

    public static function canEdit($record): bool
    {
        return false; // Menonaktifkan pengeditan data
    }

    public static function canDelete($record): bool
    {
        return false; // Menonaktifkan penghapusan data
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ManageAlumnis::route('/'),
        ];
    }
}
