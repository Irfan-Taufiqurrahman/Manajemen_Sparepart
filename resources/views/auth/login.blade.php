@include('assets.head')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.3/Chart.min.css" />
<link rel="icon" href="{{ asset('images/Logo_PT.png') }}" />
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css">

<body>
    <div class="flex items-center min-h-screen p-6 bg-gray-50 dark:bg-gray-900">
        <div class="flex-1 h-full max-w-4xl mx-auto overflow-hidden bg-white rounded-lg shadow-xl dark:bg-gray-800">
            <div class="flex flex-col overflow-y-auto md:flex-row">
                <div class="h-32 flex items-center justify-center md:h-auto md:w-1/2">
                    <img src="img/login-image.png" alt="alternative" class="object-cover dark:hidden" />
                    <img aria-hidden="true" class="hidden object-cover w-full h-full dark:block" src="../assets/img/login-office-dark.jpeg" alt="Office" />
                </div>
                <div class="flex items-center justify-center p-6 sm:p-12 md:w-1/2">
                    <div class="w-full">
                        <h1 class="mb-4 text-xl font-semibold text-gray-700 dark:text-gray-200">
                            Login
                        </h1>
                        <form method="POST" action="{{ route('auth.login') }}">
                            @csrf
                            <label class="block text-sm">
                                <span class="text-gray-700 dark:text-gray-400">Nomor Handphone</span>
                                <input name="number_phone" id="number_phone" class="block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input" placeholder="08***" required />
                            </label>
                            <label class="block mt-4 text-sm">
                                <span class="text-gray-700 dark:text-gray-400">Password</span>
                                <input name="password" id="password" class="block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input" placeholder="***************" type="password" required />
                            </label>
                            <!-- Use button instead of anchor -->
                            <button type="submit" class="block w-full px-4 py-2 mt-4 text-sm font-medium leading-5 text-center text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-lg active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple">
                                Log in
                            </button>

                        </form>
                        <hr class="my-8" />

                        <p class="mt-4">
                            <a class="text-sm font-medium text-purple-600 dark:text-purple-400 hover:underline" href="{{ route('reset.Index') }}">
                                Forgot your password?
                            </a>
                        </p>
                        <p class="mt-1">
                            <a class="text-sm font-medium text-purple-600 dark:text-purple-400 hover:underline" href="{{ route('auth.registerIndex') }}">
                                Create account
                            </a>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>