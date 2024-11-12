<x-guest-layout>
    <x-slot name="logo">
        <h1>Mi Colega</h1>
    </x-slot>

    <x-validation-errors class="mb-4" />

    <form method="POST" action="{{ route('register') }}">
        @csrf

        <div>
            <x-label for="name" value="{{ __('Name') }}" />
            <x-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
        </div>

        <div class="mt-4">
            <x-label for="email" value="{{ __('Email') }}" />
            <x-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autocomplete="username" />
        </div>

        <div class="mt-4">
            <x-label for="password" value="{{ __('Password') }}" />
            <x-input id="password" class="block mt-1 w-full" type="password" name="password" required autocomplete="new-password" />
        </div>

        <div class="mt-4">
            <x-label for="password_confirmation" value="{{ __('Confirm Password') }}" />
            <x-input id="password_confirmation" class="block mt-1 w-full" type="password" name="password_confirmation" required autocomplete="new-password" />
        </div>

        <!-- Skills -->
        <div class="form-group mt-4">
            <label for="skills">Select Skills:</label>
            <div class="space-y-2">
                @foreach ($skills as $skill)
                    <div>
                        <input type="checkbox" name="skills[]" value="{{ $skill->id }}" id="skill_{{ $skill->id }}"
                            {{ in_array($skill->id, old('skills', [])) ? 'checked' : '' }}>
                        <label for="skill_{{ $skill->id }}">{{ $skill->name }}</label>
                    </div>
                @endforeach
            </div>
        </div>

        @if (Laravel\Jetstream\Jetstream::hasTermsAndPrivacyPolicyFeature())
            <div class="mt-4">
                <x-label for="terms">
                    <div class="flex items-center">
                        <x-checkbox name="terms" id="terms" required />

                        <div class="ms-2">
                            {!! __('I agree to the :terms_of_service and :privacy_policy', [
                                    'terms_of_service' => '<a target="_blank" href="'.route('terms.show').'" class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">'.__('Terms of Service').'</a>',
                                    'privacy_policy' => '<a target="_blank" href="'.route('policy.show').'" class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">'.__('Privacy Policy').'</a>',
                            ]) !!}
                        </div>
                    </div>
                </x-label>
            </div>
        @endif

        <!-- Availability Table -->
        <div class="container mt-4">
            <h2 class="mb-4">{{ __('Select Available Times') }}</h2>
            <table class="min-w-full table-auto border-collapse border border-gray-300">
                <thead>
                    <tr class="bg-gray-200">
                        <th class="px-4 py-2 border border-gray-300">{{ __('Day') }}</th>
                        @foreach($timeSlots as $timeSlot)
                            <th class="px-4 py-2 border border-gray-300">{{ $timeSlot }}</th>
                        @endforeach
                    </tr>
                </thead>
                <tbody>
                    @foreach($availabilities as $availability)
                        <tr class="text-center">
                            <td class="px-4 py-2 border border-gray-300">{{ $availability->date }}</td>
                            @foreach($timeSlots as $timeSlot)
                                <td class="px-4 py-2 border border-gray-300">
                                    <input 
                                        type="checkbox" 
                                        name="availabilities[]" 
                                        value="{{ $availability->id . '-' . $timeSlot }}" 
                                        {{ old('availabilities') && in_array($availability->id . '-' . $timeSlot, old('availabilities')) ? 'checked' : '' }}
                                    >
                                </td>
                            @endforeach
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <div class="flex items-center justify-end mt-4">
            <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" href="{{ route('login') }}">
                {{ __('Already registered?') }}
            </a>

            <x-button class="ms-4">
                {{ __('Register') }}
            </x-button>
        </div>
    </form>
</x-guest-layout>
