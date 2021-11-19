<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Which of the top 1000 streams is the logged in user following?
        </h2>
    </x-slot>
    <div class="mt-5 max-w-7xl mx-auto">
        <div class="flex px-4 py-3 bg-gray-50 text-right sm:px-6 shadow sm:rounded-tl-md sm:rounded-tr-md">
            <div class="flex w-full gap-6">
                <div class="flex-1 text-left">
                    <span class="block font-medium text-sm text-gray-700" for="password">
                        Stream
                    </span>
                </div>

                <div class="flex-1 text-left">
                    <span class="block font-medium text-sm text-gray-700" for="password_confirmation">
                        Viewer count
                    </span>
                </div>
            </div>
        </div>
        <div class="flex flex-col bg-white px-4 py-3 text-right sm:px-6 shadow sm:rounded-bl-md sm:rounded-br-md">
        @foreach ($results as $row)
            <div class="flex w-full gap-6 border-b">
                <div class="flex-1 text-left py-3">
                    <span class="block font-medium text-sm text-gray-700" for="password">
                        {{$row->title}}
                    </span>
                </div>
                <div class="flex-1 text-left  py-3">
                    <span class="block font-medium text-sm text-gray-700" for="password_confirmation">
                        {{$row->viewer_count}}
                    </span>
                </div>
            </div>
        @endforeach
        </div>
    </div>
</x-app-layout>
