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
        <!-- cards -->
        <div class="w-full px-6 py-6 mx-auto">

            <!-- row 1 -->
            <div class="flex flex-wrap -mx-3">
                <!-- card1 -->
                <div class="w-full max-w-full px-3 mb-6 sm:w-1/2 sm:flex-none xl:mb-0 xl:w-1/4">
                    <div class="relative flex flex-col min-w-0 break-words bg-white shadow-xl">
                        <div class="flex-auto p-4">
                            <div class="flex flex-row -mx-3">
                                <div class="flex-none w-2/3 max-w-full px-3">
                                    <div>
                                        <p class="mb-0 font-sans text-sm font-semibold leading-normal">Jenis Part</p>
                                        <h5 class="mb-2 font-bold pt-1">{{ $totalParts }}</h5>

                                    </div>
                                </div>
                                <div class="px-3 text-right basis-1/3">
                                    <div class="inline-block w-12 h-12 text-center rounded-circle bg-gradient-to-tl from-blue-500 to-violet-500">
                                        <i class="ni leading-none ni-money-coins text-lg relative top-3.5 text-white"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- card2 -->
                <div class="w-full max-w-full px-3 mb-6 sm:w-1/2 sm:flex-none xl:mb-0 xl:w-1/4">
                    <div class="relative flex flex-col min-w-0 break-words bg-white shadow-xl rounded-2xl bg-clip-border">
                        <div class="flex-auto p-4">
                            <div class="flex flex-row -mx-3">
                                <div class="flex-none w-2/3 max-w-full px-3">
                                    <div>
                                        <p class="mb-0 font-sans text-sm font-semibold leading-normal">Jenis Kendaraan</p>
                                        <h5 class="mb-2 font-bold pt-1">{{ $totalVehicle }}</h5>

                                    </div>
                                </div>
                                <div class="px-3 text-right basis-1/3">
                                    <div class="inline-block w-12 h-12 text-center rounded-circle bg-gradient-to-tl from-red-600 to-orange-600">
                                        <i class="ni leading-none ni-world text-lg relative top-3.5 text-white"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- card3 -->
                <div class="w-full max-w-full px-3 mb-6 sm:w-1/2 sm:flex-none xl:mb-0 xl:w-2/6">
                    <div class="relative flex flex-col min-w-0 break-words bg-white shadow-xl rounded-2xl bg-clip-border">
                        <div class="flex-auto p-4">
                            <div class="flex flex-row -mx-3">
                                <div class="flex-none w-3/3 max-w-full px-3">
                                    <div>
                                        <p class="mb-0 font-sans text-sm font-semibold leading-normal">Barang perlu servis</p>
                                        @php
                                        $serviceTimesWithNumber = $serviceTimes->filter(function ($item) {
                                        return !empty($item->number) && !is_null($item->number);
                                        });
                                        @endphp
                                        @if($serviceTimesWithNumber->count() > 0)
                                        <ul class="max-w-md space-y-1 text-gray-800 list-inside dark:text-gray-400">
                                            @foreach($serviceTimesWithNumber as $item)
                                            <li class="list-disc">{{ $item->show_vehicle->name }} - waktunya ganti oli atau servis rutin</li>
                                            @endforeach
                                        </ul>
                                        @else
                                        <p class="text-sm text-gray-800 pt-1">Tidak ada</p>
                                        @endif
                                        @if(count($barangRusak) > 0)
                                        <ul class="max-w-md space-y-1 text-gray-800 list-inside dark:text-gray-400">
                                            @foreach($barangRusak as $item)
                                            <li class="list-disc">{{ $item->show_vehicle->name }} - {{ $item->show_part->name }}</li>
                                            @endforeach
                                        </ul>
                                        @else
                                        <p class="text-sm text-gray-800 pt-1">Tidak ada</p>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- card4 -->
            </div>

        </div>
        <!-- end cards -->
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
                            <h3 class="text-lg font-semibold">Create Maintenance</h3>
                            <!-- "X" icon to close the modal -->
                            <button class="text-gray-500 hover:text-gray-600 focus:outline-none" onclick="toggleModal('modalForm')">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <path strokeLinecap="round" strokeLinejoin="round" strokeWidth="2" d="M6 18L18 6M6 6l12 12"></path>
                                </svg>
                            </button>
                        </div>

                        <!-- Form content here (input fields, etc.) -->
                        @include('maintenance.create')

                        </form>
                    </div>
                </div>
            </div>
            <!-- Add this inside the <body> tag of your Blade PHP file -->
            <div class="container mx-auto mt-8">
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
                                    <td class="border px-4 py-2 ">{{ $item->description ?? '-' }}</td>
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
</body>