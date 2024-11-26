<x-templates>

    <x-navigation>
        <x-slot name="name">{{ $user['name'] }}</x-slot>
        <x-slot name="email">{{ $user['email'] }}</x-slot>
        <x-slot name="profile">{{ $user['profile'] }}</x-slot>
        <div class="grid grid-cols-1 gap-4 md:grid-cols-2">

            @if($project)
                <div class="md:span p-6 bg-gradient-to-r from-purple-500 to-indigo-600 border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700">
                    <h5 class="mb-2 text-2xl font-bold tracking-tight text-white truncate">{{ $project['name'] }}</h5>
                    <p class="mb-3 font-normal text-gray-100 line-clamp-2">Your project deadline is approaching on {{ $project['end_date'] }}. Make sure all tasks are completed and issues are resolved promptly.</p>

                    <div class="flex items-center space-x-2">
                        <a href="{{ route('show.project', ['id' => $project['slug']]) }}" class="flex items-center px-4 py-1.5 text-sm font-medium text-gray-900 bg-white border border-gray-300 rounded-lg hover:bg-gray-100 hover:border-gray-400 dark:bg-gray-800 dark:text-white dark:border-gray-600 dark:hover:bg-gray-700 dark:hover:border-gray-600">
                            Go to project
                            <box-icon name="right-arrow-alt" class="ml-2"></box-icon>
                        </a>

                        <div class="flex items-center -space-x-4 rtl:space-x-reverse">
                            @for ($i = 0; $i < count($avatars); $i++)
                                @if($i < 2)
                                    <img class="w-8 h-8 border-2 border-white rounded-full dark:border-gray-800" src="{{ asset('storage/profile/' . $avatars[$i]) }}" alt="member picture">
                                @endif
                            @endfor

                            @if(count($avatars) > 2)
                                <a class="flex items-center justify-center w-8 h-8 text-xs font-medium text-white bg-gray-700 border-2 border-white rounded-full hover:bg-gray-600 dark:border-gray-800" href="#">{{ count($avatars) - 2 }}</a>
                            @endif
                        </div>
                    </div>
                </div>
            @endif

            <div class="p-6 bg-gradient-to-r from-red-500 to-pink-600 border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700">
                <h5 class="mb-2 text-2xl font-bold tracking-tight text-white truncate">Initiated New Project</h5>
                <p class="mb-3 font-normal text-gray-100 line-clamp-2">Start your new project and get your team members on board. Set clear goals, roles, and deadlines.</p>

                <button data-modal-target="project-modal" data-modal-toggle="project-modal" class="inline-flex items-center px-4 py-1.5 text-sm font-medium text-gray-900 bg-white border border-gray-300 rounded-lg hover:bg-gray-100 hover:border-gray-400 dark:bg-gray-800 dark:text-white dark:border-gray-600 dark:hover:bg-gray-700 dark:hover:border-gray-600">
                    Create project
                    <box-icon name='right-arrow-alt' class="ms-2"></box-icon>
                </button>
            </div>

        </div>


        <div id="project-modal" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
            <div class="relative p-4 w-full max-w-md max-h-full mt-14 md:mt-6">
                <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                    <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600">
                        <h3 class="text-lg font-semibold text-gray-900 dark:text-white">
                            New Project
                        </h3>
                        <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-toggle="project-modal">
                            <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                            </svg>
                            <span class="sr-only">Close modal</span>
                        </button>
                    </div>

                    <form class="p-4 md:p-5  max-h-[calc(100vh-15rem)] overflow-y-auto" method="post" action="{{ route('store.project') }}">
                        @csrf
                        <div class="grid gap-4 mb-4 grid-cols-2">
                            <div class="col-span-2">
                                <label for="name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Project Name</label>
                                <input type="text" name="name" id="name" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="Type project name" required>
                            </div>

                            <div class="col-span-2">
                                <label for="description" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Project Description</label>
                                <textarea name="description" id="description" rows="4" class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Write project description here" required></textarea>
                            </div>

                            <div class="col-span-2 sm:col-span-1">
                                <label for="start_date" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Initiation Date</label>
                                <input type="date" value="<?= date('Y-m-d');?>" min="<?= date('Y-m-d');?>" name="start_date" id="start_date" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="$2999" required="">
                            </div>
                            <div class="col-span-2 sm:col-span-1">
                                <label for="end_date" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Conclusion Date</label>
                                <input type="date" min="<?= date('Y-m-d');?>" name="end_date" id="end_date" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="$2999" required="">
                            </div>


                            <div class="col-span-2">
                                <label for="status" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Status</label>
                                <select id="status" name="status" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" required>
                                    <option selected disabled>Select Status</option>
                                    <option value="ongoing">On Going</option>
                                    <option value="completed">Completed</option>
                                </select>
                            </div>

                        </div>
                        <button type="submit" class="text-white inline-flex items-center px-4 py-2 bg-purple-700 rounded-lg hover:bg-purple-800 focus:ring-4 focus:outline-none focus:ring-purple-300 dark:bg-purple-600 dark:hover:bg-purple-700 dark:focus:ring-purple-800">
                            Start project
                            <box-icon name='plus' class="ms-2" color="#ffffff"></box-icon>
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </x-navigation>
</x-templates>
