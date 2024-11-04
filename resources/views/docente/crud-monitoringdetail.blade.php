<div class="flex items-center justify-center min-h-screen min-w-fit bg-gray-900">
    <div class="col-span-12">
        <div class="overflow-auto lg:overflow-visible">
            <style>
                .table {
                    border-spacing: 0 15px;
                }

                i {
                    font-size: 1rem !important;
                }

                .table tr {
                    border-radius: 20px;
                }

                tr td:nth-child(n+9),
                tr th:nth-child(n+9) {
                    border-radius: 0 .625rem .625rem 0;
                }

                tr td:nth-child(1),
                tr th:nth-child(1) {
                    border-radius: .625rem 0 0 .625rem;
                }
            </style>
            <div class="p-4 flex items-center">
                <div class="flex-grow flex items-center">
                    <x-input type="text" wire:model="search" class="max-w-6xl w-full block pl-14 bg-gradient-to-r from-white via-#808080 to-black" placeholder="Buscar equipo..." />
                </div>
                <div>
                    <button wire:click="create()" class="relative inline-flex items-center justify-center p-0.5 mb-2 mr-2 overflow-hidden text-sm font-medium text-gray-900 rounded-lg group bg-gradient-to-br from-green-400 to-blue-600 group-hover:from-green-400 group-hover:to-blue-600 hover:text-white dark:text-white focus:ring-4 focus:outline-none focus:ring-green-200 dark:focus:ring-green-800">
                        <i class="relative px-5 py-2.5 transition-all ease-in duration-75 bg-white dark:bg-gray-900 rounded-md group-hover:bg-opacity-0">Nuevo</i>
                    </button>
                </div>
                @if($isOpen)
                @include('docente.monitoringdetail-create')
                @endif
            </div>

            <table class="table text-gray-400 border-separate space-y-6 text-sm text-center">
                <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400 ">
                    <tr class="bg-gray-800 text-gray-500 text-center">
                        <th scope="col" class="p-3 text-center">ID</th>
                        <th scope="col" class="p-3 text-center">recommendation</th>
                        <th scope="col" class="p-3 text-center">description</th>
                        <th scope="col" class="p-3 text-center">monitoring_id</th>
                        <th scope="col" class="p-3 text-center">date_monitoringdetail</th>
                        <th scope="col" class="p-3 text-center">Creado</th>
                        <th scope="col" class="p-3 text-center">Actualizado</th>
                        <th scope="col" class="p-3 text-center">Opciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($monitoringdetails as $item)
                    <tr class="bg-gray-800">
                        <tr class="bg-gray-800">
                            <td class="px-6 py-4">
                                <div class="relative h-10 w-10">
                                    @if ($item->monitoring->graduate->user->profile_photo_path)
                                        <img class="h-full w-full rounded-full object-cover object-center border-2 border-gray-400" src="/storage/{{ $item->monitoring->graduate->user->profile_photo_path }}" alt="{{ $item->monitoring->graduate->user->name }}" />
                                    @else
                                        <img class="h-9 w-9 rounded-full object-cover border-2 border-gray-400" src="{{ $item->monitoring->graduate->user->profile_photo_url }}" alt="{{ $item->monitoring->graduate->user->name }}" />
                                    @endif
                                    <span class="absolute right-0 bottom-0 flex items-center justify-center p-1 h-4 w-4 bg-indigo-900 rounded-full ring-white ring-1">
                                        <span class="text-xs font-semibold text-white">{{ $item->id }}</span>
                                    </span>
                                </div>
                            </td>
                        <td class="p-3 font-bold">{{$item->recommendation}}</td>
                        <td class="p-3">{{$item->description}}</td>
                        <td class="p-3">
                            @php
                                $monitoring = App\Models\Monitoring::find($item->monitoring_id);
                                $graduate = $monitoring->graduate_id ?? null;
                                $user = null;

                                if ($graduate) {
                                    $user = App\Models\Graduate::find($graduate)->user;
                                }
                            @endphp
                            {{ $user ? $user->name. ' ' .$user->paternal_last_name. ' ' .$user->maternal_last_name : 'Categoría no encontrada' }}
                        </td>


                        <td class="p-3">{{$item->date_monitoring}}</td>
                        <td class="p-3">{{$item->created_at}}</td>
                        <td class="p-3">{{$item->updated_at}}</td>
                        <td class="p-3">
                            <x-button wire:click="edit({{$item}})">
                                <i class="fas fa-edit"></i>
                            </x-button>
                            <x-danger-button wire:click="$emit('deleteItem',{{$item->id}})">
                                <i class="fas fa-trash"></i>
                            </x-danger-button>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
            @if(!$monitoringdetails->count())
            <p>No existe ningún registro coincidente.</p>
            @endif
            @if($monitoringdetails->hasPages())
            <div class="px-6 py-3">
                {{$monitoringdetails->links()}}
            </div>
            @endif
        </div>
    </div>

    @push('js')
    <script>
    Livewire.on('deleteItem',id=>{
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
                Livewire.emitTo('crud-monitoringdetail', 'delete', id);
                Swal.fire(
                    '¡Eliminado!',
                    'Tu archivo ha sido eliminado.',
                    'success'
                )
            }
        })
    });
    </script>
    @endpush
</div>
