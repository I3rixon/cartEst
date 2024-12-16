@extends('layouts.app')

@section('title', 'Users List')

@section('content')
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
@endsection
