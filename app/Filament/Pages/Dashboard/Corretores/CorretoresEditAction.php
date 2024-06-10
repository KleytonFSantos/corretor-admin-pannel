<?php

namespace App\Filament\Pages\Dashboard\Corretores;

use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Notifications\Notification;
use Filament\Tables\Actions\EditAction;
use Illuminate\Support\Facades\Hash;

class CorretoresEditAction
{

    public function handler(): EditAction
    {
        return EditAction::make()
            ->form([
                TextInput::make('name')
                    ->label('Nome'),
                TextInput::make('email')
                    ->label('Email')
                    ->email()
                    ->unique(),
                TextInput::make('cpf')
                    ->label('CPF')
                    ->mask('999.999.999-99')
                    ->dehydrateStateUsing(fn (string $state): string => str_replace(['.', '-'], '', $state)),
                TextInput::make('password')
                    ->label('password')
                    ->dehydrateStateUsing(fn (string $state): string => Hash::make($state))
                    ->dehydrated(fn (?string $state): bool => filled($state)),
                Select::make('roles')
                    ->options([
                        'corretor' => 'Corretor',
                        'super_admin' => 'Administrador',
                    ])
            ])
            ->color('info')
            ->successNotification(function (Notification $notification): Notification {
                return Notification::make()
                    ->success()
                    ->title('Atualizado com sucesso!');
            });
    }
}
