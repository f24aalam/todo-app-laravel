<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Categories') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
             <!-- Session Status -->
            <x-auth-session-status class="mb-4" :status="session('status')" />

            <form method="POST" action="{{ route('categories.store') }}" class="flex w-full justify-between gap-2">
                @csrf

                <div class="flex-1">
                    <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus placeholder="Enter Category" />

                    <x-input-error :messages="$errors->get('name')" class="mt-2" />
                </div>

                <x-primary-button>
                    {{ __('Add Category') }}
                </x-primary-button>
            </form>

            <div class="bg-white mt-5 rounded-lg shadow-md px-2 py-2">
                <table class="w-full">
                    <thead>
                        <tr class="text-left border-b">
                            <th>Name</th>
                            <th>Active</th>
                            <th>Delete</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($categories as $category)
                            <tr class="">
                                <td>{{ $category->name }}</td>
                                <td>{{ $category->is_active }}</td>
                                <td>
                                    <form action="{{ route('categories.destroy', $category->id) }}" method="post"  onsubmit="return confirm('Do you really want to delete the category?');">
                                        @csrf
                                        @method('delete')
                                        <button type="submit">Delete</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-app-layout>
