<x-admin-layout>
<style>
    .bg-white {
    padding: 12px;
    border-radius: 5px;
    }
</style>
    <div class="w-full h-screen overflow-x-hidden border-t flex flex-col">
        <main class="w-full flex-grow p-6">
            {{-- <h1 class="w-full text-3xl text-black pb-6">Categories</h1> --}}

            <div class="w-full mt-2">
                <p class="text-xl pb-3 flex items-center">
                    <i class="fas fa-list mr-3"></i> Categories
                </p>
                <button class="px-4 py-1 text-white font-light tracking-wider bg-blue-600 rounded mb-2" onclick="location.href='{{ route('admin.category.create') }}';">Add Category</button>
                <div class="bg-white overflow-auto">
                    <table class="text-left w-full border-collapse" id="album">
                        <thead>
                            <tr>
                                <th class="py-4 px-6 bg-grey-lightest font-bold uppercase text-sm text-grey-dark border-b border-grey-light">SL No.</th>
                                <th class="py-4 px-6 bg-grey-lightest font-bold uppercase text-sm text-grey-dark border-b border-grey-light">Name</th>
                                <th class="py-4 px-6 bg-grey-lightest font-bold uppercase text-sm text-grey-dark border-b border-grey-light">Added by</th>
                                <th class="py-4 px-6 bg-grey-lightest font-bold uppercase text-sm text-grey-dark border-b border-grey-light">Manage</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($categories as $key=>$category)
                            <tr class="hover:bg-grey-lighter">
                                <td class="py-4 px-6 border-b border-grey-light">{{ $key + 1 }}</td>
                                <td class="py-4 px-6 border-b border-grey-light">{{ $category->name }}</td>
                                <td class="py-4 px-6 border-b border-grey-light">{{ $category->user->name }}</td>
                                <td class="py-4 px-6 border-b border-grey-light">

                                    <button class="px-4 py-1 text-white font-light tracking-wider bg-green-600 rounded" type="button"  onclick="location.href='{{ route('admin.category.edit', $category->id) }}';">Edit</button>
                                    <form type="submit" method="POST" style="display: inline" action="{{ route('admin.category.destroy', $category->id)}}" onsubmit="return confirm('Are you sure?')">
                                        @csrf
                                        @method('DELETE')
                                    <button class="px-4 py-1 text-white font-light tracking-wider bg-red-600 rounded" type="submit">Delete</button>
                                    </form>
                                </td>
                            </tr>
                            @endforeach

                        </tbody>
                    </table>
                </div>
        </main>
    </div>
</x-admin-layout>

