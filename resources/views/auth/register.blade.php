<x-guest-layout>

    <h1 class="font-semibold text-2xl text-center mb-3">Register</h1>
    <p class="text-sm bg-slate-100 text-gray-700 p-3 mb-3 rounded-md"><strong>Name</strong> and <strong>Phone Number</strong> are required to login to the TerasWeb Affiliate Portal</p>

    <form method="POST" action="{{ route('register') }}">
        @csrf

        <!-- Name -->
        <div>
            <x-input-label for="name" :value="__('Name')" />
            <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" placeholder="Enter your name" required autofocus autocomplete="name" />
            <x-input-error :messages="$errors->get('name')" class="mt-2" />
        </div>

        <!-- Email Address -->
        <div class="mt-4">
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" placeholder="Enter your email address" required autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <div class="mt-4">
            <x-input-label for="phone" :value="__('Phone')" />
            <x-text-input id="phone" class="block mt-1 w-full" type="tel" name="phone" :value="old('phone')" placeholder="Enter your phone number" required autofocus autocomplete="phone" />
            <x-input-error :messages="$errors->get('phone')" class="mt-2" />
        </div>

        <p class="text-sm bg-slate-100 text-gray-700 p-3 my-3 rounded-md">Enter your <strong> Social Media Accounts </strong> to use in the TerasWeb affiliate program</p>

        <div class="mt-4">
            <x-input-label for="instagram" :value="__('Instagram')" />
            <x-text-input id="instagram" class="block mt-1 w-full" type="text" name="instagram" :value="old('instagram')" placeholder="Enter your instagram account (e.g., @username)" required autofocus autocomplete="instagram" />
            <x-input-error :messages="$errors->get('instagram')" class="mt-2" />
        </div>

        <div class="mt-4">
            <x-input-label for="facebook" :value="__('Facebook')" />
            <x-text-input id="facebook" class="block mt-1 w-full" type="text" name="facebook" :value="old('facebook')" placeholder="Enter your facebook account (e.g., @username)" required autofocus autocomplete="facebook" />
            <x-input-error :messages="$errors->get('facebook')" class="mt-2" />
        </div>

        <div class="mt-4">
            <x-input-label for="tiktok" :value="__('TikTok')" />
            <x-text-input id="tiktok" class="block mt-1 w-full" type="text" name="tiktok" :value="old('tiktok')" placeholder="Enter your tiktok account (e.g., @username)" required autofocus autocomplete="tiktok" />
            <x-input-error :messages="$errors->get('tiktok')" class="mt-2" />
        </div>

        <p class="text-sm bg-slate-100 text-gray-700 p-3 my-3 rounded-md">Enter your strong password, minimum 8 characters.</p>

        <!-- Password -->
        <div class="mt-4">
            <x-input-label for="password" :value="__('Password')" />

            <x-text-input id="password" class="block mt-1 w-full"
                            type="password"
                            name="password"
                            required autocomplete="new-password" placeholder="Enter your password"  />

            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Confirm Password -->
        <div class="mt-4">
            <x-input-label for="password_confirmation" :value="__('Confirm Password')" />

            <x-text-input id="password_confirmation" class="block mt-1 w-full"
                            type="password"
                            name="password_confirmation" required autocomplete="new-password" placeholder="Confirm your password" />

            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div>

        <div class="flex items-center mt-4">
            <input id="terms" type="checkbox" class="mr-4 rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500 dark:focus:ring-indigo-600" required>
            <label for="terms" class="text-sm text-gray-600 dark:text-gray-400">
                I agree to the <a target="_Blank" href="{{ route('terms') }}" class="underline hover:text-gray-900 dark:hover:text-gray-100">Terms and Condition</a> and <a target="_Blank" href="{{ route('privacy') }}" class="underline hover:text-gray-900 dark:hover:text-gray-100">Privacy Policy</a>
            </label>
        </div>

        <div class="text-center mt-4">
            <button class="w-full text-white bg-gradient-to-br from-purple-600 to-blue-500 hover:bg-gradient-to-bl focus:ring-4 focus:outline-none focus:ring-blue-300 dark:focus:ring-blue-800 font-medium rounded-lg text-sm py-2.5 mb-2">
                Register
            </button>
        </div>
        <div class="mt-1 text-center">
            <a class="underline text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800" href="{{ route('login') }}">
                {{ __("Already have an account?") }}
            </a>
        </div>
    </form>
</x-guest-layout>
