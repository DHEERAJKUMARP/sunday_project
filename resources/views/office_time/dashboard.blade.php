@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
   
    <div class="text-white bg-white">
    <div class="text-gray-800 bg-white dark:text-white dark:bg-gray-800 p-6 rounded-lg shadow-md">
  <h2 class="text-2xl font-semibold mb-6">Enter Time Entry Details</h2>

  <!-- Form to input entry details -->
  <form id="entryForm" class="space-y-4">
    <!-- First Row: Date, Check-In, and Check-Out -->
    <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
      <!-- Date -->
      <div>
        <label for="date" class="block text-sm font-medium">Date</label>
        <input type="date" id="date" name="date" class="w-full p-3 bg-gray-200 dark:bg-gray-700 dark:text-white rounded-lg border border-gray-300 dark:border-gray-600" required>
      </div>
      <!-- Check-In Time -->
      <div>
        <label for="checkInTime" class="block text-sm font-medium">Check-In Time</label>
        <input type="datetime-local" id="checkInTime" name="checkInTime" class="w-full p-3 bg-gray-200 dark:bg-gray-700 dark:text-white rounded-lg border border-gray-300 dark:border-gray-600" required>
      </div>
      <!-- Check-Out Time -->
      <div>
        <label for="checkOutTime" class="block text-sm font-medium">Check-Out Time</label>
        <input type="datetime-local" id="checkOutTime" name="checkOutTime" class="w-full p-3 bg-gray-200 dark:bg-gray-700 dark:text-white rounded-lg border border-gray-300 dark:border-gray-600" required>
      </div>
      <!-- Leave Type -->
      <div>
        <label for="leaveType" class="block text-sm font-medium">Leave Type</label>
        <select id="leaveType" name="leaveType" class="w-full p-3 bg-gray-200 dark:bg-gray-700 dark:text-white rounded-lg border border-gray-300 dark:border-gray-600">
          <option value="">Select Leave Type</option>
          <option value="sick">Sick Leave</option>
          <option value="vacation">Vacation</option>
          <option value="personal">Personal Leave</option>
        </select>
      </div>
    </div>

    <!-- Second Row: Leave Type, Notes, Comp Off Day, Linked Missed Day -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4">
      
      <!-- Notes -->
      <div class="col-span-2 lg:col-span-1">
        <label for="notes" class="block text-sm font-medium">Notes</label>
        <textarea id="notes" name="notes" class="w-full p-3 bg-gray-200 dark:bg-gray-700 dark:text-white rounded-lg border border-gray-300 dark:border-gray-600" rows="1"></textarea>
      </div>
      <!-- Comp Off Day -->
      <div class="flex items-center space-x-2">
        <input type="checkbox" id="isCompOffDay" name="isCompOffDay" class="h-5 w-5 text-blue-500 bg-gray-200 dark:bg-gray-700 rounded focus:ring-2 focus:ring-blue-500">
        <label for="isCompOffDay" class="text-sm font-medium">Comp Off Day?</label>
      </div>
      <!-- Linked Missed Day -->
      <div>
        <label for="linkedMissedDay" class="block text-sm font-medium">Linked Missed Day</label>
        <input type="text" id="linkedMissedDay" name="linkedMissedDay" class="w-full p-3 bg-gray-200 dark:bg-gray-700 dark:text-white rounded-lg border border-gray-300 dark:border-gray-600">
      </div>
    </div>

    <!-- Submit Button -->
    <div class="mt-4">
      <button type="submit" class="w-full md:w-auto px-4 py-2 bg-blue-500 text-white rounded-lg hover:bg-blue-600 dark:bg-blue-700 dark:hover:bg-blue-800 focus:ring-4 focus:ring-blue-500">
        Submit
      </button>
    </div>
  </form>
</div>

    </div>

    @endsection