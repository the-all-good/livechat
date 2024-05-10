<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\ChatLink;
use App\Models\Messages;
use App\Events\MessageEvent;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Str;
use Illuminate\Contracts\Encryption\DecryptException;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Queue\SerializesModels;


class Messenger extends Component implements ShouldBroadcast
{   
    public $message = "";

    public $name = "";

    public $email = "";

    public function broadcastOn(): array
    {
        return [
            new PrivateChannel()
        ];
    }

    public function getChat()
    {
        if(session()->get('chat_link') !== null){
            $id = Crypt::decryptString(session()->get('chat_link'));
            $chat_link = ChatLink::where('session', $id)->get()->first();
        }

        if(isset($chat_link)){
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

        $uuid = Str::uuid();
        session(['chat_link' => Crypt::encryptString($uuid)]);

        $chat = ChatLink::create([
            'session' => $uuid,
            'staff_id' => null,
            'email' => $validate['email'],
            'name' => $validate['name'],
            'status' => ChatLink::STATUS_PENDING,
        ]);

        $message_create = Messages::create([
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

        $message_create = Messages::create([
            'chat_id' => $this->getChat()->id,
            'message' => $validate['message'],
        ]);

        event(new MessageEvent);

        $this->reset('message');

        return view('welcome');
    }

    #[On('echo:chat-change')]
    public function render()
    {
        $chat_link = $this->getChat();
        
        if($chat_link){
            return view('livewire.messenger', ['chat' => $chat_link]);
        }

        return view('livewire.messenger');
    }
}
