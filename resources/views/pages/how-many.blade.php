<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            How many viewers does the lowest viewer count stream that the logged in user is following need to gain in order to make it into the top 1000?
        </h2>
    </x-slot>
    <div class="mt-5 max-w-7xl mx-auto">

        <div class="flex flex-col bg-white px-4 py-3 text-right sm:px-6 shadow sm:rounded-bl-md sm:rounded-br-md">
            <div class="flex w-full gap-6 border-b">
                <div class="flex-1 text-left py-3">
                    <span class="block font-medium text-sm text-gray-700" for="password">
                        Lowest viewer count stream that the logged in user is following: <b>{{ $lowerStream->title }}</b> with <b>{{$lowerStream->viewer_count}}</b> viewers
                    </span>
                </div>

            </div>
            <div class="flex w-full gap-6 border-b">
                <div class="flex-1 text-left  py-3">
                    <span class="block font-medium text-sm text-gray-700" for="password_confirmation">
                        Lowest viewer count stream from top 1000 is following: <b>{{ $minStream->title }}</b> with <b>{{$minStream->viewer_count}}</b> viewers
                    </span>
                </div>
            </div>

            <div class="flex w-full gap-6 border-b">
                <div class="flex-1 text-left  py-3">
                    <span class="block font-medium text-sm text-gray-700" for="password_confirmation">
                        Need to gain: <b>{{ $minStream->viewer_count - $lowerStream->viewer_count }}</b> viewers
                    </span>
                </div>
            </div>

        </div>
    </div>
</x-app-layout>
