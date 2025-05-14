<div>
    <flux:tab.group class="w-full">
        <flux:tabs wire:model="tab">
            <flux:tab name="details">Details</flux:tab>
            <flux:tab name="html">Html</flux:tab>
            <flux:tab name="text">Text</flux:tab>
            <flux:tab name="raw">Raw</flux:tab>
            <flux:tab name="attachments" :disabled="!$has_attachments">Attachments</flux:tab>

        </flux:tabs>


        <flux:tab.panel name="details">
            <p class="text-sm text-gray-500">
                <strong>To:</strong> {{ $email->to }}<br>
                <strong>From:</strong> {{ $email->from }}<br>
                <strong>Subject:</strong> {{ $email->header }}<br>
                <strong>Sent At:</strong> {{ $email->created_at }}<br>
            </p>

        </flux:tab.panel>
        <flux:tab.panel name="html">
            <div
                x-data="{
                    device: 'desktop',
                    devices: ['desktop', 'tablet', 'mobile'],

                    size: {
                        desktop: { width: 1920, height: 1080 }, // Desktop
                        tablet: { width: 1668, height: 2388 }, // Ipad Pro
                        mobile: { width: 1179, height: 2556 } // Iphone X
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

        </flux:tab.panel>

        <flux:tab.panel name="text">
            <pre>{{$email->text}}</pre>
        </flux:tab.panel>

        <flux:tab.panel name="raw">
            <pre>{{$email->raw}}</pre>
        </flux:tab.panel>

        <flux:tab.panel name="attachments">
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

        </flux:tab.panel>


    </flux:tab.group>
</div>
