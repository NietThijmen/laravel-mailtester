<div class="flex flex-col bg-white dark:bg-neutral-800 rounded-lg shadow-md overflow-hidden">
    <!-- Header -->
    <div class="p-4 border-b border-neutral-200 dark:border-neutral-700 flex justify-between items-center">
        <div>
            <h1 class="text-lg font-semibold text-gray-900 dark:text-white">{{ $email->header }}</h1>
            <p class="text-sm text-gray-500 dark:text-gray-400">
                <strong>From:</strong> {{ $email->from }}<br>
                <strong>To:</strong> {{ $email->to }}
            </p>
        </div>
        <div class="flex items-center gap-2">
            <flux:button class="px-3 py-1 text-sm " variant="danger" wire:click="deleteEmail" icon="trash"></flux:button>
        </div>
    </div>

    <!-- Email Content -->
    <div class="p-4">

        @php
            $items = ['Html', 'Text'];
            if($has_spam) {
                $items[] = "Spam";
            }
        @endphp

        <x-group.group
            :items="$items">

            <x-group.item name="Text">
                <div class="mb-4">
                    <h2 class="text-sm font-medium text-gray-700 dark:text-gray-300">Message</h2>
                    <div class="mt-2 text-sm text-gray-900 dark:text-gray-200">
                        {!! nl2br(e($email->text)) !!}
                    </div>
                </div>
            </x-group.item>

            <x-group.item name="Html">
                                <div class="mb-4">
                                    <h2 class="text-sm font-medium text-gray-700 dark:text-gray-300">Html</h2>
                                    <iframe class="w-full h-full min-h-screen" srcdoc="{{$email->html}}"></iframe>
                                </div>
            </x-group.item>

            <x-group.item name="Spam">
                <div class="mb-4">
                    <h2 class="text-sm font-medium text-gray-700 dark:text-gray-300">Spam</h2>

                    @if($has_spam)
                        <div class="mt-2 text-sm text-gray-900 dark:text-gray-200">
                            <p>Spam Score: {{ $email->spamassasin->score }}</p>
                            @foreach($email->spamassasin->reports as $report)
                                <p class="my-4">
                                    <strong>Points: </strong> {{ $report->points }}<br>
                                    <strong>Comment: </strong><span class="text-sm text-gray-500 dark:text-gray-400">{{ $report->description }}</span>
                                </p>
                            @endforeach
                        </div>
                    @endif
                </div>
            </x-group.item>

        </x-group.group>

        @if($has_attachments)
            <div class="mt-4">
                <h2 class="text-sm font-medium text-gray-700 dark:text-gray-300">Attachments</h2>
                <div class="mt-2 flex flex-wrap gap-4">
                    @foreach($email->getMedia('*') as $media)
                        <div class="p-2 border border-neutral-200 dark:border-neutral-700 rounded-md">
                            <p class="text-sm text-gray-500 dark:text-gray-400">
                                <strong>{{ $media->name }}</strong> ({{$media->human_readable_size}})<br>
                                <a href="{{ $media->getUrl() }}" class="text-blue-500 dark:text-blue-400">Download</a>
                            </p>
                        </div>
                    @endforeach
                </div>
            </div>
        @endif
    </div>

    <!-- Comments Section -->
    <div class="p-4 border-t border-neutral-200 dark:border-neutral-700">
        <h2 class="text-sm font-medium text-gray-700 dark:text-gray-300">Comments</h2>
        <div class="mt-2 space-y-4">
            @foreach($email->comments as $comment)
                <div class="p-3 bg-neutral-100 dark:bg-neutral-700 rounded-md">
                    <p class="text-sm text-gray-900 dark:text-white">
                        <strong>{{ $comment->user->name }}</strong> - {{ $comment->created_at->diffForHumans() }}
                    </p>
                    <p class="text-sm text-gray-700 dark:text-gray-300">{{ $comment->message }}</p>
                </div>
            @endforeach
        </div>

        <div class="mt-4">
            <flux:textarea
                :label="__('Add a comment')"
                wire:model.defer="comment"
                :placeholder="__('Write your comment here...')"
            />
            <flux:button class="mt-2" wire:click="addComment">Post Comment</flux:button>
        </div>
    </div>
</div>
