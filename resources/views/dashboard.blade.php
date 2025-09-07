<x-app-layout>
    <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
        <div class="p-4 mb-4 w-full text-white-400 rounded-lg flex justify-between items-center dark:bg-gray-800">
            <p class="text-white text-center text-xl">Notes List</p>
            <a href="{{ route('item.create') }}"
                class="focus:outline-none text-white bg-purple-700 hover:bg-purple-800 focus:ring-4 focus:ring-purple-300 font-medium rounded-lg text-sm px-5 py-2.5 dark:bg-purple-600 dark:hover:bg-purple-700 dark:focus:ring-purple-900"" type="
                button">Add</a>
        </div>
        <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                <tr>
                    <th scope="col" class="px-6 py-3">
                        Title
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Description
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Created At
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Action
                    </th>
                </tr>
            </thead>
            <tbody>
                @if (isset($notesItem) && count($notesItem) > 0)
                @foreach ($notesItem as $key => $data)
                <tr
                    class="odd:bg-white odd:dark:bg-gray-900 even:bg-gray-50 even:dark:bg-gray-800 border-b dark:border-gray-700 border-gray-200">
                    <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                        {{ $data->title }}
                    </th>
                    <td class="px-6 py-4">
                        {{$data->description}}
                    </td>
                    <td class="px-6 py-4">
                        {{ date('d-m-Y',strtotime($data->created_at))}}
                    </td>
                    <td class="px-6 py-4 flex space-x-2">
                        <a href="{{ route('item.edit', $data->id) }}"
                            class="font-medium px-3 py-1 bg-green-500 text-white rounded">Edit</a>
                        <a href="{{ route('item.destroy', $data->id) }}" 
                           class="px-3 py-1 bg-red-600 text-white rounded"
                           onclick="return confirm('Are you sure you want to delete this note?');">
                           Delete
                        </a>
                    </td>
                </tr>
                @endforeach
                @else
                <tr>
                    <td colspan="4" class="text-center">No Data Found</td>
                </tr>
                @endif
            </tbody>
        </table>
        <nav class="pt-4" aria-label="Table navigation">
            <div class="mt-4">
                {{ $notesItem->links() }}
            </div>
        </nav>

    </div>

</x-app-layout>