<?php

namespace App\Filament\Resources;

use App\Filament\Resources\SaleResource\Pages;
use App\Filament\Resources\SaleResource\Pages\LogsSale;
use App\Filament\Resources\SaleResource\RelationManagers;
use App\Models\Sale;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Notifications\Notification;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Facades\Auth;

class SaleResource extends Resource
{
    protected static ?string $model = Sale::class;

    protected static ?string $navigationIcon = 'heroicon-o-shopping-cart';
    protected static ?string $navigationLabel = 'Ventas';
    protected static ?string $modelLabel = 'Ventas';
    //protected static ?string $navigationGroup = 'Ventas'; para tener en cuenta

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                //
                Forms\Components\TextInput::make('contract')
                    ->label('Contrato')
                    ->required()
                    ->placeholder('Ingrese el número de contrato'),
                Forms\Components\Hidden::make('user_id')
                    ->default(Auth::id()),
                Forms\Components\Toggle::make('state')
                    ->label('Venta asentada')
                    ->disabled()
                    ->helperText('Una vez asentada, la venta no podrá ser modificada'),
                Forms\Components\DatePicker::make('settle_date')
                    ->label('Fecha de asentado')
                    ->disabled()
                    ->visible(fn (Forms\Get $get): bool => $get('state')),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('contract')
                    ->label('No. de Contrato')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('user.name')
                    ->label('Usuario')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\IconColumn::make('state')
                    ->label('Asentada')
                    ->boolean(),
                Tables\Columns\TextColumn::make('settle_date')
                    ->label('Fecha de asentado')
                    ->date('d/m/Y')
                    ->sortable(),
                Tables\Columns\TextColumn::make('created_at')
                    ->label('Fecha de creación')
                    ->dateTime('d/m/Y H:i')
                    ->sortable(),
            ])
            ->filters([
                Tables\Filters\Filter::make('state')
                    ->label('Estado')
                    ->form([
                        Forms\Components\Select::make('state')
                            ->options([
                                '0' => 'En proceso',
                                '1' => 'Asentada',
                            ])
                            ->placeholder('Todos'),
                    ])
                    ->query(function (Builder $query, array $data): Builder {
                        return $query
                            ->when(
                                $data['state'] !== null,
                                fn (Builder $query): Builder => $query->where('state', $data['state']),
                            );
                    }),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\Action::make('settle')
                    ->label('Asentar venta')
                    ->icon('heroicon-o-lock-closed')
                    ->color('success')
                    ->requiresConfirmation()
                    ->visible(fn (Sale $record): bool => !$record->state)
                    ->action(function (Sale $record): void {
                        $record->state = true;
                        $record->settle_date = now();
                        $record->save();
                        
                        Notification::make()
                            ->title('Venta asentada')
                            ->body('La venta ha sido asentada correctamente y no podrá ser modificada.')
                            ->success()
                            ->send();
                    }),
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
            RelationManagers\DetailSalesRelationManager::class, 
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListSales::route('/'),
            'create' => Pages\CreateSale::route('/create'),
            'edit' => Pages\EditSale::route('/{record}/edit'),
        ];
    }
}
