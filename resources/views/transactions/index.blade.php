<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Transactions') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <h3 class="text-lg font-semibold mb-4">Send New Transaction</h3>
                    <form action="{{ route('transactions.store') }}" method="POST" class="mb-6">
                        @csrf
                        <div class="mb-4">
                            <label for="recipient"
                                class="block text-gray-700 dark:text-gray-300 font-semibold mb-2">Recipient Public
                                Key:</label>
                            <input type="text" name="recipient"
                                class="w-full p-2 border border-gray-300 rounded-md dark:bg-gray-700 dark:border-gray-600 dark:text-gray-100"
                                required>
                        </div>
                        <div class="mb-4">
                            <label for="amount"
                                class="block text-gray-700 dark:text-gray-300 font-semibold mb-2">Amount:</label>
                            <input type="number" name="amount" step="0.01"
                                class="w-full p-2 border border-gray-300 rounded-md dark:bg-gray-700 dark:border-gray-600 dark:text-gray-100"
                                required>
                        </div>
                        <button type="submit"
                            class="px-4 py-2 bg-blue-500 text-white rounded hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-opacity-50">
                            Send
                        </button>
                    </form>

                    <h3 class="text-lg font-semibold mb-4">Your Transactions</h3>
                    <ul class="space-y-4">
                        @forelse ($transactions as $transaction)
                            <li class="p-4 border border-gray-300 rounded-md dark:border-gray-700">
                                <p><strong>Sender:</strong> {{ $transaction->sender }}</p>
                                <p><strong>Recipient:</strong> {{ $transaction->recipient }}</p>
                                <p><strong>Amount:</strong> {{ $transaction->amount }}</p>
                                <p><strong>Date:</strong> {{ $transaction->created_at }}</p>
                            </li>
                        @empty
                            <p class="text-gray-600 dark:text-gray-400">No transactions available.</p>
                        @endforelse
                    </ul>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
