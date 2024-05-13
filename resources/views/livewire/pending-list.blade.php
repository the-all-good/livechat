<div class="dark:text-white overflow-y-scroll overflow-x-hidden scroll-bar w-fit">
        @foreach ($pending as $pendingChat)
        
            <div class="border-2 border-black border-solid bg-slate-200 text-black overflow-ellipsis w-full p-1 flex flex-col text-left">
                <button type="button" wire:click="monitor({{ $pendingChat->id }})">
                    {{ $pendingChat['name']}}: {{ $pendingChat['email']}}
                    <br>
                    <p class="italic">
                    "{{ $pendingChat->last_message()->message }}"
                    </p>

                    <button type="submit" wire:click="accept({{ $pendingChat->id }})" class=" hover:underline hover:text-blue-800 font-bold">Accept</button>
                    <button type="submit" wire:click="close({{ $pendingChat->id }})" class=" hover:underline hover:text-blue-800 font-bold">Decline</button>
                </button>
            </div>

        @endforeach
</div>
