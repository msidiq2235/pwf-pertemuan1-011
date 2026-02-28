<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800 dark:text-gray-200">
            {{ __('About Me') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
            <div class="overflow-hidden bg-white shadow-sm dark:bg-gray-800 sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <h3 class="mb-4 text-lg font-bold">Biodata Diri</h3>
                    <ul class="space-y-2 list-none">
                        <li><strong>Nama:</strong> Muhammad Sidiq</li>
                        <li><strong>NIM:</strong> 20230140011</li>
                        <li><strong>Program Studi:</strong> Teknologi Informasi</li>
                        <li><strong>Hobi:</strong> Ngoding dan Racing</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>