<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Edit Data') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflowhidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <form method="post" action="{{ route('koperasi.pengguna.anggota.update', $users->id) }}" class="mt-6 space-y-6">
                        @csrf
                        @method('PATCH')
                        <div class="max-w-xl">
                            <x-input-label for="name" value="Nama" />
                            <x-text-input id="name" type="text" name="name" class="mt-1 block w-full" value="{{ old('name', $users->name) }}" required />
                            <x-input-error class="mt-2" :messages="$errors->get('name')" />
                        </div>

                        <div class="max-w-xl">
                            <x-input-label for="email" value="Email" />
                            <x-text-input id="email" type="text" name="email" class="mt-1 block w-full" value="{{ old('email', $users->email) }}" required />
                            <x-input-error class="mt-2" :messages="$errors->get('email')" />
                        </div>

                        <x-primary-button value="true">Update Data</x-primary-button>
                        <x-secondary-button tag="a" href="{{ route('koperasi.pengguna.anggota') }}">Cancel</x-secondary-button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>