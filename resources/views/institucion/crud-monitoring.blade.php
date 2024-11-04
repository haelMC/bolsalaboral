<div class="py-5">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg px-4 py-4">
            <div class="flex items-center justify-between">
                <!--Input de búsqueda   -->
                <div class="flex items-center p-2 rounded-md flex-1">
                    <label class="w-full relative text-gray-400 focus-within:text-gray-600 block">
                        <svg class="pointer-events-none w-8 h-8 absolute top-1/2 transform -translate-y-1/2 left-3"
                            viewBox="0 0 25 25" fill="none" stroke="currentColor" stroke-linecap="round"
                            stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" class="w-6 h-6">
                            <path d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                        </svg>
                        <x-input type="text" wire:model="search" class="w-full block pl-14"
                            placeholder="Buscar equipo..." />
                    </label>
                </div>
                <!--Boton nuevo   -->
                <div class="lg:ml-40 ml-10 space-x-8">
                    <button wire:click="create()"
                        class="bg-indigo-900 px-4 py-2 rounded-md text-white font-semibold tracking-wide cursor-pointer">
                        <i class="fa-solid fa-plus"></i> Nuevo
                    </button>
                    @if ($isOpen)
                        @include('institucion.monitoring-create')
                    @endif
                </div>
            </div>
            <!--Tabla lista de items   -->
            <div class="relative overflow-x-auto rounded-lg border border-sky-700 shadow-lg m-5">
                <table class="w-full border-collapse bg-white text-left text-sm text-white table-auto">
                    <thead class="bg-indigo-900">
                        <tr class="shadow-lg">
                            <td scope="col" class="px-6 py-3 ">ID</td>
                            <td scope="col" class="px-6 py-3 ">Docente</td>
                            <td scope="col" class="px-6 py-3 ">Supervisados</td>
                            <td scope="col" class="px-6 py-3 ">Creado</td>
                            <td scope="col" class="px-6 py-3 ">Actualizado</td>
                            <td scope="col" class="px-6 py-3 ">Opciones</td>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-indigo-900">
                        @foreach ($monitorings as $item)
                            <tr class="text-sm font-medium text-gray-900">
                                <td class="px-6 py-4">
                                    <div class="flex mb-5 -space-x-4">
                                        @isset($item->teacher)
                                            <div class="relative h-10 w-10">
                                                <img class="w-10 h-10 border-2 border-gray-400 rounded-full"
                                                    src="{{ optional($item->teacher->user)->profile_photo_path ? '/storage/' . optional($item->teacher->user)->profile_photo_path : optional($item->teacher->user)->profile_photo_url }}"
                                                    alt="{{ optional($item->teacher->user)->name }}">
                                            </div>
                                        @endisset
                                        @isset($item->graduate)
                                            <div class="relative h-10 w-10">
                                                <img class="w-full h-full object-cover border-gray-400 rounded-full border-2 border-whitl"
                                                    src="{{ optional($item->graduate->user)->profile_photo_path ? '/storage/' . optional($item->graduate->user)->profile_photo_path : optional($item->graduate->user)->profile_photo_url }}"
                                                    alt="{{ optional($item->graduate->user)->name }}">
                                                <span class="absolute right-0 bottom-0 flex items-center justify-center h-4 w-4 bg-indigo-900 rounded-full ring-white ring-1">
                                                    <span class="text-xs font-semibold text-white">{{ $item->id }}</span>
                                                </span>
                                            </div>
                                        @endisset
                                    </div>
                                </td>
                                <td class="px-6 py-4">
                                    @php
                                        $teacher = App\Models\Teacher::find($item->teacher_id);
                                        $name = $teacher && $teacher->user ? $teacher->user->name : null;
                                        $paternalLastName = $teacher && $teacher->user ? $teacher->user->paternal_last_name : null;
                                        $maternalLastName = $teacher && $teacher->user ? $teacher->user->maternal_last_name : null;
                                    @endphp
                                    @if ($name && $paternalLastName && $maternalLastName)
                                        {{ $name }} {{ $paternalLastName }} {{ $maternalLastName }}
                                    @else
                                        Teacher not found
                                    @endif
                                </td>
                                <td class="px-6 py-4">
                                    @php
                                        $graduate = App\Models\Graduate::find($item->graduate_id);
                                        $code = $graduate ? $graduate->code : null;
                                        $name = $graduate && $graduate->user ? $graduate->user->name : null;
                                        $paternalLastName = $graduate && $graduate->user ? $graduate->user->paternal_last_name : null;
                                    @endphp
                                    {{ $code && $name ? $code . ' - ' . $name . ' ' . $paternalLastName : 'Egresado no encontrado' }}
                                </td>
                                <td class="px-6 py-4">{{ $item->created_at }}</td>
                                <td class="px-6 py-4">{{ $item->updated_at }}</td>
                                <td class="px-6 py-4">
                                    {{-- @livewire('cliente-edit',['cliente'=>$item],key($item->id)) --}}
                                    <x-button wire:click="edit({{ $item }})">
                                        <i class="fas fa-edit"></i>
                                    </x-button>
                                    <x-danger-button wire:click="$emit('deleteItem',{{ $item->id }})">
                                        <!-- Usamos métodos mágicos -->
                                        <i class="fas fa-trash"></i>
                                    </x-danger-button>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            @if (!$monitorings->count())
                No existe ningún registro coincidente
            @endif
            @if ($monitorings->hasPages())
                <div class="px-6 py-3">
                    {{ $monitorings->links() }}
                </div>
            @endif
        </div>
    </div>
    <!--Scripts - Sweetalert   -->
    @push('js')
        <script>
            Livewire.on('deleteItem', id => {
                Swal.fire({
                    title: 'Are you sure?',
                    text: "You won't be able to revert this!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, delete it!'
                }).then((result) => {
                    if (result.isConfirmed) {
                        //alert("del");
                        Livewire.emitTo('crud-monitoring', 'delete', id);
                        Swal.fire(
                            'Deleted!',
                            'Your file has been deleted.',
                            'success'
                        )
                    }
                })
            });
        </script>
    @endpush
</div>
