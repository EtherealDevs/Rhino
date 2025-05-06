@extends('layouts.app')
@section('content')
    <div class="grid grid-cols-1 lg:grid-cols-12 w-full bg-gradient-to-br from-white via-white to-gray-100 top-0">
        <div class="col-span-12 lg:col-span-7 bg-transparent py-10 px-6 sm:px-8 lg:px-12 items-center">
            <div class="p-4 bg-transparent rounded-lg items-center sm:p-8">
                <div class="flex justify-between items-center mb-4">
                    <div class="">
                        <h3 class="font-bold font-josefin text-4xl sm:text-xl lg:text-5xl">Mi Carrito</h3>
                    </div>

                    <div class="">
                        @if ($combos !== null && $items !== null)
                            @if ($combos->isNotEmpty() || $items->isNotEmpty())
                                <form method="POST" action="{{ route('cart.dropCart') }}">
                                    @csrf
                                    @method('delete')
                                    <button type="submit" class="w-full sm:w-auto bg-[#f84e4e] rounded-lg mt-2 sm:mt-0">
                                        <p class="font-josefin text-lg text-white font-bold py-1 px-4">Eliminar Lista</p>
                                    </button>
                                </form>
                            @endif
                        @endif
                    </div>
                </div>
                <div class="flow-root">
                    @session('failure')
                        <p>{{ session('failure') }}</p>
                    @endsession
                    @session('cartError')
                        <p>{{ session('cartError') }}</p>
                    @endsession
                    @if ($combos !== null && $items !== null)
                        <ul role="list" class="divide-y divide-gray-200 dark:divide-gray-200">
                            @if ($combos->isNotEmpty())
                                @foreach ($combos as $comboKey => $comboValue)
                                    @livewire('cart-combo', ['cartComboId' => $comboKey, 'cartCombo' => $comboValue])
                                @endforeach
                            @endif
                            @if ($items->isNotEmpty())
                                @foreach ($items as $itemKey => $itemValue)
                                    @livewire('cart-item', ['cartItemId' => $itemKey, 'cartItem' => $itemValue])
                                @endforeach
                            @endif
                            @if ($combos->isEmpty() && $items->isEmpty())
                                <p class="text-2xl sm:text-3xl lg:text-4xl text-gray-300 mt-24 mb-24">No tenes productos en
                                    tu carrito
                                </p>

                                <a href="/products">
                                    <button type="submit" class="w-full sm:w-auto bg-blue-600 hover:bg-blue-700 rounded-lg mt-2 sm:mt-0">
                                        <p class="font-josefin text-lg text-white font-bold py-1 px-4">Ver Productos</p>
                                    </button>
                                </a>
                            @endif
                        </ul>
                    @endif
                </div>

            </div>
        </div>

        @if ($combos !== null && $items !== null)
            @if ($combos->isNotEmpty() || $items->isNotEmpty())
                <div
                    class="col-span-12 lg:col-span-5 lg:h-screen flex lg:sticky left-0 top-16 lg:space-y-10 items-center lg:content-center">
                    @livewire('checkout-config')
                </div>
            @endif
        @endif

        <script>
            document.getElementById('domicilioButton').addEventListener('click', function() {
                document.getElementById('domicilioForm').classList.remove('hidden');
                document.getElementById('sucursalOptions').classList.add('hidden');
            });

            document.getElementById('sucursalButton').addEventListener('click', function() {
                document.getElementById('sucursalOptions').classList.remove('hidden');
                document.getElementById('domicilioForm').classList.add('hidden');
            });
        </script>

    </div>
@endsection
