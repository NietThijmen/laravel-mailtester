<div
    x-data="{
        isOpen: false,
        x:0,
        y:0
    }"

    x-on:mouseleave="isOpen = false;"
    x-on:contextmenu="
    $event.preventDefault();
    isOpen = true;

    x = $event.clientX;
    y = $event.clientY;
    "

    {{$attributes}}
>

    {{$slot}}

</div>
