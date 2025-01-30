<x-templates>

    <x-navigation>
        <x-slot name="name">{{ $user['name'] }}</x-slot>
        <x-slot name="email">{{ $user['email'] }}</x-slot>
        <x-slot name="profile">{{ $user['profile'] }}</x-slot>

        <div class="max-w md:h-[86vh] p-6 bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700">

            <div class="mb-4 border-b border-gray-200 dark:border-gray-700">
                <ul class="flex flex-wrap -mb-px text-sm font-medium text-center" id="default-styled-tab" data-tabs-toggle="#default-styled-tab-content" data-tabs-active-classes="text-purple-600 hover:text-purple-600 dark:text-purple-500 dark:hover:text-purple-500 border-purple-600 dark:border-purple-500" data-tabs-inactive-classes="dark:border-transparent text-gray-500 hover:text-gray-600 dark:text-gray-400 border-gray-100 hover:border-gray-300 dark:border-gray-700 dark:hover:text-gray-300" role="tablist">
                    <li class="me-2" role="presentation">
                        <button class="inline-block p-4 border-b-2 rounded-t-lg" id="profile-styled-tab" data-tabs-target="#styled-profile" type="button" role="tab" aria-controls="profile" aria-selected="false">Profile</button>
                    </li>
                    <li class="me-2" role="presentation">
                        <button class="inline-block p-4 border-b-2 rounded-t-lg hover:text-gray-600 hover:border-gray-300 dark:hover:text-gray-300" id="security-styled-tab" data-tabs-target="#styled-security" type="button" role="tab" aria-controls="security" aria-selected="false">Security</button>
                    </li>
                </ul>
            </div>

            <div class="hidden p-4 rounded-lg" id="styled-profile" role="tabpanel" aria-labelledby="profile-tab">
                <div class="grid grid-cols-1 gap-3 md:grid-cols-5 md:gap-6">
                    <div class="md:col-span-1">
                        <div class="flex md:block space-x-4 md:space-x-0 md:space-y-5">
                            <img src="{{ asset('storage/profile/' . $user['profile']) }}" alt="Profile Picture" class="rounded-full h-12 w-12 md:h-auto md:w-auto md:mb-4">
                            <div class="flex items-center md:block w-full overflow-hidden">
                                <div class="w-full">
                                    <p class="text-xl font-semibold truncate break-words md:text-3xl md:py-0.5">{{ $user['name'] }}</p>
                                    <p class="text-sm font-light truncate text-gray-400 break-words md:text-lg">{{ $user['username'] }}</p>
                                    <div class="space-y-2 my-2">
                                        <p class="bg-blue-100 text-blue-800 text-xs font-medium px-2.5 py-1 rounded dark:bg-blue-900 dark:text-blue-300">0 Tasks</p>
                                        <p class="bg-yellow-100 text-yellow-800 text-xs font-medium px-2.5 py-1 rounded dark:bg-yellow-900 dark:text-yellow-300">{{ $user['projects'] }} Projects</p>
                                        <p class="bg-purple-100 text-purple-800 text-xs font-medium px-2.5 py-1 rounded dark:bg-purple-900 dark:text-purple-300">{{ $user['partners'] }} Partners</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="block my-2 md:my-1">
                            <button class="w-full py-1.5 text-sm font-medium rounded-lg text-white shadow-md bg-gradient-to-r from-purple-500 to-indigo-600 hover:bg-gradient-to-br hover:from-purple-600 hover:to-indigo-700 hover:shadow-lg focus:bg-gradient-to-br focus:from-purple-600 focus:to-indigo-700 focus:shadow-lg focus:outline-none focus:ring-0 active:bg-gradient-to-br active:from-purple-700 active:to-indigo-800 active:shadow-lg transition duration-150 ease-in-out">
                                Edit Profile
                            </button>
                        </div>
                    </div>

                    @if($projects != [])
                        <div class="overflow-scroll h-96 py-5 md:py-0 md:overflow-auto md:h-auto md:col-span-4">
                            <div class="grid grid-cols-1 gap-3 md:grid-cols-2 md:gap-2">

                                @foreach($projects as $project)

                                    <div class="col-span-1">
                                        <div class="border-double border-2 rounded h-full border-gray-200 p-1 md:p-3">
                                            <div class="flex items-center gap-2">
                                                <box-icon name='book-bookmark' class="opacity-50"></box-icon>
                                                <p class="font-medium text-gray-600">{{ $project['name'] }}</p>
                                            </div>

                                            <p class="text-xs my-2 line-clamp-2">{{ $project['description'] }}</p>

                                            <div class="gap-2">
                                                <span class="bg-indigo-100 text-indigo-800 text-xs font-medium ms-1 px-2.5 py-0.5 rounded dark:bg-indigo-900 dark:text-indigo-300 pt-0">{{ $project['role'] }}</span>
                                                <span class="bg-green-100 text-green-800 text-xs font-medium ms-1 px-2.5 py-0.5 rounded dark:bg-green-900 dark:text-green-300 pt-0">{{ $project['end_date'] }}</span>
                                            </div>

                                        </div>
                                    </div>

                                @endforeach

                            </div>
                        </div>
                    @endif

                    @if($projects == null)
                        <div class="md:col-span-4">
                            <div class="flex items-center justify-center md:h-96">
                                <div class="justify-center">
                                    <p class="text-xl">PROJECT NOT FOUND</p>
                                </div>
                            </div>
                        </div>
                    @endif



                    {{--                    <form class="mx-auto" method="POST" action="{{route('register.store')}}">--}}
{{--                        @csrf--}}
{{--                        <div class="space-y-4">--}}
{{--                            <div class="">--}}
{{--                                <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white" for="user_avatar">Profile Picture</label>--}}
{{--                                <input class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400" aria-describedby="user_avatar_help" id="user_avatar" type="file">--}}
{{--                            </div>--}}
{{--                            <div class="">--}}
{{--                                <label for="base-input" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Fullname</label>--}}
{{--                                <input type="text" id="base-input" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                    </form>--}}
                </div>
                <div class="hidden p-4 rounded-lg" id="styled-security" role="tabpanel" aria-labelledby="security-tab">
                    <p class="text-sm text-gray-500 dark:text-gray-400">This is some placeholder content the <strong class="font-medium text-gray-800 dark:text-white">Security tab's associated content</strong>. Clicking another tab will toggle the visibility of this one for the next. The tab JavaScript swaps classes to control the content visibility and styling.</p>
                </div>
            </div>

        </div>

    </x-navigation>
</x-templates>
