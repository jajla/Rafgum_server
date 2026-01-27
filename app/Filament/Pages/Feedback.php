<?php

namespace App\Filament\Pages;

use Filament\Forms\Components\Textarea;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Pages\Page;
use App\Models\Feedback as FeedbackModel;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Concerns\InteractsWithTable;
use Filament\Tables\Contracts\HasTable;

class Feedback extends Page implements HasForms, HasTable
{
    use InteractsWithForms;
    use InteractsWithTable;
    protected static string|null|\BackedEnum $navigationIcon = 'heroicon-o-chat-bubble-left';
    protected static ?string $navigationLabel = 'Feedback';
    protected string $view = 'filament.pages.feedback';
    protected static ?int $navigationSort = 3;
    public $content;

    // Schemat formularza
    protected function getFormSchema(): array
    {
        return [
            Textarea::make('content')
                ->label('Twoja opinia')
                ->required()
                ->rows(10),
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

      //  $this->notify('success', 'Opinia została wysłana!');
        $this->reset('content');
    }

    protected function getTableQuery()
    {
        return FeedbackModel::query()
            ->with('user') // jeśli chcesz pokazać kto wysłał
            ->orderBy('created_at', 'desc');
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
