<x-app-layout>
    <div class="py-12 bg-gray-900 min-h-screen">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg border border-gray-700">
                <div class="p-8 text-gray-100">
                    
                    <!-- Header Form -->
                    <div class="mb-8">
                        <h2 class="text-2xl font-bold text-white flex items-center gap-3">
                            <a href="{{ route('categories.index') }}" class="text-gray-400 hover:text-white transition">
                                <!-- Icon Back -->
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                                </svg>
                            </a>
                            Add Category
                        </h2>
                        <p class="text-gray-400 text-sm mt-1 ml-8">Fill in the details to add a new category.</p>
                    </div>

                    <form action="{{ route('categories.store') }}" method="POST" class="ml-8">
                        @csrf
                        
                        <!-- Input: Nama Kategori -->
                        <div class="mb-8">
                            <label class="block text-gray-300 text-sm font-semibold mb-2">Category Name</label>
                            <input type="text" name="name" value="{{ old('name') }}" class="w-full bg-gray-900 border border-gray-700 text-white rounded-lg py-2.5 px-4 focus:outline-none focus:border-indigo-500 focus:ring-1 focus:ring-indigo-500 placeholder-gray-500" placeholder="e.g. Electronic">
                            @error('name')
                                <p class="text-red-500 text-xs italic mt-2">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Tombol Action -->
                        <div class="flex items-center justify-end space-x-4 pt-4 border-t border-gray-700 mt-4">
                            <a href="{{ route('categories.index') }}" class="text-gray-400 hover:text-white text-sm font-medium transition">Cancel</a>
                            <button type="submit" class="bg-indigo-600 hover:bg-indigo-700 text-white font-semibold py-2 px-6 rounded-lg shadow-md transition duration-150">
                                Save Category
                            </button>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>