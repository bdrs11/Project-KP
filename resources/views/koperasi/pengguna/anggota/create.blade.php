<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Menambahkan Barang') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">

                    <form action="{{ route('koperasi.pengguna.anggota.store') }}" method="POST">
                        @csrf

                        <div class="max-w-xl">
                            <x-input-label for="name" value="Nama" />
                            <x-text-input id="name" type="text" name="name" class="mt-1 block w-full" value="{{ old('name') }}" required />
                            <x-input-error class="mt-2" :messages="$errors->get('name')" />
                        </div>
                        <br>

                        <div class="max-w-xl">
                            <x-input-label for="email" value="Email" />
                            <x-text-input id="email" type="text" name="email" class="mt-1 block w-full" value="{{ old('email') }}" required />
                            <x-input-error class="mt-2" :messages="$errors->get('email')" />
                        </div>
                        <br>

                        <div class="max-w-xl">
                            <x-input-label for="password" value="password" />
                            <x-text-input id="password" type="text" name="password" class="mt-1 block w-full" value="{{ old('password') }}" required />
                            <x-input-error class="mt-2" :messages="$errors->get('password')" />
                        </div>
                        <br>

                        <x-primary-button name="save" value="true">Save</x-primary-button>
                        <x-secondary-button tag="a" href="{{ route('koperasi.pengguna.anggota') }}">Cancel</x-secondary-button>
                    </form>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
