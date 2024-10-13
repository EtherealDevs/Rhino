<div>
    @if ($count == null)
    <button class="w-10 h-10 border rounded-lg focus:outline-none" disabled>-</button>

    <span id="counter" class="text-lg">{{$count}}</span>

    <button class="w-10 h-10 border rounded-lg focus:outline-none" disabled>+</button>

    @else

    <button wire:loading.attr="disabled"
    wire:click="decrement" class="w-10 h-10 border rounded-lg focus:outline-none">-</button>

    <span id="counter" class="text-lg">{{$count}}</span>

    <button wire:click="increment" class="w-10 h-10 border rounded-lg focus:outline-none">+</button>
    
    @endif
</div>