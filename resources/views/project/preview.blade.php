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
                <div class="hidden p-1 md:p-2.5" id="styled-profile" role="tabpanel" aria-labelledby="profile-tab">

                    <div class="grid grid-cols-1 md:grid-cols-6 md:gap-4">

                        <div class="col-span-1 md:col-span-4 p-4 space-y-4">

{{--                            Card for the task --}}
                            <div class="md:span p-6 bg-gradient-to-r from-blue-600 to-cyan-600 border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700">
                                <h5 class="mb-2 text-2xl font-bold tracking-tight text-white truncate">Task Hub</h5>
                                <p class="mb-3 font-normal text-gray-100 line-clamp-2">Welcome to your Task Hub! Manage and organize all your tasks effortlessly in one place. Stay productive and track your progress with ease.</p>

                                <div class="flex justify-end items-center space-x-2">
                                    <a href="link-to-project" class="flex items-center px-4 py-1.5 text-sm font-medium text-gray-900 bg-white border border-gray-300 rounded-lg hover:bg-gray-100 hover:border-gray-400 dark:bg-gray-800 dark:text-white dark:border-gray-600 dark:hover:bg-gray-700 dark:hover:border-gray-600">
                                        Go to Tasks
                                        <box-icon name="right-arrow-alt" class="ml-2"></box-icon>
                                    </a>
                                </div>
                            </div>


                            <div class="grid grid-cols-1 md:grid-cols-6 md:gap-4">

{{--                            Chart for the task --}}
                                <div class="col-span-1 md:col-span-3">
                                    <div class="w-full bg-white md:border-r-2 md:border-gray-300 dark:bg-gray-800 p-4 md:p-6">
                                        <div class="flex justify-between mb-5">
                                            <div>
                                                <h5 class="leading-none text-3xl font-bold text-gray-900 dark:text-white pb-2">{{ $chart['count'] }}</h5>
                                                <p class="text-base font-normal text-gray-500 dark:text-gray-400">Tasks is complected</p>
                                            </div>
                                        </div>
                                        <div id="tooltip-chart" class="mb-3"></div>
                                    </div>
                                </div>


{{--                            Tasks overview --}}
                                <div class="col-span-1 md:col-span-3 row-start-1 md:row-auto">
                                    <div class="w-full bg-white dark:bg-gray-800 p-4 md:p-6 border-b-2 border-gray-300 md:border-0">

                                        <div class="flex justify-between mb-5">
                                            <div class="space-y-4">
                                                <div class="">
                                                    <h5 class="leading-none text-3xl font-bold text-gray-900 dark:text-white pb-2">Tasks Overview</h5>
                                                    <p class="text-base font-normal text-gray-500 dark:text-gray-400">See your contribution or upcoming tasks</p>
                                                </div>

                                                <div class="block space-y-2">

                                                    <div class="md:span p-4 bg-gradient-to-r from-red-600 to-red-900 border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700">
                                                        <p class="text-white font-medium">{{ $user['count']['important'] }} Important Tasks</p>
                                                    </div>

                                                    <div class="md:span p-4 bg-gradient-to-r from-yellow-400 to-yellow-800 border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700">
                                                        <p class="text-white font-medium">{{ $user['count']['ongoing'] }} On Going Tasks</p>
                                                    </div>

                                                    <div class="md:span p-4 bg-gradient-to-r from-green-400 to-green-800 border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700">
                                                        <p class="text-white font-medium">{{ $user['count']['completed'] }} Completed Tasks</p>
                                                    </div>

                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                </div>


                            </div>



                        </div>

                        <div class="col-span-1 md:col-span-2 p-4">
                            <div class="grid gap-3">

                                <h1 class="text-lg font-semibold">{{ $project['name'] }}</h1>
                                <hr>
                                <p>{{ $project['description'] }}</p>
                                <hr>

                                <div class="inline-flex gap-2 items-center">
                                    <box-icon name='task' color='#6b7280'></box-icon>
                                    <p class="text-sm font-medium text-gray-500">{{ $chart['count'] }} <span class="font-normal">Tasks</span></p>
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


                                @if($user['role'] == 'master')
                                    <button data-modal-target="invite-modal" data-modal-toggle="invite-modal" class="mt-3 block text-white bg-purple-700 hover:bg-purple-800 focus:ring-4 focus:outline-none focus:ring-purple-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-purple-600 dark:hover:bg-purple-700 dark:focus:ring-purple-800" type="button">
                                        Invite Partner
                                    </button>
                                @endif
                            </div>
                        </div>

                    </div>


                </div>

                <div class="hidden p-4 rounded-lg bg-gray-50 dark:bg-gray-800" id="styled-dashboard" role="tabpanel" aria-labelledby="dashboard-tab"></div>
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
                                                <h3 class="text-base md:text-lg font-normal text-ellipsis overflow-hidden">{{ "@" . $partner->username }}</h3>
{{--                                                <h3 class="text-base md:text-lg font-normal">Destrivers</h3>--}}
                                                <div class="ml-auto">
                                                    <form action="{{ route('send.project.request') }}" method="POST">
                                                        @csrf
                                                        <input type="hidden" name="receiver_username" value="{{$partner->username}}">
                                                        <input type="hidden" name="project_slug" value="{{ $project['slug'] }}">
                                                        <button type="submit" class="invite-button focus:outline-none text-white bg-purple-700 hover:bg-purple-800 focus:ring-4 focus:ring-purple-300 font-medium rounded-lg text-sm px-5 py-2.5 mb-2 dark:bg-purple-600 dark:hover:bg-purple-700 dark:focus:ring-purple-900">
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


        <script src="https://cdn.jsdelivr.net/npm/apexcharts@3.46.0/dist/apexcharts.min.js"></script>

        <script>
            document.addEventListener('DOMContentLoaded', function () {

                const clipboardButton = document.querySelector('[data-copy-to-clipboard-target]');
                const tooltip = FlowbiteInstances.getInstance('Tooltip', 'tooltip-copy-invitation-code-copy-button');
                const $defaultIcon = document.getElementById('default-icon');
                const $successIcon = document.getElementById('success-icon');
                const $defaultTooltipMessage = document.getElementById('default-tooltip-message');
                const $successTooltipMessage = document.getElementById('success-tooltip-message');

                // const getSubmit = document.querySelectorAll('.invite-button');
                // getSubmit.forEach(el => el.addEventListener('click', async event => {
                //     el.disabled = true;
                //     el.textContent = 'Invited';
                //     el.classList.remove('bg-purple-700', 'hover:bg-purple-800', 'dark:bg-purple-600', 'dark:hover:bg-purple-700');
                //     el.classList.add('bg-gray-500', 'dark:bg-gray-400');
                //
                //     const form = el.closest('form');
                //
                //     try {
                //         const response = await fetch(form.action, {
                //             method: form.method,
                //             body: new FormData(form),
                //             headers: {'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')}
                //         });
                //     } catch (e) {
                //     }
                //
                // }));

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


            // Chart javascript
            const options = {
                tooltip: {
                    enabled: true,
                    x: {
                        show: true,
                    },
                    y: {
                        show: true,
                    },
                },
                grid: {
                    show: false,
                    strokeDashArray: 4,
                    padding: {
                        left: 2,
                        right: 2,
                        top: -26
                    },
                },
                series: [
                    {
                        name: "You",
                        data: @json($chart['user']),
                        color: "#1A56DB",
                    },
                    {
                        name: "Other",
                        data: @json($chart['other']),
                        color: "#7E3BF2",
                    },
                ],
                chart: {
                    height: "100%",
                    maxWidth: "100%",
                    type: "area",
                    fontFamily: "Inter, sans-serif",
                    dropShadow: {
                        enabled: false,
                    },
                    toolbar: {
                        show: false,
                    },
                },
                legend: {
                    show: true
                },
                fill: {
                    type: "gradient",
                    gradient: {
                        opacityFrom: 0.55,
                        opacityTo: 0,
                        shade: "#1C64F2",
                        gradientToColors: ["#1C64F2"],
                    },
                },
                dataLabels: {
                    enabled: false,
                },
                stroke: {
                    width: 6,
                },
                xaxis: {
                    categories: @json($chart['month']),
                    labels: {
                        show: false,
                    },
                    axisBorder: {
                        show: false,
                    },
                    axisTicks: {
                        show: false,
                    },
                },
                yaxis: {
                    show: false,
                    labels: {
                        formatter: function (value) {
                            return value + ' complected';
                        }
                    }
                },
            }

            if (document.getElementById("tooltip-chart") && typeof ApexCharts !== 'undefined') {
                const chart = new ApexCharts(document.getElementById("tooltip-chart"), options);
                chart.render();
            }

        </script>



    </x-navigation>
</x-templates>
