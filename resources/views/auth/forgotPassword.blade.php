@include('assets.head')

<body>
    <div class="flex items-center min-h-screen p-6 bg-gray-50 dark:bg-gray-900">
        <div class="flex-1 h-full max-w-4xl mx-auto overflow-hidden bg-white rounded-lg shadow-xl dark:bg-gray-800">
            <div class="flex flex-col overflow-y-auto md:flex-row">
                <div class="h-32 flex items-center justify-center md:h-auto md:w-1/2">
                    <img src="images/Login-image.png" alt="alternative" class="object-cover dark:hidden" />
                    <img aria-hidden="true" class="hidden object-cover w-full h-full dark:block" src="../assets/img/login-office-dark.jpeg" alt="Office" />
                </div>
                <div class="flex items-center justify-center p-6 sm:p-12 md:w-1/2">
                    <div class="w-full">
                        <h1 class="mb-4 text-xl font-semibold text-gray-700 dark:text-gray-200">
                            Forgot Password
                        </h1>
                        <form method="POST" action="{{ route('password.reset') }}">
                            @csrf
                            <div>
                                <span for="phone_number">Phone Number:</span>

                                <input class="bg-gray-100 appearance-none border-2 border-gray-200 rounded w-full py-2 px-4 text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-purple-500" type="phone_number" name="phone_number" id="phone_number" placeholder="+62821********" required>
                                @error('phone_number')
                                <span>{{ $message }}</span>
                                @enderror
                            </div>
                            <button class="block w-full px-4 py-2 mt-4 text-sm font-medium leading-5 text-center text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-lg active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple" type="submit">Kirim link reset password</button>
                        </form>
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