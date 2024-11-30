@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
    <h2 class="text-2xl font-semibold text-center mb-6">Project Dashboard</h2>
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
        <!-- Project Buttons -->
        <a href="/project/1" class="bg-blue-500 text-white p-4 rounded-lg shadow-lg hover:bg-blue-600 dark:bg-blue-800 dark:hover:bg-blue-700 transition">
            Project 1
        </a>
        <a href="/project/2" class="bg-green-500 text-white p-4 rounded-lg shadow-lg hover:bg-green-600 dark:bg-green-800 dark:hover:bg-green-700 transition">
            Project 2
        </a>
        <a href="/project/3" class="bg-purple-500 text-white p-4 rounded-lg shadow-lg hover:bg-purple-600 dark:bg-purple-800 dark:hover:bg-purple-700 transition">
            Project 3
        </a>
    </div>
@endsection
