<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Median number of viewers for all streams
        </h2>
    </x-slot>
    <div class="mt-5 max-w-7xl mx-auto text-center text-4xl">
        <h1 class="font-semibold text-xl text-gray-800 leading-tight">
            {{$number}}
        </h1>
    </div>
</x-app-layout>
