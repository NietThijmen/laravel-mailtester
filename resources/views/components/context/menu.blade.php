@props([
    'side' => 'left'
])

<div
    x-cloak
    x-show="isOpen"
    x-transition

    :style="{
        left: x + 'px',
        top: y + 'px',
    }"

    {{$attributes->merge([
    'class' => 'z-[1000] absolute',
])}}
>
    {{$slot}}
</div>
