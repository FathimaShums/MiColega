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
                
                
                    <h2>Available Skills</h2>
                    <!--need to extract skills from database and display by category here-->

                

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
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
               <h2>Create a Course</h2>
               <form action="" method="POST">  
                @csrf
                <label for="title">Course Title</label>
                <input type="text" name="title" required>
            
                <label for="description">Course Description</label>
                <textarea name="description"></textarea>
            
                <label for="skill_id">Skill</label>
                qqqq
            
                <label for="start_time">Start Time</label>
                <input type="datetime-local" name="start_time" required>
            
                <label for="duration">Duration (in minutes)</label>
                <input type="number" name="duration" required>
            
                <label for="recurrence">Recurrence</label>
                <select name="recurrence">
                    <option value="">None</option>
                    <option value="FREQ=DAILY">Daily</option>
                    <option value="FREQ=WEEKLY;BYDAY=MO">Weekly on Monday</option>
                    <option value="FREQ=MONTHLY">Monthly</option>
                </select>
            
                <button type="submit">Create Course</button>
            </form>
            </div>
        </div>
    </div>
</x-app-layout>
