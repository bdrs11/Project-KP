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
                    <form action="{{ route('koperasi.admin.penjualan.store') }}" method="POST">
                        @csrf
                        <input type="hidden" id="all-data" name="all-data" value="{{ $goods }}">
                        <div class="grid grid-cols-2 gap-2">
                            <div class="max-w-xl">
                                <x-input-label for="goodid" value="Nama Barang" />
                                <select id="goods-select" name="goodid" class="mt-1 block w-full" required>
                                    @foreach($goods as $good)       
                                        <option id="goods-item-{{ $good->id }}" value="{{ $good->id }}">{{ $good->nama_barang }}</option>
                                    @endforeach
                                </select>
                                <x-input-error class="mt-2" :messages="$errors->get('goodid')" />
                            </div>
                            
                            <div>
                                <x-input-label for="jumlah_barang" value="Jumlah Barang" />
                                <x-text-input id="jumlah_barang" type="number" name="jumlah_barang" class="mt-1 block w-full" min="1" />
                            </div>
                            
                            <div>
                                <x-input-label for="harga_satuan" value="Harga Satuan" />
                                <x-text-input id="harga_satuan" type="text" name="harga_satuan" class="mt-1 block w-full" readonly/>
                            </div>

                            <div>
                                <x-input-label for="total_harga" value="Total Harga" />
                                <x-text-input id="total_harga" type="text" name="total_harga" class="mt-1 block w-full" readonly />
                            </div>
                            <br>
                            
                            <div>
                                <x-input-label for="jumlah_uang" value="Jumlah Uang" />
                                <x-text-input id="jumlah_uang" type="text" name="jumlah_uang" class="mt-1 block w-full" />
                                <x-input-error class="mt-2" :messages="$errors->get('jumlah_uang')" />
                            </div>
                            <br>
                            <div>
                                <x-input-label for="kembalian" value="Kembalian" />
                                <x-text-input id="kembalian" type="text" name="kembalian" class="mt-1 block w-full" readonly/>
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
        // Mengambil data barang dari input hidden
        let data_harga_barang = JSON.parse(document.getElementById('all-data').value);
        
        // Referensi ke elemen HTML
        let goodsSelect = document.getElementById('goods-select');
        let hargaSatuanBarang = document.getElementById('harga_satuan');
        let jumlahBarang = document.getElementById('jumlah_barang');
        let totalHarga = document.getElementById('total_harga');
        let jumlahUang = document.getElementById('jumlah_uang');
        let kembalian = document.getElementById('kembalian');
        
        // Event ketika barang dipilih dari dropdown
        goodsSelect.onchange = (e) => {
            let currentItemIndex = goodsSelect.options[goodsSelect.selectedIndex].value;
            
            // Mengambil harga satuan dari barang yang dipilih
            let hargaSatuan = data_harga_barang.find(item => item.id == currentItemIndex).harga;
            hargaSatuanBarang.value = hargaSatuan;
    
            // Hitung total harga berdasarkan jumlah barang yang diisi
            hitungTotal();
        }
        
        // Event ketika jumlah barang diinput
        jumlahBarang.oninput = (e) => {
            hitungTotal();
        };
        
        // Fungsi untuk menghitung total harga
        function hitungTotal(){
            let satuan = parseFloat(hargaSatuanBarang.value) || 0;
            let jumlah = parseFloat(jumlahBarang.value) || 0;
            let total = satuan * jumlah;
            
            // Set nilai total harga
            totalHarga.value = total.toFixed(2); 
        }

        // Event ketika jumlah uang diinput
        jumlahUang.oninput = (e) => {
            hitungKembalian();
        };

        // Fungsi untuk menghitung kembalian
        function hitungKembalian(){
            let total = parseFloat(totalHarga.value) || 0;
            let uang = parseFloat(jumlahUang.value) || 0;
            let kembali = uang - total;

            // Set nilai kembalian
            kembalian.value = kembali >= 0 ? kembali.toFixed(2) : '0.00';
        }
    </script>
    
</x-app-layout>
