<?php

namespace App\Livewire;

use App\Events\MessageOnChat;
use App\Models\User;
use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Collection;
use Livewire\Attributes\On;
use Livewire\Component;

class Chat extends Component
{
    public User $me;

    public ?User $user = null;

    public ?Collection $messages = null;

    public string $message = '';

    public function mount(): void
    {
        $this->me = auth()->user();
    }

    public function selectUser(int $id): void
    {
        $this->user = User::findOrFail($id);

        $this->selectMessage();
    }

    public function selectMessage(): void
    {
        $this->messages = $this->me->messagesWith($this->user);

        $this->reset('message');
    }

    public function send(): void
    {
        MessageOnChat::dispatch($this->me->id, $this->user?->id, $this->message);
    }

    #[On('echo:messages,MessageOnChat')]
    public function onMessage($event): void
    {
        $this->selectMessage();
    }

    public function render(): View
    {
        return view('livewire.chat', [
            'users' => User::exceptMe()->get()
        ]);
    }
}
