<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col md:flex-row items-start md:items-center justify-between mb-6">
            <h2 class="text-2xl font-semibold text-gray-800">Users Management</h2>
            <a href="{{ route('users.create') }}" class="inline-flex items-center px-4 py-2 bg-green-600 hover:bg-green-700 text-white text-sm font-medium rounded-md mt-4 md:mt-0">
                <i class="fa fa-plus mr-2"></i> Create New User
            </a>
        </div>
    </x-slot>

    @session('success')
        <div class="mb-4 p-4 bg-green-100 border border-green-300 text-green-800 rounded">
            {{ $value }}
        </div>
    @endsession

    <div class="overflow-x-auto w-full p-16">
        <table class="min-w-full bg-white border border-gray-200 rounded-lg shadow-sm text-sm">
            <thead class="bg-gray-100">
                <tr>
                    <th class="px-4 py-2 border-b text-left">No</th>
                    <th class="px-4 py-2 border-b text-left">Name</th>
                    <th class="px-4 py-2 border-b text-left">Email</th>
                    <th class="px-4 py-2 border-b text-left">Roles</th>
                    <th class="px-4 py-2 border-b text-left w-64">Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($data as $key => $user)
                    <tr class="border-t">
                        <td class="px-4 py-2">{{ ++$i }}</td>
                        <td class="px-4 py-2">{{ $user->name }}</td>
                        <td class="px-4 py-2">{{ $user->email }}</td>
                        <td class="px-4 py-2">
                            @if(!empty($user->getRoleNames()))
                                @foreach($user->getRoleNames() as $v)
                                    <span class="inline-block bg-green-100 text-green-700 text-xs font-semibold px-2 py-1 rounded">{{ $v }}</span>
                                @endforeach
                            @endif
                        </td>
                        <td class="px-4 py-2 flex flex-wrap gap-2">
                            <a href="{{ route('users.show', $user->id) }}" class="inline-flex items-center px-3 py-1 bg-blue-500 hover:bg-blue-600 text-white text-xs font-medium rounded">
                                <i class="fa-solid fa-list mr-1"></i> Show
                            </a>
                            <a href="{{ route('users.edit', $user->id) }}" class="inline-flex items-center px-3 py-1 bg-indigo-500 hover:bg-indigo-600 text-white text-xs font-medium rounded">
                                <i class="fa-solid fa-pen-to-square mr-1"></i> Edit
                            </a>
                            <form method="POST" action="{{ route('users.destroy', $user->id) }}" onsubmit="return confirm('Are you sure?')" class="inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="inline-flex items-center px-3 py-1 bg-red-500 hover:bg-red-600 text-white text-xs font-medium rounded">
                                    <i class="fa-solid fa-trash mr-1"></i> Delete
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
