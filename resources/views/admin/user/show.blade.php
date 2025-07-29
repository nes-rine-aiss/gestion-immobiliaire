<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col md:flex-row items-start md:items-center justify-between mb-6">
            <h2 class="text-2xl font-semibold text-gray-800">Show User</h2>
            <a href="{{ route('users.index') }}"
               class="inline-flex items-center px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white text-sm font-medium rounded-md mt-4 md:mt-0">
                <i class="fa fa-arrow-left mr-2"></i> Back
            </a>
        </div>
    </x-slot>

    <div class="px-4 sm:px-6 lg:px-8 py-16">
        <div class="bg-white shadow rounded-lg p-6 space-y-4">
            <div>
                <span class="block text-sm font-semibold text-gray-700">Name:</span>
                <p class="text-gray-900">{{ $user->name }}</p>
            </div>

            <div>
                <span class="block text-sm font-semibold text-gray-700">Email:</span>
                <p class="text-gray-900">{{ $user->email }}</p>
            </div>

            <div>
                <span class="block text-sm font-semibold text-gray-700">Roles:</span>
                <div class="mt-1 space-x-2">
                    @if(!empty($user->getRoleNames()))
                        @foreach($user->getRoleNames() as $v)
                            <span class="inline-block bg-green-100 text-green-800 text-xs font-semibold px-2 py-1 rounded">
                                {{ $v }}
                            </span>
                        @endforeach
                    @else
                        <span class="text-gray-500 text-sm">No roles assigned</span>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
