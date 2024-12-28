<?php

namespace App\Filament\Resources;

use App\Filament\Resources\TagihanResource\Pages;
use App\Filament\Resources\TagihanResource\Pages\ManageTagihans;
use App\Models\Santri;
use App\Models\Tagihan;
use Filament\Forms;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Actions\DeleteAction;
use Filament\Tables\Actions\DeleteBulkAction;
use Filament\Tables\Actions\EditAction;
use Filament\Tables\Actions\ImportAction;
use Filament\Tables\Actions\ViewAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Forms\Form;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use pxlrbt\FilamentExcel\Actions\Tables\ExportAction as ExcelExportAction;
use Tables\Table;

class TagihanResource extends Resource
{
    protected static ?string $model = Tagihan::class;

    protected static ?string $navigationIcon = 'heroicon-o-swatch';
    protected static ?string $navigationLabel = 'Tagihan Pembayaran';
    protected static ?string $navigationGroup = 'Management Keuangan';
    protected static ?int $navigationSort = 42;

     public static function getNavigationBadge(): ?string
    {
        // Menghitung jumlah santri yang bukan alumni
        return static::getModel()::where('tagihan', '==', 'Belum Lunas')->count();
    }

    public static function form(Forms\Form $form): Forms\Form
    {
        return $form->schema([
            Select::make('periode_id')
                ->label('Periode')
                ->relationship('periode', 'nama_periode')
                ->required(),

            Select::make('santri_id')
                ->required()
                ->searchable()
                ->relationship('santri', 'nama'),

            TextInput::make('jenis_tagihan'),
            TextInput::make('jumlah_tagihan')
                 ->formatStateUsing(fn($state) => intval($state)),
            DatePicker::make('tanggal_jatuh_tempo'),
            TextInput::make('deskripsi'),
        ]);
    }

    public static function afterCreate(Model $record): void
    {
        Tagihan::createTagihan($record);
    }


    public static function table(Tables\Table $table): Tables\Table
    {
        return $table

         ->headerActions([
            ImportAction::make()
                ->icon('heroicon-o-arrow-up-tray')
                    ->label('Import Santri')
                    ->color('danger'),
                ExcelExportAction::make()
            ])

            ->columns([
            Tables\Columns\TextColumn::make('santri.nama')
                ->label('Nama Santri')
                ->sortable()
                ->searchable(),

            Tables\Columns\TextColumn::make('jenis_tagihan')
                ->label('Jenis Tagihan')
                ->sortable()
                ->searchable()
                ->toggleable(isToggledHiddenByDefault:true),

            Tables\Columns\TextColumn::make('santri.persentaseTagihan.jabatan_santri')
                ->label('Jabatan Santri')
                ->sortable()
                ->searchable()
                ->toggleable(isToggledHiddenByDefault:true),

            Tables\Columns\TextColumn::make('santri.persentaseTagihan.potongan')
                ->label('Potongan')
                ->sortable()
                ->searchable()
                ->formatStateUsing(fn ($state) => number_format($state).'%'),

            Tables\Columns\TextColumn::make('jumlah_tagihan')
                ->label('Jumlah Tagihan')
                ->sortable()
                ->formatStateUsing(fn ($state) => 'Rp '. number_format($state, 0, ',', '.')) ,

            Tables\Columns\TextColumn::make('potongan')
                ->label('Jumlah Setelah Potongan')
                ->formatStateUsing(function ($state, $record) {
                    $potongan = $record->santri->persentaseTagihan->potongan ?? 0;
                    $jumlahTagihan = $record->jumlah_tagihan;
                    if ($jumlahTagihan && $potongan) {
                        $jumlahSetelahPotongan = $jumlahTagihan - ($jumlahTagihan * ($potongan / 100));
                        return 'Rp ' . number_format($jumlahSetelahPotongan, 0, ',', '.');
                    } else {
                        return '-';
                    }
                }),


            Tables\Columns\TextColumn::make('periode.nama_periode')
                ->label('Periode')
                ->sortable()
                ->searchable()
                ->toggleable(isToggledHiddenByDefault:true),

            Tables\Columns\TextColumn::make('tanggal_jatuh_tempo')
                ->label('Jatuh Tempo')
                ->sortable()
                ->date()
                ->searchable()
                ->toggleable(isToggledHiddenByDefault:true),

            Tables\Columns\TextColumn::make('status')
                ->label('Status')
                ->badge()
                ->color(function(string $state):string{
                    return match($state){
                        'Lunas'=> 'success',
                        'Belum Lunas'=> 'danger',
                    }; }),

            ])

            ->actions([
                Tables\Actions\ViewAction::make()
                    ->icon('heroicon-o-eye')
                    ->label(''),
                Tables\Actions\EditAction::make()
                    ->icon('heroicon-o-pencil')
                    ->label(''),
                Tables\Actions\DeleteAction::make()
                    ->icon('heroicon-o-trash')
                    ->label(''),
            ])

            ->filters([
                SelectFilter::make('tagihan')
                    ->label('Nama Periode')
                    ->relationship('periode', 'nama_periode'),
            ])

            ->bulkActions([
                DeleteBulkAction::make(),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ManageTagihans::route('/'),
        ];
    }
}
