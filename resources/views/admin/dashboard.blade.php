@extends('admin.layout')
@section('title', 'Dashboard')
@section('content')
    <h1 class="text-2xl font-bold mb-4">Welcome to Admin Dashboard</h1>
    <div class="grid grid-cols-3 gap-4">
        <!-- Example stats cards -->
        <div class="bg-white p-4 rounded shadow">Total Products: 120</div>
        <div class="bg-white p-4 rounded shadow">Total Orders: 45</div>
        <div class="bg-white p-4 rounded shadow">Total Users: 10</div>
    </div>
@endsection
