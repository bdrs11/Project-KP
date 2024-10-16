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

                    <form action="{{ route('koperasi.admin.kelola_barang.store') }}" method="POST">
                        @csrf

                        <div class="max-w-xl">
                            <x-input-label for="nama_barang" value="Nama Barang" />
                            <x-text-input id="nama_barang" type="text" name="nama_barang" class="mt-1 block w-full" value="{{ old('nama_barang') }}" required />
                            <x-input-error class="mt-2" :messages="$errors->get('nama_barang')" />
                        </div>
                        <br>

                        <div class="max-w-xl">
                            <x-input-label for="harga" value="Harga" />
                            <x-text-input id="harga" type="text" name="harga" class="mt-1 block w-full" value="{{ old('harga') }}" required />
                            <x-input-error class="mt-2" :messages="$errors->get('harga')" />
                        </div>
                        <br>

                        <div class="max-w-xl">
                            <x-input-label for="ukuran" value="Ukuran" />
                            <x-text-input id="ukuran" type="text" name="ukuran" class="mt-1 block w-full" value="{{ old('ukuran') }}" />
                            <x-input-error class="mt-2" :messages="$errors->get('ukuran')" />
                        </div>
                        <br>

                        <div class="max-w-xl">
                            <x-input-label for="jumlah" value="Jumlah" />
                            <x-text-input id="jumlah" type="text" name="jumlah" class="mt-1 block w-full" value="{{ old('jumlah') }}" required />
                            <x-input-error class="mt-2" :messages="$errors->get('jumlah')" />
                        </div>
                        <br>

                        <div class="max-w-xl">
                            <x-input-label for="tanggal_ditambahkan" value="Tanggal Ditambahkan" />
                            <x-text-input id="tanggal_ditambahkan" type="date" name="tanggal_ditambahkan" class="mt-1 block w-full" value="{{ old('tanggal_ditambahkan') }}" required />
                            <x-input-error class="mt-2" :messages="$errors->get('tanggal_ditambahkan')" />
                        </div>
                        <br>

                        <div class="max-w-xl">
                            <x-input-label for="categoriesid" value="Category" />
                            <select id="categoriesid" name="categoriesid" class="mt-1 block w-full" required>
                                @foreach($categories as $category)
                                    <option value="{{ $category->id }}">{{ $category->nama }}</option>
                                @endforeach
                            </select>
                            <x-input-error class="mt-2" :messages="$errors->get('categoriesid')" />
                        </div>
                        <br>

                        <div class="max-w-xl">
                            <x-input-label for="supplierid" value="Supplier" />
                            <select id="supplierid" name="supplierid" class="mt-1 block w-full" required>
                                @foreach($suppliers as $supplier)
                                    <option value="{{ $supplier->id }}">{{ $supplier->supplier_name }}</option>
                                @endforeach
                            </select>
                            <x-input-error class="mt-2" :messages="$errors->get('supplierid')" />
                        </div>
                        <br>

                        <x-primary-button name="save" value="true">Save</x-primary-button>
                        <x-secondary-button tag="a" href="{{ route('koperasi.admin.kelola_barang') }}">Cancel</x-secondary-button>
                    </form>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
