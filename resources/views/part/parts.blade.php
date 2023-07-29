@include('assets.head')
@php
use Carbon\Carbon;
@endphp

<body class="m-0 font-sans text-base antialiased font-normal leading-default bg-gray-50 text-slate-500" x-data="{ isSidebarOpen: false }">
    <!--<div class="absolute w-full bg-blue-500 dark:hidden min-h-75"></div>-->
    @include('assets.sidebar')
    <main class="relative h-full max-h-screen transition-all duration-200 ease-in-out xl:ml-68 rounded-xl">
        @include('assets.navbar')
        <div class="h-full overflow-y-auto"></div>
        <!-- Button modal -->
        <div class="ml-7">
            <button class="px-4 py-2 text-white bg-green-600 rounded-md hover:bg-green-500" onclick="toggleModal('modalForm')">Create Maintenance</button>
        </div>
        <!-- end Button modal -->
        <div class="text-center text-gray-800 ">
            <!-- Modal -->
            <div class="fixed z-10 inset-0 overflow-y-auto hidden" id="modalForm">
                <div class="flex items-center justify-center min-h-screen p-4 text-center">
                    <!-- Modal Background -->
                    <div class="fixed inset-0 transition-opacity bg-gray-500 bg-opacity-75" aria-hidden="true"></div>
                    <!-- Modal Content -->
                    <div class="inline-block p-6 my-8 overflow-hidden text-left align-middle bg-white rounded-lg shadow-xl transform transition-all sm:align-middle sm:max-w-lg sm:w-full">
                        <!-- Modal Header -->
                        <div class="flex justify-between items-center mb-4">
                            <h3 class="text-lg font-semibold">Modal Title</h3>
                            <!-- "X" icon to close the modal -->
                            <button class="text-gray-200 hover:text-gray-600 focus:outline-none" onclick="toggleModal('modalForm')">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <path strokeLinecap="round" strokeLinejoin="round" strokeWidth="2" d="M6 18L18 6M6 6l12 12"></path>
                                </svg>
                            </button>
                        </div>

                        <!-- Form content here (input fields, etc.) -->
                        @include('part.create')
                        </form>
                    </div>
                </div>
            </div>
            <!-- Add this inside the <body> tag of your Blade PHP file -->
            <div class="container mx-auto mt-8">
                <div class="table-responsive">
                    <table id="dataTable" class="table-auto w-full">
                        <thead class="sticky top-0 bg-white">
                            <tr>
                                <th class="px-4 py-2 col">id</th>
                                <th class="px-4 py-2 col">nama</th>
                                <th class="px-4 py-2 col">hapus</th>
                            </tr>
                        </thead>
                        <tbody>
                            <div>
                                @foreach($parts as $item)
                                <tr>
                                    <td class="border px-4 py-2 ">{{ $item->id }}</td>
                                    <td class="border px-4 py-2 ">{{ $item->name }}</td>
                                    <td class="border px-4 py-2 ">
                                        <button>
                                            <form action="{{ route('part.destroy', $item) }}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="text-red-500">Hapus</button>
                                            </form>
                                        </button>
                                    </td>
                                </tr>
                                @endforeach
                            </div>
                            <!-- Add more rows if needed -->
                        </tbody>
                    </table>
                </div>
            </div>

        </div>
    </main>

    <script>
        function toggleModal(modalId) {
            const modal = document.getElementById(modalId);

            // If the modal is currently hidden, show it
            if (modal.classList.contains('hidden')) {
                modal.classList.remove('hidden');
            } else {
                // If the modal is currently shown, hide it
                modal.classList.add('hidden');
            }

            // Close the modal when clicking outside of it
            modal.addEventListener('click', function(event) {
                if (event.target === modal) {
                    modal.classList.add('hidden');
                }
            });

            // Close the modal when the escape key is pressed
            document.addEventListener('keydown', function(event) {
                if (event.key === 'Escape') {
                    modal.classList.add('hidden');
                }
            });
        }
    </script>


    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/alpinejs@2.8.2/dist/alpine.min.js" defer></script>

    @include('assets.script')
</body>