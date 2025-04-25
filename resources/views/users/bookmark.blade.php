<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight my-auto">
                {{$user->name}}のブックマーク
            </h2>
            <div class="space-x-8 sm:-my-px sm:ms-10 sm:flex">
            </div>
        </div>
    </x-slot>
    
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="-m-4 my-4 flex flex-wrap">
        </div>
    </div>
</x-app-layout>