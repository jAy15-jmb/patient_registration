<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PatientResource\Pages;
use App\Filament\Resources\PatientResource\RelationManagers;
use App\Models\Patient;
use Doctrine\DBAL\Schema\Schema;
use Filament\Forms;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Actions\DeleteAction;
use Filament\Tables\Actions\ViewAction;
use Filament\Tables\Columns\Layout\View;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class PatientResource extends Resource
{
    protected static ?string $model = Patient::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('hospital_number')
                ->numeric()
                ->label('Hospital Number')
                ->required(),
                TextInput::make('last_name')
                ->label('Last Name')
                ->required(),
                TextInput::make('first_name')
                ->label('First Name')
                ->required(),
                TextInput::make('suffix')
                ->label('Suffix'),
                TextInput::make('middle_name')
                ->label('Middle Name')
                ->required(),
                DatePicker::make('date_of_birth')
                ->label('Date of Birth')
                ->required(),
                Select::make('gender')
                ->label('Gender')
                ->options([
                    'male' => 'Male',
                    'female' => 'Female'
                ])
                ->required(),
                Select::make('civil_status')
                ->label('Civil Status')
                ->options([
                    'single' => 'Single',
                    'married' => 'Married',
                    'widowed/widower' => 'Widowed/Widower',

                ])
                ->required(),
                Textarea::make('address')
                ->label('Address'),
                

            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('hospital_number')
                ->label('Hospital Number')
                ->searchable()
                ->sortable(),
                TextColumn::make('last_name')
                ->label('Last Name')
                ->searchable()
                ->sortable(),
                TextColumn::make('first_name')
                ->label('First Name')
                ->searchable()
                ->sortable(),
                TextColumn::make('suffix')
                ->label('Suffix'),
                TextColumn::make('middle_name')
                ->label('Middle Name')
                ->searchable()
                ->sortable(),
                TextColumn::make('date_of_birth')
                ->label('Date of Birth')
                ->date()
                ->sortable(),
                TextColumn::make('gender')
                ->label('Gender')
                ->searchable()
                ->sortable(),
                TextColumn::make('cibil_status')
                ->label('Civil Status')
                ->searchable()
                ->sortable(),
                
            ])
            ->filters([
                Tables\Filters\TrashedFilter::make(),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                DeleteAction::make(),
                ViewAction::make()
                ->form([
                    TextInput::make('hospital_number')
                    ->label('Hospital Number'),
                    TextInput::make('last_name')
                    ->label('Last Name'),
                    TextInput::make('first_name')
                    ->label('First Name'),
                    TextInput::make('suffix')
                    ->label('Suffix'),
                    TextInput::make('middle_name')
                    ->label('Middle Name'),
                    TextInput::make('date_of_birth')
                    ->label('Date of Birth'),
                    TextInput::make('gender')
                    ->label('Gender'),
                    TextInput::make('civil_status')
                    ->label('Civil Status'),
                ]),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                    Tables\Actions\ForceDeleteBulkAction::make(),
                    Tables\Actions\RestoreBulkAction::make(),
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
            'index' => Pages\ListPatients::route('/'),
            'create' => Pages\CreatePatient::route('/create'),
            'edit' => Pages\EditPatient::route('/{record}/edit'),
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
