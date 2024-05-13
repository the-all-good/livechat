<div class="dark:text-white h-screen flex grow flex-col w-auto m-2 ">
    <div class="flex flex-col h-screen">
        <div class="border rounded-lg flex-1 bg-white overflow-scroll scroll-bar w-full">
            <div class="mx-2 overflow-y-auto ">
            @if (isset($chat->messages))
                @foreach ($chat->messages as $message)

                        <div class="bg-blue-400 rounded-xl p-1 px-2 w-fit m-1 max-w-3/5">
                            {{ $message['message'] }}
                        </div>

                @endforeach
            @endif
            </div>

        </div>
        <div class="mb-2">
            <form wire:submit="send_message" class="flex grow w-full">
            @csrf
            <div class="rounded-lg bg-white flex justify-between my-2 w-full">
                <input type="text" wire:model.change="message" placeholder="Type a message..." class="rounded-l-lg border-none grow break-words peer focus:ring-transparent">
                <button type="submit" class="text-black bg-white p-2 rounded-r-lg hover:underline hover:text-white hover:bg-blue-400 hover:font-bold cursor-pointer focus:outline-none">
                    Send
                </button>
            </div>
            </form>
        </div>
    </div>
</div>
