<?php

namespace App\Filament\Pages;

use Filament\Actions\Action;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Notifications\Notification;
use Filament\Pages\Page;
use App\Models\Feedback as FeedbackModel;
use Filament\Schemas\Components\Actions;
use Filament\Schemas\Components\Section;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Concerns\InteractsWithTable;
use Filament\Tables\Contracts\HasTable;
use Illuminate\Support\Facades\DB;

class Feedback extends Page implements HasForms, HasTable
{
    use InteractsWithForms;
    use InteractsWithTable;

    public static function getNavigationLabel(): string
    {
        return __('trans.feedback.navigation');
    }

    public function getTitle(): string
    {
        //opcja by miec rozne tytuly w zaleznosci od roli

        /*return auth()->user()?->role === \App\Enums\Roles::Admin
            ? __('trans.feedback.title_admin')
            : __('trans.feedback.title_user');*/
        return __('trans.feedback.title');
    }

    protected static string|null|\BackedEnum $navigationIcon = 'heroicon-o-chat-bubble-left';
    protected string $view = 'filament.pages.feedback';
    protected static ?int $navigationSort = 3;
    public $content;

    // Schemat formularza
    protected function getFormSchema(): array
    {
        return [
            Section::make()
                ->schema([
                Textarea::make('content')
                    ->label(__('trans.feedback.label'))
                    ->required()
                    ->rows(10),
                ]),
                    Actions::make([
                        Action::make('submit')
                            ->label(__('trans.feedback.submit'))
                            ->submit('submit') // wywoła metodę submit()
                            ->color('primary'),
            ])
        ];
    }

    // metoda submit dla usera
    public function submit()
    {
        $this->form->validate();

        FeedbackModel::create([
            'user_id' => auth()->id(),
            'content' => $this->content,
        ]);

        Notification::make()
            ->success()
            ->title(__('filament-panels::resources/pages/create-record.notifications.created.title'))
            ->send();
        return redirect('/dashboard');
    }


    protected function getTableQuery()
    {

        return FeedbackModel::query()
            ->with('user');
    }

    protected function getTableColumns(): array
    {
        return [
            TextColumn::make('user.last_name')
                ->label('Użytkownik'),

            TextColumn::make('content')
                ->label('Opinia')
                ->limit(50)
                ->wrap(),

            TextColumn::make('created_at')
                ->label('Data')
                ->dateTime('d-m-Y H:i')
                ->sortable(),
        ];
    }

    protected function getTableActions(): array
    {
        return [
            // brak edycji/usuwania, można dodać np. przycisk "Pokaż szczegóły" jeśli chcesz
        ];
    }


}
