<!-- resources/views/teach.blade.php -->
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Teach') }}
        </h2>
    </x-slot>
    <div class="py-12" x-data="{ showModal: false }"> <!-- Alpine.js scope with showModal initialized -->

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                
                
                    <h2>Skills and Demand</h2>
                    <!--need to extract skills from database and display by category here-->
                    <div class="container">
                        <h1 class="text-2xl font-bold mb-4">Available Skills</h1>
                        <table class="min-w-full bg-white border border-gray-300">
                            <thead class="bg-gray-100">
                                <tr>
                                    <th class="py-2 px-4 border-b">Skill Name</th>
                                    <th class="py-2 px-4 border-b">Skill Description</th>
                                    <th class="py-2 px-4 border-b">Demand</th>
                                    <th class="py-2 px-4 border-b">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($skills as $skill)
                                    <tr>
                                        <td class="py-2 px-4 border-b">{{ $skill->name }}</td>
                                        <td class="py-2 px-4 border-b">{{ $skill->description }}</td>
                                        <td class="py-2 px-4 border-b">{{ $skill->users_count }}</td>
                                        <td class="py-2 px-4 border-b">
                                            <button @click="showModal = true" class="bg-blue-500 text-black px-4 py-2 rounded hover:bg-blue-600">
                                                Teach Skill
                                            </button>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div>
                         <!-- Modal -->
    <div x-show="showModal" class="fixed inset-0 bg-gray-800 bg-opacity-50 flex items-center justify-center">
        <div class="bg-white p-6 rounded-lg w-1/3">
            <h2 class="text-lg font-bold mb-4">Upload Proof for Skill</h2>
            <form method="POST" action="/upload-proof" enctype="multipart/form-data">
                @csrf
                <div class="mb-4">
                    <label for="proof" class="block text-sm font-medium text-gray-700">Proof File</label>
                    <input type="file" name="proof" id="proof" class="mt-1 block w-full border-gray-300 rounded-md">
                </div>
                <div class="flex justify-end">
                    <button type="button" @click="showModal = false" class="bg-gray-500 text-white px-4 py-2 rounded mr-2 hover:bg-gray-600">
                        Cancel
                    </button>
                    <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">
                        Submit
                    </button>
                </div>
            </form>
        </div>
    </div>
                    </div>

                

            </div>
        </div>
    </div>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                
                
                    <h2>Approved skills</h2>
                    <!--Display approved skills the student can teach here-->


                

            </div>
        </div>
    </div>
</div>
</x-app-layout>
