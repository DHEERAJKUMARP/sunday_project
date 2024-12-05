@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')


<div class="text-gray-800 bg-white dark:text-white dark:bg-gray-800 p-6 rounded-lg shadow-md">
  <h2 class="text-2xl font-semibold mb-6">Enter Time Entry Details</h2>

  <!-- Form to input entry details -->
  <form id="entryForm" action="{{ route('office_time.create') }}" method="POST" class="space-y-4">
    @csrf
    <!-- Date -->
    <div>
      <label for="date" class="block text-lg font-medium">Date</label>
      <input type="date" id="date" name="date" class="w-full p-3 bg-gray-200 dark:bg-gray-700 dark:text-white rounded-lg border border-gray-300 dark:border-gray-600" required>
      @error('date') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
    </div>

    <!-- Day Type -->
    <div>
      <label for="dayType" class="block text-lg font-medium">Day Type</label>
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
      @error('dayType') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
    </div>

    <!-- Date and Time for Work -->
    <div id="workFields" class="hidden">
      <div>
        <label for="checkInTime" class="block text-lg font-medium">Check-In Time</label>
        <input type="time" id="checkInTime" name="checkInTimeWork" class="w-full p-3 bg-gray-200 dark:bg-gray-700 dark:text-white rounded-lg border border-gray-300 dark:border-gray-600" >
        @error('checkInTime') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
      </div>
      <div>
        <label for="checkOutTime" class="block text-lg font-medium">Check-Out Time</label>
        <input type="time" id="checkOutTime" name="checkOutTimeWork" class="w-full p-3 bg-gray-200 dark:bg-gray-700 dark:text-white rounded-lg border border-gray-300 dark:border-gray-600" >
        @error('checkOutTime') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
      </div>
    </div>

    <!-- Leave Type -->
    <div id="leaveFields" class="hidden">
      <div>
        <label for="leaveType" class="block text-lg font-medium">Leave Type</label>
        <select id="leaveType" name="leaveType" class="w-full p-3 bg-gray-200 dark:bg-gray-700 dark:text-white rounded-lg border border-gray-300 dark:border-gray-600">
          <option value="">Select Leave Type</option>
          <option value="sick">Sick Leave</option>
          <option value="vacation">Vacation</option>
          <option value="personal">Personal Leave</option>
        </select>
        @error('leaveType') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
      </div>

      <!-- Duration for Leave -->
      <div>
        <label class="block text-lg font-medium">Leave Duration</label>
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
        @error('leaveDuration') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
      </div>
    </div>

    <!-- Comp Off Fields -->
    <div id="compOffFields" class="hidden">
      <div>
        <label for="compOffDate" class="block text-lg font-medium">Compensatory Off Date</label>
        <input type="date" id="compOffDate" name="compOffDate" class="w-full p-3 bg-gray-200 dark:bg-gray-700 dark:text-white rounded-lg border border-gray-300 dark:border-gray-600">
        @error('compOffDate') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
      </div>

      <div>
        <label class="block text-lg font-medium">Comp Off Duration</label>
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
        @error('compDuration') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
      </div>
    </div>
    <!-- Leave Time Fields (show only when Half Day is selected) -->
<div id="leaveTimeFields" class="hidden">
<div>
    <label for="checkInTime" class="block text-lg font-medium"> Check-In Time</label>
    <input type="time" id="checkInTime" name="checkInTimeLeave" class="w-full p-3 bg-gray-200 dark:bg-gray-700 dark:text-white rounded-lg border border-gray-300 dark:border-gray-600">
    @error('checkInTime') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
  </div>
  <div>
    <label for="checkOutTime" class="block text-lg font-medium">Check-Out Time</label>
    <input type="time" id="checkOutTime" name="checkOutTimeLeave" class="w-full p-3 bg-gray-200 dark:bg-gray-700 dark:text-white rounded-lg border border-gray-300 dark:border-gray-600">
    @error('checkOutTime') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
  </div>
</div>

<!-- Compensatory Off Time Fields (show only when Half Day is selected) -->
<div id="compTimeFields" class="hidden">
  <div>
    <label for="checkInTime" class="block text-lg font-medium">Comp Off Check-In Time</label>
    <input type="time" id="checkInTime" name="checkInTimeComp" class="w-full p-3 bg-gray-200 dark:bg-gray-700 dark:text-white rounded-lg border border-gray-300 dark:border-gray-600">
    @error('checkInTime') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
  </div>
  <div>
    <label for="checkOutTime" class="block text-lg font-medium">Comp Off Check-Out Time</label>
    <input type="time" id="checkOutTime" name="checkOutTimeComp" class="w-full p-3 bg-gray-200 dark:bg-gray-700 dark:text-white rounded-lg border border-gray-300 dark:border-gray-600">
    @error('checkOutTime') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
  </div>
</div>


    <!-- Notes -->
    <div>
      <label for="notes" class="block text-lg font-medium">Notes</label>
      <textarea id="notes" name="notes" class="w-full p-3 bg-gray-200 dark:bg-gray-700 dark:text-white rounded-lg border border-gray-300 dark:border-gray-600" rows="4"></textarea>
      @error('notes') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
    </div>

    <!-- Submit Button -->
    <button type="submit" class="w-full px-4 py-2 bg-blue-500 text-white rounded-lg hover:bg-blue-600 dark:bg-blue-700 dark:hover:bg-blue-800 focus:ring-4 focus:ring-blue-500">
      Submit
    </button>
  </form>
</div>
<!-- Entries Section -->
<div class="mt-8 bg-gray-300 dark:bg-gray-700 text-gray-800 dark:text-white">
  <h2 class="text-2xl font-semibold mb-4">Entries</h2>

  <table id="entriesTable" class="w-full display bg-gray-100 dark:bg-gray-800 text-gray-800 dark:text-white rounded-lg shadow-lg border border-gray-300 dark:border-gray-700">
    <thead class="bg-gray-300 dark:bg-gray-700 text-gray-800 dark:text-white">
      <tr>
        <th class="border border-gray-400 dark:border-gray-600">ID</th>
        <th class="border border-gray-400 dark:border-gray-600">Date</th>
        <th class="border border-gray-400 dark:border-gray-600">Day Type</th>
        <th class="border border-gray-400 dark:border-gray-600">Check-In</th>
        <th class="border border-gray-400 dark:border-gray-600">Check-Out</th>
        <th class="border border-gray-400 dark:border-gray-600">Notes</th>
      </tr>
    </thead>
    <tbody class="bg-white dark:bg-gray-900 dark:text-white">
      @foreach($entries as $entry)
        <tr class="hover:bg-gray-200 dark:hover:bg-gray-700">
          <td class="border border-gray-400 dark:border-gray-600">{{ $entry->id }}</td>
          <td class="border border-gray-400 dark:border-gray-600">{{ $entry->date }}</td>
          <td class="border border-gray-400 dark:border-gray-600">{{ ucfirst($entry->day_type) }}</td>
          <td class="border border-gray-400 dark:border-gray-600">{{ $entry->check_in_time ?? 'N/A' }}</td>
          <td class="border border-gray-400 dark:border-gray-600">{{ $entry->check_out_time ?? 'N/A' }}</td>
          <td class="border border-gray-400 dark:border-gray-600">{{ $entry->notes ?? 'No Notes' }}</td>
        </tr>
      @endforeach
    </tbody>
  </table>
</div>



<script>
  $(document).ready(function() {
    $('#entriesTable').DataTable({
      paging: true, // Enable pagination
      searching: true, // Enable search bar
      info: true, // Show table information
      ordering: true, // Enable sorting
      responsive: true, // Make table responsive
      language: {
        paginate: {
          previous: "Previous",
          next: "Next"
        },
        search: "Search:",
        info: "Showing _START_ to _END_ of _TOTAL_ entries",
        lengthMenu: "Show _MENU_ entries"
      }
    });
  });
</script>



<script>
  // Wait for the DOM to fully load
  document.addEventListener('DOMContentLoaded', function () {
    // Get references to the radio buttons and fields
    const dayTypeRadios = document.querySelectorAll('input[name="dayType"]');
    const workFields = document.getElementById('workFields');
    const leaveFields = document.getElementById('leaveFields');
    const compOffFields = document.getElementById('compOffFields');
    const leaveDurationRadios = document.querySelectorAll('input[name="leaveDuration"]');
    const compDurationRadios = document.querySelectorAll('input[name="compDuration"]');
    const checkInTime = document.getElementById('checkInTime');
    const checkOutTime = document.getElementById('checkOutTime');
    const leaveTimeFields = document.getElementById('leaveTimeFields');
    const compTimeFields = document.getElementById('compTimeFields');

    // Function to handle the visibility of fields based on selected day type
    function toggleFields() {
      // Hide all fields first
      workFields.classList.add('hidden');
      leaveFields.classList.add('hidden');
      compOffFields.classList.add('hidden');
      leaveTimeFields.classList.add('hidden');
      compTimeFields.classList.add('hidden');

      // Show the appropriate fields based on the selected day type
      const selectedDayType = document.querySelector('input[name="dayType"]:checked');
      if (selectedDayType) {
        if (selectedDayType.value === 'work') {
          workFields.classList.remove('hidden');
        } else if (selectedDayType.value === 'leave') {
          leaveFields.classList.remove('hidden');
          handleLeaveDuration();
        } else if (selectedDayType.value === 'compOff') {
          compOffFields.classList.remove('hidden');
          handleCompOffDuration();
        }
      }
    }

    // Function to handle leave duration and show time fields
    function handleLeaveDuration() {
      const selectedLeaveDuration = document.querySelector('input[name="leaveDuration"]:checked');
      if (selectedLeaveDuration && selectedLeaveDuration.value === 'full') {
        leaveTimeFields.classList.add('hidden');
      } else if (selectedLeaveDuration && selectedLeaveDuration.value === 'half') {
        leaveTimeFields.classList.remove('hidden');
      }
    }

    // Function to handle compensatory off duration and show time fields
    function handleCompOffDuration() {
      const selectedCompDuration = document.querySelector('input[name="compDuration"]:checked');
      if (selectedCompDuration && selectedCompDuration.value === 'full') {
        compTimeFields.classList.add('hidden');
      } else if (selectedCompDuration && selectedCompDuration.value === 'half') {
        compTimeFields.classList.remove('hidden');
      }
    }

    // Add event listeners to radio buttons to trigger the toggle
    dayTypeRadios.forEach(radio => {
      radio.addEventListener('change', toggleFields);
    });

    leaveDurationRadios.forEach(radio => {
      radio.addEventListener('change', handleLeaveDuration);
    });

    compDurationRadios.forEach(radio => {
      radio.addEventListener('change', handleCompOffDuration);
    });

    // Initial field visibility based on pre-selected radio button (if any)
    toggleFields();
  });

</script>

@endsection
