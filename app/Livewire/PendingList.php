<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\ChatLink;
use App\Events\MessageEvent;

class PendingList extends Component
{
    protected $listeners = [
        'echo:message-change:MessageEvent' => 'render'
    ];

    public function getPending()
    {
        $pending = ChatLink::where('status', ChatLink::STATUS_PENDING)->get();
        if(!empty($pending)){
            return $pending;
        }
        return false;
    }

    public function accept(ChatLink $chat)
    {
        if($chat->status == ChatLink::STATUS_PENDING){
            $chat->status = ChatLink::STATUS_ACTIVE;
            $chat->save();
        }
        $this->dispatch('chat-change');
    }

    public function close(ChatLink $chat)
    {
        if($chat->status == ChatLink::STATUS_PENDING){
            $chat->status = ChatLink::STATUS_COMPLETE;
            $chat->save();
        }
        $this->dispatch('chat-change');
    }

    #[On('echo:message-change,MessageEvent')]
    public function render()
    {
        if($this->getPending()){
            return view('livewire.pending-list', ['pending' => $this->getPending()]);
        }

        return view('livewire.pending-list');
    }
}
