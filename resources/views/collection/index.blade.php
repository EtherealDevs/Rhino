@extends('layouts.app')

@section('content')
    <section>
        <div class="relative isolate px-0 pt-0">
            <div class="fixed top-0 left-0 w-full -z-10 transform-gpu overflow-hidden blur-3xl" aria-hidden="true">
                <div class="relative left-[calc(50%-11rem)] aspect-[1155/678] w-[36.125rem] -translate-x-1/2 rotate-[30deg] bg-gradient-to-tr from-[#0051ff] to-[#bb94b7] opacity-30 sm:left-[calc(50%-30rem)] sm:w-[72.1875rem]"
                    style="clip-path: polygon(74.1% 44.1%, 100% 61.6%, 97.5% 26.9%, 85.5% 0.1%, 80.7% 2%, 72.5% 32.5%, 60.2% 62.4%, 52.4% 68.1%, 47.5% 58.3%, 45.2% 34.5%, 27.5% 76.7%, 0.1% 64.9%, 17.9% 100%, 27.6% 76.8%, 76.1% 97.7%, 74.1% 44.1%)">
                </div>
            </div>

            <div class="w-screen h-2/6">
                @if ($category->images->isNotEmpty())
                    <div class="container mx-auto relative bg-black/50 rounded-b-2xl flex flex-col h-[500px] w-full bg-cover bg-center"
                        style="background-image: url('{{ url(Storage::url($category->images->first()->url)) }}');">
                        <!-- Capa de opacidad superpuesta -->
                        <div class="absolute inset-0 bg-black opacity-50 rounded-b-3xl"></div>
                        <!-- Contenido aquí -->
                    </div>
                @else
                    <div class="container mx-auto relative bg-black/50 rounded-b-2xl flex flex-col h-[500px] w-full bg-cover bg-center"
                        style="background-image: url('https://images.unsplash.com/photo-1470309864661-68328b2cd0a5?q=80&w=3540&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D');">
                        <!-- Capa de opacidad superpuesta -->
                        <div class="absolute inset-0 bg-black opacity-50 rounded-b-3xl"></div>
                        <!-- Contenido aquí -->
                    </div>
                @endif


                <!-- Verificamos si hay imagen y aplicamos color de texto según la existencia de la imagen -->
                <div class="-translate-y-full w-full grid grid-cols-8 justify-between p-14 overflow-x-hidden">
                    <div class="mx-auto col-span-8 relative">
                        <div class="w-12 text-2xl font-extrabold text-white font-josefin italic border-gray-500">
                            Colección
                            <h1 class="text-4xl text-white font-bold sm:text-6xl">
                                {{ $category->name }}
                            </h1>
                        </div>
                        <div class="grid grid-cols-2 lg:grid-cols-4 mt-3 relative">
                            @foreach ($categories as $category)
                                @if (is_null($category->parent_id))
                                    <a href="{{ route('collection.index', ['category' => $category->id]) }}"
                                        class="collection-item px-6 border-r-2 border-gray-300 italic font-semibold">
                                        <p class="text-white">
                                            {{ $category->name }}
                                        </p>
                                    </a>
                                @endif
                            @endforeach
                        </div>
                        <div class="underline-bar absolute"></div>
                    </div>
                </div>
            </div>

            <!-- Muestra los productos de las categorías hijas -->
            <div class="w-full -translate-y-64">
                <div class="container mx-auto flex flex-col items-start">
                    <div class="flex justify-center w-full px-2 lg:px-8">
                        <div class="p-0 w-full lg:w-11/12">

                            <!-- Grid de productos -->
                            <div class="grid grid-cols-2 lg:grid-cols-4 gap-2 lg:gap-8">
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

        <div class="absolute inset-x-0 top-[calc(100%-13rem)] -z-10 transform-gpu overflow-hidden blur-3xl sm:top-[calc(100%-30rem)]"
            aria-hidden="true">
            <div class="relative left-[calc(50%+3rem)] aspect-[1155/678] w-[36.125rem] -translate-x-1/2 bg-gradient-to-tr from-[#004cff] to-[#0e0953] opacity-30 sm:left-[calc(50%+36rem)] sm:w-[72.1875rem]"
                style="clip-path: polygon(74.1% 44.1%, 100% 61.6%, 97.5% 26.9%, 85.5% 0.1%, 80.7% 2%, 72.5% 32.5%, 60.2% 62.4%, 52.4% 68.1%, 47.5% 58.3%, 45.2% 34.5%, 27.5% 76.7%, 0.1% 64.9%, 17.9% 100%, 27.6% 76.8%, 76.1% 97.7%, 74.1% 44.1%)">
            </div>
        </div>
    </div>
</section>
@endsection
