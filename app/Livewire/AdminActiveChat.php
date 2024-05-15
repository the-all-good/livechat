<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\Attributes\On;
use App\Models\ChatLink;
use App\Models\Messages;
use App\Events\PrivateMessage;
use App\Events\MessageEvent;

class AdminActiveChat extends Component
{
    public $chat = null;

    public $message = "";

    public function getListeners()
    {
        $listeners = [
            // Public Channel
            "echo:message-change,.message-change" => 'render',            
        ];

        return $listeners;
    }

    #[On('view-chat')]
    public function view_chat(ChatLink $chat)
    {
        $this->getListeners();
        $this->chat = $chat;
    }

    public function send_message()
    {
        $validate = $this->validate([
            'message' => ['string', 'max:5000', 'required'],
        ]);

        $message_create = Messages::create([
            'chat_id' => $this->chat->id,
            'message' => $validate['message'],
            'staff_sent' => 1,
        ]);

        MessageEvent::dispatch('hidden');

        $this->reset('message');

        return view('dashboard');
    }
    
    public function render()
    {
        if($this->chat !== null){
            return view('livewire.admin-active-chat', ['chat' => $this->chat]);
        }
        return view('livewire.admin-active-chat');
    }
}
