<form method="POST" action="{{ route('maintenance.post') }}" enctype="multipart/form-data">
    @csrf
    <div class="pt-4">
        <label for="name" class="text-gray-800 text-sm font-bold leading-tight tracking-normal">Part </label>
    </div>
    <select name="part_id" class="form-control bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" id="part_id" required>
        @foreach($parts as $part)
        <option value="{{ $part->id }}">
            {{ $part->name }} <!-- use the first fillable attribute -->
        </option>
        @endforeach
    </select>
    <div class="pt-4">
        <label for="email2" class="text-gray-800 text-sm font-bold leading-tight tracking-normal">Vehicle </label>
    </div>
    <select id="vehicle_id" name="vehicle_id" class="form-control bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required>
        @foreach($vehicles as $vehicle)
        <option value="{{ $vehicle->id }}">
            {{ $vehicle->name }}
        </option>
        @endforeach
    </select>
    <div class="pt-4">
        <label for="email2" class="text-gray-800 text-sm font-bold leading-tight tracking-normal">Quality </label>
    </div>
    <select name="quality_id" class="form-control bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" id="quality_id" required>
        @foreach($qualities as $quality)
        <option value="{{ $quality->id }}">
            {{ $quality->name }} <!-- use the first fillable attribute -->
        </option>
        @endforeach
    </select>
    <div class="md:flex md:items-center mb-6 mt-4">
        <div class="md:w-3/3">
            <label class="block text-gray-500 font-bold md:text-right mb-1 md:mb-0 pr-4" for="inline-password">
                Deskripsi
            </label>
        </div>
        <div class="md:w-2/3">
            <input class="bg-gray-200 appearance-none border-2 border-gray-200 rounded w-full py-2 px-4 text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-purple-500" id="description" name="description" type="text" placeholder="Barang Waktu Ganti">
        </div>
    </div>
    <div class="md:flex md:items-center mb-6">
        <div class="md:w-3/3">
            <label class="block text-gray-500 font-bold md:text-right mb-1 md:mb-0 pr-4" for="inline-password">
                Foto Bukti
            </label>
        </div>
        <div class="md:w-2/3">
            <input class="bg-gray-200 appearance-none border-2 border-gray-200 rounded w-full py-2 px-4 text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-purple-500" type="file" id="file_image" name="file_image" accept="image/*" required>
        </div>
    </div>
    <div class="flex items-center justify-start w-full">
        <button class="focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-700 transition duration-150 ease-in-out hover:bg-green-500 bg-green-700 rounded text-white px-8 py-2 text-sm" type="submit">Submit</button>
        <button type="button" class="focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-700 transition duration-150 ease-in-out hover:bg-indigo-600 bg-indigo-700 rounded text-white px-8 py-2 text-sm ml-5" onclick="toggleModal('modalForm')">Cancel</button>
    </div>
    <!-- Add more form fields as needed -->
    <div class="mt-4">

    </div>
</form>