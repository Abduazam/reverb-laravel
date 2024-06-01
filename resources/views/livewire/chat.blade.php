<div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
    <div class="flex gap-3">
        <div class="col-1 w-2/5 bg-white overflow-hidden shadow-sm sm:rounded-lg px-5 pb-2">
            <ul role="list" class="divide-y divide-gray-100 py-4">
                @foreach($users as $user)
                    <li wire:click="selectUser({{ $user->id }})" class="flex justify-between gap-x-6 py-2 my-1 px-3">
                        <div class="flex min-w-0 gap-x-4">
                            <span class="flex items-center justify-center w-10 h-10 @if($this->user?->id === $user->id) bg-indigo-500 @else bg-gray-500 @endif text-center text-white rounded-full">
                                {{ $user->name[0] }}
                            </span>
                            <div class="min-w-0 flex-auto">
                                <p class="text-sm font-semibold leading-6 text-gray-900 border-b @if($this->user?->id === $user->id) border-indigo-500 @else border-white @endif">{{ $user->name }}</p>
                                <p class="truncate text-xs leading-5 text-gray-500">{{ $user->email }}</p>
                            </div>
                        </div>
                    </li>
                @endforeach
            </ul>
        </div>
        <div class="col-1 w-full bg-white overflow-hidden shadow-sm sm:rounded-lg">
        @if($this->user)
            <div class="p-4 flex items-center">
                <span class="flex items-center justify-center w-10 h-10 bg-gray-500 text-center text-white rounded-full">
                    {{ $this->user->name[0] }}
                </span>
                <div class="ms-2">
                    <p class="font-semibold">{{ $this->user->name }}</p>
                    <p class="text-sm text-gray-600">{{ $this->user->email }}</p>
                </div>
            </div>
            <div class="border-t border-gray-200"></div>
            <div class="p-4" style="max-height: 400px; overflow-y: auto;">
                @if($this->messages)
                    @foreach($this->messages as $message)
                        @if($message->sender_id === $this->me->id)
                            <div class="mb-4">
                                <div class="flex items-start justify-end">
                                    <div class="bg-blue-500 text-white p-3 rounded-lg shadow">
                                        <p>{{ $message->message }}</p>
                                        <p class="text-xs text-blue-200 mt-1">{{ $message->created_at->format('g:i A') }}</p>
                                    </div>
                                </div>
                            </div>
                        @else
                            <div class="mb-4">
                                <div class="flex items-start">
                                    <div class="bg-gray-100 text-gray-800 p-3 rounded-lg shadow">
                                        <p>{{ $message->message }}</p>
                                        <p class="text-xs text-gray-500 mt-1">{{ $message->created_at->format('g:i A') }}</p>
                                    </div>
                                </div>
                            </div>
                        @endif
                    @endforeach
                @endif
            </div>
            <div class="border-t border-gray-200"></div>
            <div class="p-4 flex items-center">
                <form wire:submit.prevent="send" class="flex items-center w-full">
                    <input wire:model="message" type="text" placeholder="Write your message here.." class="flex-1 p-2 border border-gray-300 rounded-lg mr-2">
                    <button type="submit" class="bg-indigo-500 text-white p-2 rounded-lg">Send</button>
                </form>
            </div>
        @endif
        </div>
    </div>
</div>
