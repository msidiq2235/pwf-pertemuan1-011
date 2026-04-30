<x-app-layout>
    <div class="py-12 bg-gray-900 min-h-screen">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            
            @if(session('success'))
                <div class="mb-6 bg-green-500/10 border border-green-500/20 text-green-400 px-4 py-3 rounded-lg relative">
                    {{ session('success') }}
                </div>
            @endif

            <div class="bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg border border-gray-700">
                <div class="p-6 text-gray-100">

                    <!-- Header & Add Button -->
                    <div class="flex items-center justify-between mb-8">
                        <div>
                            <h2 class="text-2xl font-bold text-white tracking-tight">Category List</h2>
                            <p class="text-sm text-gray-400 mt-1">Manage your category</p>
                        </div>
                        <a href="{{ route('categories.create') }}" class="inline-flex items-center gap-2 px-4 py-2 bg-indigo-600 hover:bg-indigo-700 text-white text-sm font-medium rounded-lg transition duration-150 shadow-sm">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                            </svg>
                            Add Category
                        </a>
                    </div>

                    <!-- Table -->
                    <div class="overflow-x-auto">
                        <table class="w-full text-left text-sm text-gray-400 border-collapse">
                            <thead class="text-xs text-gray-300 uppercase bg-gray-700/50 border-y border-gray-700">
                                <tr>
                                    <th scope="col" class="px-6 py-4 font-semibold tracking-wider">Name</th>
                                    <th scope="col" class="px-6 py-4 font-semibold tracking-wider">Total Product</th>
                                    <th scope="col" class="px-6 py-4 font-semibold tracking-wider">Action</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-700">
                                @forelse ($categories as $category)
                                    <tr class="hover:bg-gray-700/25 transition duration-150">
                                        <td class="px-6 py-4 font-medium text-white">{{ $category->name }}</td>
                                        <td class="px-6 py-4">
                                            <!-- Menampilkan hasil dari withCount('products') -->
                                            <span class="inline-flex px-3 py-1 bg-blue-500/10 text-blue-400 border border-blue-500/20 rounded-full text-xs font-semibold">
                                                {{ $category->products_count }} Products
                                            </span>
                                        </td>
                                        <td class="px-6 py-4 flex items-center gap-4">
                                            <!-- Tombol Edit & Delete Sederhana (sesuai soal) -->
                                            <a href="{{ route('categories.edit', $category->id) }}" class="text-indigo-400 hover:text-indigo-300 font-medium transition">Edit</a>
                                            <form action="{{ route('categories.destroy', $category->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus kategori ini? Semua produk di dalamnya mungkin akan terpengaruh.');">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="text-red-500 hover:text-red-400 font-medium transition">Delete</button>
                                            </form>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="3" class="px-6 py-10 text-center text-gray-500 italic">
                                            Belum ada data kategori. Silakan tambahkan kategori baru.
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