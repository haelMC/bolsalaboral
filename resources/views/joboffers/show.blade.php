<x-app-layout>
    <div class="mt-6 mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 lg:gap-8 border-slate-200">
            <!-- Primer contenedor -->
            <div class="p-4 md:col-span-2 shadow-2xl">
                <div class="p-4 md:col-span-2 shadow-2xl">
                    <a class="text-sm text-indigo-500 hover:text-indigo-600" href="{{ route('joboffers') }}">
                        &lt;-Trabajos
                    </a>
                    <header class="p-3">
                        <!-- Title -->
                        <h1 class="text-gray-800 font-bold text-2xl mb-2 uppercase">{{ $joboffer->title }}</h1>
                        <p class="text-gray-600 dark:text-gray-400">{{ $joboffer->description }}</p>
                    </header>
                    <!-- Meta -->
                    <div class="flex items-center justify-between">
                        <!-- Category -->
                        <div class="flex items-center mb-2">
                            <div class="bg-gray-800 bg-opacity-50 inline-flex items-center rounded-full text-white text-xl px-1 py-1 mr-1">
                                <svg class="w-3 h-3 mr-1" viewBox="0 0 12 12">
                                    <path d="M11.953 4.29a.5.5 0 00-.454-.292H6.14L6.984.62A.5.5 0 006.12.173l-6 7a.5.5 0 00.379.825h5.359l-.844 3.38a.5.5 0 00.864.445l6-7a.5.5 0 00.075-.534z"></path>
                                </svg>
                                <span class="capitalize">{{ $joboffer->category ? $joboffer->category->name : 'Categoría no asignada' }}</span>
                            </div>
                        </div>
                    </div>
                    <!-- Image -->

                    <!-- Product content -->
                    <div class="p-4">
                        <h2 class="text-gray-800 font-bold text-xl mb-2">Datos del Trabajo:</h2>
                    </div>
                    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 xl:grid-cols-4 gap-4">
                        <x-cardjob icon='<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6"><path strokeLinecap="round" strokeLinejoin="round" d="M2.25 12l8.954-8.955c.44-.439 1.152-.439 1.591 0L21.75 12M4.5 9.75v10.125c0 .621.504 1.125 1.125 1.125H9.75v-4.875c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21h4.125c.621 0 1.125-.504 1.125-1.125V9.75M8.25 21h8.25"></path></svg>' title="Tipo de trabajo" :description="$joboffer->type" />
                        <x-cardjob icon='<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6"><path stroke-linecap="round" stroke-linejoin="round" d="M15 10.5a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" d="M19.5 10.5c0 7.142-7.5 11.25-7.5 11.25S4.5 17.642 4.5 10.5a7.5 7.5 0 1115 0z" /></svg>' title="Ubicacion" :description="$joboffer->location" />
                        <x-cardjob icon='<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6"><path stroke-linecap="round" stroke-linejoin="round" d="M12 6v12m-3-2.818l.879.659c1.171.879 3.07.879 4.242 0 1.172-.879 1.172-2.303 0-3.182C13.536 12.219 12.768 12 12 12c-.725 0-1.45-.22-2.003-.659-1.106-.879-1.106-2.303 0-3.182s2.9-.879 4.006 0l.415.33M21 12a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>' title="Salario" :description="$joboffer->salary" />
                        <x-cardjob icon='<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6"><path stroke-linecap="round" stroke-linejoin="round" d="M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 012.25-2.25h13.5A2.25 2.25 0 0121 7.5v11.25m-18 0A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75v-7.5A2.25 2.25 0 015.25 9h13.5A2.25 2.25 0 0121 11.25v7.5m-9-6h.008v.008H12v-.008zM12 15h.008v.008H12V15zm0 2.25h.008v.008H12v-.008zM9.75 15h.008v.008H9.75v-.008zM7.5 15h.008v.008H7.5V15zm0 2.25h.008v.008H7.5v-.008zm6.75-4.5h.008v.008H16.5v-.008zm0 2.25h.008v.008H16.5V15z" /></svg>' title="Fecha de Inicio" :description="$joboffer->start_date" />
                        <!-- Agrega más items según sea necesario -->
                    </div>

                    <!-- Botón Postular -->

                </div>
            </div>

            <!-- Segundo contenedor -->
            <div class="bg-white rounded-sm border border-slate-200 p-2" x-data="{ open: false }">
                <div class="flex flex-col sm:flex-row justify-between items-center">
                    <div class="rounded-md p-2 text-xl text-slate-800 font-bold shadow-xl border-b-2 border-blue-950 mb-2 sm:mb-0">
                        <h3 class="relative inline-flex">Últimos Trabajos</h3>
                    </div>
                </div>
                <div class="space-y-4 mt-4">
                    @foreach ($ultimas as $item)
                        <a href="{{ route('joboffers.show', $item) }}">
                            <div class="shadow-xl grid grid-cols-2 my-4 border-b-2 border-[#003263] rounded bg-white items-center justify-between">
                                <div class="text-slate-800 dark:text-slate-100 font-bold px-1 relative rounded-xl">
                                    <img src="{{ $item->image ? Storage::url($item->image->url) : '' }}" alt="" class="rounded-sm">
                                </div>
                                <div class="ml-4 text-sm leading-relaxed line-clamp-5">
                                    <h4>{{ $item->description }}</h4>
                                </div>
                            </div>
                        </a>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
