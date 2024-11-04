<div class="py-5">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

    <div class="max-w-4xl mx-auto bg-white p-6 shadow-md rounded-lg">
        <h2 class="text-2xl font-semibold text-gray-800">Crear Nueva Oferta de Trabajo</h2>
        <p class="mt-4 text-gray-600">
            Use esta sección para ingresar una nueva oferta de empleo al portal. Complete cada campo de la oferta, proporcionando detalles que ayuden a los candidatos a entender el rol, sus requisitos y los beneficios. A continuación se detallan los campos requeridos:
        </p>
        
        <ul class="mt-4 list-disc list-inside text-gray-700 space-y-2">
            <li><strong>Título del Puesto</strong>: Nombre del trabajo, debe ser claro y conciso (Ejemplo: "Desarrollador Backend Junior").</li>
            <li><strong>Descripción</strong>: Detalle las responsabilidades y tareas clave del puesto.</li>
            <li><strong>Tipo de Contrato</strong>: Especifique si es contrato a tiempo completo, medio tiempo, freelance, etc.</li>
            <li><strong>Ubicación</strong>: Indique la ciudad, estado o país, y si es remoto o presencial.</li>
            <li><strong>Salario</strong>: Rango salarial o salario exacto, en la moneda local.</li>
            <li><strong>Fecha de Inicio y Fecha de Fin</strong>: Si aplica, indique la duración del contrato o proyecto.</li>
            <li><strong>Experiencia Requerida</strong>: Mencione los años de experiencia o habilidades clave.</li>
            <li><strong>Detalles de Contacto</strong>: Proporcione información para que los interesados puedan aplicar o resolver dudas (puede incluir correo, teléfono o sitio web).</li>
            <li><strong>Estatus</strong>: Indique si el trabajo está "Activo" o "Inactivo".</li>
            <li><strong>Categoría</strong>: Seleccione la categoría a la que pertenece la oferta (Ejemplo: "Tecnología", "Marketing").</li>
            <li><strong>Imagen</strong> (Opcional): Cargue una imagen o logo representativo para la oferta.</li>
        </ul>
        

    </div>
    <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg px-4 py-4">
            <div class="flex items-center justify-between">
                <!--Input de busqueda-->
                <div class="flex items-center p-2 rounded-md flex-1">
                    <label class="w-full relative text-gray-400 focus-within:text-gray-600 block">
                        <svg class="pointer-events-none w-8 h-8 absolute top-1/2 transform -translate-y-1/2 left-3"
                            viewBox="0 0 25 25" fill="none" stroke="currentColor" stroke-linecap="round"
                            stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" class="w-6 h-6">
                            <path d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                        </svg>
                        <x-input type="text" wire:model="search" class="w-full block pl-14" placeholder="Buscar equipo..." />
                    </label>
                </div>

                <!--Boton nuevo-->
                <div class="lg:ml-40 ml-10 space-x-8">
                    <button wire:click="create()"
                        class="bg-indigo-600 px-4 py-2 rounded-md text-white font-semibold tracking-wide cursor-pointer">
                        <i class="fa-solid fa-plus"></i> Nuevo
                    </button>
                    @if($isOpen)
                        @include('joboffer.joboffer-create')
                    @endif
                </div>
            </div>
            <div class="py-5">
</div>
            <!--Tabla lista de items-->
            <div class="shadow overflow-x-auto border-b border-blue-800 sm:rounded-lg">
                <table class="w-full divide-y divide-blue-800 table-auto">
                    <thead class="bg-blue-800 text-white">
                        <tr class="text-left text-xs font-bold uppercase">
                            <td scope="col" class="px-6 py-3">ID</td>
                            <td scope="col" class="px-6 py-3">Titulo</td>
                            <td scope="col" class="px-6 py-3">Descripcion</td>
                            <td scope="col" class="px-6 py-3">Tipo</td>
                            <td scope="col" class="px-6 py-3">Ubicacion</td>
                            <td scope="col" class="px-6 py-3">Salario</td>
                            <td scope="col" class="px-6 py-3">Fecha de Inicio</td>
                            <td scope="col" class="px-6 py-3">Fecha del Fin</td>
                            <td scope="col" class="px-6 py-3">Experiencia Requerida</td>
                            <td scope="col" class="px-6 py-3">Detalles de Contacto</td>
                            <td scope="col" class="px-6 py-3">Estatus</td>
                            <td scope="col" class="px-6 py-3">Categoria</td>
                            <td scope="col" class="px-6 py-3">Imagen</td>
                            <td scope="col" class="px-6 py-3">Create</td>
                            <td scope="col" class="px-6 py-3">Actualizado</td>
                            <td scope="col" class="px-6 py-3">Opciones</td>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200">
                        @foreach ($joboffers as $item)
                        <tr class="text-sm font-medium text-gray-900">
                            <td class="px-6 py-4">
                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-indigo-500 text-white">
                                    {{$item->id}}
                                </span>
                            </td>
                            <td class="px-6 py-4 max-w-sm overflow-hidden truncate">{{$item->title}}</td>
                            <td class="px-6 py-4 max-w-sm overflow-hidden truncate">{{$item->description}}</td>
                            <td class="px-6 py-4 max-w-sm overflow-hidden truncate">{{$item->type}}</td>
                            <td class="px-6 py-4 max-w-sm overflow-hidden truncate">{{$item->location}}</td>
                            <td class="px-6 py-4 max-w-sm overflow-hidden truncate">{{$item->salary}}</td>
                            <td class="px-6 py-4 max-w-sm overflow-hidden truncate">{{$item->start_date}}</td>
                            <td class="px-6 py-4 max-w-sm overflow-hidden truncate">{{$item->end_date}}</td>
                            <td class="px-6 py-4 max-w-sm overflow-hidden truncate">{{$item->experience_required}}</td>
                            <td class="px-6 py-4 max-w-sm overflow-hidden truncate">{{$item->contact_details}}</td>
                            <td class="px-6 py-4 max-w-sm overflow-hidden truncate">{{$item->status}}</td>
                            <td class="px-6 py-4">
                                @php
                                    $category = App\Models\Category::find($item->category_id);
                                @endphp
                                {{ $category ? $category->name : 'Categoria no encontrada' }}
                            </td>
                            <td class="w-1/3">
                                @if ($item->image)
                                    <img src="{{ asset('storage/' . $item->image->url) }}" alt="Image" class="max-w-full max-h-full rounded-md object-cover">
                                @else
                                    <span class="text-gray-500">Sin imagen</span>
                                @endif
                            </td>
                            <td class="px-6 py-4">{{$item->created_at}}</td>
                            <td class="px-6 py-4">{{$item->updated_at}}</td>
                            <td class="px-6 py-4">
                                <x-button wire:click="edit({{$item}})">
                                    <i class="fas fa-edit"></i>
                                </x-button>
                                <x-danger-button wire:click="$emit('deleteItem',{{$item->id}})">
                                    <i class="fas fa-trash"></i>
                                </x-danger-button>
                                <x-button wire:click="openPreviewModal({{ $item->id }})" class="bg-green-800">
                                    <i class="fas fa-eye"></i>
                                </x-button>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            @if($joboffers->isEmpty())
                No hay ofertas de trabajo disponibles.
            @else
                @if($joboffers->hasPages())
                    <div class="px-6 py-3">
                        {{ $joboffers->links() }}
                    </div>
                @endif
            @endif

            @if ($showPreviewModal)
                <!-- Modal de previsualización -->
                <div class="fixed inset-0 flex items-center justify-center z-50">
                    <div class="bg-black opacity-75 fixed inset-0"></div>
                    <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg px-4 py-4 max-w-xl mx-auto sm:px-6 lg:px-8 grid z-10">
                        <div class="flex flex-col relative shadow-2xl rounded-b-lg">
                            <div class="flex-grow">
                                <div class="bg-white overflow-hidden">
                                    <img class="rounded-t-sm" src="@if ($selectedJobOffer->image) {{Storage::url($selectedJobOffer->image->url)}} @endif" width="100%" height="auto" alt="Application 21">
                                    <button class="mr-4 absolute top-4 left-4 bg-gray-800 bg-opacity-50 rounded-full">
                                        <div class="inline-flex items-center">
                                            <span class="text-white tracking-wider ml-2 mr-2 text-sm capitalize">{{$selectedJobOffer->category->name}}</span>
                                        </div>
                                    </button>
                                    <div class="ml-4 absolute top-4 right-4 bg-gray-800 bg-opacity-50 rounded-full">
                                        <div class="inline-flex items-center">
                                            <div class="inline-flex text-sm rounded-full mx-2 text-white">$ {{$selectedJobOffer->salary}}</div>
                                        </div>
                                    </div>
                                </div>
                                <div class="flex flex-col">
                                    <header class="m-4">
                                        <h3 class="text-slate-800 text-xl font-bold mb-2">{{$selectedJobOffer->title}}</h3>
                                        <div class="text-sm leading-relaxed line-clamp-3">{{$selectedJobOffer->description}}</div>
                                        <div class="flex flex-wrap justify-between items-center mt-4">
                                            <div class="text-sm text-gray-500">
                                                <div class="flex items-center">
                                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                                        <path stroke-linecap="round" stroke-linejoin="round" d="M15 10.5a3 3 0 11-6 0 3 3 0 016 0z" />
                                                        <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 10.5c0 7.142-7.5 11.25-7.5 11.25S4.5 17.642 4.5 10.5a7.5 7.5 0 1115 0z" />
                                                    </svg>
                                                    <span>{{$selectedJobOffer->location}}</span>
                                                </div>
                                            </div>
                                            <div class="flex items-center text-sm text-gray-500">
                                                <div class="flex items-center">
                                                    <svg class="inline-block w-4 h-4 mr-1 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                                        <path d="M12 22s-8-4.5-8-11.8A8 8 0 0 1 12 2a8 8 0 0 1 8 8.2c0 7.3-8 11.8-8 11.8z" />
                                                    </svg>
                                                    {{$selectedJobOffer->type}}
                                                </div>
                                            </div>
                                        </div>
                                    </header>
                                </div>
                            </div>
                        </div>  
                        <button wire:click="closePreviewModal" class="me-8 absolute bottom-4 right-4 bg-red-500 text-white px-4 py-2 rounded">Cerrar</button>
                    </div>
                </div>
            @endif
        </div>
    </div>
</div>

@push('js')
    <script>
        Livewire.on('deleteItem', id => {
            Swal.fire({
                title: '¿Estás seguro?',
                text: "¡No podrás revertir esto!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Sí, eliminarlo'
            }).then((result) => {
                if (result.isConfirmed) {
                    Livewire.emitTo('crud-joboffer', 'delete', id);
                    Swal.fire(
                        '¡Eliminado!',
                        'El registro ha sido eliminado.',
                        'success'
                    );
                }
            });
        });
    </script>
@endpush
