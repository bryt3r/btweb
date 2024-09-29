<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ProductResource\Pages;
use App\Filament\Resources\ProductResource\RelationManagers;
use App\Models\Product;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class ProductResource extends Resource
{
    protected static ?string $model = Product::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('title')
                    ->required()
                    ->maxLength(191),
                Forms\Components\TextInput::make('slug')
                    ->required()
                    ->maxLength(250),
                Forms\Components\TextInput::make('identifier')
                    ->required()
                    ->maxLength(50),
                Forms\Components\TextInput::make('category')
                    ->required()
                    ->maxLength(191),
                Forms\Components\TextInput::make('brand')
                    ->required()
                    ->maxLength(191),
                Forms\Components\TextInput::make('condition')
                    ->required()
                    ->maxLength(191),
                Forms\Components\Textarea::make('description')
                    ->required()
                    ->columnSpanFull(),
                Forms\Components\Toggle::make('price_set')
                    ->required(),
                Forms\Components\Toggle::make('is_listed')
                    ->required(),
                Forms\Components\Toggle::make('is_sold')
                    ->required(),
                Forms\Components\Toggle::make('discounted')
                    ->required(),
                Forms\Components\TextInput::make('costprice')
                    ->required()
                    ->numeric(),
                Forms\Components\TextInput::make('sellingprice')
                    ->numeric()
                    ->default(null),
                Forms\Components\TextInput::make('saleprice')
                    ->numeric()
                    ->default(null),
                Forms\Components\TextInput::make('discount')
                    ->numeric()
                    ->default(null),
                Forms\Components\TextInput::make('lister_id')
                    ->required()
                    ->numeric(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('title')
                    ->searchable(),
                Tables\Columns\TextColumn::make('slug')
                    ->searchable(),
                Tables\Columns\TextColumn::make('identifier')
                    ->searchable(),
                Tables\Columns\TextColumn::make('category')
                    ->searchable(),
                Tables\Columns\TextColumn::make('brand')
                    ->searchable(),
                Tables\Columns\TextColumn::make('condition')
                    ->searchable(),
                Tables\Columns\IconColumn::make('price_set')
                    ->boolean(),
                Tables\Columns\IconColumn::make('is_listed')
                    ->boolean(),
                Tables\Columns\IconColumn::make('is_sold')
                    ->boolean(),
                Tables\Columns\IconColumn::make('discounted')
                    ->boolean(),
                Tables\Columns\TextColumn::make('costprice')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('sellingprice')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('saleprice')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('discount')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('lister_id')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
                Tables\Actions\EditAction::make(),
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
            'index' => Pages\ListProducts::route('/'),
            'create' => Pages\CreateProduct::route('/create'),
            'view' => Pages\ViewProduct::route('/{record}'),
            'edit' => Pages\EditProduct::route('/{record}/edit'),
        ];
    }
}
