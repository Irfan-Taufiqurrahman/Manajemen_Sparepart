@include('assets.head')
@php
use Carbon\Carbon;
@endphp

<!-- Add this inside the <body> tag of your Blade PHP file -->
<div class="container mx-auto mt-8">
    <div class="table-responsive">
        <!-- Add a new row for the month filter -->
        <div class="mb-4">
            <label for="filterMonth">Filter by Month:</label>
            <select id="filterMonth">
                <option value="">All Months</option>
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


<link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/alpinejs@2.8.2/dist/alpine.min.js" defer></script>

@include('assets.script')

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
</script>