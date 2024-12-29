<?php

namespace App\Filament\Resources;

use App\Filament\Resources\TagihanResource\Pages;
use App\Filament\Resources\TagihanResource\Pages\ManageTagihans;
use App\Models\JenisTagihan;
use App\Models\Periode;
use App\Models\PersentaseTagihan;
use App\Models\Santri;
use App\Models\Tagihan;
use Filament\Forms;
use Filament\Forms\Components\Actions\Action;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Notifications\Notification;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Actions\CreateAction;
use Filament\Tables\Actions\DeleteAction;
use Filament\Tables\Actions\DeleteBulkAction;
use Filament\Tables\Actions\EditAction;
use Filament\Tables\Actions\ViewAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Forms\Form;
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
        return static::getModel()::where('status', 'Belum Lunas')->count();
    }


    public static function form(Forms\Form $form): Forms\Form
    {
        return $form->schema([
            Forms\Components\Select::make('periode_id')
                ->label('Periode')
                ->relationship('periode', 'nama_periode')
                ->required(),
            Forms\Components\Select::make('santri_id')
                ->label('Santri')
                ->relationship('santri', 'nama')
                ->searchable()
                ->required(),
            Forms\Components\Select::make('jenis_tagihan_id')
                ->label('Jenis Tagihan')
                ->relationship('jenis_tagihan', 'nama_jenis')
                ->required(),
            Forms\Components\TextInput::make('jumlah_tagihan')
                ->numeric()
                ->required(),
            Forms\Components\DatePicker::make('tanggal_jatuh_tempo')
                ->required()
                ->columnSpan(2),
            Forms\Components\Textarea::make('deskripsi')
                ->label('Deskripsi')
                ->nullable()
                ->columnSpan(2),
        ]);
    }

    public static function table(Tables\Table $table): Tables\Table
    {
        return $table

            ->headerActions([
                Tables\Actions\Action::make('Generate Massal')
                    ->label('Generate Tagihan')
                    ->color('danger')
                    ->icon('heroicon-o-cloud-arrow-up')
                    ->form([
                        Forms\Components\Select::make('periode_id')
                            ->label('Periode')
                            ->options(Periode::pluck('nama_periode', 'id'))
                            ->required(),
                        Forms\Components\Select::make('jenis_tagihan_id')
                            ->label('Jenis Tagihan')
                            ->options(JenisTagihan::pluck('nama_jenis', 'id'))
                            ->required(),
                        Forms\Components\TextInput::make('jumlah_tagihan')
                            ->label('Jumlah Tagihan')
                            ->numeric()
                            ->required(),
                        Forms\Components\DatePicker::make('tanggal_jatuh_tempo')
                            ->label('Tanggal Jatuh Tempo')
                            ->required(),
                        Forms\Components\Select::make('filter_jabatan')
                            ->label('Filter Jabatan Santri')
                            ->options(PersentaseTagihan::pluck('jabatan_santri', 'id'))
                            ->placeholder('Semua Jabatan'),
                        Forms\Components\Textarea::make('deskripsi')
                            ->label('Deskripsi')
                            ->nullable(),
                    ])

                    ->action(function (array $data) {
                        $santris = Santri::query()
                            ->where('status_santri', 'aktif');

                        if (!empty($data['filter_jabatan'])) {
                            $santris->where('persentase_tagihan_id', $data['filter_jabatan']);
                        }

                        $santris = $santris->get();

                        if ($santris->isEmpty()) {
                            Notification::make()
                                ->title('Tidak ada santri yang berstatus aktif atau sesuai filter!')
                                ->warning()
                                ->send();
                            return;
                        }

                        $tagihanData = [];
                        foreach ($santris as $santri) {
                            $tagihanData[] = [
                                'santri_id' => $santri->id,
                                'periode_id' => $data['periode_id'],
                                'jenis_tagihan_id' => $data['jenis_tagihan_id'],
                                'jumlah_tagihan' => $data['jumlah_tagihan'],
                                'tanggal_jatuh_tempo' => $data['tanggal_jatuh_tempo'],
                                'status' => 'Belum Lunas',
                                'deskripsi' => $data['deskripsi'],
                                'created_at' => now(),
                                'updated_at' => now(),
                            ];
                        }

                        Tagihan::insert($tagihanData);

                        Notification::make()
                            ->title('Tagihan berhasil dibuat secara massal!')
                            ->success()
                            ->send();
                    }),

                 Tables\Actions\CreateAction::make('CreateAction')
                    ->label('Add Tagihan')
                    ->icon('heroicon-o-plus-circle'),
                ExcelExportAction::make()
                    ->label('Export')
                    ->color('success')
                    ->icon('heroicon-o-archive-box-arrow-down'),

            ])
            ->columns([

                Tables\Columns\TextColumn::make('santri.nama')
                    ->label('Nama Santri')
                    ->sortable()
                    ->searchable(),

                Tables\Columns\TextColumn::make('santri.persentaseTagihan.jabatan_santri')
                    ->label('Jabatan Santri')
                    ->sortable()
                    ->searchable()
                    ->toggleable(isToggledHiddenByDefault:true),

                Tables\Columns\TextColumn::make('jenis_tagihan.nama_jenis')
                    ->label('Jenis Tagihan')
                    ->sortable()
                    ->searchable()
                    ->toggleable(isToggledHiddenByDefault:true),

                Tables\Columns\TextColumn::make('jumlah_tagihan')
                    ->label('Jumlah Tagihan')
                    ->sortable()
                    ->formatStateUsing(fn ($state) => 'Rp ' . number_format($state, 0, ',', '.')),
                Tables\Columns\TextColumn::make('santri.persentaseTagihan.potongan')
                    ->label('Potongan')
                    ->sortable()
                    ->searchable()
                    ->formatStateUsing(fn ($state) => number_format($state) . '%'),
              Tables\Columns\TextColumn::make('potongan')
                ->label('Tagihan')
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
                Tables\Columns\TextColumn::make('tanggal_jatuh_tempo')
                    ->label('Jatuh Tempo')
                    ->sortable()
                    ->date(),

                Tables\Columns\TextColumn::make('periode.nama_periode')
                ->label('Periode')
                ->sortable()
                ->searchable()
                ->toggleable(isToggledHiddenByDefault:true),

                Tables\Columns\TextColumn::make('status')
                    ->label('Status')
                    ->badge()
                    ->color(fn ($state) => $state === 'Lunas' ? 'success' : 'danger'),
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
                Tables\Actions\DeleteBulkAction::make(),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ManageTagihans::route('/'),
        ];
    }
}
