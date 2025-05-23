<div class="h-full flex flex-col bg-white dark:bg-neutral-800 overflow-hidden">
    <!-- Header -->
    <div class="p-4 border-b border-neutral-200 dark:border-neutral-700 flex justify-between items-center">
        <h2 class="text-xl font-semibold text-gray-800 dark:text-white">Recent Messages</h2>
    </div>

    <!-- Email List -->
    <div class="overflow-y-auto flex-grow">
        @if($emails->count() > 0)
            <ul class="divide-y divide-gray-200 dark:divide-neutral-700">
                @foreach($emails as $email)
                    <li class="hover:bg-gray-50 dark:hover:bg-neutral-700/50 transition-colors duration-150 cursor-pointer group">
                        <a href="{{ route('emails.detail', $email->id) }}" class="block p-4">
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
                    </li>
                @endforeach
            </ul>
        @else
            <div class="flex items-center justify-center h-full text-gray-500 dark:text-gray-400">
                No emails found
            </div>
        @endif
    </div>
</div>
