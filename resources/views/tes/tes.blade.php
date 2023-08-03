@include('assets.head')
@php
use Carbon\Carbon;
@endphp

<!-- Add this inside the <body> tag of your Blade PHP file -->
<div class="container mx-auto mt-8">
    <form action="{{ route('view.pdf') }}" method="post" target="__blank">
        @csrf
        <div>
            <label for="from">From:</label>
            <input type="date" name="from" required>

            <label for="to">To:</label>
            <input type="date" name="to" required>

            <button type="submit" class="inline-block rounded-full border-2 border-primary-100 px-6 pb-[6px] pt-2 text-xs font-medium uppercase leading-normal text-primary-700 transition duration-150 ease-in-out hover:border-primary-accent-100 hover:bg-neutral-500 hover:bg-opacity-10 focus:border-primary-accent-100 focus:outline-none focus:ring-0 active:border-primary-accent-200 dark:text-primary-100 dark:hover:bg-neutral-100 dark:hover:bg-opacity-10" data-te-ripple-init>
                <div class="flex justify-between content-center">
                    <div class="pr-2">
                        <svg xlmns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                            <path stroke-linecap="round" stroke-linejoin="round" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4" />
                        </svg>
                    </div>
                    <div>
                        View PDF
                    </div>
                </div>
            </button>
        </div>
    </form>

    <div class="table-responsive">
        <!-- Add a new row for the month filter -->
        <div class="mb-4 grid grid-cols-2 md:grid-cols-3 xl:grid-cols-6 gap-2 mt-4">
            <label for="filterMonth" class="text-base">Filter Berdasarkan bulan:</label>
            <select id="filterMonth" class="px-4 py-3 w-full rounded-md bg-gray-50 border-transparent border border-gray-300 focus:border-gray-500 focus:bg-white focus:ring-0 text-sm">
                <option value="" onclick="clearMonthFilter()">Bulan</option>
                <option value="January">Januari</option>
                <option value="February">Februari</option>
                <option value="March">Maret</option>
                <option value="April">April</option>
                <option value="Mei">Mei</option>
                <option value="June">Juni</option>
                <option value="July">Juli</option>
                <option value="August">Agustus</option>
                <option value="September">September</option>
                <option value="October">Oktober</option>
                <option value="November">November</option>
                <option value="December">Desember</option>
                <!-- Add other months as needed -->
            </select>
        </div>

        <table id="dataTable" class="table-auto w-full">
            <thead class="sticky top-0 bg-white">
                <tr>
                    <th class="px-4 py-2 col">Gambar Bukti</th>
                    <th class="px-4 py-2 col">Kendaraan</th>
                    <th class="px-4 py-2 col">Part</th>
                    <th class="px-4 py-2 col filter-quality">Quality</th>
                    <th class="px-4 py-2 col">Deskripsi</th>
                    <th class="px-4 py-2 col">Dibuat Oleh</th>
                    <th class="px-4 py-2 col">Tanggal</th>
                    <th class="px-4 py-2 col">Aksi</th>
                </tr>
            </thead>
            <tbody>
                <div>
                    @foreach($maintenance as $item)
                    <tr>
                        <td class="border px-4 py-2 flex justify-center items-center">
                            <div x-data="{ open: false }">
                                <!-- Image Thumbnail -->
                                <img src="{{ asset('storage/foto_kondisi/' . $item->file_image) }}" alt="tes" class="w-32 h-32 object-cover cursor-pointer" @click="open = true">
                                <!-- Modal -->
                                <div x-show="open" @click.away="open = false" @keydown.escape.window="open = false" class="fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-50">
                                    <div class="bg-white rounded-lg p-4 shadow-lg max-w-xl mx-auto">
                                        <div class="flex justify-end">
                                            <button @click="open = false" class="text-gray-600 hover:text-gray-800 focus:outline-none">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                                                </svg>
                                            </button>
                                        </div>
                                        <img src="{{ asset('storage/foto_kondisi/' . $item->file_image) }}" alt="tes" class="w-full h-auto max-h-screen">
                                        <button @click="open = false" class="mt-4 px-4 py-2 bg-gray-800 text-white rounded">Close</button>
                                    </div>
                                </div>
                            </div>
                        </td>

                        <td class="border px-4 py-2 ">{{ $item->show_vehicle->name }}</td>
                        <td class="border px-4 py-2 ">{{ $item->show_part->name }}</td>
                        <td class="border px-4 py-2 ">{{ $item->show_quality->name }}</td>
                        <td class="border px-4 py-2 ">{{ $item->description }}</td>
                        <td class="border px-4 py-2">{{ $item->createdBy }}</td>
                        <td class="border px-4 py-2">{{ Carbon::parse($item->tanggal)->format('d F Y') }}
                        </td>
                        <td class="border px-4 py-2 ">
                            <button>
                                <form action="{{ route('maintenance.destroy', $item) }}" method="POST">
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

<!-- Add the required DataTables.net script -->



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



@include('assets.script')
<link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/alpinejs@2.8.2/dist/alpine.min.js" defer></script>
<script>
    // Initialize the DataTable
    $(document).ready(function() {
        var table = $('#dataTable').DataTable();

        // Add event listener to the month filter dropdown
        $('#filterMonth').on('change', function() {
            var selectedMonth = $(this).val();

            // Clear any previous search filter
            table.search('').draw();

            // Apply the new month filter
            if (selectedMonth) {
                table.column(6).search(selectedMonth, true, false).draw();
            }
        });
    });
    // Add a function to clear the month filter and show all data
    function clearMonthFilter() {
        var table = $('#dataTable').DataTable();
        $('#filterMonth').val(''); // Reset the filter dropdown to its initial state
        table.search('').draw(); // Clear any existing search filter
    }
</script>