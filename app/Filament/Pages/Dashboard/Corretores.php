<?php

namespace App\Filament\Pages\Dashboard;

use App\Models\User;
use Filament\Forms\Components\Section;
use Filament\Tables\Actions\Action;
use Filament\Facades\Filament;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Select;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Forms\Form;
use Filament\Pages\Page;
use Filament\Tables\Actions\EditAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Concerns\InteractsWithTable;
use Filament\Tables\Contracts\HasTable;
use Filament\Tables\Table;
use Illuminate\Database\Query\Builder;

class Corretores extends Page implements HasForms, HasTable
{
    use InteractsWithForms;
    use InteractsWithTable;

    public ?array $data = [];
    protected static ?string $navigationIcon = 'heroicon-o-document-text';

    protected static string $view = 'filament.pages.dashboard.corretores';

    public User $user;

    public function mount(): void
    {
        $this->user = Filament::getCurrentPanel()->auth()->user();

        $this->form->fill(['teste' => 'testando']);

    }

    public function table(Table $table): Table
    {
        return $table
            ->query(User::query())
            ->headerActions([
                Action::make('Adicionar')
                    ->color('success')
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

//    public function form(Form $form): Form
//    {
//        return $form->schema([
//            Repeater::make('members')
//                ->schema([
//                    Select::make('role')
//                        ->options([
//                            'corretor' => 'Corretor',
//                            'administrador' => 'Administrador',
//                        ])
//                        ->required(),
//                ]),
//        ])
//        ->columns(2);
//    }

    public static function canAccess(): bool
    {
        return auth()->user()->hasRole('super_admin');
    }
}
