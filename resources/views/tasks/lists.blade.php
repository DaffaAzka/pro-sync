<x-templates>

    <x-navigation>
        <x-slot name="name">{{ $user['name'] }}</x-slot>
        <x-slot name="email">{{ $user['email'] }}</x-slot>
        <x-slot name="profile">{{ $user['profile'] }}</x-slot>

        @if(session('success'))
            <div id="alert-success" class="flex items-center p-4 mb-4 text-green-800 rounded-lg bg-green-50 dark:bg-gray-800 dark:text-green-400" role="alert">
                <svg class="flex-shrink-0 w-4 h-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                    <path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z"/>
                </svg>
                <span class="sr-only">Info</span>
                <div class="ms-3 text-sm font-medium">
                    {{session('success.message')}} <span class="font-semibold underline hover:no-underline">{{ session('success.name') }}</span>.
                </div>
                <button type="button" class="ms-auto -mx-1.5 -my-1.5 bg-green-50 text-green-500 rounded-lg focus:ring-2 focus:ring-green-400 p-1.5 hover:bg-green-200 inline-flex items-center justify-center h-8 w-8 dark:bg-gray-800 dark:text-green-400 dark:hover:bg-gray-700" data-dismiss-target="#alert-success" aria-label="Close">
                    <span class="sr-only">Close</span>
                    <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                    </svg>
                </button>
            </div>
        @endif

        <div class="relative">
            <div class="flex md:grid md:grid-cols-5 md:gap-4">
                <div class="col-span-1 md:col-span-4">
                    <form class=" mx-auto mb-4" method="get" action="{{ route('lists.project') }}">
                    <div class="relative w-full">
                        <input type="search" name="title" id="location-search"
                               class="block p-2.5 w-full z-20 text-sm text-gray-900 bg-white rounded-lg border border-gray-300 shadow focus:ring-purple-500 focus:border-purple-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:border-purple-500"
                               placeholder="Search tasks..." required/>
                        <button type="submit"
                                class="absolute top-0 right-0 h-full p-2.5 text-sm font-medium text-white shadow bg-purple-700 rounded-r-lg border border-purple-700 hover:bg-purple-800 focus:ring-4 focus:outline-none focus:ring-purple-300 dark:bg-purple-600 dark:hover:bg-purple-700 dark:focus:ring-purple-800">
                            <svg class="w-4 h-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                                 viewBox="0 0 20 20">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                      d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z"/>
                            </svg>
                            <span class="sr-only">Search</span>
                        </button>
                    </div>
                    </form>
                </div>

                @if($user['role'] == 'master')
                    <div>
                        <button id="dropdownHoverButton" data-dropdown-toggle="dropdownHover" data-dropdown-trigger="hover" class="w-full text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center flex justify-center items-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800" type="button">Filter by users
                            <svg class="w-2.5 h-2.5 ml-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 4 4 4-4"/>
                            </svg>
                        </button>


                        <!-- Dropdown menu -->
                        <div id="dropdownHover"
                             class="shadow z-10 hidden bg-white divide-y divide-gray-100 rounded-lg w-44 dark:bg-gray-700">
                            <ul class="py-2 text-sm text-gray-700 dark:text-gray-200" aria-labelledby="dropdownHoverButton">
                                @foreach($members as $member)
                                    <li>
                                        <a href="#"
                                           class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">{{ $member['name'] }}</a>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                @endif
            </div>
        </div>


        <div class="my-5">
            <div class="grid grid-cols-1 gap-4 md:grid-cols-2 lg:grid-cols-3">

                 @if($user['role'] == 'master')
                    <div class="md:span p-6 bg-gradient-to-r from-purple-500 to-indigo-600 border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700">
                        <h5 class="mb-2 text-2xl font-bold tracking-tight text-white truncate">Initiated New Task</h5>
                        <p class="mb-3 font-normal text-gray-100 line-clamp-2">Assigning new tasks to your team members is a crucial aspect of effective for project management.</p>

                        <div class="flex items-center space-x-2">
                            <button data-modal-target="task-modal" data-modal-toggle="task-modal" class="flex items-center px-4 py-1.5 text-sm font-medium text-gray-900 bg-white border border-gray-300 rounded-lg hover:bg-gray-100 hover:border-gray-400 dark:bg-gray-800 dark:text-white dark:border-gray-600 dark:hover:bg-gray-700 dark:hover:border-gray-600">
                                Create Task
                                <box-icon name="right-arrow-alt" class="ml-2"></box-icon>
                            </button>
                        </div>
                    </div>
                @endif


                @foreach($tasks as $task)
                    <div
                        class="md:span p-6 bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700 flex flex-col h-full">
                        <div class="grid gap-y-3 flex-grow">
                            <h5 class="text-2xl font-semibold tracking-tight truncate">{{ $task['name'] }}</h5>
                            <p class="font-normal text-sm text-gray-600 line-clamp-2 md:line-clamp-3">{{ $task['description'] }}</p>
                        </div>
                        <div class="flex my-1.5 space-x-2 mt-3.5 w-full">
                            <a href="{{ route('show.task', ['slug' => $slug, 'id' => $task->id]) }}"
                               class="flex items-center px-4 py-1.5 text-sm font-medium rounded-lg text-white shadow-md bg-gradient-to-r from-purple-500 to-indigo-600 hover:bg-gradient-to-br hover:from-purple-600 hover:to-indigo-700 hover:shadow-lg focus:bg-gradient-to-br focus:from-purple-600 focus:to-indigo-700 focus:shadow-lg focus:outline-none focus:ring-0 active:bg-gradient-to-br active:from-purple-700 active:to-indigo-800 active:shadow-lg transition duration-150 ease-in-out">
                                Go to task
                                <box-icon name="right-arrow-alt" class="ml-2" color="#ffffff"></box-icon>
                            </a>

                            @if($user['role'] == 'master')
                                <button data-popover-target="popover-{{$task['id']}}-description"
                                        data-popover-placement="top-start" type="button">
                                    <svg class="w-6 h-6 ms-0.5 text-gray-400 hover:text-gray-500" aria-hidden="true"
                                         fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                        <path fill-rule="evenodd"
                                              d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-8-3a1 1 0 00-.867.5 1 1 0 11-1.731-1A3 3 0 0113 8a3.001 3.001 0 01-2 2.83V11a1 1 0 11-2 0v-1a1 1 0 011-1 1 1 0 100-2zm0 8a1 1 0 100-2 1 1 0 000 2z"
                                              clip-rule="evenodd"></path>
                                    </svg>
                                    <span class="sr-only">Show details</span>
                                </button>
                                <div data-popover id="popover-{{$task['id']}}-description" role="tooltip"
                                     class="absolute z-10 invisible inline-block text-sm text-white transition-opacity duration-300 bg-gray-700 border border-gray-200 rounded-lg shadow-sm opacity-0 w-auto dark:bg-gray-800 dark:border-gray-600 dark:text-gray-400">
                                    <div class="p-3 space-y-1">
                                        <p>Assigned to: <span class="ms-1">{{ $task['assigned_to'] }}</span></p>
                                        <p>Role: <span class="bg-indigo-100 text-indigo-800 text-xs font-medium ms-1 px-2.5 py-0.5 rounded dark:bg-indigo-900 dark:text-indigo-300 pt-0">{{ $task['assigned_role'] }}</span>
                                    </div>
                                    <div data-popper-arrow></div>
                                </div>
                            @endif

                        </div>
                    </div>
                @endforeach


            </div>

            <div class="my-4 md:mx-4">
                {{ $tasks->links() }}
            </div>
        </div>

        @if($user['role'] == 'master')
            <div id="task-modal" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
                <div class="relative p-4 w-full max-w-md max-h-full mt-14">
                    <!-- Modal content -->
                    <div class="relative bg-white rounded-lg shadow-sm dark:bg-gray-700">
                        <!-- Modal header -->
                        <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600 border-gray-200">
                            <h3 class="text-lg font-semibold text-gray-900 dark:text-white">
                                New Task
                            </h3>
                            <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-toggle="task-modal">
                                <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                                </svg>
                                <span class="sr-only">Close modal</span>
                            </button>
                        </div>
                        <!-- Modal body -->
                        <form class="p-4 md:p-5 max-h-[calc(100vh-15rem)] overflow-y-auto" method="post" action="{{ route('store.task', ['url' => $slug]) }}">
                            @csrf
                            <div class="grid gap-4 mb-4 grid-cols-2">
                                <div class="col-span-2">
                                    <label for="name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Name</label>
                                    <input type="text" name="name" id="name" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="Type task name" required="">
                                </div>
                                <div class="col-span-2 sm:col-span-1">
                                    <label for="priority" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Members</label>
                                    <select id="priority" name="priority" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
                                        <option value="routine">Routine</option>
                                        <option value="important">Important</option>
                                    </select>
                                </div>
                                <div class="col-span-2 sm:col-span-1">
                                    <label for="members" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Members</label>
                                    <select id="members" name="project_member_id" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
                                        @foreach($members as $member)
                                            <option value="{{ $member['project_member_id'] }}">{{ $member['name'] }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-span-2">
                                    <label for="description" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Task Description</label>
                                    <textarea id="description" name="description" rows="4" class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Write task description here"></textarea>
                                </div>

                                <div class="col-span-2">
                                    <label for="due_date" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Conclusion Date</label>
                                    <input type="date" min="<?= date('Y-m-d');?>" name="due_date" id="due_date" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="$2999" required="">
                                </div>

{{--                                <div class="col-span-2">--}}
{{--                                    <div class="flex items-start mb-5">--}}
{{--                                        <div class="flex items-center h-5">--}}
{{--                                            <input id="remember" type="checkbox" value="" class="w-4 h-4 border border-gray-300 rounded-sm bg-gray-50 focus:ring-3 focus:ring-blue-300 dark:bg-gray-700 dark:border-gray-600 dark:focus:ring-blue-600 dark:ring-offset-gray-800 dark:focus:ring-offset-gray-800" required />--}}
{{--                                        </div>--}}
{{--                                        <label for="remember" class="ms-2 text-sm font-medium text-gray-900 dark:text-gray-300">Remember me</label>--}}
{{--                                    </div>--}}
{{--                                </div>--}}
                            </div>
                            <button type="submit" class="text-white inline-flex items-center px-4 py-2 bg-purple-700 rounded-lg hover:bg-purple-800 focus:ring-4 focus:outline-none focus:ring-purple-300 dark:bg-purple-600 dark:hover:bg-purple-700 dark:focus:ring-purple-800">
                                Create Task
                                <box-icon name='plus' class="ms-2" color="#ffffff"></box-icon>
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        @endif

    </x-navigation>

</x-templates>
