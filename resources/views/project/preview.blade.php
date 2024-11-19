<x-templates>

    <x-navigation>
        <x-slot name="name">{{ $user['name'] }}</x-slot>
        <x-slot name="email">{{ $user['email'] }}</x-slot>
        <x-slot name="profile">{{ $user['profile'] }}</x-slot>

        <div class="max-w min-h-[88vh] bg-white p-4 border border-gray-200 rounded-lg shadow md:overflow-y-hidden">
            <div class="mb-4 border-b border-gray-200 dark:border-gray-700">
                <ul class="flex flex-wrap -mb-px text-sm font-medium text-center" id="default-styled-tab" data-tabs-toggle="#default-styled-tab-content" data-tabs-active-classes="text-purple-600 hover:text-purple-600 dark:text-purple-500 dark:hover:text-purple-500 border-purple-600 dark:border-purple-500" data-tabs-inactive-classes="dark:border-transparent text-gray-500 hover:text-gray-600 dark:text-gray-400 border-gray-100 hover:border-gray-300 dark:border-gray-700 dark:hover:text-gray-300" role="tablist">
                    <li class="me-2" role="presentation">
                        <button class="inline-block p-4 border-b-2 rounded-t-lg" id="profile-styled-tab" data-tabs-target="#styled-profile" type="button" role="tab" aria-controls="profile" aria-selected="false">Overview</button>
                    </li>
                    <li class="me-2" role="presentation">
                        <button class="inline-block p-4 border-b-2 rounded-t-lg hover:text-gray-600 hover:border-gray-300 dark:hover:text-gray-300" id="dashboard-styled-tab" data-tabs-target="#styled-dashboard" type="button" role="tab" aria-controls="dashboard" aria-selected="false">Others</button>
                    </li>
                </ul>
            </div>
            <div id="default-styled-tab-content">
                <div class="hidden p-4" id="styled-profile" role="tabpanel" aria-labelledby="profile-tab">

                    <div class="grid grid-cols-1 md:grid-cols-6 gap-4">

                        <div class="col-span-1 md:col-span-4 p-4">
                            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Aspernatur, eum?</p>
                        </div>

                        <div class="col-span-1 md:col-span-2 p-4">
                            <div class="grid gap-3">

                                <h1 class="text-lg font-semibold">Title project</h1>
                                <hr>
                                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Doloremque dolorum eveniet exercitationem harum labore odio optio porro qui suscipit tempore.</p>
                                <hr>

                                <div class="inline-flex gap-2 items-center">
                                    <box-icon name='task' color='#6b7280'></box-icon>
                                    <p class="text-sm font-medium text-gray-500">2 <span class="font-normal">Tasks</span></p>
                                </div>

                                <div class="inline-flex gap-2 items-center">
                                    <box-icon name='group' color='#6b7280'></box-icon>
                                    <p class="text-sm font-medium text-gray-500">2 <span class="font-normal">Users</span></p>
                                </div>

                                <div class="inline-flex gap-2 items-center">
                                    <box-icon name='history' color='#6b7280'></box-icon>
                                    <p class="text-sm font-medium text-gray-500">3 <span class="font-normal">Logs</span></p>
                                </div>

                                <div class="inline-flex gap-2 items-center">
                                    <box-icon name='chat' color='#6b7280'></box-icon>
                                    <p class="text-sm font-medium text-gray-500">3 <span class="font-normal">Comments</span></p>
                                </div>


                                <button data-modal-target="authentication-modal" data-modal-toggle="authentication-modal" class="mt-3 block text-white bg-purple-700 hover:bg-purple-800 focus:ring-4 focus:outline-none focus:ring-purple-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-purple-600 dark:hover:bg-purple-700 dark:focus:ring-purple-800" type="button">
                                    Invite Partner
                                </button>
                            </div>
                        </div>

                    </div>


                </div>

                <div class="hidden p-4 rounded-lg bg-gray-50 dark:bg-gray-800" id="styled-dashboard" role="tabpanel" aria-labelledby="dashboard-tab">
                    <p class="text-sm text-gray-500 dark:text-gray-400">This is some placeholder content the <strong class="font-medium text-gray-800 dark:text-white">Dashboard tab's associated content</strong>. Clicking another tab will toggle the visibility of this one for the next. The tab JavaScript swaps classes to control the content visibility and styling.</p>
                </div>
            </div>
        </div>


    </x-navigation>
</x-templates>
