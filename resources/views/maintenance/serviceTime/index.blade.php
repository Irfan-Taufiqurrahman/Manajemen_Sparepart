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
        <div class="text-center text-3xl text-gray-900">
            Report Part Maintenance
        </div>
        <div class="flex flex-wrap items-center mb-4">
            <!-- Add a new row for the month filter -->
            <div class="w-full md:w-auto mb-4 md:mb-0 md:mr-4 ml-10">
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
            <div class="w-full md:w-auto md:ml-auto"></div>
            @if(auth()->user()->role->name === 'Admin' || auth()->user()->role->name === 'Pengawas')
            <div class=" pr-6">
                <button class="px-4 py-2 text-white bg-blue-600 rounded-md hover:bg-blue-500" onclick="toggleModal('modalForm')">Generate PDF</button>
            </div>
            @endif
            @include('maintenance.serviceTime.modalGeneratePdf')
        </div>
        <div class="text-center text-gray-800 ">
            <!-- Add this inside the <body> tag of your Blade PHP file -->
            <div class="container mx-auto mt-8">
                <div class="table-responsive">

                    <table id="dataTable" class="table-auto w-full">
                        <thead class="sticky top-0 bg-white">
                            <tr>
                                <th class="px-4 py-2 col">Bukti</th>
                                <th class="px-4 py-2 col">Kendaraan</th>
                                <th class="px-4 py-2 col">Part</th>
                                <th class="px-4 py-2 col">Kilometer</th>
                                <th class="px-4 py-2 col">Deskripsi</th>
                                <th class="px-4 py-2 col">Di Input Oleh</th>
                                <th class="px-4 py-2 col">Tanggal</th>
                                <th class="px-4 py-2 col">Status Service</th>
                                <th class="px-4 py-2 col">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <div>
                                <!-- Modify the loop to filter data based on week and month -->
                                @foreach($serviceTimes as $item)
                                @php
                                $monthName = Carbon::parse($item->tanggal)->format('F');
                                @endphp
                                <tr data-month="{{ $monthName }}">
                                    <td class="border px-4 py-2 flex justify-center items-center">
                                        @if (!empty ($item->file_service_evidence))
                                        <div x-data="{ open: false }" class="pr-4">
                                            <!-- Image Thumbnail -->
                                            <img src="{{ asset('storage/foto_kondisi/' . $item->file_service_evidence) }}" alt="" class="w-32 h-32 object-cover cursor-pointer" @click="open = true">
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
                                                    <img src="{{ asset('storage/foto_kondisi/' . $item->file_service_evidence) }}" alt="" class="w-full h-auto max-h-screen">
                                                    <button @click="open = false" class="mt-4 px-4 py-2 bg-gray-800 text-white rounded">Close</button>
                                                </div>
                                            </div>
                                        </div>
                                        @else
                                        <!-- Render a placeholder image or empty space if file_service_evidence is empty -->
                                        <div class="w-32 h-32 bg-white"></div>
                                        @endif
                                        <div x-data="{ open: false }">
                                            <!-- Image Thumbnail -->
                                            <img src="{{ asset('storage/foto_kondisi/' . $item->image) }}" alt="" class="w-32 h-32 object-cover cursor-pointer" @click="open = true">
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
                                                    <img src="{{ asset('storage/foto_kondisi/' . $item->image) }}" alt="tes" class="w-full h-auto max-h-screen">
                                                    <button @click="open = false" class="mt-4 px-4 py-2 bg-gray-800 text-white rounded">Close</button>
                                                </div>
                                            </div>
                                        </div>
                                    </td>

                                    <td class="border px-4 py-2 ">{{ $item->show_vehicle->name }}</td>
                                    <td class="border px-4 py-2">{{ $item->show_part->name ?? 'Oli' }}</td>
                                    <td class="border px-4 py-2">{{ $item->number ? number_format($item->number) . ' Kilometer' : '-' }}</td>
                                    <td class="border px-4 py-2 ">{{ $item->description ?? '-' }}</td>
                                    <td class="border px-4 py-2">{{ $item->createdBy }}</td>
                                    <td class="border px-4 py-2">{{ Carbon::parse($item->tanggal)->format('d F Y') }}
                                    <td class="border px-4 py-2">
                                        <div onclick="toggleModal('modalService{{ $item->id }}')" data-target="#updateModal{{ $item->id }}">
                                            @if ($item->status_service === 'no')
                                            <span class="text-red-500 text-2xl">&#10008;</span>
                                            <!-- X icon -->
                                            @elseif ($item->status_service === 'yes')
                                            <span class="text-green-500 text-2xl">&#10004;</span>
                                            <!-- Checkmark icon -->
                                            @endif
                                        </div>
                                    </td>
                                    <!-- Modal -->
                                    <div class="fixed z-10 inset-0 overflow-y-auto hidden" id="modalService{{ $item->id }}" aria-labelledby="updateModalLabel{{ $item->id }}">
                                        <div class="flex items-center justify-center min-h-screen p-4 text-center">
                                            <!-- Modal Background -->
                                            <div class="fixed inset-0 transition-opacity bg-gray-500 bg-opacity-75" aria-hidden="true"></div>
                                            <!-- Modal Content -->
                                            <div class="inline-block p-6 my-8 overflow-hidden text-left align-middle bg-white rounded-lg shadow-xl transform transition-all sm:align-middle sm:max-w-lg sm:w-full">
                                                <!-- Modal Header -->
                                                <div class="flex justify-between items-center mb-4">
                                                    <h3 class="text-lg font-semibold">Ubah Status dan Upload Nota Service</h3>
                                                    <!-- "X" icon to close the modal -->
                                                    <button class="text-gray-500 hover:text-gray-600 focus:outline-none" onclick="toggleModal('modalService{{ $item->id }}')">
                                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                                            <path strokeLinecap="round" strokeLinejoin="round" strokeWidth="2" d="M6 18L18 6M6 6l12 12"></path>
                                                        </svg>
                                                    </button>
                                                </div>

                                                <!-- Form content here (input fields, etc.) -->
                                                @include('maintenance.serviceTime.modalStatusService')
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                    <td class="border px-4 py-2 ">
                                        <form action="{{ route('service.destroy', $item) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="text-red-500">Hapus</button>
                                        </form>
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


    @include('assets.script')
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/alpinejs@2.8.2/dist/alpine.min.js" defer></script>
    <!-- Add this inside the <body> tag of your Blade PHP file -->
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
                    table.column(6).search(selectedMonth, true, false).draw(); // Use column index 5 for "Tanggal" column
                }
            });
        });
    </script>
    <!-- Add this at the bottom, just before the closing </body> tag -->

</body>