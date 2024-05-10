<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\Attributes\On;
use App\Models\ChatLink;

class ActiveList extends Component
{
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

    #[On('chat-change')]
    public function render()
    {
        if($this->getActive()){
            return view('livewire.active-list', ['active' => $this->getActive()]);
        }

        return view('livewire.active-list');
    }
}
