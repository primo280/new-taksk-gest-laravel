
<x-guest-layout>
    <div class="max-w-md mx-auto mt-10 bg-white p-6 rounded shadow">
        <h1 class="text-2xl font-bold mb-6">Inscription</h1>
        <form method="POST" action="{{ route('register') }}">
            @csrf

            <!-- Nom -->
            <div class="mb-4">
                <label for="name" class="block text-gray-700">Nom</label>
                <input id="name" type="text" name="name" value="{{ old('name') }}"
                       class="w-full border rounded p-2 @error('name') border-red-500 @enderror" required>
                @error('name')
                <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>

            <!-- Email -->
            <div class="mb-4">
                <label for="email" class="block text-gray-700">Email</label>
                <input id="email" type="email" name="email" value="{{ old('email') }}"
                       class="w-full border rounded p-2 @error('email') border-red-500 @enderror" required>
                @error('email')
                <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>

            <!-- Mot de passe -->
            <div class="mb-4">
                <label for="password" class="block text-gray-700">Mot de passe</label>
                <input id="password" type="password" name="password"
                       class="w-full border rounded p-2 @error('password') border-red-500 @enderror" required>
                @error('password')
                <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>

            <!-- Confirmation mot de passe -->
            <div class="mb-4">
                <label for="password_confirmation" class="block text-gray-700">Confirmation du mot de passe</label>
                <input id="password_confirmation" type="password" name="password_confirmation"
                       class="w-full border rounded p-2" required>
            </div>

            <button type="submit" class="w-full bg-blue-500 text-white py-2 rounded">S'inscrire</button>
        </form>
    </div>
</x-guest-layout>



<!-- Bootstrap 5 JS (JavaScript Bundle with Popper) -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>

</body>
</html>
