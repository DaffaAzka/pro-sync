<x-templates>
    <x-navigation>
        <x-slot name="name">{{ $user['name'] }}</x-slot>
        <x-slot name="email">{{ $user['email'] }}</x-slot>
        <x-slot name="profile">{{ $user['profile'] }}</x-slot>

        <div class="max-w min-h-[88vh] bg-white p-4 border border-gray-200 rounded-lg shadow">
            <div class="grid grid-cols-1 md:grid-cols-6 md:gap-4">
                <div class="col-span-1 md:col-span-4 p-4 space-y-4">

                    <h1 class="text-2xl font-semibold">{{ $task['name'] }}</h1>
                    <p>{{ $task['description'] }}</p>

                </div>
                <div class="col-span-1 md:col-span-2 p-4">

                    <div class="grid gap-3">
                        <div class="">
                            <p>Due date: {{ $task['due_date'] }}</p>
                        </div>
                        <hr>
                        <form action="" method="post" enctype="multipart/form-data">
                            <div class="">
                                <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white" for="user_avatar">Upload file</label>
                                <input class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400" aria-describedby="user_avatar_help" id="user_avatar" type="file">
                            </div>
                            <button data-modal-target="invite-modal" data-modal-toggle="invite-modal" class="mt-3 w-full block text-white bg-green-700 hover:bg-green-800 focus:ring-4 focus:outline-none focus:ring-green-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-green-600 dark:hover:bg-green-700 dark:focus:ring-green-800" type="button">
                                Task Complete
                            </button>
                        </form>
                    </div>

                </div>
            </div>
        </div>
    </x-navigation>
</x-templates>
