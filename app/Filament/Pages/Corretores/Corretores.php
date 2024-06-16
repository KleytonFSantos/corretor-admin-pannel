<?php

namespace App\Filament\Pages\Corretores;

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
                (new CorretoresCreateActionBuilder())->build()
            ])
            ->columns([
                TextColumn::make('id'),
                TextColumn::make('email')
                    ->searchable(),
                TextColumn::make('name')
                    ->searchable(),
            ])
            ->filters([

            ])
            ->actions([
                (new CorretoresEditActionBuilder())->build(),
                (new CorretoresDeleteActionBuilder())->build(),
            ]
        );
    }

    public static function canAccess(): bool
    {
        return auth()->user()->getRoles->id === RolesEnum::SUPER_ADMIN->value;
    }
}
