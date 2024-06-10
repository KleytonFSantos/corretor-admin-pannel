<?php

namespace App\Filament\Pages\Dashboard\Corretores;

use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Notifications\Notification;
use Filament\Tables\Actions\CreateAction;
use Illuminate\Support\Facades\Hash;

class CorretoresCreateAction
{

    public function handler(): CreateAction
    {
        return CreateAction::make('Adicionar')
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
                    ->mask('999.999.999-99')
                    ->required()
                    ->autocomplete()
                    ->autofocus()
                    ->dehydrateStateUsing(fn (string $state): string => str_replace(['.', '-'], '', $state)),
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
            ])
            ->successNotification(function (Notification $notification): Notification {
                return Notification::make()
                    ->success()
                    ->title('Criado com sucesso!');
            });
    }
}
