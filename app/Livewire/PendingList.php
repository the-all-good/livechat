<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\ChatLink;
use App\Events\MessageEvent;
use Livewire\Attributes\On; 

class PendingList extends Component
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

    public function getPending()
    {
        $pending = ChatLink::where('status', ChatLink::STATUS_PENDING)->get();
        if(!empty($pending)){
            return $pending;
        }
        return false;
    }

    public function accept(ChatLink $chat): void
    {
        if($chat->status == ChatLink::STATUS_PENDING){
            $chat->status = ChatLink::STATUS_ACTIVE;
            $chat->staff_id = auth()->user()->id;
            $chat->save();
        }
        MessageEvent::dispatch('accepted');
    }

    public function close(ChatLink $chat): void
    {
        if($chat->status == ChatLink::STATUS_PENDING){
            $chat->status = ChatLink::STATUS_COMPLETE;
            $chat->save();
        }
        MessageEvent::dispatch('closed');
    }

    public function monitor(ChatLink $chat): void
    {
        $this->dispatch('view-chat', chat: $chat);
    }

    public function render()
    {
        if($this->getPending()){
            return view('livewire.pending-list', ['pending' => $this->getPending()]);
        }

        return view('livewire.pending-list');
    }
}
