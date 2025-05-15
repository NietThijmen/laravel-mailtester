<div class="bg-white rounded-lg shadow-md p-4 h-full">
    <h2 class="text-xl font-semibold text-gray-800 mb-4">Average Spam Score by Mailbox</h2>

    <div class="overflow-y-auto max-h-full py-4 pr-2">
        @foreach($spamPerMailbox as $index => $spam)
            <div class="mb-3 p-3 border-l-4 border-orange-500 bg-gray-50 rounded-r-md hover:bg-gray-100 transition duration-150">
                <div class="flex justify-between items-center">
                    <h3 class="font-medium text-gray-700">{{ $spam['account'] }}</h3>
                    <span class="bg-orange-100 text-orange-800 text-sm font-semibold px-3 py-1 rounded-full">{{ number_format($spam['count'], 2) }}</span>
                </div>

                <div class="mt-2">
                    <div class="w-full bg-gray-200 rounded-full h-2">
                        @php
                            $maxScore = max(array_column($spamPerMailbox, 'count')) ?: 1;
                            $percentage = ($spam['count'] / $maxScore) * 100;
                        @endphp
                        <div class="bg-orange-600 h-2 rounded-full" style="width: {{ $percentage }}%"></div>
                    </div>
                </div>
            </div>
        @endforeach

        @if(count($spamPerMailbox) === 0)
            <div class="text-center py-6 text-gray-500">
                No spam score data available
            </div>
        @endif
    </div>
</div>
