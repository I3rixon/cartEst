<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User List</title>
</head>
<body>
    <h1>User List</h1>

    <!-- Display Flash Messages -->
    @if (session('success'))
        <p style="color: green;">{{ session('success') }}</p>
    @endif
    @if (session('error'))
        <p style="color: red;">{{ session('error') }}</p>
    @endif

    <ul>
        @foreach($users as $user)
        <li>
            {{ $user->name }} ({{ $user->email }})
            <form method="POST" action="{{ route('login-as') }}" style="display:inline;">
                @csrf
                <input type="hidden" name="user_id" value="{{ $user->id }}">
                <button type="submit">Login as {{ $user->name }}</button>
            </form>
        </li>
        @endforeach
    </ul>
</body>
</html>
