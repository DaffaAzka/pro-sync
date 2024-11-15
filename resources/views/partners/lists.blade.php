<x-templates>

    <x-navigation>
        <x-slot name="name">{{ $user['name'] }}</x-slot>
        <x-slot name="email">{{ $user['email'] }}</x-slot>
        <x-slot name="profile">{{ $user['profile'] }}</x-slot>


{{--        <div class="relative">--}}
{{--            <div class="flex flex-row flex-wrap space-y-4 sm:space-y-0 items-center justify-between pb-4">--}}
{{--                <div class="relative">--}}
{{--                    <button data-modal-target="crud-modal" data-modal-toggle="crud-modal" class="block text-white bg-purple-700 hover:bg-purple-800 focus:ring-4 focus:outline-none focus:ring-purple-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-purple-600 dark:hover:bg-purple-700 dark:focus:ring-purple-800" type="button">--}}
{{--                        Send Request--}}
{{--                    </button>--}}
{{--                </div>--}}
{{--                <label for="table-search" class="sr-only">Search</label>--}}
{{--                <div class="relative !mt-0">--}}
{{--                    <div class="absolute inset-y-0 left-0 rtl:inset-r-0 rtl:right-0 flex items-center ps-3 pointer-events-none">--}}
{{--                        <svg class="w-5 h-5 text-gray-500 dark:text-gray-400" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z" clip-rule="evenodd"></path></svg>--}}
{{--                    </div>--}}
{{--                    <input type="text" id="table-search" class="w-40 sm:w-60 block p-2 ps-10 text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Search for items">--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}

{{--        <div class="relative max-h-[76vh] overflow-x-auto shadow-lg sm:rounded-lg overflow-y-auto">--}}
{{--            <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">--}}
{{--                <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">--}}
{{--                <tr>--}}
{{--                    <th scope="col" class="px-6 py-3">--}}
{{--                        Partner name--}}
{{--                    </th>--}}
{{--                    <th scope="col" class="px-6 py-3">--}}
{{--                        Since--}}
{{--                    </th>--}}
{{--                    <th scope="col" class="px-6 py-3">--}}
{{--                        Action--}}
{{--                    </th>--}}
{{--                </tr>--}}
{{--                </thead>--}}
{{--                <tbody>--}}

{{--                    @for ($i = 0; $i < 10; $i++)--}}

{{--                        <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">--}}
{{--                            <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">--}}
{{--                                <a href="#" class="font-medium text-gray-600 dark:text-gray-500">Daffa Azka</a>--}}
{{--                            </th>--}}
{{--                            <td class="px-6 py-4">--}}
{{--                                Silver--}}
{{--                            </td>--}}
{{--                            <td class="px-6 py-4">--}}
{{--                                <a href="#" class="font-medium text-red-600 dark:text-red-500 hover:underline">Dissociate</a>--}}
{{--                            </td>--}}
{{--                        </tr>--}}

{{--                    @endfor--}}

{{--                </tbody>--}}
{{--            </table>--}}
{{--        </div>--}}





        <div class="max-w h-[86vh] overflow-y-auto p-6 bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700">


            <div class="mb-4 border-b border-gray-200 dark:border-gray-700">
                <ul class="flex flex-wrap -mb-px text-sm font-medium text-center" id="default-tab" data-tabs-toggle="#default-tab-content" role="tablist">
                    <li class="me-2" role="presentation">
                        <button class="inline-block p-4 border-b-2 rounded-t-lg" id="profile-tab" data-tabs-target="#profile" type="button" role="tab" aria-controls="profile" aria-selected="false">Profile</button>
                    </li>
                    <li class="me-2" role="presentation">
                        <button class="inline-block p-4 border-b-2 rounded-t-lg hover:text-gray-600 hover:border-gray-300 dark:hover:text-gray-300" id="dashboard-tab" data-tabs-target="#dashboard" type="button" role="tab" aria-controls="dashboard" aria-selected="false">Dashboard</button>
                    </li>
                    <li class="me-2" role="presentation">
                        <button class="inline-block p-4 border-b-2 rounded-t-lg hover:text-gray-600 hover:border-gray-300 dark:hover:text-gray-300" id="settings-tab" data-tabs-target="#settings" type="button" role="tab" aria-controls="settings" aria-selected="false">Settings</button>
                    </li>
                    <li role="presentation">
                        <button class="inline-block p-4 border-b-2 rounded-t-lg hover:text-gray-600 hover:border-gray-300 dark:hover:text-gray-300" id="contacts-tab" data-tabs-target="#contacts" type="button" role="tab" aria-controls="contacts" aria-selected="false">Contacts</button>
                    </li>
                </ul>
            </div>
            <div id="default-tab-content">
                <div class="hidden p-4 rounded-lg bg-gray-50 dark:bg-gray-800" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                    <p class="text-sm text-gray-500 dark:text-gray-400">This is some placeholder content the <strong class="font-medium text-gray-800 dark:text-white">Profile tab's associated content</strong>. Clicking another tab will toggle the visibility of this one for the next. The tab JavaScript swaps classes to control the content visibility and styling.</p>
                </div>
                <div class="hidden p-4 rounded-lg bg-gray-50 dark:bg-gray-800" id="dashboard" role="tabpanel" aria-labelledby="dashboard-tab">
                    <p class="text-sm text-gray-500 dark:text-gray-400">This is some placeholder content the <strong class="font-medium text-gray-800 dark:text-white">Dashboard tab's associated content</strong>. Clicking another tab will toggle the visibility of this one for the next. The tab JavaScript swaps classes to control the content visibility and styling.</p>
                </div>
                <div class="hidden p-4 rounded-lg bg-gray-50 dark:bg-gray-800" id="settings" role="tabpanel" aria-labelledby="settings-tab">
                    <p class="text-sm text-gray-500 dark:text-gray-400">This is some placeholder content the <strong class="font-medium text-gray-800 dark:text-white">Settings tab's associated content</strong>. Clicking another tab will toggle the visibility of this one for the next. The tab JavaScript swaps classes to control the content visibility and styling.</p>
                </div>
                <div class="hidden p-4 rounded-lg bg-gray-50 dark:bg-gray-800" id="contacts" role="tabpanel" aria-labelledby="contacts-tab">
                    <p class="text-sm text-gray-500 dark:text-gray-400">This is some placeholder content the <strong class="font-medium text-gray-800 dark:text-white">Contacts tab's associated content</strong>. Clicking another tab will toggle the visibility of this one for the next. The tab JavaScript swaps classes to control the content visibility and styling.</p>
                </div>
            </div>
        </div>


    </x-navigation>

</x-templates>
