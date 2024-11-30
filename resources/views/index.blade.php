@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
    <h2 class="text-2xl font-semibold text-center mb-6">Project Dashboard</h2>
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
        <!-- Project Buttons -->
        <a href="/project/1" class="bg-blue-500 text-white p-4 rounded-lg shadow-lg hover:bg-blue-600 dark:bg-blue-800 dark:hover:bg-blue-700 transition">
            Project 1
        </a>
    
        
        @endsection