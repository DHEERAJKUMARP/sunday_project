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
        'checkInTime' => 'nullable|date_format:H:i',
        'checkOutTime' => 'nullable|date_format:H:i',
        'dayType' => 'required|in:leave,compOff,work',
        'leaveType' => 'nullable|in:sick,vacation,personal',
        'leaveDuration' => 'nullable|in:full,half',
        'compOffDate' => 'nullable|date',
        'compDuration' => 'nullable|in:full,half',
    ]);
    Log::info($validated);

    // Fetch the request values and store them in variables
    $date = $validated['date'];

    $checkInTime = $request->input('checkInTime');
    $checkOutTime = $request->input('checkOutTime');
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
