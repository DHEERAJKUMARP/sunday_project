@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')

<div class="text-white bg-white">
  <div class="text-gray-800 bg-white dark:text-white dark:bg-gray-800 p-6 rounded-lg shadow-md">
    <h2 class="text-2xl font-semibold mb-6">Enter Time Entry Details</h2>

    <!-- Form to input entry details -->
    <form id="entryForm" class="space-y-4" action="{{ route('office_time.create') }}" method="POST">

    @csrf <!-- Include this to add the CSRF token -->
    
      <!-- First Row: Day Type -->
      <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
        <!-- Day Type Selection -->
        <div>
          <label class="block text-sm font-medium">Type of Day</label>
          <div class="flex items-center space-x-4">
            <div class="flex items-center">
              <input type="radio" id="work" name="dayType" value="work" class="h-4 w-4 text-blue-500 bg-gray-200 dark:bg-gray-700 focus:ring-blue-500">
              <label for="work" class="ml-2 text-sm font-medium">Work</label>
            </div>
            <div class="flex items-center">
              <input type="radio" id="leave" name="dayType" value="leave" class="h-4 w-4 text-blue-500 bg-gray-200 dark:bg-gray-700 focus:ring-blue-500">
              <label for="leave" class="ml-2 text-sm font-medium">Leave</label>
            </div>
            <div class="flex items-center">
              <input type="radio" id="compOff" name="dayType" value="compOff" class="h-4 w-4 text-blue-500 bg-gray-200 dark:bg-gray-700 focus:ring-blue-500">
              <label for="compOff" class="ml-2 text-sm font-medium">Compensatory Off</label>
            </div>
          </div>
        </div>
      </div>

      <!-- Conditional Fields -->
      <div id="conditionalFields" class="space-y-4 hidden">
        
        <!-- Date and Time for Work -->
        <div id="workFields" class="hidden">
          <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
            <div>
              <label for="date" class="block text-sm font-medium">Date</label>
              <input type="date" id="date" name="date" class="w-full p-3 bg-gray-200 dark:bg-gray-700 dark:text-white rounded-lg border border-gray-300 dark:border-gray-600" required>
            </div>
            <div>
              <label for="checkInTime" class="block text-sm font-medium">Check-In Time</label>
              <input type="time" id="checkInTime" name="checkInTime" class="w-full p-3 bg-gray-200 dark:bg-gray-700 dark:text-white rounded-lg border border-gray-300 dark:border-gray-600" required>
            </div>
            <div>
              <label for="checkOutTime" class="block text-sm font-medium">Check-Out Time</label>
              <input type="time" id="checkOutTime" name="checkOutTime" class="w-full p-3 bg-gray-200 dark:bg-gray-700 dark:text-white rounded-lg border border-gray-300 dark:border-gray-600" required>
            </div>
          </div>
        </div>

        <!-- Date and Leave Type for Leave -->
        <div id="leaveFields" class="hidden">
          <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
            <div>
              <label for="date" class="block text-sm font-medium">Date</label>
              <input type="date" id="date" name="date" class="w-full p-3 bg-gray-200 dark:bg-gray-700 dark:text-white rounded-lg border border-gray-300 dark:border-gray-600" required>
            </div>
          </div>

          <!-- Full/Half Day Selection -->
          <div>
            <label class="block text-sm font-medium">Duration</label>
            <div class="flex items-center space-x-4">
              <div class="flex items-center">
                <input type="radio" id="leaveFullDay" name="leaveDuration" value="full" class="h-4 w-4 text-blue-500 bg-gray-200 dark:bg-gray-700 focus:ring-blue-500">
                <label for="leaveFullDay" class="ml-2 text-sm font-medium">Full Day</label>
              </div>
              <div class="flex items-center">
                <input type="radio" id="leaveHalfDay" name="leaveDuration" value="half" class="h-4 w-4 text-blue-500 bg-gray-200 dark:bg-gray-700 focus:ring-blue-500">
                <label for="leaveHalfDay" class="ml-2 text-sm font-medium">Half Day</label>
              </div>
            </div>
          </div>

          <!-- Check-In and Check-Out Time for Half Day -->
          <div id="leaveHalfDayFields" class="hidden">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
              <div>
                <label for="checkInTime" class="block text-sm font-medium">Check-In Time</label>
                <input type="time" id="checkInTime" name="checkInTime" class="w-full p-3 bg-gray-200 dark:bg-gray-700 dark:text-white rounded-lg border border-gray-300 dark:border-gray-600" required>
              </div>
              <div>
                <label for="checkOutTime" class="block text-sm font-medium">Check-Out Time</label>
                <input type="time" id="checkOutTime" name="checkOutTime" class="w-full p-3 bg-gray-200 dark:bg-gray-700 dark:text-white rounded-lg border border-gray-300 dark:border-gray-600" required>
              </div>
            </div>
          </div>
        </div>

        <!-- Date and Comp Off Fields for Compensatory Off -->
        <div id="compOffFields" class="hidden">
          <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
            <div>
              <label for="compOffDate" class="block text-sm font-medium">Compensatory Off Date</label>
              <input type="date" id="compOffDate" name="compOffDate" class="w-full p-3 bg-gray-200 dark:bg-gray-700 dark:text-white rounded-lg border border-gray-300 dark:border-gray-600">
            </div>
          </div>

          <!-- Full/Half Day Selection for Comp Off -->
          <div>
            <label class="block text-sm font-medium">Duration</label>
            <div class="flex items-center space-x-4">
              <div class="flex items-center">
                <input type="radio" id="compFullDay" name="compDuration" value="full" class="h-4 w-4 text-blue-500 bg-gray-200 dark:bg-gray-700 focus:ring-blue-500">
                <label for="compFullDay" class="ml-2 text-sm font-medium">Full Day</label>
              </div>
              <div class="flex items-center">
                <input type="radio" id="compHalfDay" name="compDuration" value="half" class="h-4 w-4 text-blue-500 bg-gray-200 dark:bg-gray-700 focus:ring-blue-500">
                <label for="compHalfDay" class="ml-2 text-sm font-medium">Half Day</label>
              </div>
            </div>
          </div>

          <!-- Check-In and Check-Out Time for Half Day Comp Off -->
          <div id="compHalfDayFields" class="hidden">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
              <div>
                <label for="checkInTime" class="block text-sm font-medium">Check-In Time</label>
                <input type="time" id="checkInTime" name="checkInTime" class="w-full p-3 bg-gray-200 dark:bg-gray-700 dark:text-white rounded-lg border border-gray-300 dark:border-gray-600" required>
              </div>
              <div>
                <label for="checkOutTime" class="block text-sm font-medium">Check-Out Time</label>
                <input type="time" id="checkOutTime" name="checkOutTime" class="w-full p-3 bg-gray-200 dark:bg-gray-700 dark:text-white rounded-lg border border-gray-300 dark:border-gray-600" required>
              </div>
            </div>
          </div>
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

<script>
  document.addEventListener('DOMContentLoaded', () => {
    const dayTypeInputs = document.querySelectorAll('input[name="dayType"]');
    const conditionalFields = document.getElementById('conditionalFields');
    const leaveFields = document.getElementById('leaveFields');
    const compOffFields = document.getElementById('compOffFields');
    const leaveHalfDayFields = document.getElementById('leaveHalfDayFields');
    const compHalfDayFields = document.getElementById('compHalfDayFields');

    dayTypeInputs.forEach(input => {
      input.addEventListener('change', () => {
        conditionalFields.classList.remove('hidden');
        leaveFields.classList.add('hidden');
        compOffFields.classList.add('hidden');
        leaveHalfDayFields.classList.add('hidden');
        compHalfDayFields.classList.add('hidden');

        if (input.value === 'work') {
          // Show work fields
          document.getElementById('workFields').classList.remove('hidden');
        } else if (input.value === 'leave') {
          // Show leave fields
          leaveFields.classList.remove('hidden');
        } else if (input.value === 'compOff') {
          // Show comp off fields
          compOffFields.classList.remove('hidden');
        }
      });
    });

    // Show check-in/out times for half-day leave
    const leaveDurationInputs = document.querySelectorAll('input[name="leaveDuration"]');
    leaveDurationInputs.forEach(input => {
      input.addEventListener('change', () => {
        if (input.value === 'half') {
          leaveHalfDayFields.classList.remove('hidden');
        } else {
          leaveHalfDayFields.classList.add('hidden');
        }
      });
    });

    // Show check-in/out times for half-day comp off
    const compDurationInputs = document.querySelectorAll('input[name="compDuration"]');
    compDurationInputs.forEach(input => {
      input.addEventListener('change', () => {
        if (input.value === 'half') {
          compHalfDayFields.classList.remove('hidden');
        } else {
          compHalfDayFields.classList.add('hidden');
        }
      });
    });
  });
</script>

@endsection
