<?php

namespace App\Filament\Resources;

use App\Filament\Exports\AlumniExporter;
use App\Filament\Resources\AlumniResource\Pages;
use App\Models\Alumni;
use Filament\Forms;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Actions\ViewAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\ImageColumn;
use Illuminate\Database\Eloquent\Builder;
use pxlrbt\FilamentExcel\Actions\Tables\ExportAction as ExcelExportAction;

class AlumniResource extends Resource
{
    protected static ?string $model = Alumni::class;
    protected static ?string $navigationIcon = 'heroicon-o-academic-cap';
    protected static ?string $navigationLabel = 'Data Alumni';
    protected static ?string $navigationGroup = 'Data Master';

    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()
            ->where('status_santri', 'alumni')
            ->with(['kamar', 'periode']); // Memuat data relasi kamar dan periode
    }

    public static function getNavigationBadge(): ?string
    {
        return (string) Alumni::where('status_santri', 'alumni')->count();
    }

    public static function table(Tables\Table $table): Tables\Table
    {
        return $table
            ->columns([
                ImageColumn::make('image')->circular()->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('nama')->sortable()->searchable(),
                TextColumn::make('nis')->searchable()->toggleable(),
                TextColumn::make('nik')->searchable()->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('jenis_kelamin')->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('alamat')->searchable()->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('tempat_lahir')->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('tanggal_lahir')->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('status_santri')->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('nama_wali')->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('no_kk')->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('kamar.nama_kamar')->label('Nama Kamar')->sortable()->searchable()->toggleable(),
                TextColumn::make('periode.nama_periode')->label('Nama Periode')->sortable()->searchable()->toggleable(),
            ])
            ->actions([
                ViewAction::make()
                    ->icon('heroicon-o-eye')
                    ->label('Lihat')
                    ->form([
                        Forms\Components\TextInput::make('nama')->disabled(),
                        Forms\Components\TextInput::make('nis')->disabled(),
                        Forms\Components\TextInput::make('nik')->disabled(),
                        Forms\Components\TextInput::make('jenis_kelamin')->disabled(),
                        Forms\Components\TextInput::make('alamat')->disabled(),
                        Forms\Components\TextInput::make('tempat_lahir')->disabled(),
                        Forms\Components\TextInput::make('tanggal_lahir')->disabled(),
                        Forms\Components\TextInput::make('nama_wali')->disabled(),
                        Forms\Components\TextInput::make('no_kk')->disabled(),
                        Forms\Components\Placeholder::make('kamar')
                            ->label('Nama Kamar')
                            ->content(fn ($record) => $record->kamar?->nama_kamar ?? 'Tidak Ada'),
                        Forms\Components\Placeholder::make('periode')
                            ->label('Nama Periode')
                            ->content(fn ($record) => $record->periode?->nama_periode ?? 'Tidak Ada'),
                    ]),
            ])
            ->headerActions([
                ExcelExportAction::make()->color('success'),
            ])
            ->paginated([10, 25, 50]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ManageAlumnis::route('/'),
        ];
    }

    public static function canCreate(): bool
    {
        return false;
    }
}
