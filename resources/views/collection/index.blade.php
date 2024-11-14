@extends('layouts.app')

@section('content')
    <section>
        <div class="relative isolate px-0 pt-14 lg:px-8">
            <div class="absolute inset-x-0 -top-40 -z-10 transform-gpu overflow-hidden blur-3xl sm:-top-80"
                aria-hidden="true">
                <div class="relative left-[calc(50%-11rem)] aspect-[1155/678] w-[36.125rem] -translate-x-1/2 rotate-[30deg] bg-gradient-to-tr from-[#0051ff] to-[#bb94b7] opacity-30 sm:left-[calc(50%-30rem)] sm:w-[72.1875rem]"
                    style="clip-path: polygon(74.1% 44.1%, 100% 61.6%, 97.5% 26.9%, 85.5% 0.1%, 80.7% 2%, 72.5% 32.5%, 60.2% 62.4%, 52.4% 68.1%, 47.5% 58.3%, 45.2% 34.5%, 27.5% 76.7%, 0.1% 64.9%, 17.9% 100%, 27.6% 76.8%, 76.1% 97.7%, 74.1% 44.1%)">
                </div>
            </div>

            <div class="text-black font-sans antialiased">
                <div class="container mx-auto flex flex-col items-center">
                    <div class="flex mt-12 flex-col w-full sticky md:top-36 lg:w-1/3 md:mt-12 px-8">
                        <div class="text-center">

                        </div>
                    </div>
                </div>

                <div class="w-full grid grid-cols-8 justify-between p-14 overflow-x-hidden">
                    <div class="mx-auto col-span-8 relative">
                        <div class="w-12 text-2xl font-extrabold font-josefin italic border-gray-500">Colección
                            <h1 class="text-4xl font-bold text-gray-900 sm:text-6xl">{{ $category->name }}</h1>
                        </div>
                        <div class="grid grid-cols-2 lg:grid-cols-4 mt-3 relative">
                            @foreach ($categories as $category)
                                @if (is_null($category->parent_id))
                                    <a href="{{ route('collection.index', ['category' => $category->id]) }}"
                                        class="collection-item px-6 border-r-2 border-gray-300 italic font-semibold">
                                        <p>{{ $category->name }}</p>
                                    </a>
                                @endif
                            @endforeach
                        </div>
                        <div class="underline-bar absolute"></div>
                    </div>
                </div>
            </div>

            <!-- Muestra los productos de las categorías hijas -->
            <div class="text-black font-sans py-8 w-full">
                <div class="container mx-auto flex flex-col items-start">
                    <div class="flex justify-center mt-12 w-full md:mt-12 px-2 lg:px-8">
                        <div class="lg:p-7 p-0 w-full lg:w-11/12">

                            <!-- Grid de productos -->
                            <div class="grid grid-cols-2 lg:grid-cols-4 gap-2 lg:gap-8 mt-6">
                                @foreach ($products as $product)
                                    @php
                                        $notDeletedItems = collect();
                                    @endphp

                                    @if ($product->items->first())
                                        @foreach ($product->items as $item)
                                            @foreach ($item->sizes as $size)
                                                @if ($size->pivot->deleted_at == null && $size->pivot->stock > 0)
                                                    @php
                                                        $notDeletedItems->push($item);
                                                    @endphp
                                                @break;
                                            @endif
                                        @endforeach
                                    @endforeach
                                    @endif

                                    @if ($product->variations->isNotEmpty())
                                        <div class="product-card-container">
                                            @livewire('product-card', ['product' => $product, 'item' => $notDeletedItems->first()])
                                        </div>
                                    @endif
                                @endforeach
                            </div>
                            <!-- Fin del grid de productos -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
