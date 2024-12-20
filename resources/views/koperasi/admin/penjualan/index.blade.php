<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Daftar Penjualan') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">

                    <x-primary-button tag="a" href="{{ route('koperasi.admin.penjualan.create') }}">Transaksi</x-primary-button>
                    <br>

                    <div class="flex flex-col mt-4">
                        <div class="-m-1.5 overflow-x-auto">
                            <div class="p-1.5 min-w-full inline-block align-middle">
                                <div class="overflow-hidden">
                                    <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                                        <thead>
                                            <tr>
                                                <th scope="col" class="px-6 py-3 text-start text-xs font-medium text-gray-500 uppercase">No</th>
                                                <th scope="col" class="px-6 py-3 text-start text-xs font-medium text-gray-500 uppercase">Tanggal Terjual</th>
                                                <th scope="col" class="px-6 py-3 text-start text-xs font-medium text-gray-500 uppercase">Nama Barang</th>
                                                <th scope="col" class="px-6 py-3 text-start text-xs font-medium text-gray-500 uppercase">Jumlah</th>
                                                <th scope="col" class="px-6 py-3 text-start text-xs font-medium text-gray-500 uppercase">Harga Satuan</th>
                                                <th scope="col" class="px-6 py-3 text-start text-xs font-medium text-gray-500 uppercase">Total Harga Rp</th>
                                                <th scope="col" class="px-6 py-3 text-start text-xs font-medium text-gray-500 uppercase">Jumlah Uang</th>
                                                <th scope="col" class="px-6 py-3 text-start text-xs font-medium text-gray-500 uppercase">Kembalian</th>
                                                <th scope="col" class="px-6 py-3 text-start text-xs font-medium text-gray-500 uppercase">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody class="divide-y divide-gray-200 dark:divide-gray-700">
                                            @php $num = 1; @endphp
                                            @foreach($sale_items as $datetime => $items)
                                                <tr>
                                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-800 dark:text-gray-200">{{ $num++ }}</td>
                                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-800 dark:text-gray-200">{{ $datetime }}</td>
                                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-800 dark:text-gray-200">
                                                        @foreach($items as $sale_item)
                                                            {{ $sale_item->good ? $sale_item->good->nama_barang : 'N/A' }}{{ !$loop->last ? ', ' : '' }}
                                                        @endforeach
                                                    </td>
                                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-800 dark:text-gray-200">
                                                        @foreach($items as $sale_item)
                                                            {{ $sale_item->jumlah }}{{ !$loop->last ? ', ' : '' }}
                                                        @endforeach
                                                    </td>
                                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-800 dark:text-gray-200">
                                                        @foreach($items as $sale_item)
                                                            {{ number_format($sale_item->harga_satuan, 0, ',', '.') }}{{ !$loop->last ? ', ' : '' }}
                                                        @endforeach
                                                    </td>
                                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-800 dark:text-gray-200">
                                                            {{ number_format($sale_item->sale->total_harga, 0, ',', '.') }}{{ !$loop->last ? ', ' : '' }}  
                                                    </td>
                                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-800 dark:text-gray-200">
                                                        {{ $items[0]->sale ? number_format($items[0]->sale->jumlah_uang, 0, ',', '.') : 'N/A' }}
                                                    </td>
                                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-800 dark:text-gray-200">
                                                        {{ $items[0]->sale ? number_format($items[0]->sale->kembalian, 0, ',', '.') : 'N/A' }}
                                                    </td>                                                    
                                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-800 dark:text-gray-200">
                                                        <x-primary-button tag="a" href="{{ route('koperasi.admin.penjualan.struk', ['id' => $items[0]->saleid]) }}" target="_blank">
                                                            {{ __('Cetak Struk') }}
                                                        </x-primary-button>
                                                        {{-- <x-danger-button
                                                            x-data=""
                                                            x-on:click.prevent="$dispatch('open-modal', 'confirm-user-deletion')"
                                                            x-on:click="$dispatch('set-action', '{{ route('koperasi.admin.penjualan.destroy', $items[0]->id) }}')">
                                                            {{ __('Delete') }}
                                                        </x-danger-button> --}}
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- MODAL -->
                    <x-modal name="confirm-user-deletion" :show="$errors->userDeletion->isNotEmpty()" focusable>
                        <form method="post" x-bind:action="action" class="p-6">
                            @csrf
                            @method('delete')

                            <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
                                {{ __('Apakah anda yakin akan menghapus data?') }}
                            </h2>

                            <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
                                {{ __('Setelah proses dilakukan, maka data tidak dapat dikembalikan.') }}
                            </p>

                            <div class="mt-6 flex justify-end">
                                <x-secondary-button x-on:click="$dispatch('close')">
                                    {{ __('Cancel') }}
                                </x-secondary-button>

                                <x-danger-button class="ml-3">
                                    {{ __('Delete Data') }}
                                </x-danger-button>
                            </div>
                        </form>
                    </x-modal>
                    <!-- End OF Content -->
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
