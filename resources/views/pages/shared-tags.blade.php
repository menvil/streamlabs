<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Which tags are shared between the user followed streams and the top 1000 streams? Also make sure to translate the tags to their respective name?
        </h2>
    </x-slot>
    <div class="mt-5 max-w-7xl mx-auto">
        <div class="flex px-4 py-3 bg-gray-50 text-right sm:px-6 shadow sm:rounded-tl-md sm:rounded-tr-md">
            <div class="flex w-full gap-6">
                <div class="flex-1 text-left">
                    <span class="block font-medium text-sm text-gray-700" for="password">
                        Tag
                    </span>
                </div>

                <div class="flex-1 text-left">
                    <span class="block font-medium text-sm text-gray-700" for="password_confirmation">
                        Name
                    </span>
                </div>
            </div>
        </div>
        <div class="flex flex-col bg-white px-4 py-3 text-right sm:px-6 shadow sm:rounded-bl-md sm:rounded-br-md">
        @foreach ($results as $result)
            <div class="flex w-full gap-6 border-b">
                <div class="flex-1 text-left py-3">
                    <span class="block font-medium text-sm text-gray-700" for="password">
                        {{$result->tag_hash}}
                    </span>
                </div>
                <div class="flex-1 text-left  py-3">
                    <span class="block font-medium text-sm text-gray-700" for="password_confirmation">
                        {{$result->name}}
                    </span>
                </div>
            </div>
        @endforeach
        </div>
    </div>
</x-app-layout>
