<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Blockchain Activity</title>
    <link rel="stylesheet" href="{{ asset('css/blockchain.css') }}">
</head>

<body>
    <div class="container">
        <!-- Tombol Login -->
        <div class="auth-button">
            @guest
                <a href="{{ route('login') }}" class="btn-auth">Login</a>
                <a href="{{ route('register') }}" class="btn-auth">Register</a>
            @endguest

            @auth
                <form action="{{ route('logout') }}" method="POST" style="display: inline;">
                    @csrf
                    <button type="submit" class="btn-auth">Logout</button>
                </form>
            @endauth
        </div>


        <h1>Blockchain Activity</h1>
        <table>
            <thead>
                <tr>
                    <th>Block ID</th>
                    <th>Hash</th>
                    <th>Previous Hash</th>
                    <th>Timestamp</th>
                    <th>Transactions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($blocks as $block)
                    <tr>
                        <td>{{ $block->id }}</td>
                        <td>{{ $block->hash }}</td>
                        <td>{{ $block->previous_hash ?: 'None' }}</td>
                        <td>{{ $block->timestamp }}</td>
                        <td>
                            <ul class="transactions-list">
                                @forelse($block->transactions as $transaction)
                                    <li class="transaction-item">
                                        <span>Sender:</span> {{ $transaction->sender }}<br>
                                        <span>Recipient:</span> {{ $transaction->recipient }}<br>
                                        <span>Amount:</span> {{ $transaction->amount }}
                                    </li>
                                @empty
                                    <li>No Transactions</li>
                                @endforelse
                            </ul>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</body>

</html>
