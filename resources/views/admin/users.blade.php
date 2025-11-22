<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">Gestionar usuarios</h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow sm:rounded-lg p-6">
                <h3 class="text-lg font-medium">Gestionar usuarios</h3>
                <p class="text-sm text-gray-600 mt-2">Lista de usuarios y acciones administrativas. (Vista placeholder)</p>

                @isset($users)
                    <div class="mt-4">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead>
                                <tr>
                                    <th class="px-4 py-2 text-left text-sm font-medium text-gray-500">Nombre</th>
                                    <th class="px-4 py-2 text-left text-sm font-medium text-gray-500">Email</th>
                                    <th class="px-4 py-2 text-left text-sm font-medium text-gray-500">Rol</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                @foreach($users as $u)
                                    <tr>
                                        <td class="px-4 py-2 text-sm text-gray-700">{{ $u->name }}</td>
                                        <td class="px-4 py-2 text-sm text-gray-700">{{ $u->email }}</td>
                                        <td class="px-4 py-2 text-sm text-gray-700">{{ $u->role ?? 'user' }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <div class="mt-4">{{ $users->links() }}</div>
                    </div>
                @endisset

            </div>
        </div>
    </div>
</x-app-layout>
