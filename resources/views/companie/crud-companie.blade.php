<div class="py-5">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
<div class="bg-white overflow-hidden shadow-xl sm:rounded-lg px-4 py-4">
<div class="flex items-center justify-between">
<!--Input de búsqueda-->
<div class="flex items-center p-2 rounded-md flex-1">
<label class="w-full relative text-gray-400 focus-within:text-gray-600 block">
<svg class="pointer-events-none w-8 h-8 absolute top-1/2 transform -translate-y-1/2 left-3"
viewBox="0 0 25 25" fill="none" stroke="currentColor" stroke-linecap="round"
stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" class="w-6 h-6">
<path d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                        </svg>
                        <x-input type="text" wire:model="search" class="w-full block pl-14"
                            placeholder="Buscar empresa..." />
                    </label>
                </div>
                <!--Botón nuevo-->
                <div class="lg:ml-40 ml-10 space-x-8">
                    <button wire:click="create()"
                        class="bg-indigo-900 px-4 py-2 rounded-md text-white font-semibold tracking-wide cursor-pointer">
                        <i class="fa-solid fa-plus"></i> Nuevo
                    </button>
                    @if ($isOpen)
                        @include('companie.companie-create')
                    @endif
                </div>
            </div>
            <!--Tabla lista de empresas-->
            <div class="shadow overflow-x-auto border-b border-gray-700 sm:rounded-lg">
                <table class="w-full divide-y divide-gray-200 table-auto">
                    <thead class="bg-indigo-900 text-white">
                        <tr class="text-left text-xs font-bold uppercase">
                            <td scope="col" class="px-6 py-3">ID</td>
                            <td scope="col" class="px-6 py-3">Nombre</td>
                            <td scope="col" class="px-6 py-3">Descripción</td>
                            <td scope="col" class="px-6 py-3">Ubicación</td>
                            <td scope="col" class="px-6 py-3">Correo electrónico</td>
                            <td scope="col" class="px-6 py-3">Dirección</td>
                            <td scope="col" class="px-6 py-3">Teléfono</td>
                            <td scope="col" class="px-6 py-3">Sector de la industria</td>
                            <td scope="col" class="px-6 py-3">Años de actividad</td>
                            <td scope="col" class="px-6 py-3">Usuario</td>
                            <td scope="col" class="px-6 py-3">Creado</td>
                            <td scope="col" class="px-6 py-3">Actualizado</td>
                            <td scope="col" class="px-6 py-3">Opciones</td>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200">
                        @foreach ($companies as $company)
                            <tr class="text-sm font-medium text-gray-900">
                                <td class="px-6 py-4">{{ $company->id }}</td>
                                <td class="px-6 py-4">{{ $company->name }}</td>
                                <td class="px-6 py-4">{{ $company->description }}</td>
                                <td class="px-6 py-4">{{ $company->location }}</td>
                                <td class="px-6 py-4">{{ $company->email }}</td>
                                <td class="px-6 py-4">{{ $company->address }}</td>
                                <td class="px-6 py-4">{{ $company->phone }}</td>
                                <td class="px-6 py-4">{{ $company->industry_sector }}</td>
                                <td class="px-6 py-4">{{ $company->years_of_activity }}</td>
                                <td class="px-6 py-4">{{ $company->user->name }}</td>
                                <td class="px-6 py-4">{{ $company->created_at }}</td>
                                <td class="px-6 py-4">{{ $company->updated_at }}</td>
                                <td class="px-6 py-4">
                                    <x-button wire:click="edit({{ $company }})">
                                        <i class="fas fa-edit"></i>
                                    </x-button>
                                    <x-danger-button wire:click="$emit('deleteItem',{{ $company->id }})">
                                        <i class="fas fa-trash"></i>
                                    </x-danger-button>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            @if (!$companies->count())
                No existe ningún registro coincidente
            @endif
            @if ($companies->hasPages())
                <div class="px-6 py-3">
                    {{ $companies->links() }}
                </div>
            @endif
        </div>
    </div>

    <!--Scripts - Sweetalert-->
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
                        Livewire.emitTo('crud-companie', 'delete', id);
                        Swal.fire(
                            '¡Eliminado!',
                            'Tu registro ha sido eliminado.',
                            'success'
                        )
                    }
                })
            });
        </script>
    @endpush
</div>
