<div class="dark:text-white h-screen flex grow flex-col w-auto m-2">
    <div class="flex flex-col flex-grow h-full ">
        <div class="text-white border-solid border-white grow h-full overflow-hidden">
            <div class="bg-white border-solid border-gray-500 rounded-md flex-col h-full m-2 p-1 overflow-y-scroll scroll-bar snap-end overflow-auto break-message flex-grow">
            @if (isset($chat->messages))
                @foreach ($chat->messages as $message)

                        <div class="bg-blue-400 rounded-xl p-1 px-2 w-fit m-1 max-w-3/5">
                            {{ $message['message'] }}
                        </div>

                @endforeach
            @endif
            </div>

        </div>
        <div>
            <form wire:submit="send_message">
            @csrf
            <div class="rounded-lg bg-white flex justify-between m-2">
                <input type="text" wire:model.change="message" placeholder="Type a message..." class="rounded-l-lg border-none grow break-words peer focus:ring-transparent">
                <button type="submit" class="text-black bg-white p-2 rounded-r-lg hover:underline hover:text-white hover:bg-blue-400 hover:font-bold cursor-pointer w-fit focus:outline-none">
                    Send
                </button>
            </div>
            </form>
        </div>
    </div>
</div>
