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
                x-on:click="
                    item = items[{{$loop->index}}]
                "
                class="px-2 py-1 text-sm rounded-md">
                {{$item}}
            </button>
        @endforeach
    </div>

    {{$slot}}
</div>
