<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\Attributes\On;
use App\Models\ChatLink;

class AdminActiveChat extends Component
{
    public $chat = null;

    #[On('view-chat')]
    public function view_chat(ChatLink $chat)
    {
        $this->chat = $chat;
    }


    public function render()
    {
        if($this->chat !== null){
            return view('livewire.admin-active-chat', ['chat' => $this->chat]);
        }
        return view('livewire.admin-active-chat');
    }
}
