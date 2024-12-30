<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Laporan Penerimaan Barang & Stock') }}
        </h2>
    </x-slot>
  
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    
                    <!-- Form Filter Bulan -->
                    <form method="GET" action="{{ route('koperasi.pengguna.laporan') }}" class="mb-4">
                        <div class="grid grid-cols-2 gap-4">
                            <div class="col-span-1">
                                <x-input-label for="month" value="Bulan" />
                                <select id="month" name="month" class="block w-full">
                                    @for ($i = 1; $i <= 12; $i++)
                                        <option value="{{ $i }}" {{ request('month') == $i ? 'selected' : '' }}>
                                            {{ DateTime::createFromFormat('!m', $i)->format('F') }}
                                        </option>
                                    @endfor
                                </select>
                            </div>
                            <div class="col-span-1">
                                <x-input-label for="year" value="Tahun" />
                                <select id="year" name="year" class="block w-full">
                                    @for ($i = date('Y'); $i >= 2020; $i--)
                                        <option value="{{ $i }}" {{ request('year') == $i ? 'selected' : '' }}>
                                            {{ $i }}
                                        </option>
                                    @endfor
                                </select>
                            </div>
                            <div class="col-span-2">
                                <x-primary-button class="mt-4">Filter</x-primary-button>
                                <x-primary-button tag="a" href="{{route('koperasi.pengguna.laporan.pdf')}}">
                                    Cetak PDF
                                </x-primary-button>
                            </div>
                        </div>
                    </form>
  
                    <div class="flex flex-col">
                        <div class="-m-1.5 overflow-x-auto">
                            <div class="p-1.5 min-w-full inline-block align-middle">
                                <div class="overflow-hidden">
                                    <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                                        <thead>
                                            <tr>
                                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">No</th>
                                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Nama Barang</th>
                                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Harga (Rp)</th>
                                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Jumlah Stock Tersedia</th>
                                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Tanggal Stock Barang Masuk</th>
                                            </tr>
                                        </thead>
                                        <tbody class="divide-y divide-gray-200 dark:divide-gray-700">
                                            @php $num = 1; @endphp
                                            @foreach ($reports as $report)
                                                <tr>
                                                    <td class="px-6 py-4 text-sm text-gray-800 dark:text-gray-200">{{ $num++ }}</td>
                                                    <td class="px-6 py-4 text-sm text-gray-800 dark:text-gray-200">{{ $report->goods->nama_barang ?? 'Tidak ada data' }}</td>
                                                    <td class="px-6 py-4 text-sm text-gray-800 dark:text-gray-200">{{ number_format($report->goods->harga ?? 0, 0, ',', '.') }}</td>
                                                    <td class="px-6 py-4 text-sm text-gray-800 dark:text-gray-200">{{ $report->goods->jumlah ?? 'Tidak ada data' }}</td>
                                                    <td class="px-6 py-4 text-sm text-gray-800 dark:text-gray-200">{{ $report->goods->updated_at ?? 'Tidak ada data' }}</td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
  
                </div>
            </div>
        </div>
    </div>
</x-app-layout>