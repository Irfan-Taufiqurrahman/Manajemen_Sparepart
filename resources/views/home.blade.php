@include('assets.head')

<body class="m-0 font-sans text-base antialiased font-normal leading-default bg-gray-50 text-slate-500" x-data="{ isSidebarOpen: false }">
    @include('assets.sidebar')
    <main class="relative h-full max-h-screen transition-all duration-200 ease-in-out xl:ml-68 rounded-xl">
        @include('assets.navbar')
        <div class="h-full overflow-y-auto"></div>

        <!-- end cards -->
        <div class="text-center text-gray-800">

            <!-- Add this inside the <body> tag of your Blade PHP file -->
            <div class="container mx-auto mt-8">
                <table id="dataTable" class="table-auto w-full">
                    <thead>
                        <tr>
                            <th class="px-4 py-2">Nama tipe</th>
                            <th class="px-4 py-2">Judul Konten</th>

                            <th class="px-4 py-2">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($users as $user)
                        <tr>
                            <td class="border px-4 py-2 ">{{ $user->name }}</td>
                            <td class="border px-4 py-2 ">{{ $user->role->name }}</td>

                            <td class="border px-4 py-2">
                                <button>
                                    <form action="{{ route('delete.user', $user) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-red-500">Hapus</button>
                                    </form>
                                </button>

                            </td>
                        </tr>

                        @endforeach
                        <!-- Add more rows if needed -->
                    </tbody>
                </table>
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