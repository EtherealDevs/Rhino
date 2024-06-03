<script>
    document.addEventListener('DOMContentLoaded', function() {
        new Glide('.glide', {
            type: 'carousel',
            perView: 1,
            autoplay: 3000,
            hoverpause: true,
            animationDuration: 800,
        }).mount();
    });
</script>
<!-- Carousel -->
<div class="glide" x-data="{ currentSlide: 0 }">
    <div class="glide__track" data-glide-el="track">
        <ul class="glide__slides">
            @foreach ($item->images as $image)    
            @dd($image->url)
                <li class="glide__slide">
                    <img class="w-full h-64 lg:h-96 object-cover" 
                    src="/{{$image->url}}"
                        alt="{{$item->id}}-{{$item->product->id}}-{{$item->product->name}}-{{$item->color->name}}-{{$loop->index}}">
                </li>
            @endforeach
        </ul>
    </div>
    <div class="glide__bullets" data-glide-el="controls[nav]">
        <button class="glide__bullet" data-glide-dir="=0"></button>
        <button class="glide__bullet" data-glide-dir="=1"></button>
        <button class="glide__bullet" data-glide-dir="=2"></button>
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
   
    <div class="glide__track" data-glide-el="track">
        <ul class="glide__slides">
            
                <li class="glide__slide">
                    <img class="w-full h-64 lg:h-96 object-cover"
                        alt="placeholder">
                </li>

        </ul>
    </div>

</div>
<!-- Thumbnails -->
<div class="flex mt-4">
    <img class="w-24 h-24 object-cover mr-2 cursor-pointer" @click="currentSlide = 0"
        src="https://pixahive.com/wp-content/uploads/2020/10/Gym-shoes-153180-pixahive.jpg"
        alt="Miniatura 1">
    <img class="w-24 h-24 object-cover mr-2 cursor-pointer" @click="currentSlide = 1"
        src="https://pixahive.com/wp-content/uploads/2020/10/Gym-shoes-153180-pixahive.jpg"
        alt="Miniatura 2">
    <img class="w-24 h-24 object-cover cursor-pointer" @click="currentSlide = 2"
        src="https://pixahive.com/wp-content/uploads/2020/10/Gym-shoes-153180-pixahive.jpg"
        alt="Miniatura 3">
</div>
