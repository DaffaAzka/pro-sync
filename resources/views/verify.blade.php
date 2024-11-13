<x-templates>


    <div class="h-screen flex items-center justify-center">
        <div class="w-11/12 max-w-96 p-6 pb-8 bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700">

            <h5 class="text-xl font-semibold tracking-tight text-gray-900 dark:text-white text-center">2-Step Verification</h5>

            @if (session('error'))
                <div class="flex items-center p-4 my-4 text-sm text-red-800 rounded-lg bg-red-50 dark:bg-gray-800 dark:text-red-400" role="alert">
                    <svg class="flex-shrink-0 inline w-4 h-4 me-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                        <path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z"/>
                    </svg>
                    <span class="sr-only">Info</span>
                    <div>
                        {{session('error')}}
                    </div>
                </div>
            @endif

            <p class="text-sm text-gray-600 dark:text-gray-300 my-5">To enhance the security of your account, verification code has been sent to {{session('email')}}</p>

            <form class="max-w-md mx-auto my-3" method="POST" action="{{route('verify.code')}}">
                @csrf
                <input type="hidden" name="email" value="{{ session('email') }}">
                <div class="relative z-0 w-full mb-3 group">
                    <input type="text" name="code" id="token" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required placeholder="Verification Code"/>
                </div>

                <button type="submit" class="inline-flex items-center px-3 py-2 text-sm font-medium text-center text-white bg-green-700 rounded-lg hover:bg-green-800 focus:ring-4 focus:outline-none focus:ring-green-300 dark:bg-green-600 dark:hover:bg-green-700 dark:focus:ring-green-800">
                    Verify code
                    <box-icon name='right-arrow' type='solid' class="w-3.5 h-4 ms-2" color="#ffffff"></box-icon>
                </button>
            </form>
        </div>
    </div>


</x-templates>

