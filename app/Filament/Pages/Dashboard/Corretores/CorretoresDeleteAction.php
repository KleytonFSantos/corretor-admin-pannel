<?php

namespace App\Filament\Pages\Dashboard\Corretores;

use App\Models\User;
use Filament\Notifications\Notification;
use Filament\Tables\Actions\DeleteAction;

class CorretoresDeleteAction
{
    public function handler()
    {
        return DeleteAction::make('deletar')
            ->color('danger')
            ->action(fn (User $record) => $record->delete())
            ->requiresConfirmation()
            ->successNotification(function (Notification $notification): Notification {
                return Notification::make()
                    ->success()
                    ->title('Deletado com sucesso!');
            });
    }
}
