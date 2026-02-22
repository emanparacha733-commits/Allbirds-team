@extends('layouts.admin.layout')

@section('title', 'Registered Emails')

@section('content')
<div class="bg-white shadow rounded p-6">
    <h2 class="text-lg font-bold mb-4">Registered Emails</h2>

    <ul class="list-disc pl-6">
        @foreach ($emails as $user)
            <li>{{ $user->email }}</li>
        @endforeach
    </ul>
</div>
@endsection