<?php

namespace App\Filament\Resources;

use App\Filament\Resources\LogResource\Pages;
use App\Filament\Resources\LogResource\RelationManagers;
use App\Models\Log;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class LogResource extends Resource
{
    protected static ?string $model = Log::class;

    protected static ?string $navigationIcon = 'heroicon-o-document-text';
    protected static ?string $navigationLabel = 'Historial de Cambios';
    
    
    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                //
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('detail_sale.sale.contract')
                    ->label('Venta'),
                    
                Tables\Columns\TextColumn::make('detail_sale_id')
                    ->label('ID Detalle de Venta')
                    ->sortable(),

                Tables\Columns\TextColumn::make('user.name')
                    ->label('Usuario')
                    ->sortable(),

                Tables\Columns\TextColumn::make('modified_field')
                    ->label('Campo Modificado')
                    ->sortable(),

                Tables\Columns\TextColumn::make('old_value')
                    ->label('Valor Anterior')
                    ->limit(30),

                Tables\Columns\TextColumn::make('new_value')
                    ->label('Valor Nuevo')
                    ->limit(30),

                Tables\Columns\TextColumn::make('modified_date')
                    ->label('Fecha de Modificación')
                    ->dateTime()
                    ->sortable(),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('user_id')
                    ->relationship('user', 'name')
                    ->label('Filtrar por Usuario'),
            ])
            ->defaultSort('modified_date', 'desc');
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
            'index' => Pages\ListLogs::route('/'),
            //'create' => Pages\CreateLog::route('/create'),
            //'edit' => Pages\EditLog::route('/{record}/edit'),
        ];
    }
}
