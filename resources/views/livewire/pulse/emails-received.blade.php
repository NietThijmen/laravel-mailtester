<x-pulse::card :cols="$cols" :rows="$rows" :class="$class" wire:poll.5s>
    <x-pulse::card-header name="Emails received"
        details="Emails received per account"
    >
        <x-slot:icon>
            <flux:icon.envelope/>
        </x-slot:icon>
    </x-pulse::card-header>

    <x-pulse::scroll :expand="$expand">
        @foreach ($emails as $email)
            {{ $email->key }}
            {{ $email->sum }}
            {{ $email->count }}
        @endforeach
    </x-pulse::scroll>
</x-pulse::card>
