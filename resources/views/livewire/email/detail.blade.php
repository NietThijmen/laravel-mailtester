<div>
    <flux:tab.group class="w-full">
        <flux:tabs wire:model="tab">
            <flux:tab name="details">Details</flux:tab>
            <flux:tab name="html">Html</flux:tab>
            <flux:tab name="text">Text</flux:tab>
            <flux:tab name="raw">Raw</flux:tab>
            <flux:tab name="attachments">Attachments</flux:tab>

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
            <iframe srcdoc="{{ $email->html }}" class="w-full min-h-96 max-h-screen overflow-y-scroll"></iframe>
        </flux:tab.panel>

        <flux:tab.panel name="text">
            <pre>{{$email->text}}</pre>
        </flux:tab.panel>

        <flux:tab.panel name="raw">
            <pre>{{$email->raw}}</pre>
        </flux:tab.panel>


    </flux:tab.group>
</div>
