<!-- Page Header -->
<header id="page-header"
    class="fixed top-0 left-0 right-0 z-30 flex h-16 flex-none items-center bg-white shadow-sm transition-all duration-300 ease-out"
    x-bind:class="{ 'lg:pl-64': desktopSidebarOpen }">
    <div class="mx-auto flex w-full max-w-7xl justify-between px-4 lg:px-8 space-x-3">

        <!-- Botón de menú para la barra lateral -->
        <div class="flex items-center">
            <button type="button"
                class="inline-flex items-center justify-center space-x-2 rounded border border-gray-300 bg-white px-3 py-2 font-semibold leading-6 text-gray-800 shadow-sm hover:border-gray-300 hover:bg-gray-100 hover:text-gray-800 hover:shadow focus:outline-none focus:ring focus:ring-gray-500 focus:ring-opacity-25 active:border-white active:bg-white active:shadow-none"
                x-on:click="mobileSidebarOpen = true; desktopSidebarOpen = !desktopSidebarOpen">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor"
                    class="hi-solid hi-menu-alt-1 inline-block h-5 w-5">
                    <path fill-rule="evenodd"
                        d="M2 4.75A.75.75 0 012.75 4h14.5a.75.75 0 010 1.5H2.75A.75.75 0 012 4.75zm0 10.5a.75.75 0 01.75-.75h7.5a.75.75 0 010 1.5h-7.5a.75.75 0 01-.75-.75zM2 10a.75.75 0 01.75-.75h14.5a.75.75 0 010 1.5H2.75A.75.75 0 012 10z"
                        clip-rule="evenodd" />
                </svg>
            </button>
        </div>

        <!-- Barra de búsqueda centrada -->
        <div class="flex justify-center flex-1 lg:mr-32 rounded-md">
            <div class="relative w-full max-w-xl mr-2 focus-within:text-purple-500">
                <div class="absolute inset-y-0 flex items-center pl-2">
                    <svg aria-hidden="true" fill="currentColor" viewBox="0 0 20 20" class="w-4 h-4 text-gray-600">

                    </svg>
                </div>
                <input
                    class="block w-full text-sm focus:outline-none border-gray-400 leading-5 focus:border-purple-400 focus:shadow-outline-purple rounded-md pl-8 text-gray-700"
                    type="text" placeholder=" Encuentra el empleo ideal" aria-label="Search">
            </div>
        </div>

        <!-- Menú de usuario con foto, nombre, perfil y cerrar sesión -->
        <div class="relative inline-flex" x-data="{ open: false }">
            <button class="inline-flex items-center group" aria-haspopup="true" @click.prevent="open = !open"
                :aria-expanded="open">

                <!-- Imagen de perfil -->
                @if (Auth::user()->profile_photo_path)
                    <img class="h-10 w-10 rounded-full object-cover" src="/storage/{{ Auth::user()->profile_photo_path }}" alt="{{ Auth::user()->name }}" />
                @else
                    <img class="h-8 w-8 rounded-full object-cover" src="{{ Auth::user()->profile_photo_url }}" alt="{{ Auth::user()->name }}" />
                @endif

                <!-- Nombre de usuario y flecha para abrir menú -->
                <div class="flex items-center truncate ml-2">
                    <span class="truncate text-sm font-medium group-hover:text-slate-800">{{ Auth::user()->name }}</span>
                    <svg class="w-3 h-3 ml-1 fill-current text-slate-400" viewBox="0 0 12 12">
                        <path d="M5.9 11.4L.5 6l1.4-1.4 4 4 4-4L11.3 6z" />
                    </svg>
                </div>
            </button>

            <!-- Menú desplegable para Perfil y Cerrar sesión -->
            <div class="z-10 absolute top-full min-w-44 right-0 mt-2 w-48 origin-top-right rounded-md bg-white py-1 shadow-lg ring-1 ring-black ring-opacity-5 focus:outline-none"
                role="menu" aria-orientation="vertical" aria-labelledby="user-menu-button" tabindex="-1"
                @click.outside="open = false" @keydown.escape.window="open = false" x-show="open"
                x-transition:enter="transition ease-out duration-200 transform"
                x-transition:enter-start="opacity-0 -translate-y-2" x-transition:enter-end="opacity-100 translate-y-0"
                x-transition:leave="transition ease-out duration-200" x-transition:leave-start="opacity-100"
                x-transition:leave-end="opacity-0" x-cloak>

                <!-- Información del usuario -->
                <div class="pt-0.5 pb-2 px-3 mb-1 border-b border-slate-200">
                    <div class="font-medium text-slate-800">{{ Auth::user()->name }}</div>
                    <div class="text-xs text-slate-500 italic">Administrator</div>
                </div>

                <!-- Opciones del menú -->
                <ul>
                    <li>
                        <a class="font-medium text-sm text-indigo-500 hover:text-indigo-600 flex items-center py-1 px-3"
                            href="{{ route('profile.show') }}" @click="open = false" @focus="open = true" @focusout="open = false">Perfil</a>
                    </li>
                    <li>
                        <form method="POST" action="{{ route('logout') }}" x-data>
                            @csrf
                            <a class="font-medium text-sm text-indigo-500 hover:text-indigo-600 flex items-center py-1 px-3"
                                href="{{ route('logout') }}" @click.prevent="$root.submit();" @focus="open = true"
                                @focusout="open = false">
                                Cerrar sesión
                            </a>
                        </form>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</header>
