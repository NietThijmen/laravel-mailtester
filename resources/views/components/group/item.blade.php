@props([
    'name' => null,
])

<div
    x-cloak
    x-show="item == '{{ $name }}'"
    x-transition
>
    {{$slot}}
</div>
