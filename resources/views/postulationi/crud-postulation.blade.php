<div>
    <div class="py-5">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg px-4 py-4">
            <h1 class="text-xl font-bold mb-4">Postulaciones</h1>
                <p class="text-gray-700 mb-6">
                    Aquí encontrarás una lista de todas las postulaciones realizadas por los egresados para las diferentes ofertas de trabajo. Revisa y gestiona el estado de cada postulación, así como el acceso a los perfiles y documentos adjuntos de cada candidato.
                </p>

                <div class="flex items-center justify-between">

                    <!-- Input de búsqueda -->
                    <div class="flex items-center p-2 rounded-md flex-1">
                        <label class="w-full relative text-blue-800 focus-within:text-gray-600 block">
                            <svg class="pointer-events-none w-8 h-8 absolute top-1/2 transform -translate-y-1/2 left-3" viewBox="0 0 25 25" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2">
                                <path d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                            </svg>
                            <x-input type="text" wire:model="search" class="w-full block pl-14" placeholder="Buscar equipo..." />
                        </label>
                    </div>
                </div>

                <div class="shadow overflow-x-auto border-b border-blue-800 sm:rounded-lg">
                        <table class="w-full divide-y divide-blue-800 table-auto">
                            <thead class="bg-blue-800 text-white">
                                <tr class="text-center text-xs font-bold uppercase">
                                    <th scope="col" class="px-6 py-3">Id</th>
                                    <th scope="col" class="px-6 py-3">Cv</th>
                                    <th scope="col" class="px-6 py-3">Estado</th>
                                    <th scope="col" class="px-6 py-3">Nombre del graduado</th>
                                    <th scope="col" class="px-6 py-3">Nombre del trabajo</th>
                                    @if (Auth::user()->role_id == 2 || Auth::user()->role_id == 3)
                                        <th scope="col" class="px-6 py-3">Opciones</th>
                                    @endif
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-blue-800">
                                @foreach ($postulations as $item)
                                    <tr class="text-sm font-bold text-gray-900">
                                        <td class="px-6 py-4 text-center">{{ $item->id }}</td>
                                        <td class="px-6 py-4 text-center">
                                            @if ($item->cv)
                                                <a href="{{ $item->cv_url }}" target="_blank" class="text-blue-600 hover:underline">Ver archivo adjunto</a>
                                            @else
                                                <p>No se ha enviado ningún archivo</p>
                                            @endif
                                        </td>
                                        <td class="px-6 py-4 text-center">
                                            @if ($item->status === 'accepted')
                                                Aceptado
                                            @elseif ($item->status === 'rejected')
                                                Rechazado
                                            @elseif ($item->status === 'pending')
                                                Pendiente
                                            @endif
                                        </td>
                                        <td class="px-6 py-4 text-center">
                                            @php
                                                $graduate = App\Models\Graduate::find($item->graduate_id);
                                                $user = null;

                                                if ($graduate) {
                                                    $user = App\Models\User::find($graduate->user_id);
                                                    $user = $user->name . ' ' . $user->paternal_last_name . ' ' . $user->maternal_last_name;
                                                }
                                            @endphp
                                            {{ $user ?: 'Información no encontrada' }}
                                        </td>
                                        <td class="px-6 py-4 text-center">
                                            @php
                                                $joboffer = App\Models\Joboffer::find($item->joboffer_id);
                                            @endphp
                                            {{ $joboffer ? $joboffer->title : 'Información no encontrada' }}
                                        </td>
                                        @if (Auth::user()->role_id == 2 || Auth::user()->role_id == 3)
                                            <td class="px-6 py-4 text-center">
                                                <!-- Botón de editar -->
                                                <x-button wire:click="edit({{ $item->id }})" class="bg-blue-600 hover:bg-blue-500 text-white">
                                                    <i class="fas fa-edit"></i>
                                                </x-button>

                                                <!-- Botón de eliminar -->
                                                <x-danger-button wire:click="delete({{ $item->id }})" class="bg-red-600 hover:bg-red-500 text-white">
                                                    <i class="fas fa-trash"></i>
                                                </x-danger-button>
                                            </td>
                                        @endif
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>


                @if (!$postulations->count())
                    <p class="mt-4 text-center">No existe ningún registro coincidente</p>
                @endif

                @if ($postulations->hasPages())
                    <div class="px-6 py-3">
                        {{ $postulations->links() }}
                    </div>
                @endif
            </div>
        </div>
    </div>

    <!-- Modal de edición de postulación -->
    @if ($isOpen)
        <x-dialog-modal wire:model="isOpen">
            <x-slot name="title">
                Editar Postulación
            </x-slot>

            <x-slot name="content">
                <form wire:submit.prevent="update">
                    <!-- Campos de la postulación a editar -->

                    <div class="mb-4">
                        <x-label for="status" value="Status" />
                        <select id="status" wire:model="postulation.status" class="block mt-1 w-full">
                            <option value="">Seleccione un estado</option>
                            <option value="accepted">Aceptado</option>
                            <option value="rejected">Rechazado</option>
                            <option value="pending">Pendiente</option>
                        </select>
                        <x-input-error for="postulation.status" class="mt-2" />
                    </div>
                </form>
            </x-slot>

            <x-slot name="footer">
                <x-secondary-button wire:click="$set('isOpen', false)">
                    Cancelar
                </x-secondary-button>

                <x-button wire:click="update">
                    Guardar
                </x-button>
            </x-slot>
        </x-dialog-modal>
    @endif
</div>
