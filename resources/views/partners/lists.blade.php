<x-templates>

    <x-navigation>
        <x-slot name="name">{{ $user['name'] }}</x-slot>
        <x-slot name="email">{{ $user['email'] }}</x-slot>
        <x-slot name="profile">{{ $user['profile'] }}</x-slot>

        <div class="max-w md:h-[86vh] p-6 bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700">

            <div class="mb-4 border-b border-gray-200 dark:border-gray-700">
                <ul class="flex flex-wrap -mb-px text-sm font-medium text-center" id="default-tab" data-tabs-toggle="#default-tab-content" role="tablist">
                    <li class="me-2" role="presentation">
                        <button class="inline-block p-4 border-b-2 rounded-t-lg hover:text-gray-600 hover:border-gray-300 dark:hover:text-gray-300" id="search-tab" data-tabs-target="#search" type="button" role="tab" aria-controls="search" aria-selected="{{ $page['partners'] ? 'true' : 'false'}}">Partners</button>
                    </li>
                    <li class="me-2" role="presentation">
                        <button class="inline-block p-4 border-b-2 rounded-t-lg hover:text-gray-600 hover:border-gray-300 dark:hover:text-gray-300" id="add-partner-tab" data-tabs-target="#add-partner" type="button" role="tab" aria-controls="add-partner" aria-selected="{{ $page['connect'] ? 'true' : 'false'}}">Connect</button>
                    </li>
                    <li class="me-2" role="presentation">
                        <button class="inline-block p-4 border-b-2 rounded-t-lg hover:text-gray-600 hover:border-gray-300 dark:hover:text-gray-300" id="pending-partner-tab" data-tabs-target="#pending-partner" type="button" role="tab" aria-controls="pending-partner" aria-selected="{{ $page['pending'] ? 'true' : 'false'}}">Pending</button>
                    </li>
                </ul>
            </div>
            <div id="default-tab-content">
                <div class="hidden rounded-lg" id="search" role="tabpanel" aria-labelledby="search-tab">
                    <div class="max-w p-4">
                        @if(session('success'))
                            <div id="alert-success" class="flex items-center p-4 mb-4 text-green-800 rounded-lg bg-green-50 dark:bg-gray-800 dark:text-green-400" role="alert">
                                <svg class="flex-shrink-0 w-4 h-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                                    <path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z"/>
                                </svg>
                                <span class="sr-only">Info</span>
                                <div class="ms-3 text-sm font-medium">
                                    {{ session('success.message') }} <span class="font-semibold underline hover:no-underline">{{ session('success.username') }}</span>.
                                </div>
                                <button type="button" class="ms-auto -mx-1.5 -my-1.5 bg-green-50 text-green-500 rounded-lg focus:ring-2 focus:ring-green-400 p-1.5 hover:bg-green-200 inline-flex items-center justify-center h-8 w-8 dark:bg-gray-800 dark:text-green-400 dark:hover:bg-gray-700" data-dismiss-target="#alert-success" aria-label="Close">
                                    <span class="sr-only">Close</span>
                                    <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                                    </svg>
                                </button>
                            </div>
                        @endif

                        <form class="w-full mx-auto" method="get" action="{{ route('partners.show') }}">
                            <div class="flex">
                                <div class="relative w-full">
                                    <input type="search" name="related" id="location-search" class="block p-2.5 w-full z-20 text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:border-blue-500" placeholder="Search user..." required />
                                    <button type="submit" class="absolute top-0 right-0 h-full p-2.5 text-sm font-medium text-white bg-blue-700 rounded-r-lg border border-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                                        <svg class="w-4 h-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z"/>
                                        </svg>
                                        <span class="sr-only">Search</span>
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>

                    <div class="max-w md:max-h-[60vh] p-4">

                        <div class="grid gap-4">

                            @foreach($partners as $partner)

                                <div class="max-w p-4 border border-gray-200 rounded-lg bg-gray-50 dark:bg-gray-800 dark:border-gray-700">
                                    <div class="flex items-center gap-3 md:gap-6">
                                        <img class="w-8 h-8 md:w-10 md:h-10 border-2 border-white rounded-full dark:border-gray-800" src="{{ asset('storage/profile/guest.jpg')}}" alt="member picture">
                                        <h3 class="text-base md:text-lg font-normal truncate">{{ "@" . $partner->username }}</h3>
                                        <div class="ml-auto">

                                            <button id="dropdownMenuIcon-search-{{ $partner->username }}" data-dropdown-toggle="dropdownDots-search-{{ $partner->username }}" class="inline-flex items-center p-2 text-sm font-medium text-center text-white bg-blue-600 rounded-lg hover:bg-blue-700 focus:ring-4 focus:outline-none dark:focus:ring-blue-800" type="button">
                                                <svg class="w-5 h-5 text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 4 15">
                                                    <path d="M3.5 1.5a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0Zm0 6.041a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0Zm0 5.959a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0Z"/>
                                                </svg>
                                            </button>


                                            <!-- Dropdown menu -->
                                            <div id="dropdownDots-search-{{ $partner->username }}" class="z-10 hidden bg-white divide-y divide-gray-100 rounded-lg shadow w-44 dark:bg-gray-700 dark:divide-gray-600">
                                                <ul class="py-2 text-sm text-gray-700 dark:text-gray-200" aria-labelledby="dropdownMenuIcon-search-{{ $partner->username }}">
                                                    <li>
                                                        <a href="#" class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">View Profile</a>
                                                    </li>

                                                    <li>
                                                        <a href="#" class="block px-4 py-2 text-red-700 hover:bg-gray-100 dark:hover:bg-gray-600 dark:text-red-500">Disconnect</a>
                                                    </li>
                                                </ul>
                                            </div>

                                        </div>
                                    </div>
                                </div>

                            @endforeach

                            <div class="my-4 md:mx-4">
                                {{ $partners->appends(request()->query())->links() }}
                            </div>
                        </div>

                    </div>
                </div>

                <div class="hidden rounded-lg" id="add-partner" role="tabpanel" aria-labelledby="add-partner-tab">
                    <div class="max-w p-4">

                        <form class="w-full mx-auto" method="get" action="{{ route('partners.show') }}">
                            <div class="flex">
                                <div class="relative w-full">
                                    <input type="search" name="connect_to_partner" id="location-search" class="block p-2.5 w-full z-20 text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:border-blue-500" placeholder="Search user..." required />
                                    <button type="submit" class="absolute top-0 right-0 h-full p-2.5 text-sm font-medium text-white bg-blue-700 rounded-r-lg border border-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                                        <svg class="w-4 h-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z"/>
                                        </svg>
                                        <span class="sr-only">Search</span>
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>

                    <div class="max-w md:max-h-[60vh] p-4">

                        <div class="grid gap-4">

                            @foreach($connects as $partner)
                                <div class="max-w p-4 border border-gray-200 rounded-lg bg-gray-50 dark:bg-gray-800 dark:border-gray-700">
                                    <div class="flex items-center gap-3 md:gap-6">
                                        <img class="w-8 h-8 md:w-10 md:h-10 border-2 border-white rounded-full dark:border-gray-800" src="{{ asset('storage/profile/' . ($partner->profile_img ?? 'guest.jpg'))}}" alt="member picture">
                                        <h3 class="text-base md:text-lg font-normal truncate">@<?= $partner->username ?></h3>
                                        <div class="ml-auto">

                                            <button id="dropdownMenuIcon-connect-{{ $partner->username }}" data-dropdown-toggle="dropdownDots-connect-{{ $partner->username }}" class="inline-flex items-center p-2 text-sm font-medium text-center text-white bg-blue-600 rounded-lg hover:bg-blue-700 focus:ring-4 focus:outline-none dark:focus:ring-blue-800" type="button">
                                                <svg class="w-5 h-5 text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 4 15">
                                                    <path d="M3.5 1.5a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0Zm0 6.041a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0Zm0 5.959a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0Z"/>
                                                </svg>
                                            </button>


                                            <!-- Dropdown menu -->
                                            <div id="dropdownDots-connect-{{ $partner->username }}" class="z-10 hidden bg-white divide-y divide-gray-100 rounded-lg shadow w-44 dark:bg-gray-700 dark:divide-gray-600">
                                                <ul class="py-2 text-sm text-gray-700 dark:text-gray-200" aria-labelledby="dropdownMenuIcon-connect-{{ $partner->username }}">
                                                    <li>
                                                        <a href="" class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">View Profile</a>
                                                    </li>
                                                    <li>
                                                        <a href="{{ route('store.partner', ['username' => $partner->username]) }}" class="block px-4 py-2 text-blue-700 hover:bg-gray-100 dark:hover:bg-gray-600 dark:text-blue-500">Request Connect</a>
                                                    </li>
                                                </ul>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            @endforeach

                          @if($connects)
                            <div class="my-4 md:mx-4">
                                {{ $connects->appends(request()->query())->links() }}
                            </div>
                          @endif

                        </div>

                    </div>
                </div>

                <div class="hidden rounded-lg" id="pending-partner" role="tabpanel" aria-labelledby="pending-partner-tab">

                    <div class="max-w md:max-h-[68vh] p-4">

                        <div class="grid gap-4">

                            @foreach($pending as $partner)
                                <div class="max-w p-4 border border-gray-200 rounded-lg bg-gray-50 dark:bg-gray-800 dark:border-gray-700">
                                    <div class="flex items-center gap-3 md:gap-6">
                                        <img class="w-8 h-8 md:w-10 md:h-10 border-2 border-white rounded-full dark:border-gray-800" src="{{ asset('storage/profile/guest.jpg')}}" alt="member picture">
                                        <h3 class="text-base md:text-lg font-normal truncate">@<?= $partner->username ?></h3>
                                        <div class="ml-auto">

                                            <button id="dropdownMenuIcon-pending-{{ $partner->username }}" data-dropdown-toggle="dropdownDots-pending-{{ $partner->username }}" class="inline-flex items-center p-2 text-sm font-medium text-center text-white bg-blue-600 rounded-lg hover:bg-blue-700 focus:ring-4 focus:outline-none dark:focus:ring-blue-800" type="button">
                                                <svg class="w-5 h-5 text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 4 15">
                                                    <path d="M3.5 1.5a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0Zm0 6.041a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0Zm0 5.959a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0Z"/>
                                                </svg>
                                            </button>


                                            <!-- Dropdown menu -->
                                            <div id="dropdownDots-pending-{{ $partner->username }}" class="z-10 hidden bg-white divide-y divide-gray-100 rounded-lg shadow w-44 dark:bg-gray-700 dark:divide-gray-600">
                                                <ul class="py-2 text-sm text-gray-700 dark:text-gray-200" aria-labelledby="dropdownMenuIcon-pending-{{ $partner->username }}">
                                                    <li>
                                                        <a href="#" class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">View Profile</a>
                                                    </li>

                                                    <li>
                                                        <a href="#" class="block px-4 py-2 text-red-700 hover:bg-gray-100 dark:hover:bg-gray-600 dark:text-red-500">Cancel Request</a>
                                                    </li>
                                                </ul>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                              @endforeach

                                <div class="my-4 md:mx-4">
                                    {{ $pending->appends(request()->query())->links() }}
                                </div>

                        </div>

                    </div>
                </div>
            </div>
        </div>


    </x-navigation>

</x-templates>
