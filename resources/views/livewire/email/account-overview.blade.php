<div class="h-full flex flex-col bg-white dark:bg-neutral-800 overflow-hidden">
    <!-- Header -->
    <div class="p-4 border-b border-neutral-200 dark:border-neutral-700 flex justify-between items-center">
        <h2 class="text-xl font-semibold text-gray-800 dark:text-white">Mailbox</h2>
    </div>

    <!-- Email List -->
    <div class="overflow-y-auto flex-grow" wire:poll>
        @if($emails->count() > 0)
            <ul class="divide-y divide-gray-200 dark:divide-neutral-700">
                @foreach($emails as $email)
                    <li class="hover:bg-gray-50 dark:hover:bg-neutral-700/50 transition-colors duration-150 cursor-pointer group">
                        <div class="block p-4">
                            <a href="{{ route('emails.detail', $email->id) }}">
                                <div class="flex justify-between">
                                    <span class="font-medium text-gray-900 dark:text-white truncate max-w-[40%]">{{ $email->from }}</span>
                                    <span class="text-xs text-gray-500 dark:text-gray-400">{{ $email->created_at->diffForHumans() }}</span>
                                </div>
                                <div class="mt-1 text-sm text-gray-900 dark:text-gray-200 font-medium truncate">{{ $email->subject }}</div>
                                <div class="mt-1 text-xs text-gray-500 dark:text-gray-400 truncate">
                                    To: {{ $email->to }}
                                </div>

                                <div class="mt-1 text-sm text-gray-500 dark:text-gray-400 truncate">
                                    {{ Str::limit($email->header, 50) }}
                                </div>
                            </a>


                            <div class="mt-1 text-sm text-gray-500 dark:text-gray-400 truncate flex z-10">
                                <flux:button
                                    wire:click="deleteEmail({{$email->id}})"
                                    icon="trash"
                                    variant="danger"
                                    class="ml-auto z-10"
                                ></flux:button>
                            </div>
                        </div>
                    </li>
                @endforeach
            </ul>


            <div class="flex justify-center place-items-center">
                    <flux:button
                        x-on:click="$wire.set('page', $wire.page - 1)"
                        :disabled="$page < 1"
                    >Previous</flux:button>

                    <span class="flex-1 text-center">{{$page + 1}}/{{$pages}}</span>

                    <flux:button
                        x-on:click="$wire.set('page', $wire.page + 1)"
                        :disabled="$page >= $pages - 1"
                    >Next</flux:button>
            </div>

        @else
            <div class="flex items-center justify-center h-full text-gray-500 dark:text-gray-400">
                No emails found
            </div>
        @endif
    </div>
</div>
