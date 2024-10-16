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
                    <form method="post" action="{{ route('koperasi.admin.suppliers.update', $supplier->id) }}" class="mt-6 space-y-6">
                        @csrf
                        @method('PATCH')
                        <div class="max-w-xl">
                            <x-input-label for="supplier_name" value="Nama Pemasok" />
                            <x-text-input id="supplier_name" type="text" name="supplier_name" class="mt-1 block w-full" value="{{ old('supplier_name', $supplier->supplier_name) }}" required />
                            <x-input-error class="mt-2" :messages="$errors->get('supplier_name')" />
                        </div>

                        <div class="max-w-xl">
                            <x-input-label for="address" value="Alamat" />
                            <x-text-input id="address" type="text" name="address" class="mt-1 block w-full" value="{{ old('address', $supplier->address) }}" required />
                            <x-input-error class="mt-2" :messages="$errors->get('address')" />
                        </div>

                        <div class="max-w-xl">
                            <x-input-label for="phone_number" value="No Hp" />
                            <x-text-input id="phone_number" type="text" name="phone_number" class="mt-1 block w-full" value="{{ old('phone_number', $supplier->phone_number) }}" required />
                            <x-input-error class="mt-2" :messages="$errors->get('phone_number')" />
                        </div>

                        <x-primary-button value="true">Update Data</x-primary-button>
                        <x-secondary-button tag="a" href="{{ route('koperasi.admin.suppliers') }}">Cancel</x-secondary-button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>