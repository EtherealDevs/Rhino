@props(['item', 'colors'])

<!-- Carousel -->
<div class="glide" x-data="{ currentSlide: 0 }">
    <div class="glide__track" data-glide-el="track">
        <ul class="glide__slides">
            @foreach ($item->images as $image)    
                <li class="glide__slide">
                    <img class="w-full h-64 lg:h-96 object-cover"
                    src="/storage/images/product/{{$image->url}}"
                        alt="{{$item->id}}-{{$item->product->id}}-{{$item->product->name}}-{{$colors[$loop->index]->name}}-{{$loop->index}}">
                </li>
            @endforeach
        </ul>
    </div>
    <div class="glide__bullets" data-glide-el="controls[nav]">
        @foreach ($item->images as $image)
        <button class="glide__bullet" data-glide-dir="={{$loop->index}}"></button>
        @endforeach
    </div>
    <div class="glide__arrows" data-glide-el="controls">
        <button class="glide__arrow glide__arrow--left" data-glide-dir="<">
            <svg class="h-6 w-6 text-gray-700" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                xmlns="http://www.w3.org/2000/svg">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7">
                </path>
            </svg>
        </button>
        <button class="glide__arrow glide__arrow--right" data-glide-dir=">">
            <svg class="h-6 w-6 text-gray-700" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                xmlns="http://www.w3.org/2000/svg">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7">
                </path>
            </svg>
        </button>
    </div>

</div>
<!-- Thumbnails -->
<div class="flex mt-4">
    @foreach ($item->images as $image)
    <img class="w-24 h-24 object-cover mr-2 cursor-pointer" @click="currentSlide = {{$loop->index}}"
        src="/storage/images/product/{{$image->url}}"
        alt="Miniatura {{$loop->index + 1}}">
    @endforeach
</div>