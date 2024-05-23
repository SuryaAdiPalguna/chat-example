<?php

namespace App\Livewire;

use App\Models\Message;
use App\Models\User;
use Livewire\Component;

class Chat extends Component
{
    public User $user;

    public $message = '';
    
    public function render()
    {
        return view('livewire.chat', [
            'messages' => Message::where('from_user_id', auth()->id())
                ->orWhere('from_user_id', $this->user->id)
                ->orWhere('to_user_id', auth()->id())
                ->orWhere('to_user_id', $this->user->id)
                ->get()
        ]);
    }

    public function sendMessage()
    {
        Message::create([
            'from_user_id' => auth()->id(),
            'to_user_id' => $this->user->id,
            'message' => $this->message
        ]);

        $this->reset('message');
    }
}
