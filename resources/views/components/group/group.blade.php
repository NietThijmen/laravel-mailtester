@props([
    'items' => []
])

@php
    $data = [];
    $data['items'] = $items;
    $data['item'] = $items[0];


@endphp

<div
    x-data='@json($data)'
    {{$attributes}}
>
    <div class="flex">
        @foreach($items as $item)
            <button
                class="px-2 py-1 text-sm"
                x-on:click="
                    item = items[{{$loop->index}}]
                "
                :class="
                    item === '{{ $item }}' && 'border-b-blue-500 border-b-2'
                "
                >
                {{$item}}
            </button>
        @endforeach
    </div>

    <hr/>
    <br/>

    {{$slot}}
</div>
