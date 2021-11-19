<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            List of top 100 streams by viewer count that can be sorted asc & desc
        </h2>
    </x-slot>
    <div class="mt-5 max-w-7xl mx-auto">
        <div class="flex px-4 py-3 bg-gray-50 text-right sm:px-6 shadow sm:rounded-tl-md sm:rounded-tr-md">
            <div class="flex w-full gap-6">
                <div class="flex-1 text-left">
                    <span class="inline-flex items-center text-sm font-medium text-gray-700 " for="">
                        Stream name
                    </span>
                </div>

                <div class="flex-1 text-left">
                     <a href="{{ route('top-100-streams-by-viewer-count', ['order'=>request()->get('order') === 'asc' ? 'desc' : 'asc']) }}" class="inline-flex items-center text-sm font-medium text-gray-700 ">
                        Viewer count
                     @if(request()->get('order') === 'asc')
                             <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                 <path fill-rule="evenodd" d="M14.707 12.707a1 1 0 01-1.414 0L10 9.414l-3.293 3.293a1 1 0 01-1.414-1.414l4-4a1 1 0 011.414 0l4 4a1 1 0 010 1.414z" clip-rule="evenodd" />
                             </svg>
                     @else
                             <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                 <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                             </svg>
                     @endif
                    </a>
                </div>
            </div>
        </div>
        <div class="flex flex-col bg-white px-4 py-3 text-right sm:px-6 shadow sm:rounded-bl-md sm:rounded-br-md">
        @foreach ($results as $row)
            <div class="flex w-full gap-6 border-b">
                <div class="flex-1 text-left py-3">
                    <span class="block font-medium text-sm text-gray-700" for="password">
                        {{$row['title']}}
                    </span>
                </div>
                <div class="flex-1 text-left  py-3">
                    <span class="block font-medium text-sm text-gray-700" for="password_confirmation">
                        {{$row['viewer_count']}}
                    </span>
                </div>
            </div>
        @endforeach
        </div>
    </div>
</x-app-layout>
