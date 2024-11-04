<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-md rounded-lg px-4 py-6">
                <h2 class="text-2xl font-semibold mb-6">Usuarios Pendientes de Aprobación</h2>
                Lista de usuarios que han solicitado acceso y están en espera de ser aprobados para poder utilizar el sistema. Revisa y aprueba los perfiles que cumplan con los requisitos establecidos para garantizar la seguridad y calidad de la comunidad.
                <div class="mb-4">
                    <input type="text" wire:model="search" placeholder="Buscar usuario..."
                        class="w-full px-4 py-2 border rounded-lg focus:ring focus:ring-blue-300 focus:border-blue-500">
                </div>

                <div class="overflow-x-auto">
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
                                        <form action="{{ route('admin.approve-user', $user->id) }}" method="POST" onsubmit="return confirm('¿Estás seguro de que deseas aprobar este usuario?')">
                                            @csrf
                                            <div class="inline-flex items-center space-x-4">
                                                <label class="inline-flex items-center">
                                                    <input type="radio" name="role" value="usuario" required class="form-radio h-4 w-4 text-blue-600">
                                                    <span class="ml-2">Usuario</span>
                                                </label>
                                                <label class="inline-flex items-center">
                                                    <input type="radio" name="role" value="empresa" required class="form-radio h-4 w-4 text-blue-600">
                                                    <span class="ml-2">Empresa</span>
                                                </label>
                                                <button type="submit" class="ml-4 bg-blue-600 text-white px-4 py-2 rounded-lg shadow hover:bg-blue-500 transition duration-150">
                                                    Aprobar
                                                </button>
                                            </div>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                @if (!$users->count())
                    <p class="mt-4 text-center text-gray-500">No hay usuarios pendientes de aprobación.</p>
                @endif
            </div>
        </div>
    </div>
</x-app-layout>
