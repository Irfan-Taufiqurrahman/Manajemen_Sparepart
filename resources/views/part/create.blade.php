<form method="POST" action="{{ route('part.post') }}" enctype="multipart/form-data">
    @csrf
    <div class="md:flex md:items-center mb-6 mt-4">
        <div class="md:w-3/3">
            <label class="block text-gray-500 font-bold md:text-right mb-1 md:mb-0 pr-4" for="inline-password">
                nama part
            </label>
        </div>
        <div class="md:w-2/3">
            <input class="bg-gray-200 appearance-none border-2 border-gray-200 rounded w-full py-2 px-4 text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-purple-500" id="name" name="name" type="text" placeholder="jenis part" required>
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