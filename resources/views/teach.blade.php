<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-2xl text-gray-800 leading-tight">
            {{ __('Teach') }}
        </h2>
    </x-slot>

    <div class="py-8" x-data="{ showModal: false }">

        <!-- Skills and Demand Section -->
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 mb-8">
            <div class="bg-white overflow-hidden shadow-md sm:rounded-lg p-6">
                <h2 class="text-2xl font-semibold mb-6">Skills and Demand</h2>
                
                <!-- Available Skills Table -->
                <h3 class="text-lg font-medium mb-4">Available Skills</h3>
                <table class="min-w-full bg-white border border-gray-300 rounded-lg">
                    <thead class="bg-gray-100">
                        <tr>
                            <th class="py-3 px-4 border-b font-medium text-left">Skill Name</th>
                            <th class="py-3 px-4 border-b font-medium text-left">Skill Description</th>
                            <th class="py-3 px-4 border-b font-medium text-left">Demand</th>
                            <th class="py-3 px-4 border-b font-medium text-left">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($skills as $skill)
                            <tr class="hover:bg-gray-50">
                                <td class="py-3 px-4 border-b">{{ $skill->name }}</td>
                                <td class="py-3 px-4 border-b">{{ $skill->description }}</td>
                                <td class="py-3 px-4 border-b">{{ $skill->users_count }}</td>
                                <td class="py-3 px-4 border-b">
                                    <button @click="showModal = true" class="bg-blue-500 text-white px-4 py-2 rounded-md hover:bg-blue-600">
                                        Teach Skill
                                    </button>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Modal for Proof Upload -->
        <div x-show="showModal" class="fixed inset-0 bg-gray-800 bg-opacity-50 flex items-center justify-center">
            <div class="bg-white p-8 rounded-lg w-full max-w-md">
                <h2 class="text-xl font-bold mb-4">Upload Proof for Skill</h2>
                <form method="POST" action="{{ route('submit.skill.request') }}" enctype="multipart/form-data">
                    @csrf
                    <div class="mb-6">
                        <label for="proof" class="block text-sm font-medium text-gray-700">Proof Files</label>
                        <input type="file" name="proof[]" id="proof" class="mt-2 block w-full border border-gray-300 rounded-md p-2" multiple>
                    </div>
                    @foreach ($skills as $skill)
                        <input type="hidden" name="skill_id[]" value="{{ $skill->id }}">
                    @endforeach
                    <div class="flex justify-end space-x-3">
                        <button type="button" @click="showModal = false" class="bg-gray-500 text-white px-4 py-2 rounded-md hover:bg-gray-600">
                            Cancel
                        </button>
                        <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded-md hover:bg-blue-600">
                            Submit
                        </button>
                    </div>
                </form>
            </div>
        </div>

        <!-- Approved Skills Section -->
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 mb-8">
            <div class="bg-white overflow-hidden shadow-md sm:rounded-lg p-6">
                <h2 class="text-2xl font-semibold mb-6">Approved Skills</h2>
                <!-- Placeholder for Approved Skills -->
                <p class="text-gray-600">Display approved skills the student can teach here.</p>
            </div>
        </div>

        <!-- Session Requests Section -->
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <h2 class="text-2xl font-semibold mb-4">Session Requests</h2>
            @if($sessionRequests->isEmpty())
                <p class="text-gray-600">No session requests found.</p>
            @else
                <table class="min-w-full bg-white border border-gray-300 rounded-lg">
                    <thead class="bg-gray-100">
                        <tr>
                            <th class="py-3 px-4 border-b font-medium text-left">Requester</th>
                            <th class="py-3 px-4 border-b font-medium text-left">Skill</th>
                            <th class="py-3 px-4 border-b font-medium text-left">Status</th>
                            <th class="py-3 px-4 border-b font-medium text-left">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($sessionRequests as $request)
                            <tr class="hover:bg-gray-50">
                                <td class="py-3 px-4 border-b">{{ $request->user->name }}</td>
                                <td class="py-3 px-4 border-b">{{ $request->skill->name }}</td>
                                <td class="py-3 px-4 border-b">{{ ucfirst($request->status) }}</td>
                                <td class="py-3 px-4 border-b">
                                    <form action="{{ route('session-request.update', $request->id) }}" method="POST" class="inline-block">
                                        @csrf
                                        @method('PUT')
                                        <input type="hidden" name="status" value="accepted">
                                        <button type="submit" class="bg-green-500 text-white px-3 py-1 rounded-md hover:bg-red-600">
                                            Accept
                                        </button>
                                    </form>
                                    <form action="{{ route('session-request.update', $request->id) }}" method="POST" class="inline-block">
                                        @csrf
                                        @method('PUT')
                                        <input type="hidden" name="status" value="rejected">
                                        <button type="submit" class="bg-red-500 text-white px-3 py-1 rounded-md hover:bg-red-600">
                                            Reject
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @endif
        </div>
    </div>
</x-app-layout>
