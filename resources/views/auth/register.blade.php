@include('assets.head')

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.3/Chart.min.css" />
<link rel="icon" href="{{ asset('images/Logo_PT.png') }}" />
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css">

<body>
    <div class="flex items-center min-h-screen p-6 bg-gray-50">
        <div class="flex-1 h-full max-w-4xl mx-auto overflow-hidden bg-white rounded-lg shadow-xl ">
            <div class="flex flex-col overflow-y-auto md:flex-row">
                <div class="h-32 flex items-center justify-center md:h-auto md:w-1/2">
                    <img src="img/truck.png" alt="alternative" class="object-cover" />
                    <img aria-hidden="true" class="hidden object-cover w-full h-full " src="../assets/img/create-account-office-dark.jpeg" alt="Office" />
                </div>
                <div class="flex items-center justify-center p-6 sm:p-12 md:w-1/2">
                    <div class="w-full">
                        <h1 class="mb-4 text-xl font-semibold text-gray-700">
                            Create account
                        </h1>
                        <form action="{{ route('auth.register') }}" method="POST">
                            @csrf
                            <label class="block text-sm">
                                <span class="text-gray-700">Nomor Handphone</span>
                                <input name="number_phone" id="number_phone" class="bg-gray-50 appearance-none border-2 border-gray-200 rounded w-full py-2 px-4 text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-purple-500" placeholder="08***" type="number" required />
                            </label>
                            <label class="block text-sm">
                                <span class="text-gray-700">Nama</span>
                                <input name="name" id="name" class="bg-gray-50 appearance-none border-2 border-gray-200 rounded w-full py-2 px-4 text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-purple-500" placeholder="Irfan" type="text" required />
                            </label>
                            <label class="block mt-4 text-sm">
                                <span class="text-gray-700">Password</span>
                                <input name="password" id="password" class="bg-gray-50 appearance-none border-2 border-gray-200 rounded w-full py-2 px-4 text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-purple-500" placeholder="********" type="password" required />
                            </label>
                            <label class="block mt-4 text-sm">
                                <span class="text-gray-700">
                                    Confirm password
                                </span>
                                <input name="confirm_password" id="confirm_password" class="bg-gray-50 appearance-none border-2 border-gray-200 rounded w-full py-2 px-4 text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-purple-500" placeholder="********" type="password" required />
                            </label>

                            <div class="flex mt-6 text-sm">
                                <label class="flex items-center">
                                    <input type="checkbox" class="text-purple-600 form-checkbox focus:border-purple-400 focus:outline-none focus:shadow-outline-purple" />
                                    <span class="ml-2">
                                        I agree to the
                                        <span class="underline">privacy policy</span>
                                    </span>
                                </label>
                            </div>

                            <!-- Use a submit button to handle form submission -->
                            <button type="submit" class="block w-full px-4 py-2 mt-4 text-sm font-medium leading-5 text-center text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-lg active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple">
                                Create account
                            </button>
                        </form>

                        <hr class="my-8" />

                        <p class="mt-4">
                            <a class="text-sm font-medium text-purple-600 hover:underline" href="/login">
                                Already have an account? Login
                            </a>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>