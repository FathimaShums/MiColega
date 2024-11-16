<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                @if(auth()->user()->hasRole('admin'))
                    <h2>Welcome Admin</h2>
                    {{-- <div>
                        <h3>All Proof Documents:</h3>
                        <div>
                            <h3>Pending Proof Documents:</h3>
                            @foreach ($proofDocuments->where('status', 'pending') as $document)
                            <!-- Display pending proof documents -->
                        @endforeach
                        </div>
                    </div> --}}
                    

                    
            </div>
        </div>
    </div>
    
    {{-- @if (isset($proofDocuments) && $proofDocuments->count() > 0)
    
    <div>
        <h3>Pending Proof Documents:</h3>
        @foreach ($proofDocuments as $document)
            <div class="mb-4 p-4 border rounded">
                <p><strong>Skill:</strong> {{ $document->skill->name }}</p>
                <p><strong>User:</strong> {{ $document->user->name }}</p>
                <p><strong>Document:</strong>
                    <a href="{{ Storage::url($document->document_path) }}" target="_blank">View Document</a>
                </p>
                <form action="{{ route('admin.proof.update', $document->id) }}" method="POST" class="mt-2">
                    @csrf
                    @method('PUT')
                    <select name="status" class="border rounded p-2">
                        <option value="approved">Approve</option>
                        <option value="rejected">Reject</option>
                    </select>
                    <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">Update Status</button>
                </form>
            </div>
        @endforeach
    </div>
@else
    <p>No pending proof documents.</p>
@endif --}}

                        @if (session('success'))
    <div class="mb-4 p-4 text-green-700 bg-green-100 rounded">
        {{ session('success') }}
    </div>
@endif
                    </div>
                    <!--delete a particular skill-->
                    <div class="mt-6">
                        <h3 class="text-lg font-semibold mb-2">Available Skills:</h3>
                        <table class="min-w-full bg-white border">
                            <thead>
                                <tr>
                                    <th class="px-4 py-2 border">Name</th>
                                    <th class="px-4 py-2 border">Description</th>
                                    <th class="px-4 py-2 border">Category</th>
                                    <th class="px-4 py-2 border">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($skills as $skill)
                                    <tr>
                                        <td class="px-4 py-2 border">{{ $skill->name }}</td>
                                        <td class="px-4 py-2 border">{{ $skill->description }}</td>
                                        <td class="px-4 py-2 border">{{ $skill->category->category_name }}</td>
                                        <td class="px-4 py-2 border">
                                            <form method="POST" action="{{ route('admin.skills.destroy', $skill->id) }}">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="px-4 py-2   rounded-md">Delete</button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <!-- Form to Add a New Skill -->
                <h3>Add a New skill</h3>
                <form method="POST" action="{{ route('admin.skills.store') }}">
                    @csrf
                    <div class="mb-4">
                        <label for="name" class="block text-gray-700">Skill Name:</label>
                        <input type="text" name="name" id="name" class="w-full border-gray-300 rounded-md" required>
                    </div>

                    <div class="mb-4">
                        <label for="description" class="block text-gray-700">Description:</label>
                        <textarea name="description" id="description" class="w-full border-gray-300 rounded-md" required></textarea>
                    </div>

                    <div class="mb-4">
                        <label for="category_id" class="block text-gray-700">Category:</label>
                        @foreach($categories as $category)
                            <div>
                                <input type="radio" name="category_id" value="{{ $category->id }}" required>
                                <label>{{ $category->category_name }}</label>
                            </div>
                        @endforeach
                    </div>

                    <button type="submit" class="px-4 py-2 bg-blue-500  rounded-md">Add Skill</button>
                </form>

                 

                @else
                    <h1>Recommended Tutors for you:</h1>
                @endif
            </div>
        </div>
    </div>
</x-app-layout>
