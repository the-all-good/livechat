<div class="dark:text-white overflow-y-scroll overflow-x-hidden scroll-bar w-fit">
    @if (isset($active))
        @foreach ($active as $activeChat)
            <div class="border-2 border-black border-solid bg-slate-200 text-black overflow-ellipsis w-full p-1">
                {{ $activeChat['name']}}: {{ $activeChat['email']}}
                <br>
                <p class="italic">
                "{{ $activeChat->last_message()->message }}"
                </p>

            </div>
        @endforeach
    @endif
</div>