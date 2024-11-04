 <div class="py-5">
     <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
         <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg px-4 py-4">
             <div class="flex items-center justify-between">
                 <!--Input de busqueda   -->
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
                         @include('institucion.teacher-create')
                     @endif
                 </div>
             </div>
             <!--Tabla lista de items   -->
             <div class="relative shadow overflow-x-auto  border-b border-sky-700 sm:rounded-lg">
                 <table class="w-full border-collapse bg-white text-left text-sm text-white table-auto">
                     <thead class="bg-indigo-900 text-white">
                         <tr class="text-left text-xs font-bold  uppercase">
                             <td scope="col" class="px-6 py-3">ID</td>
                             <td scope="col" class="px-6 py-3">Usuario</td>
                             <td scope="col" class="px-6 py-3">academic_degree</td>
                             <td scope="col" class="px-6 py-3">specialty</td>
                             <td scope="col" class="px-6 py-3">email</td>
                             <td scope="col" class="px-6 py-3">institution_id</td>
                             <td scope="col" class="px-6 py-3">Creado</td>
                             <td scope="col" class="px-6 py-3">Actualizado</td>
                             <td scope="col" class="px-6 py-3">Opciones</td>
                         </tr>
                     </thead>
                     <tbody class="divide-y divide-indigo-900">
                         @foreach ($teachers as $item)
                             <tr class="text-sm font-medium text-gray-900">
                                <td class="px-6 py-4">
                                    <div class="relative h-10 w-10">
                                      @if ($item->user->profile_photo_path)
                                        <img class="h-full w-full rounded-full object-cover object-center border-2 border-gray-400" src="/storage/{{ $item->user->profile_photo_path }}" alt="{{ $item->user->name }}" />
                                      @else
                                        <img class="h-9 w-9 rounded-full object-cover border-2 border-gray-400" src="{{ $item->user->profile_photo_url }}" alt="{{ $item->user->name }}" />
                                      @endif
                                      <span class="absolute right-0 bottom-0 flex items-center justify-center h-4 w-4 bg-indigo-900 rounded-full ring-white ring-1">
                                        <span class="text-xs font-semibold text-white">{{ $item->id }}</span>
                                      </span>
                                    </div>
                                  </td>
                                 <td class="px-6 py-4">
                                     {{ $item->user->name }} {{ $item->user->paternal_last_name }}
                                     {{ $item->user->maternal_last_name }}
                                 </td>
                                 <td class="px-6 py-4">{{ $item->academic_degree }}</td>
                                 <td class="px-6 py-4">{{ $item->specialty }}</td>
                                 <td class="px-6 py-4">
                                     {{ $item->user ? $item->user->email : 'Correo no encontrado' }}
                                 </td>
                                 <td class="px-6 py-4">
                                     @php
                                         $institution = App\Models\Institution::find($item->institution_id);
                                     @endphp
                                     {{ $institution ? $institution->name : 'Institucion no encontrada' }}
                                 </td>
                                 <td class="px-6 py-4">{{ $item->created_at }}</td>
                                 <td class="px-6 py-4">{{ $item->updated_at }}</td>
                                 <td class="px-6 py-4">
                                     {{-- @livewire('cliente-edit',['cliente'=>$item],key($item->id)) --}}
                                     <x-button wire:click="edit({{ $item }})">
                                         <i class="fas fa-edit"></i>
                                     </x-button>
                                     <x-danger-button wire:click="$emit('deleteItem',{{ $item->id }})">
                                         <!-- Usamos metodos magicos -->
                                         <i class="fas fa-trash"></i>
                                     </x-danger-button>
                                 </td>
                             </tr>
                         @endforeach
                     </tbody>

                 </table>
             </div>
             @if (!$teachers->count())
                 No existe ningun registro conincidente
             @endif
             @if ($teachers->hasPages())
                 <div class="px-6 py-3">
                     {{ $teachers->links() }}
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
                         Livewire.emitTo('crud-teacher', 'delete', id);
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
