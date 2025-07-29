<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col md:flex-row items-start md:items-center justify-between mb-6">
            <h2 class="text-2xl font-semibold text-gray-800">Edit User</h2>
            <a href="{{ route('users.index') }}" class="inline-flex items-center px-3 py-2 bg-blue-600 hover:bg-blue-700 text-white text-sm font-medium rounded-md mt-4 md:mt-0">
                <i class="fa fa-arrow-left mr-2"></i> Back
            </a>
        </div>
    </x-slot>

    <div class="px-4 sm:px-6 lg:px-8 py-16">
        @if (count($errors) > 0)
        <div class="mb-4 p-4 bg-red-100 border border-red-300 text-red-800 rounded">
            <strong>Whoops!</strong> There were some problems with your input.
            <ul class="mt-2 list-disc list-inside text-sm">
                @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif

        <form method="POST" action="{{ route('users.update', $user->id) }}">
            @csrf
            @method('PUT')

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                <div>
                    <label class="block mb-1 text-sm font-medium text-gray-700">Name:</label>
                    <input type="text" name="name" value="{{ $user->name }}" placeholder="Name"
                        class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring focus:border-blue-400">
                </div>

                <div>
                    <label class="block mb-1 text-sm font-medium text-gray-700">Email:</label>
                    <input type="email" name="email" value="{{ $user->email }}" placeholder="Email"
                        class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring focus:border-blue-400">
                </div>


                <div class="md:col-span-2">
                    <label class="block mb-2 text-sm font-medium text-gray-700">Roles:</label>
                    <div class="flex flex-wrap gap-4">
                        @foreach ($roles as $value => $label)
                        <label class="flex items-center space-x-2">
                            <input type="checkbox" name="roles[]" value="{{ $value }}"
                                class="text-blue-600 rounded border-gray-300 focus:ring focus:ring-blue-200"
                                {{ isset($userRole[$value]) ? 'checked' : '' }}>
                            <span class="text-sm text-gray-700">{{ $label }}</span>
                        </label>
                        @endforeach
                    </div>
                </div>
            </div>

            <div class="text-center">
                <button type="submit"
                    class="inline-flex items-center px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white text-sm font-medium rounded">
                    <i class="fa-solid fa-floppy-disk mr-2"></i> Submit
                </button>
            </div>
        </form>
        <form action="{{ route('users.update-password', $user->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div>
                <label class="block mb-1 text-sm font-medium text-gray-700">Password:</label>
                <input type="password" name="password" placeholder="Password"
                    class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring focus:border-blue-400">
            </div>

            <div>
                <label class="block mb-1 text-sm font-medium text-gray-700">Confirm Password:</label>
                <input type="password" name="password_confirmation" placeholder="Confirm Password"
                    class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring focus:border-blue-400">
            </div>


            <div class="text-center mt-4">
                <button type="submit"
                    class="inline-flex items-center px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white text-sm font-medium rounded">
                    <i class="fa-solid fa-floppy-disk mr-2"></i> Submit
                </button>
            </div>
        </form>

    </div>
</x-app-layout>