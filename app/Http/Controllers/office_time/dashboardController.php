<?php
namespace App\Http\Controllers\office_time;

use App\Http\Controllers\Controller;
use App\Models\OfficeEntry; // Add the OfficeEntry model
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class dashboardController extends Controller
{
    public function index()
    {
        // Return the view with the correct path
        return view('office_time.dashboard');
    }
    


    public function create(Request $request)
{
    // Log the request data for debugging
    Log::info($request->all());

    // Validate the incoming request data
    $validated = $request->validate([
        'date' => 'required|date',
        'dayType' => 'required|in:leave,compOff,work',
        'leaveType' => 'nullable|in:sick,vacation,personal',
        'leaveDuration' => 'nullable|in:full,half',
        'compOffDate' => 'nullable|date',
        'compDuration' => 'nullable|in:full,half',
    ]);
    Log::info($validated);


    // Inside your controller method where you handle the form submission

$checkInTime = null;
$checkOutTime = null;

// Check which set of fields has data
if ($request->has('checkInTimeWork') && $request->has('checkOutTimeWork')) {
    // If Work check-in and check-out are filled, store them
    $checkInTime = $request->input('checkInTimeWork');
    $checkOutTime = $request->input('checkOutTimeWork');
} elseif ($request->has('checkInTimeLeave') && $request->has('checkOutTimeLeave')) {
    // If Leave check-in and check-out are filled, store them
    $checkInTime = $request->input('checkInTimeLeave');
    $checkOutTime = $request->input('checkOutTimeLeave');
} elseif ($request->has('checkInTimeComp') && $request->has('checkOutTimeComp')) {
    // If Comp Off check-in and check-out are filled, store them
    $checkInTime = $request->input('checkInTimeComp');
    $checkOutTime = $request->input('checkOutTimeComp');
}

    // Fetch the request values and store them in variables
    $date = $validated['date'];
    $checkInTime = $checkInTime ?? null;
    $checkOutTime = $checkOutTime ?? null;
    $dayType = $validated['dayType'];
    $leaveType = $validated['leaveType'] ?? null; // Nullable value
    $leaveDuration = $validated['leaveDuration'] ?? null; // Nullable value
    $compOffDate = $validated['compOffDate'] ?? null; // Nullable value
    $compDuration = $validated['compDuration'] ?? null; // Nullable value

    // Add the authenticated user's ID to the data
    $userId = auth()->id();

    // Prepare the data array to be saved in the database
    $data = [
        'user_id' => $userId,
        'date' => $date,
        'check_in_time' => $checkInTime,
        'check_out_time' => $checkOutTime,
        'day_type' => $dayType,
        'leave_type' => $leaveType,
        'leave_duration' => $leaveDuration,
        'comp_off_date' => $compOffDate,
        'comp_duration' => $compDuration,
    ];

    // Create the office entry in the database using the prepared data
    OfficeEntry::create($data);

    // Log the creation for debugging
    Log::info('Office entry created and saved to the database:', $data);

    // Redirect to the dashboard or another page with a success message
    return redirect()->route('office_time')->with('success', 'Office entry created successfully.');
}

    
}
