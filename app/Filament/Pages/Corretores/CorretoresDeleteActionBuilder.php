<?php

namespace App\Filament\Pages\Corretores;

use App\Models\User;
use Filament\Notifications\Notification;
use Filament\Tables\Actions\DeleteAction;

class CorretoresDeleteActionBuilder
{
    public function build()
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
