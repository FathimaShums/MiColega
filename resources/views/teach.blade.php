<!-- resources/views/teach.blade.php -->
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Teach') }}
        </h2>
    </x-slot>

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
                                            <button class="bg-blue-500 text-black px-4 py-2 rounded hover:bg-blue-600">
                                                Teach Skill
                                            </button>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
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
    
</x-app-layout>
