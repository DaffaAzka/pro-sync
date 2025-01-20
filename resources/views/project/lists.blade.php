<x-templates>

    <x-navigation>
        <x-slot name="name">{{ $user['name'] }}</x-slot>
        <x-slot name="email">{{ $user['email'] }}</x-slot>
        <x-slot name="profile">{{ $user['profile'] }}</x-slot>

        <form class="w-full mx-auto mb-4" method="get" action="{{ route('lists.project') }}">
            <div class="flex">
                <div class="relative w-full">
                    <input type="search" name="title" id="location-search" class="block p-2.5 w-full z-20 text-sm text-gray-900 bg-white rounded-lg border border-gray-300 shadow focus:ring-purple-500 focus:border-purple-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:border-purple-500" placeholder="Search project..." required />
                    <button type="submit" class="absolute top-0 right-0 h-full p-2.5 text-sm font-medium text-white shadow bg-purple-700 rounded-r-lg border border-purple-700 hover:bg-purple-800 focus:ring-4 focus:outline-none focus:ring-purple-300 dark:bg-purple-600 dark:hover:bg-purple-700 dark:focus:ring-purple-800">
                        <svg class="w-4 h-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z"/>
                        </svg>
                        <span class="sr-only">Search</span>
                    </button>
                </div>
            </div>
        </form>

        <div class="my-5">
            <div class="grid grid-cols-1 gap-4 md:grid-cols-2 lg:grid-cols-3">

                @foreach($projects as $project)
                    <div class="md:span p-6 bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700 flex flex-col h-full">
                        <div class="grid gap-y-3 flex-grow">
                            <h5 class="text-2xl font-semibold tracking-tight truncate">{{ $project['name'] }}</h5>
                            <p class="font-normal text-sm text-gray-600 line-clamp-2 md:line-clamp-3">{{ $project['description'] }}</p>
                        </div>
                        <div class="flex my-1.5 space-x-2 mt-3.5 w-full">
                            <a href="{{ route('show.project', ['id' => $project['slug']]) }}" class="flex items-center px-4 py-1.5 text-sm font-medium rounded-lg text-white shadow-md bg-gradient-to-r from-purple-500 to-indigo-600 hover:bg-gradient-to-br hover:from-purple-600 hover:to-indigo-700 hover:shadow-lg focus:bg-gradient-to-br focus:from-purple-600 focus:to-indigo-700 focus:shadow-lg focus:outline-none focus:ring-0 active:bg-gradient-to-br active:from-purple-700 active:to-indigo-800 active:shadow-lg transition duration-150 ease-in-out">
                                Go to project
                                <box-icon name="right-arrow-alt" class="ml-2" color="#ffffff"></box-icon>
                            </a>

                            <button data-popover-target="popover-{{$project['slug']}}-description" data-popover-placement="top-start" type="button">
                                <svg class="w-6 h-6 ms-0.5 text-gray-400 hover:text-gray-500" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-8-3a1 1 0 00-.867.5 1 1 0 11-1.731-1A3 3 0 0113 8a3.001 3.001 0 01-2 2.83V11a1 1 0 11-2 0v-1a1 1 0 011-1 1 1 0 100-2zm0 8a1 1 0 100-2 1 1 0 000 2z" clip-rule="evenodd"></path>
                                </svg>
                                <span class="sr-only">Show details</span>
                            </button>
                            <div data-popover id="popover-{{$project['slug']}}-description" role="tooltip" class="absolute z-10 invisible inline-block text-sm text-white transition-opacity duration-300 bg-gray-700 border border-gray-200 rounded-lg shadow-sm opacity-0 w-auto dark:bg-gray-800 dark:border-gray-600 dark:text-gray-400">
                                <div class="p-3 space-y-1">
                                    <p>Role:
                                        <span class="bg-indigo-100 text-indigo-800 text-xs font-medium ms-1 px-2.5 py-0.5 rounded dark:bg-indigo-900 dark:text-indigo-300 pt-0">{{ $project['role'] }}</span>
                                    <p>Deadline: <span class="ms-1">{{ $project['end_date'] }}</span></p>
                                </div>
                                <div data-popper-arrow></div>
                            </div>

                        </div>
                    </div>
                @endforeach


            </div>

            <div class="my-4 md:mx-4">
                {{ $projects->links() }}
            </div>
        </div>

    </x-navigation>

</x-templates>

