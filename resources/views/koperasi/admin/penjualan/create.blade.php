<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Transaksi') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <!-- Menampilkan Pesan Sukses atau Error -->
                    @if (session('success'))
                        <div class="bg-green-500 text-white p-4 rounded-lg mb-6">
                            {{ session('success') }}
                        </div>
                    @endif

                    @if ($errors->any())
                        <div class="bg-red-500 text-white p-4 rounded-lg mb-6">
                            <ul class="list-disc pl-5">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form id="transaction-form" action="{{ route('koperasi.admin.penjualan.store') }}" method="POST">
                        @csrf
                        <input type="hidden" id="all-data" name="selected_goods" value="{{ json_encode($goods) }}">

                        <!-- Pilih Barang -->
                        <div class="grid grid-cols-2 gap-2">
                            <div class="max-w-xl">
                                <x-input-label for="goods-select" value="Nama Barang" />
                                <select id="goods-select" name="goodid" class="mt-1 block w-full">
                                    <option value="">Pilih Barang</option>
                                    @foreach($goods as $good)
                                        <option id="goods-item-{{ $good->id }}" value="{{ $good->id }}">
                                            {{ $good->nama_barang }} {{ $good->ukuran }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <!-- Tabel barang yang dipilih -->
                            <div class="col-span-2">
                                <h3 class="text-lg font-semibold">Daftar Barang yang Dipilih</h3>
                                <table class="min-w-full mt-4 bg-white dark:bg-gray-700">
                                    <thead>
                                        <tr>
                                            <th class="px-4 py-2">Nama Barang</th>
                                            <th class="px-4 py-2">Harga Satuan</th>
                                            <th class="px-4 py-2">Jumlah</th>
                                            <th class="px-4 py-2">Total Harga</th>
                                            <th class="px-4 py-2">Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody id="selected-goods-list">
                                        <!-- Barang yang dipilih akan dimasukkan di sini -->
                                    </tbody>
                                </table>
                            </div>

                            <!-- Total Keseluruhan dan Jumlah Uang -->
                            <div class="flex space-x-4 items-center mt-6">
                                <div class="w-1/2">
                                    <x-input-label for="total_semua" value="Total Keseluruhan" />
                                    <x-text-input id="total_semua" name="total_harga" type="text" class="mt-1 block w-full" readonly />
                                </div>

                                <div class="w-1/2">
                                    <x-input-label for="jumlah_uang" value="Jumlah Uang" />
                                    <x-text-input id="jumlah_uang" name="jumlah_uang" type="text" class="mt-1 block w-full" value="{{ old('jumlah_uang') }}" />
                                    <x-input-error class="mt-2" :messages="$errors->get('jumlah_uang')" />
                                </div>
                            </div>

                            <!-- Kembalian -->
                            <div class="mt-6 w-1/2">
                                <x-input-label for="kembalian" value="Kembalian" />
                                <x-text-input id="kembalian" name="kembalian" type="text" class="mt-1 block w-full" readonly/>
                            </div>
                        </div>

                        <div class="mt-6 flex space-x-4">
                            <x-secondary-button type="reset">Ulang</x-secondary-button>
                            <x-danger-button type="submit">Selesai</x-danger-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        let data_harga_barang = JSON.parse(document.getElementById('all-data').value);
        let goodsSelect = document.getElementById('goods-select');
        let selectedGoodsList = document.getElementById('selected-goods-list');
        let totalSemua = document.getElementById('total_semua');
        let jumlahUang = document.getElementById('jumlah_uang');
        let kembalian = document.getElementById('kembalian');

        let selectedGoods = [];

        goodsSelect.onchange = () => {
            let selectedItemId = goodsSelect.value;

            if (selectedItemId && !selectedGoods.some(item => item.id == selectedItemId)) {
                let selectedItem = data_harga_barang.find(item => item.id == selectedItemId);

                if (selectedItem) {
                    selectedGoods.push({
                        id: selectedItem.id,
                        nama_barang: selectedItem.nama_barang,
                        harga: selectedItem.harga,
                        jumlah: 1
                    });
                }

                renderSelectedGoods();
                calculateTotal();
            }

            goodsSelect.value = "";
        };

        function renderSelectedGoods() {
            selectedGoodsList.innerHTML = '';

            selectedGoods.forEach((item, index) => {
                let row = `
                    <tr>
                        <td class="px-4 py-2">${item.nama_barang}</td>
                        <td class="px-4 py-2">${item.harga}</td>
                        <td class="px-4 py-2">
                            <input type="number" value="${item.jumlah}" min="1" onchange="updateJumlah(${index}, this.value)" class="w-full"/>
                        </td>
                        <td class="px-4 py-2">${(item.harga * item.jumlah).toFixed(2)}</td>
                        <td class="px-4 py-2">
                            <button type="button" onclick="removeItem(${index})">Hapus</button>
                        </td>
                    </tr>
                `;
                selectedGoodsList.insertAdjacentHTML('beforeend', row);
            });
        }

        function calculateTotal() {
            let total = selectedGoods.reduce((sum, item) => sum + (item.harga * item.jumlah), 0);
            totalSemua.value = total.toFixed(2);
            document.getElementById('all-data').value = JSON.stringify(selectedGoods);
        }

        function updateJumlah(index, newJumlah) {
            selectedGoods[index].jumlah = parseInt(newJumlah) || 1;
            renderSelectedGoods();
            calculateTotal();
        }

        function removeItem(index) {
            selectedGoods.splice(index, 1);
            renderSelectedGoods();
            calculateTotal();
        }

        jumlahUang.oninput = () => {
            let total = parseFloat(totalSemua.value) || 0;
            let uang = parseFloat(jumlahUang.value) || 0;
            let kembali = uang - total;
            kembalian.value = kembali >= 0 ? kembali.toFixed(2) : '0.00';
        }

        // Validate before submitting the form
        document.getElementById('transaction-form').onsubmit = (event) => {
            let total = parseFloat(totalSemua.value) || 0;
            let uang = parseFloat(jumlahUang.value) || 0;

            if (uang < total) {
                event.preventDefault(); // Prevent form submission
                alert('Uang tidak cukup. Silakan masukkan jumlah uang yang sesuai.'); // Notification
            }
        }
    </script>
</x-app-layout>
