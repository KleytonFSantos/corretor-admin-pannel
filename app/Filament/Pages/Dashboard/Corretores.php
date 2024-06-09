<?php

namespace App\Filament\Pages\Dashboard;

use App\Models\User;
use Filament\Actions\Concerns\InteractsWithActions;
use Filament\Actions\Contracts\HasActions;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Tables\Actions\CreateAction;
use Filament\Tables\Actions\Action;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Pages\Page;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Concerns\InteractsWithTable;
use Filament\Tables\Contracts\HasTable;
use Filament\Tables\Table;
use Illuminate\Support\Facades\Hash;

class Corretores extends Page implements HasForms, HasTable, HasActions
{
    use InteractsWithForms;
    use InteractsWithTable;
    use InteractsWithActions;

    public ?array $data = [];

    public ?array $formData = [];

    protected static ?string $navigationIcon = 'heroicon-o-document-text';

    protected static string $view = 'filament.pages.dashboard.corretores';

    public function table(Table $table): Table
    {
        return $table
            ->query(User::query())
            ->headerActions([
                CreateAction::make('Adicionar')
                    ->label('Novo Corretor')
                    ->color('success')
                    ->form([
                        TextInput::make('name')
                            ->label('Nome')
                            ->required(),
                        TextInput::make('email')
                            ->label('Email')
                            ->email()
                            ->required(),
                        TextInput::make('cpf')
                            ->label('CPF')
                            ->required(),
                        TextInput::make('password')
                            ->label('password')
                            ->dehydrateStateUsing(fn (string $state): string => Hash::make($state))
                            ->dehydrated(fn (?string $state): bool => filled($state))
                            ->required(),
                        Select::make('roles')
                            ->options([
                                'corretor' => 'Corretor',
                                'super_admin' => 'Administrador',
                            ])
                            ->required(),
                    ]),
            ])
            ->columns([
                TextColumn::make('email'),
                TextColumn::make('roles.name'),
            ])
            ->filters([
                // ...
            ])
            ->actions([
                Action::make('editar')
                    ->color('info'),
                Action::make('deletar')
                    ->color('danger')
                    ->action(fn (User $record) => $record->delete())
                    ->requiresConfirmation()
            ]);
    }

    public static function canAccess(): bool
    {
        return auth()->user()->hasRole('super_admin');
    }
}
