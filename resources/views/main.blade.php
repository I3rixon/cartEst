@extends('layouts.app')
@section('styles')
    <link rel="stylesheet" href="{{ asset('css/styles.css') }}">
@endsection
@section('title', 'Users List')

@section('content')
    @if (session('success'))
        <p class="text-success">{{ session('success') }}</p>
    @endif
    @if (session('error'))
        <p class="text-danger">{{ session('error') }}</p>
    @endif

    <ul class="user-list">
        @foreach($users as $user)
        <li class="user-item">
            {{ $user->name }} ({{ $user->email }})
            <form method="POST" action="{{ route('login-as') }}" class="inline-form">
                @csrf
                <input type="hidden" name="user_id" value="{{ $user->id }}">
                <button type="submit" class="btn btn-primary">Login as {{ $user->name }}</button>
            </form>
        </li>
        @endforeach
    </ul>
@endsection

