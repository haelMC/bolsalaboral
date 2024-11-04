<div>
    <h1 class="text-xl font-bold mb-4">Lista de Usuarios y Empresas</h1>
    Directorio completo de usuarios y empresas registrados en la plataforma, con sus perfiles y detalles relevantes para facilitar la conexión y colaboración.
    <!-- Usuarios -->
    <h2 class="text-xl font-bold mb-4">Usuarios</h2>
    Accede a la lista de usuarios registrados, con información detallada para facilitar la búsqueda y el contacto según especialidades y experiencia.
    <div class="mb-4">
        <input type="text" wire:model="searchUser" placeholder="Buscar usuario..."
            class="w-full px-4 py-2 border rounded-lg focus:ring focus:ring-blue-300 focus:border-blue-500">
    </div>
    <table class="min-w-full bg-white divide-y divide-gray-200">
        <thead class="bg-blue-600 text-white">
            <tr>
                <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider">Nombre</th>
                <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider">Email</th>
                <th class="px-6 py-3 text-center text-xs font-medium uppercase tracking-wider">Acciones</th>
            </tr>
        </thead>
        <tbody class="bg-white divide-y divide-gray-200">
            @foreach ($users as $user)
                <tr>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <div class="text-sm font-medium text-gray-900">{{ $user->name }}</div>
                    </td>
                    <td class="px-6 py-4">
                        <div class="text-sm text-gray-500">{{ $user->email }}</div>
                    </td>
                    <td class="px-6 py-4 text-center">
                        <button wire:click="confirmUserDeletion({{ $user->id }})" class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded">
                            Eliminar
                        </button>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <!-- Empresas -->
    <h2 class="text-xl font-bold mb-4 mt-8">Empresas</h2>
    <div class="mb-4">
        <input type="text" wire:model="searchCompany" placeholder="Buscar empresa..."
            class="w-full px-4 py-2 border rounded-lg focus:ring focus:ring-blue-300 focus:border-blue-500">
    </div>
    <table class="min-w-full bg-white divide-y divide-gray-200">
        <thead class="bg-blue-600 text-white">
            <tr>
                <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider">Nombre</th>
                <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider">Email</th>
                <th class="px-6 py-3 text-center text-xs font-medium uppercase tracking-wider">Acciones</th>
            </tr>
        </thead>
        <tbody class="bg-white divide-y divide-gray-200">
            @foreach ($companies as $company)
                <tr>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <div class="text-sm font-medium text-gray-900">{{ $company->name }}</div>
                    </td>
                    <td class="px-6 py-4">
                        <div class="text-sm text-gray-500">{{ $company->email }}</div>
                    </td>
                    <td class="px-6 py-4 text-center">
                        <button wire:click="confirmUserDeletion({{ $company->id }})" class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded">
                            Eliminar
                        </button>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <!-- Modal de Confirmación -->
    @if($confirmingUserDeletion)
        <div class="fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full" id="my-modal">
            <div class="relative top-20 mx-auto p-5 border w-96 shadow-lg rounded-md bg-white">
                <h3 class="text-lg leading-6 font-medium text-gray-900 text-center">Confirmar Eliminación</h3>
                <div class="mt-2 text-center">
                    <p class="text-sm text-gray-500">¿Estás seguro de que deseas eliminar este usuario/empresa? Esta acción no se puede deshacer.</p>
                </div>
                <div class="flex justify-center mt-4">
                    <button wire:click="deleteUser" class="bg-red-600 text-white px-4 py-2 rounded hover:bg-red-800">Eliminar</button>
                    <button wire:click="$set('confirmingUserDeletion', false)" class="ml-4 bg-gray-300 text-black px-4 py-2 rounded hover:bg-gray-400">Cancelar</button>
                </div>
            </div>
        </div>
    @endif

    <!-- Mensaje de éxito -->
    @if (session()->has('message'))
        <div class="mt-4 text-green-600 font-semibold">
            {{ session('message') }}
        </div>
    @endif
</div>
