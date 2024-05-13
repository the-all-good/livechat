<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\Attributes\On;
use App\Models\ChatLink;

class ActiveList extends Component
{
    public function getListeners()
    {
        return [
            // Public Channel
            "echo:message-change,.message-change" => 'render',
 
            // Private Channel

 
            // Presence Channel

        ];
    }

    public function getActive()
    {
        $active = ChatLink::where('status', ChatLink::STATUS_ACTIVE)->get();
        if(!empty($active)){
            return $active;
        }
        return false;
    }

    public function close(ChatLink $chat)
    {
        if($chat->status == ChatLink::STATUS_ACTIVE){
            $chat->status = ChatLink::STATUS_COMPLETE;
            $chat->save();
        }
        $this->dispatch('chat-change');
    }

    public function monitor(ChatLink $chat): void
    {
        $this->dispatch('view-chat', chat: $chat);
    }

    #[On('chat-change')]
    public function render()
    {
        if($this->getActive()){
            return view('livewire.active-list', ['active' => $this->getActive()]);
        }

        return view('livewire.active-list');
    }
}
