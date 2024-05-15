<div>
    <div class="text-white border-solid border-white">
        Message areas: {{ isset($chat) ? ucwords($chat->status) : ""}}
        @if (isset($chat->messages))
        <div class="bg-white border-solid border-gray-500 rounded-md flex-col p-1 h-80 overflow-y-scroll scroll-bar snap-end overflow-auto break-message">
            @foreach ($chat->messages as $message)
                @if ($message->staff_sent)
                    <div class="w-full flex justify-end">
                @else
                    <div class="w-full flex justify-start">
                @endif
                        <div class="bg-blue-400 rounded-xl p-1 px-2 w-fit m-1 max-w-3/5">
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
                <div>
                    <label for="email" class="dark:text-white">Email: </label>
                    <input type="text" wire:model="email" name="email" placeholder="Example@domain.tld" id="email">
                </div>
                <div>
                    <label for="name" class="dark:text-white">Name: </label>
                    <input type="text" wire:model="name" name="name" placeholder="John Doe" id="name">
                </div>
        @else
        <form wire:submit="send_message">
        @endif
        @csrf
        <div class="rounded-lg bg-white flex justify-between w-full">
            <input type="text" wire:model.change="message" placeholder="Type a message..." class="rounded-l-lg border-none grow break-words peer focus:ring-transparent">
            <button type="submit" class="bg-white p-2 rounded-r-lg hover:underline hover:text-white hover:bg-blue-400 hover:font-bold cursor-pointer w-fit focus:outline-none">
                Send
            </button>
        </div>
        </form>
    </div>
</div>
