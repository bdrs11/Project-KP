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
                    <form method="post" action="{{ route('koperasi.admin.kelola_stock.update', $goods->id) }}" class="mt-6 space-y-6">
                        @csrf
                        @method('PATCH')
                        <div class="max-w-xl">
                            <x-input-label for="nama_barang" value="Nama Barang" />
                            <x-text-input id="nama_barang" type="text" name="nama_barang" class="mt-1 block w-full" value="{{ old('nama_barang', $goods->nama_barang) }}" required />
                            <x-input-error class="mt-2" :messages="$errors->get('nama_barang')" />
                        </div>

                        <div class="max-w-xl">
                            <x-input-label for="harga" value="Harga Rp" />
                            <x-text-input id="harga" type="text" name="harga" class="mt-1 block w-full" value="{{ old('harga', $goods->harga) }}" required />
                            <x-input-error class="mt-2" :messages="$errors->get('harga')" />
                        </div> 

                        <div class="max-w-xl">
                            <x-input-label for="ukuran" value="Ukuran" />
                            <x-text-input id="ukuran" type="text" name="ukuran" class="mt-1 block w-full" value="{{ old('ukuran', $goods->ukuran) }}" />
                            <x-input-error class="mt-2" :messages="$errors->get('ukuran')" />
                        </div>

                        <div class="max-w-xl">
                            <x-input-label for="jumlah" value="Jumlah" />
                            <x-text-input id="jumlah" type="text" name="jumlah" class="mt-1 block w-full" value="{{ old('jumlah', $goods->jumlah) }}" required />
                            <x-input-error class="mt-2" :messages="$errors->get('jumlah')" />
                        </div>

                        <div class="max-w-xl">
                            <x-input-label for="tanggal_masuk" value="Tanggal Ditambahkan" />
                            <x-text-input id="tanggal_masuk" type="date" name="tanggal_masuk" class="mt-1 block w-full" value="{{ old('tanggal_masuk') }}" required />
                            <x-input-error class="mt-2" :messages="$errors->get('tanggal_masuk')" />
                        </div>
                        <br>

                        <x-primary-button value="true">Update Data</x-primary-button>
                        <x-secondary-button tag="a" href="{{ route('koperasi.admin.kelola_stock') }}">Cancel</x-secondary-button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>