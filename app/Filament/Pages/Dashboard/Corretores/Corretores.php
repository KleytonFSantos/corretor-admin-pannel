<?php

namespace App\Filament\Pages\Dashboard\Corretores;

use App\Enums\RolesEnum;
use App\Models\User;
use Filament\Actions\Concerns\InteractsWithActions;
use Filament\Actions\Contracts\HasActions;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Pages\Page;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Concerns\InteractsWithTable;
use Filament\Tables\Contracts\HasTable;
use Filament\Tables\Table;

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
            ->query(User::query()->whereNot('roles_id', '=', RolesEnum::SUPER_ADMIN->value))
            ->headerActions([
                (new CorretoresCreateAction())->handler()
            ])
            ->columns([
                TextColumn::make('id'),
                TextColumn::make('email'),
                TextColumn::make('name'),
                TextColumn::make('getRoles.name'),
            ])
            ->filters([

            ])
            ->actions([
                (new CorretoresEditAction())->handler(),
                (new CorretoresDeleteAction())->handler(),
            ]
        );
    }

    public static function canAccess(): bool
    {
        return auth()->user()->hasRole('super_admin');
    }
}
