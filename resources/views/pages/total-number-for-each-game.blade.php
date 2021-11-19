<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Total number of streams for each game
        </h2>
    </x-slot>
    <div class="mt-5 max-w-7xl mx-auto">
        <div class="flex px-4 py-3 bg-gray-50 text-right sm:px-6 shadow sm:rounded-tl-md sm:rounded-tr-md">
            <div class="flex w-full gap-6">
                <div class="flex-1 text-left">
                    <span class="block font-medium text-sm text-gray-700" for="password">
                        Game
                    </span>
                </div>

                <div class="flex-1 text-left">
                    <span class="block font-medium text-sm text-gray-700" for="password_confirmation">
                        Streams count
                    </span>
                </div>
            </div>
        </div>
        <div class="flex flex-col bg-white px-4 py-3 text-right sm:px-6 shadow sm:rounded-bl-md sm:rounded-br-md">
        @foreach ($games as $game)
            <div class="flex w-full gap-6 border-b">
                <div class="flex-1 text-left py-3">
                    <span class="block font-medium text-sm text-gray-700" for="password">
                        {{$game->name}}
                    </span>
                </div>
                <div class="flex-1 text-left  py-3">
                    <span class="block font-medium text-sm text-gray-700" for="password_confirmation">
                        {{$game->streams_count}}
                    </span>
                </div>
            </div>
        @endforeach
        </div>
    </div>
</x-app-layout>
