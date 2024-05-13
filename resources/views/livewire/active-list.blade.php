<div class="dark:text-white overflow-y-scroll overflow-x-hidden scroll-bar w-fit">
        @foreach ($active as $activeChat)

            <div class="border-2 border-black border-solid bg-slate-200 text-black overflow-ellipsis w-full p-1 flex flex-col text-left">
                <button type="button" wire:click="monitor({{ $activeChat->id}})">
                        {{ $activeChat['name']}}: {{ $activeChat['email']}}
                        <br>
                        <p class="italic">
                        "{{ $activeChat->last_message()->message }}"
                        </p>
                        
                        <button type="submit" wire:click="close({{ $activeChat->id }})" class=" hover:underline hover:text-blue-800 font-bold">Close</button>
                </button>
            </div>
            
        @endforeach
</div>