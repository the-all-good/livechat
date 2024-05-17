<div>
    <div class="text-white border-solid border-white">
        Chat Status: {{ isset($chat) ? ucwords($chat->status) : "Not Connected"}} <br>
        Agent: {{ isset($chat->staff) ? ucwords($chat->staff->name) : "No Agent" }}
        @if (isset($chat->messages))
        <div class="bg-white border-solid border-gray-500 rounded-md flex-col p-1 h-80 overflow-y-scroll scroll-bar snap-end overflow-auto break-message">
            @foreach ($chat->messages as $message)
                @if ($message->staff_sent)
                    <div class="w-full flex justify-start">
                        <div class="bg-gray-400 rounded-xl p-1 px-2 w-fit m-1 max-w-3/5">
                @else
                    <div class="w-full flex justify-end">
                        <div class="bg-blue-400 rounded-xl p-1 px-2 w-fit m-1 max-w-3/5">
                @endif      
                            {{ $message['message'] }}
                        </div>
                    </div>
            @endforeach
        </div>
        @endif
    </div>
    <div>
        @if (!isset($chat))
            <form wire:submit="request">
                    <div class="grid grid-rows-2 grid-cols-5 gap-2 w-full mb-2">
                        <label for="email" class="dark:text-white flex justify-end items-center text-right">Email: </label>
                        <input type="text" class=" rounded-md col-span-4" wire:model="email" name="email" placeholder="Example@domain.tld" id="email">

                        <label for="name" class="dark:text-white flex justify-end items-center text-right">Name: </label>
                        <input type="text" class=" rounded-md col-span-4" wire:model="name" name="name" placeholder="John Doe" id="name">
                    </div>
        @else
        <form wire:submit="send_message">
        @endif
        @csrf
        @if(!isset($chat) || $chat->status !== App\Models\ChatLink::STATUS_COMPLETE)
        <div class="rounded-lg bg-white flex justify-between w-full">
            <input type="text" wire:model.change="message" placeholder="Type a message..." class="rounded-l-lg border-none grow break-words peer focus:ring-transparent">
            <button type="submit" class="bg-white p-2 rounded-r-lg hover:underline hover:text-white hover:bg-blue-400 hover:font-bold cursor-pointer w-fit focus:outline-none">
                Send
            </button>
        </div>
        @endif
        </form>
    </div>
</div>
