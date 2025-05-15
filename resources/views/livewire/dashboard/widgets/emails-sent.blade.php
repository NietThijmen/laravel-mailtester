<div class="bg-white rounded-lg shadow-md p-4 h-full">
    <h2 class="text-xl font-semibold text-gray-800 mb-4">Emails Sent by Mailbox</h2>

    <div class="overflow-y-auto max-h-full py-4 pr-2">
        @foreach($emailsSentPerMailbox as $index => $emails)
            <div class="mb-3 p-3 border-l-4 border-blue-500 bg-gray-50 rounded-r-md hover:bg-gray-100 transition duration-150">
                <div class="flex justify-between items-center">
                    <h3 class="font-medium text-gray-700">{{ $emails['account'] }}</h3>
                    <span class="bg-blue-100 text-blue-800 text-sm font-semibold px-3 py-1 rounded-full">{{ number_format($emails['count']) }}</span>
                </div>

                <div class="mt-2">
                    <div class="w-full bg-gray-200 rounded-full h-2">
                        @php
                            $maxCount = max(array_column($emailsSentPerMailbox, 'count')) ?: 1;
                            $percentage = ($emails['count'] / $maxCount) * 100;
                        @endphp
                        <div class="bg-blue-600 h-2 rounded-full" style="width: {{ $percentage }}%"></div>
                    </div>
                </div>
            </div>
        @endforeach

        @if(count($emailsSentPerMailbox) === 0)
            <div class="text-center py-6 text-gray-500">
                No email data available
            </div>
        @endif
    </div>
</div>
