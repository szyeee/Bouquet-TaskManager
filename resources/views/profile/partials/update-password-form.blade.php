<section>
    <header>
        <h2 class="text-lg font-medium text-gray-900">
            {{ __('Update Password') }}
        </h2>

        <p class="mt-1 text-sm text-gray-600">
            {{ __('Ensure your account is using a long, random password to stay secure.') }}
        </p>
    </header>

    @if(session('status') === 'password-updated')
        <div class="mb-4 text-green-600">
            {{ __('Password berhasil diupdate.') }}
        </div>
    @endif

    <form method="post" action="{{ route('password.update') }}" class="mt-6 space-y-6">
        @csrf
        @method('put')

        <div>
            <label for="current_password" class="block font-medium text-sm text-gray-700">{{ __('Current Password') }}</label>
            <input id="current_password" name="current_password" type="password" class="mt-1 block w-full border rounded px-3 py-2" autocomplete="current-password" required>
            @error('current_password')
                <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label for="password" class="block font-medium text-sm text-gray-700">{{ __('New Password') }}</label>
            <input id="password" name="password" type="password" class="mt-1 block w-full border rounded px-3 py-2" autocomplete="new-password" required>
            @error('password')
                <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label for="password_confirmation" class="block font-medium text-sm text-gray-700">{{ __('Confirm Password') }}</label>
            <input id="password_confirmation" name="password_confirmation" type="password" class="mt-1 block w-full border rounded px-3 py-2" autocomplete="new-password" required>
            @error('password_confirmation')
                <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <button type="submit" class="bg-blue-600 text-white rounded px-4 py-2 hover:bg-blue-700">
                {{ __('Save') }}
            </button>
        </div>
    </form>
</section>
