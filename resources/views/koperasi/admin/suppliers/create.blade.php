<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Menambahkan Pemasok') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">

                    <form action="{{ route('koperasi.admin.suppliers.store') }}" method="POST">
                        @csrf

                        <div class="max-w-xl">
                            <x-input-label for="supplier_name" value="Nama Supplier" />
                            <x-text-input id="supplier_name" type="text" name="supplier_name" class="mt-1 block w-full" value="{{ old('supplier_name') }}" required />
                            <x-input-error class="mt-2" :messages="$errors->get('supplier_name')" />
                        </div>
                        <br>

                        <div class="max-w-xl">
                            <x-input-label for="address" value="Alamat" />
                            <x-text-input id="address" type="text" name="address" class="mt-1 block w-full" value="{{ old('address') }}" required />
                            <x-input-error class="mt-2" :messages="$errors->get('address')" />
                        </div>
                        <br>

                        <div class="max-w-xl">
                            <x-input-label for="phone_number" value="Nomor Perusahaan" />
                            <x-text-input id="phone_number" type="text" name="phone_number" class="mt-1 block w-full" value="{{ old('phone_number') }}" required />
                            <x-input-error class="mt-2" :messages="$errors->get('phone_number')" />
                        </div>
                        <br>

                        <x-primary-button name="save" value="true">Save</x-primary-button>
                        <x-secondary-button tag="a" href="{{ route('koperasi.admin.suppliers') }}">Cancel</x-secondary-button>
                    </form>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>