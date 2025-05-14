<div>
    <table class="w-full">
        <thead>
            <tr class="bg-gray-50">
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                    #
                </th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                    {{ __('Recipient') }}
                </th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                    {{ __('Subject') }}
                </th>

                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                    {{ __('Action') }}
                </th>
        </thead>

        <tbody>
        @foreach($emails as $email)
            <tr class="bg-white border-b hover:bg-gray-50" wire:key="email-{{$email->id}}">
                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                    {{ $email->id }}
                </td>
                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                    {{ $email->to }}
                </td>
                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                    {{ $email->header }}
                </td>

                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                    <flux:button
                        href="{{ route('emails.detail', $email->id) }}"
                    >
                        View
                    </flux:button>
                </td>
            </tr>
        @endforeach

        <tfoot>
            <tr>
                <td colspan="1" class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                    <flux:button
                        x-on:click="$wire.set('page', $wire.page - 1)"
                        :disabled="$page < 1"
                    >Previous</flux:button>
                </td>

                <td colspan="2" class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 text-center">
                    <span>{{$page + 1}}/{{$pages}}</span>
                </td>

                <td colspan="1" class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                    <flux:button
                        x-on:click="$wire.set('page', $wire.page + 1)"
                        :disabled="$page >= $pages - 1"
                    >Next</flux:button>
                </td>
            </tr>
        </tfoot>
        </tbody>
    </table>
</div>
