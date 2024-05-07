<div>
    <div class="text-white border-solid border-white">
        Message areas
        @if (isset($messages))
            @foreach ($messages as $message)
                <div>
                    {{ $message['message'] }}
                </div>
            @endforeach
        @endif
    </div>
    <div>
        @if (!isset($messages))
            <form wire:submit="request">
                <div>
                    <label for="email" class="text-white">Email: </label>
                    <input type="text" wire:model="email" name="email" placeholder="Example@domain.tld" id="email">
                </div>
                <div>
                    <label for="name" class="text-white">Name: </label>
                    <input type="text" wire:model="name" name="name" placeholder="John Doe" id="name">
                </div>
        @else
        <form wire:submit="send_message">
        @endif
        @csrf
            <input type="text" wire:model.change="message" placeholder="Send Message">
            <button type="submit" class="bg-white p-2 rounded-lg hover:bg-gray-400 cursor-pointer">
                Send Message
            </button>
        </form>
    </div>
</div>
