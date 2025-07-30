<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col md:flex-row items-start md:items-center justify-between mb-6">
            <h2 class="text-2xl font-semibold text-gray-800">Gestion des Utilisaturs</h2>
            <a href="{{ route('users.create') }}" class="inline-flex gap-3 items-center px-4 py-2 text-blue-700 hover:text-blue-700 hover:bg-blue-50 ease-out duration-500 transition-all  bg-white border text-sm font-medium rounded-md mt-4 md:mt-0">
              Ajouter un utilisateur  <x-heroicon-o-plus class="h-4 w-4 "  /> 
            </a>
        </div>
    </x-slot>

    @session('success')
    <div class="mb-4 p-4 bg-green-100 border border-green-300 text-green-800 rounded">
        {{ $value }}
    </div>
    @endsession

    <div class="overflow-x-auto w-full p-16 px-24">
        <table class="min-w-full bg-white border border-gray-200 rounded-lg shadow-sm text-sm">
            <thead class="bg-gray-100">
                <tr>
                    <th class="px-4 py-2 border-b text-left">No</th>
                    <th class="px-4 py-2 border-b text-left">Nom</th>
                    <th class="px-4 py-2 border-b text-left">Adresse E-mail</th>
                    <th class="px-4 py-2 border-b text-left">Liste des roles</th>
                    <th class="px-4 py-2 border-b text-center w-64">Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($data as $key => $user)
                <tr class="border-t">
                    <td class="px-4 py-2">{{ ++$i }}</td>
                    <td class="px-4 py-2">{{ $user->name }}</td>
                    <td class="px-4 py-2">{{ $user->email }}</td>
                    <td class="px-4 py-2 uppercase">
                        @if(!empty($user->getRoleNames()))
                        @foreach($user->getRoleNames() as $v)
                        <span class="inline-block bg-blue-50 text-blue-700 underline text-xs font-semibold px-2 py-1 rounded">{{ $v }}</span>
                        @endforeach
                        @endif
                    </td>
                    <td class="px-4 py-2 flex flex-wrap items-center justify-center gap-2">
                        <a href="{{ route('users.show', $user->id) }}" class="inline-flex items-center px-3 py-2 hover:bg-green-50 text-green-500 hover:text-green-600 bg-white border text-xs font-medium rounded">
                            <x-heroicon-o-eye class="h-4 w-4"  />
                        </a>
                        <a href="{{ route('users.edit', $user->id) }}" class="inline-flex items-center px-3 py-2 hover:bg-indigo-50 text-indigo-500 hover:text-indigo-600 border bg-white text-xs font-medium rounded">
                            <x-fas-pen class="h-4 w-4"/>
                        </a>
                        <form method="POST" action="{{ route('users.destroy', $user->id) }}" onsubmit="return confirm('Are you sure?')" class="inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="inline-flex items-center px-3 py-2 text-red-500 hover:text-red-600 hover:bg-red-50 bg-white border text-xs font-medium rounded">
                                <x-fas-trash-can class="h-4 w-4" />
                            </button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        <div class="mt-6">
            {!! $data->links('pagination::tailwind') !!}
        </div>
    </div>

</x-app-layout>