<?php

namespace App\Filament\Resources;

use App\Filament\Resources\UserResource\Pages;
use App\Filament\Resources\UserResource\RelationManagers;
use App\Models\User;
use Filament\Actions\EditAction;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Database\Eloquent\Model;

class UserResource extends Resource
{
    protected static ?string $model = User::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('name')->required(),
                Forms\Components\TextInput::make('email')->email()->required(),
                Forms\Components\TextInput::make('imgURL')->required(),
                Forms\Components\TextInput::make('dormitory')->required(),
                Forms\Components\TextInput::make('room')->required(),
                Forms\Components\TextInput::make('phone')->required(),
                Forms\Components\TextInput::make('instagram')->required(),
                Forms\Components\TextInput::make('telegram')->required(),
                Forms\Components\TextInput::make('role_id')->required(),
                Forms\Components\TextInput::make('status')->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->query(User::with('role'))
            ->query(User::query()->whereNotNull('google_id'))
            ->columns([
                // Tables\Columns\TextColumn::make('id'),
                // Tables\Columns\TextColumn::make('google_id'),
                Tables\Columns\TextColumn::make('name'),
                Tables\Columns\TextColumn::make('email'),
                Tables\Columns\ImageColumn::make('imgURL'),
                Tables\Columns\TextColumn::make('dormitory'),
                Tables\Columns\TextColumn::make('room'),
                Tables\Columns\TextColumn::make('phone'),
                Tables\Columns\TextColumn::make('instagram'),
                Tables\Columns\TextColumn::make('telegram'),
                Tables\Columns\TextColumn::make('role.role')->label('Role'),
                Tables\Columns\TextColumn::make('status'),
            ])
            ->filters([
                SelectFilter::make('dormitory')
                    ->options([
                        '1'=>'1',
                        '2'=>'2',
                        '3'=>'3',
                        '4'=>'4'
                    ]),
                SelectFilter::make('status')
                    ->options([
                        '1' => __('Approved'),
                        '0' => __('Unapproved'),
                    ])
            ])
            ->actions([
                //Надаємо статус 1 (тобто підтверджуємо, що акаунт користувача перевірений)
                Tables\Actions\ButtonAction::make('approve')
                    ->mountUsing(function ($record) {
                        User::where('id', $record->getKey())->update(["status" => 1]);
                    }),
                //Надаємо статус 0 (тобто не підтверджуємо, що акаунт користувача перевірений)
                Tables\Actions\ButtonAction::make('unapprove')
                    ->mountUsing(function ($record) {
                        User::where('id', $record->getKey())->update(["status" => 0]);
                    }),
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
            'index' => Pages\ListUsers::route('/'),
            'create' => Pages\CreateUser::route('/create'),
            'edit' => Pages\EditUser::route('/{record}/edit'),
        ];
    }
}
