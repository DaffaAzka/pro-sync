<x-templates>

    <x-navigation>
        <x-slot name="name">{{ $user['name'] }}</x-slot>
        <x-slot name="email">{{ $user['email'] }}</x-slot>
        <x-slot name="profile">{{ $user['profile'] }}</x-slot>

        <div class="max-w min-h-[88vh] bg-white p-4 border border-gray-200 rounded-lg shadow">
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

                                <h1 class="text-lg font-semibold">{{ $project['name'] }}</h1>
                                <hr>
                                <p>{{ $project['description'] }}</p>
                                <hr>

                                <div class="inline-flex gap-2 items-center">
                                    <box-icon name='task' color='#6b7280'></box-icon>
                                    <p class="text-sm font-medium text-gray-500">2 <span class="font-normal">Tasks</span></p>
                                </div>

                                <div class="inline-flex gap-2 items-center">
                                    <box-icon name='group' color='#6b7280'></box-icon>
                                    <p class="text-sm font-medium text-gray-500">{{ $members_count }} <span class="font-normal">Users</span></p>
                                </div>

                                <div class="inline-flex gap-2 items-center">
                                    <box-icon name='history' color='#6b7280'></box-icon>
                                    <p class="text-sm font-medium text-gray-500">3 <span class="font-normal">Logs</span></p>
                                </div>

                                <div class="inline-flex gap-2 items-center">
                                    <box-icon name='chat' color='#6b7280'></box-icon>
                                    <p class="text-sm font-medium text-gray-500">3 <span class="font-normal">Comments</span></p>
                                </div>


                                <button data-modal-target="invite-modal" data-modal-toggle="invite-modal" class="mt-3 block text-white bg-purple-700 hover:bg-purple-800 focus:ring-4 focus:outline-none focus:ring-purple-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-purple-600 dark:hover:bg-purple-700 dark:focus:ring-purple-800" type="button">
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

        <div id="invite-modal" tabindex="-1" class="fixed top-0 left-0 right-0 z-50 hidden w-full p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-[calc(100%-1rem)] max-h-full">
            <div class="relative w-full max-w-lg max-h-full">
                <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                    <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600">
                        <h3 class="text-xl font-medium text-gray-900 dark:text-white">
                            Invite Partners
                        </h3>
                        <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-hide="invite-modal">
                            <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                            </svg>
                            <span class="sr-only">Close modal</span>
                        </button>
                    </div>
                    <!-- Modal body -->
                    <div class="p-4 md:p-5 space-y-4">

                        <div class="space-y-2">
                            <label class="text-sm leading-relaxed text-gray-500 dark:text-gray-400">
                                Invite everyone, with this invite code:
                            </label>

                            <div class="w-full">
                                <div class="relative">
                                    <label for="invitation-code-copy-button" class="sr-only">Invitation Code</label>
                                    <input id="invitation-code-copy-button" type="text" class="col-span-6 bg-gray-50 border border-gray-300 text-gray-500 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-gray-400 dark:focus:ring-blue-500 dark:focus:border-blue-500" value="ABCD1234" disabled readonly>

                                    <button data-copy-to-clipboard-target="invitation-code-copy-button" data-tooltip-target="tooltip-copy-invitation-code-copy-button" class="absolute end-2 top-1/2 -translate-y-1/2 text-gray-500 dark:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-800 rounded-lg p-2 inline-flex items-center justify-center">
                                        <span id="default-icon">
                                            <svg class="w-3.5 h-3.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 18 20">
                                                <path d="M16 1h-3.278A1.992 1.992 0 0 0 11 0H7a1.993 1.993 0 0 0-1.722 1H2a2 2 0 0 0-2 2v15a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2V3a2 2 0 0 0-2-2Zm-3 14H5a1 1 0 0 1 0-2h8a1 1 0 0 1 0 2Zm0-4H5a1 1 0 0 1 0-2h8a1 1 0 1 1 0 2Zm0-5H5a1 1 0 0 1 0-2h2V2h4v2h2a1 1 0 1 1 0 2Z"/>
                                            </svg>
                                        </span>

                                        <span id="success-icon" class="hidden inline-flex items-center">
                                            <svg class="w-3.5 h-3.5 text-blue-700 dark:text-blue-500" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 16 12">
                                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1 5.917 5.724 10.5 15 1.5"/>
                                            </svg>
                                        </span>
                                    </button>

                                    <div id="tooltip-copy-invitation-code-copy-button" role="tooltip" class="absolute z-10 invisible inline-block px-3 py-2 text-sm font-medium text-white transition-opacity duration-300 bg-gray-900 rounded-lg shadow-sm opacity-0 tooltip dark:bg-gray-700">
                                        <span id="default-tooltip-message">Copy invitation code</span>
                                        <span id="success-tooltip-message" class="hidden">Copied!</span>
                                        <div class="tooltip-arrow" data-popper-arrow></div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="space-y-2">
                            <label class="text-sm leading-relaxed text-gray-500 dark:text-gray-400">
                                Or invite your partners:
                            </label>
                            <div class="overflow-y-auto max-h-[40vh]">
                                <div class="grid gap-3">
                                    @foreach($partners as $partner)
                                        <div class="max-w p-4 border border-gray-200 rounded-lg bg-gray-50 dark:bg-gray-800 dark:border-gray-700">
                                            <div class="flex items-center gap-3 md:gap-6">
                                                <img class="w-8 h-8 md:w-10 md:h-10 border-2 border-white rounded-full dark:border-gray-800" src="{{ asset('storage/profile/guest.jpg')}}" alt="member picture">
                                                <h3 class="text-base md:text-lg font-normal">{{ "@" . $partner->username }}</h3>
{{--                                                <h3 class="text-base md:text-lg font-normal">Destrivers</h3>--}}
                                                <div class="ml-auto">
                                                    <form action="#" method="get">
                                                        @csrf
                                                        <input type="hidden" name="partner-id" value="">
                                                        <button type="button" class="invite-button focus:outline-none text-white bg-purple-700 hover:bg-purple-800 focus:ring-4 focus:ring-purple-300 font-medium rounded-lg text-sm px-5 py-2.5 mb-2 dark:bg-purple-600 dark:hover:bg-purple-700 dark:focus:ring-purple-900">
                                                            Invite
                                                        </button>
                                                    </form>

                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>


        <script>
            document.addEventListener('DOMContentLoaded', function () {

                // Get elements
                const clipboardButton = document.querySelector('[data-copy-to-clipboard-target]');
                const tooltip = FlowbiteInstances.getInstance('Tooltip', 'tooltip-copy-invitation-code-copy-button');
                const $defaultIcon = document.getElementById('default-icon');
                const $successIcon = document.getElementById('success-icon');
                const $defaultTooltipMessage = document.getElementById('default-tooltip-message');
                const $successTooltipMessage = document.getElementById('success-tooltip-message');

                document.addEventListener('DOMContentLoaded', function () {
                    document.querySelectorAll('.invite-button').forEach(function (button) {
                        button.addEventListener('click', function () {
                            console.log('masuk');
                            this.disabled = true; this.textContent = 'Invited';
                            this.classList.remove('bg-purple-700', 'hover:bg-purple-800', 'dark:bg-purple-600', 'dark:hover:bg-purple-700');
                            this.classList.add('bg-gray-500', 'dark:bg-gray-400'); t
                            this.closest('form').submit();
                        });
                    });
                });

                // Event listener for clipboard button click
                clipboardButton.addEventListener('click', () => {
                    const input = document.getElementById(clipboardButton.getAttribute('data-copy-to-clipboard-target'));
                    input.select();
                    document.execCommand('copy');
                    showSuccess();

                    // Reset to default after 2 seconds
                    setTimeout(() => {
                        resetToDefault();
                    }, 2000);
                });

                // Show success state
                const showSuccess = () => {
                    $defaultIcon.classList.add('hidden');
                    $successIcon.classList.remove('hidden');
                    $defaultTooltipMessage.classList.add('hidden');
                    $successTooltipMessage.classList.remove('hidden');
                    tooltip.show();
                };

                // Reset to default state
                const resetToDefault = () => {
                    $defaultIcon.classList.remove('hidden');
                    $successIcon.classList.add('hidden');
                    $defaultTooltipMessage.classList.remove('hidden');
                    $successTooltipMessage.classList.add('hidden');
                    tooltip.hide();
                };
            });
        </script>


    </x-navigation>
</x-templates>
