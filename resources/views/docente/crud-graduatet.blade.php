<div class="min-h-screen bg-gray-100 py-8">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Título estadística -->
        <div class="text-center mb-12">
            <h1 class="text-5xl font-extrabold text-gray-800">
                Estadísticas de los Usuarios
            </h1>
        </div>

        <!-- Estadísticas -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-12">
            <!-- Usuarios -->
            <div class="bg-white rounded-lg p-6 text-center shadow-lg transition duration-300 ease-in-out transform hover:scale-105">
                <div class="flex items-center justify-center space-x-4">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" class="w-10 h-10 text-green-500">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15 19.128a9.38 9.38 0 002.625.372 9.337 9.337 0 004.121-.952 4.125 4.125 0 00-7.533-2.493M15 19.128v-.003c0-1.113-.285-2.16-.786-3.07M15 19.128v.106A12.318 12.318 0 018.624 21c-2.331 0-4.512-.645-6.374-1.766l-.001-.109a6.375 6.375 0 0111.964-3.07M12 6.375a3.375 3.375 0 11-6.75 0 3.375 3.375 0 016.75 0zm8.25 2.25a2.625 2.625 0 11-5.25 0 2.625 2.625 0 015.25 0z" />
                    </svg>
                    <div>
                        <p class="text-gray-700 text-lg font-medium">Usuarios</p>
                        <p class="text-gray-900 text-4xl font-bold">{{ $graduateCount }}</p>
                    </div>
                </div>
            </div>

            <!-- Niveles Académicos -->
            @foreach ($academicLevels as $level => $count)
                <div class="bg-white rounded-lg p-6 text-center shadow-lg transition duration-300 ease-in-out transform hover:scale-105">
                    <div class="flex items-center justify-center space-x-4">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" class="w-10 h-10 text-blue-500">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
                        </svg>
                        <div>
                            <p class="text-gray-700 text-lg font-medium">{{ ucfirst($level) }}</p>
                            <p class="text-gray-900 text-4xl font-bold">{{ $count }}</p>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        <!-- Tabla de Egresados -->
        <div class="text-center mb-12">
            <h1 class="text-5xl font-extrabold text-gray-800">
                Tabla de Egresados
            </h1>
        </div>

        <!-- Buscar Egresados -->
        <div class="mb-6">
            <x-input type="text" wire:model="search" class="w-full block" placeholder="Buscar egresado..." />
        </div>

        <!-- Tabla -->
        <div class="bg-white shadow-md rounded-lg overflow-hidden">
            <table class="min-w-full table-auto text-gray-800">
                <thead class="bg-blue-500 text-white">
                    <tr>
                        <th class="p-4 text-left text-sm font-semibold">ID</th>
                        <th class="p-4 text-left text-sm font-semibold">Número de Contacto</th>
                        <th class="p-4 text-left text-sm font-semibold">Especialidad</th>
                        <th class="p-4 text-left text-sm font-semibold">Nivel Académico</th>
                        <th class="p-4 text-left text-sm font-semibold">Usuario</th>
                        <th class="p-4 text-left text-sm font-semibold">Institución</th>
                        <th class="p-4 text-left text-sm font-semibold">Creado</th>
                        <th class="p-4 text-left text-sm font-semibold">Actualizado</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200 bg-gray-50">
                    @foreach ($graduates as $item)
                        <tr class="hover:bg-gray-100 transition duration-150 ease-in-out">
                            <td class="p-4">{{ $item->id }}</td>
                            <td class="p-4">{{ $item->code }}</td>
                            <td class="p-4">{{ $item->specialty }}</td>
                            <td class="p-4">{{ $item->academic_level }}</td>
                            <td class="p-4">{{ $item->user->name }}</td>
                            <td class="p-4">{{ $item->institution->name }}</td>
                            <td class="p-4">{{ $item->created_at ? $item->created_at->format('d/m/Y H:i:s') : 'Sin fecha' }}</td>
                            <td class="p-4">{{ $item->updated_at ? $item->updated_at->format('d/m/Y H:i:s') : 'Sin fecha' }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

            <!-- Si no hay registros -->
            @if(!$graduates->count())
                <p class="p-6 text-center text-gray-500">No existe ningún registro coincidente.</p>
            @endif

            <!-- Paginación -->
            @if($graduates->hasPages())
                <div class="p-6">
                    {{ $graduates->links() }}
                </div>
            @endif
        </div>
    </div>
</div>
