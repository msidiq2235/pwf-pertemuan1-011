<x-app-layout>
    <x-slot name="header">
        <!-- Teks header diubah jadi text-gray-200 biar kelihatan di dark mode -->
        <h2 class="font-semibold text-xl text-gray-200 leading-tight">
            {{ __('Daftar Produk') }}
        </h2>
    </x-slot>

    <!-- Background utama aplikasi diset ke bg-gray-900 -->
    <div class="py-12 bg-gray-900 min-h-screen">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            
            <!-- Alert Success Dark Mode -->
            @if(session('success'))
                <div class="mb-6 bg-green-500/10 border border-green-500/20 text-green-400 px-4 py-3 rounded-lg relative">
                    {{ session('success') }}
                </div>
            @endif

            <!-- Card Tabel Dark Mode -->
            <div class="bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg border border-gray-700">
                <div class="p-6 text-gray-100">
                    
                    <!-- Header Tabel & Add Button -->
                    <div class="flex items-center justify-between mb-8">
                        <div>
                            <h2 class="text-2xl font-bold text-white tracking-tight">Product List</h2>
                            <p class="text-sm text-gray-400 mt-1">
                                Halo <span class="text-indigo-400 font-semibold">{{ auth()->user()->name }}</span>, Role: [ {{ auth()->user()->role }} ]
                            </p>
                        </div>
                        
                        @can('manage-product')
                            <x-add-product :url="route('products.create')" :name="'Product'" />
                        @endcan
                    </div>

                    <!-- Tabel dengan Border Transparan & Hover Row -->
                    <div class="overflow-x-auto">
                        <table class="w-full text-left text-sm text-gray-400 border-collapse">
                            <thead class="text-xs text-gray-300 uppercase bg-gray-700/50 border-y border-gray-700">
                                <tr>
                                    <th scope="col" class="px-6 py-4 font-semibold tracking-wider">Nama Produk</th>
                                    <th scope="col" class="px-6 py-4 font-semibold tracking-wider">Kategori</th>
                                    <th scope="col" class="px-6 py-4 font-semibold tracking-wider">Harga</th>
                                    <th scope="col" class="px-6 py-4 font-semibold tracking-wider">Stok</th>
                                    <th scope="col" class="px-6 py-4 font-semibold tracking-wider">Pembuat</th>
                                    <th scope="col" class="px-6 py-4 font-semibold tracking-wider">Aksi</th>
                                </tr>
                            </thead>
                            
                            <tbody class="divide-y divide-gray-700">
                                @forelse ($products as $product)
                                    <tr class="hover:bg-gray-700/25 transition duration-150">
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <!-- Link ke Detail Produk -->
                                            <a href="{{ route('products.show', $product->id) }}" class="text-indigo-400 hover:text-indigo-300 font-semibold hover:underline">
                                                {{ $product->name }}
                                            </a>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <!-- Badge Kategori Glowing -->
                                            <span class="px-3 py-1 inline-flex text-xs font-semibold rounded-full bg-indigo-500/10 text-indigo-400 border border-indigo-500/20">
                                                {{ $product->category->name ?? 'Tanpa Kategori' }}
                                            </span>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-white font-medium">
                                            Rp {{ number_format($product->price, 0, ',', '.') }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <!-- Badge Qty Glowing -->
                                            <span class="px-3 py-1 inline-flex text-xs font-semibold rounded-full bg-blue-500/10 text-blue-400 border border-blue-500/20">
                                                {{ $product->qty }} unit
                                            </span>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-400">
                                            {{ $product->user->name ?? 'Unknown' }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium flex items-center space-x-3">
                                            
                                            <!-- Komponen Button Edit & Delete tetap aman! -->
                                            @can('update', $product)
                                                <x-edit-button :url="route('products.edit', $product->id)" />
                                            @endcan

                                            @can('delete', $product)
                                                <x-delete-button :action="route('products.destroy', $product->id)" />
                                            @endcan

                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="6" class="px-6 py-10 text-center text-gray-500 italic">
                                            Belum ada data produk tersedia.
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>