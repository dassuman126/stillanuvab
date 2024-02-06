<x-admin-layout>
    <style>
        .bg-white {
        padding: 12px;
        border-radius: 5px;
        }
    </style>
    <div class="w-full h-screen overflow-x-hidden border-t flex flex-col">
        <main class="w-full flex-grow p-6">
           
            <div class="w-full mt-2">
                <p class="text-xl pb-3 flex items-center">
                    <i class="fas fa-list mr-3"></i> Album List
                </p>
                @can('create', 'App\Models\Post')
                    <button class="px-4 py-1 text-white font-light tracking-wider bg-blue-600 rounded mb-2"
                        onclick="location.href='{{ route('admin.album.create') }}';">Add Album</button>
                @endcan
                <div class="bg-white overflow-auto">
                    <table class="text-left w-full border-collapse" id="album">
                        <thead>
                            <tr>
                                <th
                                    class="py-4 px-6 bg-grey-lightest font-bold uppercase text-sm text-grey-dark border-b border-grey-light">
                                    Sl No</th>
                                <th
                                    class="py-4 px-6 bg-grey-lightest font-bold uppercase text-sm text-grey-dark border-b border-grey-light">
                                    Title</th>
                                <th
                                    class="py-4 px-6 bg-grey-lightest font-bold uppercase text-sm text-grey-dark border-b border-grey-light">
                                    Category</th>
                                <th
                                    class="py-4 px-6 bg-grey-lightest font-bold uppercase text-sm text-grey-dark border-b border-grey-light">
                                    Photo</th>
                                 {{-- <th
                                    class="py-4 px-6 bg-grey-lightest font-bold uppercase text-sm text-grey-dark border-b border-grey-light">
                                    Photos count</th>
                                <th
                                    class="py-4 px-6 bg-grey-lightest font-bold uppercase text-sm text-grey-dark border-b border-grey-light">
                                    Comments count</th> --}}
                                <th
                                    class="py-4 px-6 bg-grey-lightest font-bold uppercase text-sm text-grey-dark border-b border-grey-light">
                                    Manage</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($posts as $key => $post)
                                <tr class="hover:bg-grey-lighter">
                                    <td class="py-4 px-6 border-b border-grey-light">{{ $key + 1 }}</td>
                                    <td class="py-4 px-6 border-b border-grey-light">{{ $post->title }}</td>
                                    <td class="py-4 px-6 border-b border-grey-light">{{ $post->category->name }}</td>
                                    <td class="py-4 px-6 border-b border-grey-light"><img id="previewImage" src="{{ asset("storage/$post->image") }}" alt="Image Preview" style="width:224px;"></td>
                                    <td class="py-4 px-6 border-b border-grey-light">
                                        @can('update', $post)
                                            <button
                                                class="px-4 py-1 text-white font-light tracking-wider bg-green-600 rounded"
                                                type="button"
                                                onclick="location.href='{{ route('admin.album.edit', $post->id) }}';">Edit</button>
                                        @endcan
                                        @can('delete', $post)
                                            <form type="submit" method="POST" style="display: inline"
                                                action="{{ route('admin.album.destroy', $post->id) }}"
                                                onsubmit="return confirm('Are you sure?')">
                                                @csrf
                                                @method('DELETE')
                                                <button
                                                    class="px-4 py-1 text-white font-light tracking-wider bg-red-600 rounded"
                                                    type="submit">Delete</button>
                                            </form>
                                        @endcan


                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                {!! $posts->links() !!}
        </main>
    </div>
</x-admin-layout>
