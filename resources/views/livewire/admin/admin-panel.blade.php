<div>
    <style>
        /* Sidebar hidden by default on mobile and visible by default on desktop */
        .sidebar-menu {
            transform: translateX(-100%);
            transition: transform 0.3s ease;
            position: fixed;
            top: 0;
            left: 0;
            height: 100%;
            width: 16rem;
            /* Adjust width as needed */
            z-index: 50;
            background-color: #f8f4f3;
            overflow-y: auto;
        }

        .sidebar-menu.active {
            transform: translateX(0);
        }

        .sidebar-overlay {
            display: none;
        }

        .sidebar-overlay.active {
            display: block;
        }

        /* Always show sidebar on large screens */
        @media (min-width: 768px) {
            .sidebar-menu {
                transform: translateX(0);
            }

            .sidebar-overlay {
                display: none;
            }
        }
    </style>

    <!--sidenav -->
    <div id="sidebar" class="fixed left-0 top-0 w-64 h-full bg-[#f8f4f3] p-4 z-50 sidebar-menu overflow-scroll">
        <a href="/" class="flex pb-4">
            <img class="flex mx-auto px-8 w-36 mt-4" src="/img/rino-black.png" alt="Your Company">
        </a>
        <ul class="mt-4">
            <li class="mb-1 group">
                <a href="/"
                    class="flex font-semibold items-center py-2 px-4 text-gray-900 transition hover:bg-blue-500 hover:text-gray-100 rounded-md group-[.active]:bg-gray-800 group-[.active]:text-white group-[.selected]:bg-gray-950 group-[.selected]:text-gray-100">
                    <i class="ri-arrow-go-back-line mr-3 text-lg"></i>
                    <span class="text-sm">Volver</span>
                </a>
            </li>
            <li class="mb-1 group">
                <a href="/admin"
                    class="flex font-semibold items-center py-2 px-4 text-gray-900 transition hover:bg-blue-500 hover:text-gray-100 rounded-md group-[.active]:bg-gray-800 group-[.active]:text-white group-[.selected]:bg-gray-950 group-[.selected]:text-gray-100">
                    <i class="ri-home-3-line mr-3 text-lg"></i>
                    <span class="text-sm">Inicio</span>
                </a>
            </li>
            <li class="mb-1 group">
                <a href="{{ route('admin.notifications.index') }}"
                    class="flex font-semibold items-center py-2 px-4 text-gray-900 transition hover:bg-blue-500 hover:text-gray-100 rounded-md group-[.active]:bg-gray-800 group-[.active]:text-white group-[.selected]:bg-gray-950 group-[.selected]:text-gray-100">
                    <i class="ri-notification-3-fill mr-3 text-lg"></i>
                    <span class="text-sm">Notificaciones</span>
                    <span
                        class=" md:block px-2 py-0.5 ml-auto text-xs font-medium tracking-wide text-red-600 bg-red-200 rounded-full">{{ count($user->notifications) }}</span>
                </a>
            </li>
            <span class="text-gray-400 font-bold">Tienda</span>
            <li class="mb-1 group">
                <a href="{{ route('admin.stock.index') }}"
                    class="flex font-semibold items-center py-2 px-4 text-gray-900 transition hover:bg-blue-500 hover:text-gray-100 rounded-md group-[.active]:bg-gray-800 group-[.active]:text-white group-[.selected]:bg-gray-950 group-[.selected]:text-gray-100">
                    <i class="ri-funds-fill mr-3 text-lg"></i>
                    <span class="text-sm">Stock</span>
                </a>
            </li>
            <li class="mb-1 group">
                <a href="{{ route('admin.orders.index') }}"
                    class="flex font-semibold items-center py-2 px-4 text-gray-900 transition hover:bg-blue-500 hover:text-gray-100 rounded-md group-[.active]:bg-gray-800 group-[.active]:text-white group-[.selected]:bg-gray-950 group-[.selected]:text-gray-100">
                    <i class='ri-shopping-bag-line mr-3 text-lg'></i>
                    <span class="text-sm">Pedidos</span>
                </a>
            </li>
            <li class="mb-1 group">
                <a href="{{ route('admin.ventas.index') }}"
                    class="flex font-semibold items-center py-2 px-4 text-gray-900 transition hover:bg-blue-500 hover:text-gray-100 rounded-md group-[.active]:bg-gray-800 group-[.active]:text-white group-[.selected]:bg-gray-950 group-[.selected]:text-gray-100">
                    <i class="ri-funds-box-fill mr-3 text-lg"></i>
                    <span class="text-sm">Ventas</span>
                </a>
            </li>
            <li class="mb-1 group">
                <a href="{{ route('admin.sales.index') }}"
                    class="flex font-semibold items-center py-2 px-4 text-gray-900 transition hover:bg-blue-500 hover:text-gray-100 rounded-md group-[.active]:bg-gray-800 group-[.active]:text-white group-[.selected]:bg-gray-950 group-[.selected]:text-gray-100">
                    <i class="ri-percent-line mr-3 text-lg"></i>
                    <span class="text-sm">Promociones</span>
                </a>
            </li>
            <span class="text-gray-400 font-bold">Administrar</span>
            <li class="mb-1 group">
                <a href="{{ route('admin.products.index') }}"
                    class="flex font-semibold items-center py-2 px-4 text-gray-900 transition hover:bg-blue-500 hover:text-gray-100 rounded-md group-[.active]:bg-gray-800 group-[.active]:text-white group-[.selected]:bg-gray-950 group-[.selected]:text-gray-100">
                    <i class="ri-t-shirt-fill mr-3 text-lg"></i>
                    <span class="text-sm">Productos</span>
                </a>
            </li>
            <li class="mb-1 group">
                <a href="{{ route('admin.combos.index') }}"
                    class="flex font-semibold items-center py-2 px-4 text-gray-900 transition hover:bg-blue-500 hover:text-gray-100 rounded-md group-[.active]:bg-gray-800 group-[.active]:text-white group-[.selected]:bg-gray-950 group-[.selected]:text-gray-100">
                    <i class='ri-handbag-fill mr-3 text-lg'></i>
                    <span class="text-sm">Combos</span>
                </a>
            </li>
            <li class="mb-1 group">
                <a href={{ route('admin.categories.index') }}
                    class="flex font-semibold items-center py-2 px-4 text-gray-900 transition hover:bg-blue-500 hover:text-gray-100 rounded-md group-[.active]:bg-gray-800 group-[.active]:text-white group-[.selected]:bg-gray-950 group-[.selected]:text-gray-100">
                    <i class='bx bx-archive mr-3 text-lg'></i>
                    <span class="text-sm">Categorias</span>
                </a>
            </li>
            <li class="mb-1 group">
                <a href="{{ route('admin.categories.index') }}"
                    class="flex font-semibold items-center py-2 px-4 text-gray-900 transition hover:bg-blue-500 hover:text-gray-100 rounded-md group-[.active]:bg-gray-800 group-[.active]:text-white group-[.selected]:bg-gray-950 group-[.selected]:text-gray-100">
                    <i class="ri-folders-line mr-3 text-lg"></i>
                    <span class="text-sm">Subcategorias</span>
                </a>
            </li>
            <li class="mb-1 group">
                <a href="{{ route('admin.brands.index') }}"
                    class="flex font-semibold items-center py-2 px-4 text-gray-900 transition hover:bg-blue-500 hover:text-gray-100 rounded-md group-[.active]:bg-gray-800 group-[.active]:text-white group-[.selected]:bg-gray-950 group-[.selected]:text-gray-100">
                    <i class='ri-barcode-box-fill mr-3 text-lg'></i>
                    <span class="text-sm">Marcas</span>
                </a>
            </li>
            <span class="text-gray-400 font-bold">Gestion de Tienda</span>
            <li class="mb-1 group">
                <a href="{{ route('admin.mystore.index') }}"
                    class="flex font-semibold items-center py-2 px-4 text-gray-900 transition hover:bg-blue-500 hover:text-gray-100 rounded-md group-[.active]:bg-gray-800 group-[.active]:text-white group-[.selected]:bg-gray-950 group-[.selected]:text-gray-100">
                    <i class="ri-store-2-line mr-3 text-lg"></i>
                    <span class="text-sm">Mi Tienda</span>
                </a>
            </li>
            <li class="mb-1 group">
                <a href="{{ route('admin.users.index') }}"
                    class="flex font-semibold items-center py-2 px-4 text-gray-900 transition hover:bg-blue-500 hover:text-gray-100 rounded-md group-[.active]:bg-gray-800 group-[.active]:text-white group-[.selected]:bg-gray-950 group-[.selected]:text-gray-100">
                    <i class="ri-team-fill mr-3 text-lg"></i>
                    <span class="text-sm">Roles y Permisos</span>
                </a>
            </li>

        </ul>
    </div>
    <div id="sidebar-overlay" class="fixed top-0 left-0 w-full h-full bg-black/50 z-40 md:hidden sidebar-overlay"></div>
    <!-- end sidenav -->

    <div class="w-full fixed md:w-[calc(100%-256px)] md:ml-64 bg-gray-200 transition-all main">
        <!-- navbar -->

        <div class="top-0 py-2 px-6 bg-[#f8f4f3] flex items-center shadow-md shadow-black/5 sticky left-0 z-30">
            <button id="toggle-sidebar" type="button" class="text-gray-500 focus:outline-none md:hidden">
                <i class="fas fa-bars"></i>
            </button>
            <div class="p-2 md:block text-left">
                <h2 class="text-xl font-thin text-gray-800">Hola, <span class="uppercase font-extrabold font-blinker">
                        {{ $user->name }}</span> 👋🏻</h2>
            </div>

            <ul class="ml-auto flex items-center">

                <script>
                    document.addEventListener('DOMContentLoaded', () => {
                        const dropdownButton = document.querySelector('.dropdown-toggle');
                        const dropdownMenu = document.querySelector('.dropdown-menu');
                        const tabs = document.querySelectorAll('.notification-tab button');

                        // Toggle dropdown menu visibility
                        dropdownButton.addEventListener('click', () => {
                            dropdownMenu.classList.toggle('hidden');
                        });

                        // Switch tabs in the dropdown menu
                        tabs.forEach(tab => {
                            tab.addEventListener('click', (e) => {
                                const tabPage = e.target.getAttribute('data-tab-page');

                                // Remove active class from all tabs and hide all tab contents
                                tabs.forEach(button => {
                                    button.classList.remove('active');
                                });

                                document.querySelectorAll('.dropdown-menu > div > ul').forEach(list => {
                                    list.classList.add('hidden');
                                });

                                // Add active class to the clicked tab and show the associated content
                                e.target.classList.add('active');
                                document.querySelector(`[data-tab-for="notification"][data-page="${tabPage}"]`)
                                    .classList.remove('hidden');
                            });
                        });
                    });
                </script>

                <li class="dropdown">
                    <button type="button"
                        class="dropdown-toggle text-gray-400 mr-4 w-8 h-8 rounded flex items-center justify-center hover:text-gray-600">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                            class="hover:bg-gray-100 rounded-full" viewBox="0 0 24 24"
                            style="fill: gray;transform: ;msFilter:;">
                            <path
                                d="M19 13.586V10c0-3.217-2.185-5.927-5.145-6.742C13.562 2.52 12.846 2 12 2s-1.562.52-1.855 1.258C7.185 4.074 5 6.783 5 10v3.586l-1.707 1.707A.996.996 0 0 0 3 16v2a1 1 0 0 0 1 1h16a1 1 0 0 0 1-1v-2a.996.996 0 0 0-.293-.707L19 13.586zM19 17H5v-.586l1.707-1.707A.996.996 0 0 0 7 14v-4c0-2.757 2.243-5 5-5s5 2.243 5 5v4c0 .266.105.52.293.707L19 16.414V17zm-7 5a2.98 2.98 0 0 0 2.818-2H9.182A2.98 2.98 0 0 0 12 22z">
                            </path>
                        </svg>
                    </button>
                    <div
                        class="dropdown-menu absolute right-2 top-18 shadow-md shadow-black/5 hidden max-w-xs w-full bg-white z-50 rounded-md border border-gray-100">
                        <div class="flex items-center px-4 pt-4 border-b border-b-gray-100 notification-tab">
                            <button type="button" data-tab="notification" data-tab-page="notifications"
                                class="text-gray-400 font-medium text-[13px] hover:text-gray-600 border-b-2 border-b-transparent mr-4 pb-1 active">Pedidos</button>
                            <button type="button" data-tab="notification" data-tab-page="messages"
                                class="text-gray-400 font-medium text-[13px] hover:text-gray-600 border-b-2 border-b-transparent mr-4 pb-1">Messages</button>
                        </div>
                        <div class="my-2">
                            <ul class="max-h-64 overflow-y-auto" data-tab-for="notification"
                                data-page="notifications">
                                <ul class="max-h-64 overflow-y-auto " data-tab-for="notification"
                                    data-page="notifications">
                                    @foreach ($pendingOrders as $order)
                                        <li class="relative mt-2 p-8 group border-t border-gray-200 last:border-0">
                                            <div class="flex">
                                                <time
                                                    class="translate-y-0.5 inline-flex items-center justify-center text-xs font-semibold uppercase w-20 h-6 mb-3 sm:mb-0 text-emerald-600 bg-emerald-100 rounded-full">{{ $order->created_at->format('d-m-Y') }}</time>
                                                <br>
                                                <time
                                                    class="translate-y-0.5 inline-flex items-center justify-center text-xs font-semibold uppercase w-20 h-6 mb-3 sm:mb-0 text-gray-600 bg-gray-100 rounded-full">{{ $order->created_at->format('H:i') }}</time>
                                            </div>
                                            <div class="mt-2 font-medium text-indigo-500 mb-1 sm:mb-0">
                                                Pedido #{{ $order->id }} - <a
                                                    href="{{ route('admin.orders.show', $order->id) }}"
                                                    class="text-blue-600 hover:underline">Ver detalles →</a>
                                            </div>
                                            <div class="flex flex-col sm:flex-row items-start mb-1">
                                                <div class="text-xl font-bold text-slate-900">
                                                    ${{ $order->total }}
                                                </div>
                                            </div>
                                            <div class="text-slate-500 flex">
                                                <p class="mr-2">{{ $order->user->name }}</p> -
                                                <p class="ml-2">{{ $order->user->email }}</p>
                                            </div>
                                        </li>
                                    @endforeach
                                </ul>

                            </ul>
                            <ul class="max-h-64 overflow-y-auto hidden" data-tab-for="notification"
                                data-page="messages">
                                <li>
                                    <a href="#" class="py-2 px-4 flex items-center hover:bg-gray-50 group">
                                        <img src="https://placehold.co/32x32" alt=""
                                            class="w-8 h-8 rounded block object-cover align-middle">
                                        <div class="ml-2">
                                            <div
                                                class="text-[13px] text-gray-600 font-medium truncate group-hover:text-blue-500">
                                                John Doe</div>
                                            <div class="text-[11px] text-gray-400">Hello there!</div>
                                        </div>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </li>


                <button id="fullscreen-button">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                        class="hover:bg-gray-100 rounded-full" viewBox="0 0 24 24"
                        style="fill: gray;transform: ;msFilter:;">
                        <path d="M5 5h5V3H3v7h2zm5 14H5v-5H3v7h7zm11-5h-2v5h-5v2h7zm-2-4h2V3h-7v2h5z"></path>
                    </svg>
                </button>


                <li class="dropdown ml-3">
                    @auth
                        <!-- Bloque de autenticación para usuarios autenticados -->
                        <div class="ml-4 items-end">
                            <div class="flex relative justify-end" x-data="{ open: false }">
                                <div class="border-4 w-10 rounded-full p-1">
                                    <button x-on:click="open = !open" type="button"
                                        class="flex items-end text-sm font-medium text-white ">
                                        <img class="h-6 rounded-full" src="{{ auth()->user()->profile_photo_url }}"
                                            alt="">
                                    </button>
                                </div>

                                <div x-show="open" x-on:click.away="open = false"
                                    class="z-50 absolute mt-6 right-2 top-8 w-48 bg-white backdrop-blur-2xl divide-y divide-gray-300"
                                    role="menu" aria-orientation="vertical" aria-labelledby="user-menu-button"
                                    tabindex="-1">
                                    <a href="{{ route('profile.show') }}"
                                        class="flex justify-end px-4 py-2 text-sm text-back font-extralight"
                                        role="menuitem" tabindex="-1" id="user-menu-item-0">Tu Perfil</a>
                                    <a href="/admin" class="flex justify-end px-4 py-2 text-sm text-back font-extralight"
                                        role="menuitem" tabindex="-1" id="user-menu-item-1">Panel de
                                        Administracion</a>
                                    <form method="POST" class="flex justify-end" action="{{ route('logout') }}" x-data>
                                        @csrf
                                        <button type="submit" href="{{ route('logout') }}"
                                            class="px-4 py-2 text-sm text-backfont-extralight" role="menuitem"
                                            tabindex="-1" id="user-menu-item-2">Cerrar Sesion</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    @else
                        <!-- Bloque de inicio de sesión y registro para usuarios no autenticados -->
                        <div class="ml-4 flex items-center">
                            <a href="{{ route('login') }}"
                                class="text-gray-600 hover:bg-blue-900 hover:text-white px-3 py-2 rounded-md text-sm font-medium">Iniciar
                                Sesión</a>
                            <a href="{{ route('register') }}"
                                class="text-gray-600 hover:bg-blue-900 hover:text-white px-3 py-2 rounded-md text-sm font-medium">Registrarme</a>
                        </div>
                    @endauth
                </li>
            </ul>
        </div>
        <!-- end navbar -->
    </div>

    <script>
        // Toggle sidebar and overlay
        document.getElementById('toggle-sidebar').addEventListener('click', function() {
            document.getElementById('sidebar').classList.toggle('active');
            document.getElementById('sidebar-overlay').classList.toggle('active');
        });

        // Close sidebar when overlay is clicked
        document.getElementById('sidebar-overlay').addEventListener('click', function() {
            document.getElementById('sidebar').classList.remove('active');
            document.getElementById('sidebar-overlay').classList.remove('active');
        });

        // Open sidebar and overlay on page load only if not in desktop mode
        window.addEventListener('load', function() {
            if (window.innerWidth < 768) {
                document.getElementById('sidebar').classList.add('active');
                document.getElementById('sidebar-overlay').classList.add('active');
            }
        });

        // Adjust sidebar visibility on window resize
        window.addEventListener('resize', function() {
            if (window.innerWidth >= 768) {
                document.getElementById('sidebar').classList.remove('active');
                document.getElementById('sidebar-overlay').classList.remove('active');
            }
        });
    </script>

    <script>
        const fullscreenButton = document.getElementById('fullscreen-button');

        fullscreenButton.addEventListener('click', toggleFullscreen);

        function toggleFullscreen() {
            if (document.fullscreenElement) {
                // If already in fullscreen, exit fullscreen
                document.exitFullscreen();
            } else {
                // If not in fullscreen, request fullscreen
                document.documentElement.requestFullscreen();
            }
        }
    </script>

    <script src="https://unpkg.com/@popperjs/core@2"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/prism/1.24.1/prism.min.js"
        integrity="sha512-axJX7DJduStuBB8ePC8ryGzacZPr3rdLaIDZitiEgWWk2gsXxEFlm4UW0iNzj2h3wp5mOylgHAzBzM4nRSvTZA=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://flowbite.com/docs/flowbite.min.js?v=2.5.1a"></script>
    <script src="https://flowbite.com/docs/docs.js?v=2.5.1a"></script>

    <script>
        // start: Sidebar
        const sidebarToggle = document.querySelector('.sidebar-toggle')
        const sidebarOverlay = document.querySelector('.sidebar-overlay')
        const sidebarMenu = document.querySelector('.sidebar-menu')
        const main = document.querySelector('.main')
        sidebarToggle.addEventListener('click', function(e) {
            e.preventDefault()
            main.classList.toggle('active')
            sidebarOverlay.classList.toggle('hidden')
            sidebarMenu.classList.toggle('-translate-x-full')
        })
        sidebarOverlay.addEventListener('click', function(e) {
            e.preventDefault()
            main.classList.add('active')
            sidebarOverlay.classList.add('hidden')
            sidebarMenu.classList.add('-translate-x-full')
        })
        document.querySelectorAll('.sidebar-dropdown-toggle').forEach(function(item) {
            item.addEventListener('click', function(e) {
                e.preventDefault()
                const parent = item.closest('.group')
                if (parent.classList.contains('selected')) {
                    parent.classList.remove('selected')
                } else {
                    document.querySelectorAll('.sidebar-dropdown-toggle').forEach(function(i) {
                        i.closest('.group').classList.remove('selected')
                    })
                    parent.classList.add('selected')
                }
            })
        })
        // end: Sidebar



        // start: Popper
        const popperInstance = {}
        document.querySelectorAll('.dropdown').forEach(function(item, index) {
            const popperId = 'popper-' + index
            const toggle = item.querySelector('.dropdown-toggle')
            const menu = item.querySelector('.dropdown-menu')
            menu.dataset.popperId = popperId
            popperInstance[popperId] = Popper.createPopper(toggle, menu, {
                modifiers: [{
                        name: 'offset',
                        options: {
                            offset: [0, 8],
                        },
                    },
                    {
                        name: 'preventOverflow',
                        options: {
                            padding: 24,
                        },
                    },
                ],
                placement: 'bottom-end'
            });
        })
        document.addEventListener('click', function(e) {
            const toggle = e.target.closest('.dropdown-toggle')
            const menu = e.target.closest('.dropdown-menu')
            if (toggle) {
                const menuEl = toggle.closest('.dropdown').querySelector('.dropdown-menu')
                const popperId = menuEl.dataset.popperId
                if (menuEl.classList.contains('hidden')) {
                    hideDropdown()
                    menuEl.classList.remove('hidden')
                    showPopper(popperId)
                } else {
                    menuEl.classList.add('hidden')
                    hidePopper(popperId)
                }
            } else if (!menu) {
                hideDropdown()
            }
        })

        function hideDropdown() {
            document.querySelectorAll('.dropdown-menu').forEach(function(item) {
                item.classList.add('hidden')
            })
        }

        function showPopper(popperId) {
            popperInstance[popperId].setOptions(function(options) {
                return {
                    ...options,
                    modifiers: [
                        ...options.modifiers,
                        {
                            name: 'eventListeners',
                            enabled: true
                        },
                    ],
                }
            });
            popperInstance[popperId].update();
        }

        function hidePopper(popperId) {
            popperInstance[popperId].setOptions(function(options) {
                return {
                    ...options,
                    modifiers: [
                        ...options.modifiers,
                        {
                            name: 'eventListeners',
                            enabled: false
                        },
                    ],
                }
            });
        }
        // end: Popper



        // start: Tab
        document.querySelectorAll('[data-tab]').forEach(function(item) {
            item.addEventListener('click', function(e) {
                e.preventDefault()
                const tab = item.dataset.tab
                const page = item.dataset.tabPage
                const target = document.querySelector('[data-tab-for="' + tab + '"][data-page="' + page +
                    '"]')
                document.querySelectorAll('[data-tab="' + tab + '"]').forEach(function(i) {
                    i.classList.remove('active')
                })
                document.querySelectorAll('[data-tab-for="' + tab + '"]').forEach(function(i) {
                    i.classList.add('hidden')
                })
                item.classList.add('active')
                target.classList.remove('hidden')
            })
        })
        // end: Tab



        // start: Chart
        new Chart(document.getElementById('order-chart'), {
            type: 'line',
            data: {
                labels: generateNDays(7),
                datasets: [{
                        label: 'Active',
                        data: generateRandomData(7),
                        borderWidth: 1,
                        fill: true,
                        pointBackgroundColor: 'rgb(59, 130, 246)',
                        borderColor: 'rgb(59, 130, 246)',
                        backgroundColor: 'rgb(59 130 246 / .05)',
                        tension: .2
                    },
                    {
                        label: 'Completed',
                        data: generateRandomData(7),
                        borderWidth: 1,
                        fill: true,
                        pointBackgroundColor: 'rgb(16, 185, 129)',
                        borderColor: 'rgb(16, 185, 129)',
                        backgroundColor: 'rgb(16 185 129 / .05)',
                        tension: .2
                    },
                    {
                        label: 'Canceled',
                        data: generateRandomData(7),
                        borderWidth: 1,
                        fill: true,
                        pointBackgroundColor: 'rgb(244, 63, 94)',
                        borderColor: 'rgb(244, 63, 94)',
                        backgroundColor: 'rgb(244 63 94 / .05)',
                        tension: .2
                    },
                ]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });

        function generateNDays(n) {
            const data = []
            for (let i = 0; i < n; i++) {
                const date = new Date()
                date.setDate(date.getDate() - i)
                data.push(date.toLocaleString('en-US', {
                    month: 'short',
                    day: 'numeric'
                }))
            }
            return data
        }

        function generateRandomData(n) {
            const data = []
            for (let i = 0; i < n; i++) {
                data.push(Math.round(Math.random() * 10))
            }
            return data
        }
        // end: Chart
    </script>
</div>
