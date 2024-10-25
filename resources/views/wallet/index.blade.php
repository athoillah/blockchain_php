<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('My Wallets') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    @foreach ($wallets as $wallet)
                        <div class="wallet-item mb-4 p-4 border border-gray-300 rounded-md">
                            <p><strong>Public Key:</strong> {{ $wallet->public_key }}</p>
                            <p>
                                <strong>Secret Key:</strong>
                                <span id="secret-key-{{ $wallet->id }}" class="masked-secret">
                                    {{ str_repeat('*', 64) }}
                                </span>
                                <button onclick="toggleSecretKey({{ $wallet->id }}, '{{ $wallet->secret_key }}')"
                                    class="btn-toggle">Show</button>
                            </p>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>


    <script>
        function toggleSecretKey(id, secretKey) {
            const secretKeyElement = document.getElementById(`secret-key-${id}`);
            const button = secretKeyElement.nextElementSibling;

            if (secretKeyElement.classList.contains('masked-secret')) {
                // Tampilkan secret key asli
                secretKeyElement.textContent = secretKey;
                secretKeyElement.classList.remove('masked-secret');
                button.textContent = 'Hide';
            } else {
                // Sembunyikan dengan bintang
                secretKeyElement.textContent = '*'.repeat(64);
                secretKeyElement.classList.add('masked-secret');
                button.textContent = 'Show';
            }
        }
    </script>
</x-app-layout>

{{-- <script>
    function toggleSecretKey(id) {
        const secretKeyElement = document.getElementById(`secret-key-${id}`);
        const button = secretKeyElement.nextElementSibling;

        if (secretKeyElement.classList.contains('hidden-secret')) {
            secretKeyElement.classList.remove('hidden-secret');
            button.textContent = 'Hide';
        } else {
            secretKeyElement.classList.add('hidden-secret');
            button.textContent = 'Show';
        }
    }
</script> --}}
