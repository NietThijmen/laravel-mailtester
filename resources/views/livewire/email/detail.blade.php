<div>
    <x-group.group class="w-full"
        :items="[
            'Details',
            'Html',
            'Text',
            'Raw',
            'Attachments',
            'Spam',
            'Chat',
        ]"
    >




        <x-group.item name="Details">
            <p class="text-sm text-gray-500">
                <strong>To:</strong> {{ $email->to }}<br>
                <strong>From:</strong> {{ $email->from }}<br>
                <strong>Subject:</strong> {{ $email->header }}<br>
                <strong>Sent At:</strong> {{ $email->created_at }}<br>
            </p>

        </x-group.item>
        <x-group.item name="Html">
            <div
                x-data="{
                    device: 'desktop',
                    devices: ['desktop', 'tablet', 'mobile'],

                    size: {
                        desktop: { width: 960, height: 540 }, // Desktop (scale: 50%)
                        tablet: { width: 834, height: 1194 }, // Ipad Pro
                        mobile: { width: 590, height: 1278 } // Iphone X
                    },
                }"
            >

                <template x-for="deviceOption in devices">
                    <flux:button
                        x-on:click="
                        device = deviceOption;
                        "

                        class="px-2 py-1 text-sm rounded-md"
                    >
                        <span x-text="deviceOption.charAt(0).toUpperCase() + deviceOption.slice(1)"></span>
                    </flux:button>
                </template>




                <iframe
                    x-bind:width="size[device].width"
                    x-bind:height="size[device].height"

                    x-ref
                    x-transition

                    srcdoc="{{ $email->html }}" class="min-h-96 max-h-screen overflow-y-scroll"></iframe>
            </div>

        </x-group.item>

        <x-group.item name="Text">
            <pre>{{$email->text}}</pre>
        </x-group.item>

        <x-group.item name="Raw">
            <pre>{{$email->raw}}</pre>
        </x-group.item>

        <x-group.item name="Attachments">
            <div class="flex flex-col gap-2">
                @foreach($email->getMedia('*') as $media)
                    <div>
                        <p class="text-sm text-gray-500">
                            <strong>Name:</strong> {{ $media->name }}<br>
                            <strong>Bytes:</strong> {{ $media->human_readable_size }}<br>
                            <strong>Mime:</strong> {{ $media->mime_type }}<br>
                            <strong>Url:</strong> <a href="{{ $media->getUrl() }}">{{ $media->getUrl() }}</a><br>
                        </p>
                    </div>
                @endforeach
            </div>

        </x-group.item>

        <x-group.item name="Spam">
            @if(!$email->spamassasin)
                <h1>No spamassasin score found</h1>
            @else
                <p>Spamassasin score <span>{{$email->spamassasin?->score}}</span></p>
                <br/>
                <p>Score information: </p>
                <ul>
                    @foreach($email->spamassasin?->reports as $report)
                        <li>
                            <strong>{{ $report->points }}</strong>: {{ $report->description }}
                        </li>
                    @endforeach
            @endif

        </x-group.item>

        <x-group.item name="Chat" wire:poll>
            @foreach($email->comments as $comment)
                <div class="flex flex-col gap-2">
                    <p class="text-sm text-gray-500">
                        <strong>From:</strong> {{ $comment->user->name }}<br>
                        <strong>Created At:</strong> {{ $comment->created_at }}<br>
                        <strong>Comment:</strong> {{ $comment->message }}<br>
                    </p>
                </div>
            @endforeach


            <div class="flex flex-col gap-2 mt-5">
                <flux:textarea
                    :label="__('Comment')"
                    wire:model.defer="comment"
                    :placeholder="__('Add a comment')"
                />
                <flux:button wire:click="addComment">Add Comment</flux:button>
            </div>
        </x-group.item>



        </x-group.group>
</div>
