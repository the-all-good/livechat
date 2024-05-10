<div class="dark:text-white overflow-y-scroll overflow-x-hidden scroll-bar w-fit">
    @if (isset($pending))
        @foreach ($pending as $pendingChat)
            <div class="border-2 border-black border-solid bg-slate-200 text-black overflow-ellipsis w-full p-1">
                {{ $pendingChat['name']}}: {{ $pendingChat['email']}}
                <br>
                <p class="italic">
                "{{ $pendingChat->last_message()->message }}"
                </p>

                <button type="submit" wire:click="accept({{ $pendingChat }})" class=" hover:underline hover:text-blue-800 font-bold">Accept</button>
                <button type="submit" wire:click="close({{ $pendingChat }})" class=" hover:underline hover:text-blue-800 font-bold">Decline</button>
            </div>
        @endforeach
    @endif
</div>
