<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ $image->name }}
            </h2>
        </div>
    </x-slot>
    
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="py-4">
            <div class="max-w-[50%] max-h-[50%]">
                <img src="{{ asset($image->path) }}" class="w-full h-full bg-white">
            </div>
        </div>
    </div>
</x-app-layout>