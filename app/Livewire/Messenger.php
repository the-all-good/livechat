<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\ChatLink;
use App\Models\Messages;
use Illuminate\Validation\ValidationException;


class Messenger extends Component
{   
    public $message = "";

    public $name = "";

    public $email = "";

    public function getChat()
    {
        $chat_link = ChatLink::where('session', session()->getId())->get('id')->first();
        if($chat_link){
            return $chat_link;
        }
        return false;
    }

    public function request()
    {
        if($this->getChat()){
            throw ValidationException::withMessages(['error' => 'Chat Session Already exists']);
        }

        $validate = $this->validate([
            'email' => ['email', 'required'],
            'name' => ['string', 'required', 'regex:/[A-z -]*/'],
            'message' => ['string', 'max:5000', 'required']
        ]);

        $chat = ChatLink::create([
            'session' => session()->getId(),
            'staff_id' => null,
            'email' => $validate['email'],
            'name' => $validate['name'],
            'status' => ChatLink::STATUS_PENDING,
        ]);

        $message = Messages::create([
            'chat_id' => $chat->id,
            'message' => $validate['message'],
        ]);

        $this->reset('message');

        return view('livewire.messenger');
    }

    public function send_message()
    {
        if(!$this->getChat()){
            throw ValidationException::withMessages(['error' => 'Chat Session Already exists']);
        }
        $validate = $this->validate([
            'message' => ['string', 'max:5000', 'required']
        ]);

        $message = Messages::create([
            'chat_id' => $this->getChat()->id,
            'message' => $validate['message'],
        ]);

        $this->reset('message');

        return view('welcome');
    }

    public function render()
    {
        $chat_link = ChatLink::where('session', session()->getId())->get('id')->first();
        if($chat_link){
            $messages = Messages::where('chat_id', $chat_link['id'])->get('message');
            return view('livewire.messenger', ['messages' => $messages]);
        }
        return view('livewire.messenger');
    }
}
