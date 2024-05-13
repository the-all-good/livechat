<x-app-layout>
    <div class="flex flex-row h-screen w-screen">
        <div class="flex flex-col h-full max-w-64 dark:text-white ml-4">
            Active Chats
            <div class="flex basis-1/2 h-1/2 border-solid border-2 dark:border-white border-black overflow-y-scroll overflow-x-hidden scroll-bar w-full">
                <livewire:active-list></livewire>
            </div>

            Pending Chats
            <div class="flex basis-1/2 h-1/2 border-solid border-2 dark:border-white border-black overflow-y-scroll overflow-x-hidden scroll-bar w-full">
                <livewire:pending-list></livewire>
            </div>
        </div>
        <div class="flex flex-grow h-full overflow-hidden">
            <livewire:admin-active-chat />
        </div>
    </div>
</x-app-layout>
