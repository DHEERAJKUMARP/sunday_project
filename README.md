
# **Feature: Dynamic Check-In and Check-Out Time Handling**

## **Overview**
This feature allows the user to submit their check-in and check-out times based on their work type: **Work**, **Leave**, or **Compensatory Off**. The form dynamically displays relevant fields and sends the appropriate data to the server, storing the check-in and check-out times accordingly.

## **Behavior**
1. **Work Type**: When the user selects the "Work" type, the form displays check-in and check-out time fields. The values entered in these fields will be stored in the database.
2. **Leave Type**: When the user selects "Half Day" (Leave type), the form displays check-in and check-out time fields specific to leave. These values will be stored in the database.
3. **Compensatory Off**: If the user selects compensatory off, the form shows check-in and check-out time fields specifically for comp off. These values will be stored in the database.

### **Dynamic Field Visibility**
- Based on the selected type, only the relevant fields for check-in and check-out time are shown.
  - For **Work**: `checkInTimeWork`, `checkOutTimeWork`
  - For **Leave**: `checkInTimeLeave`, `checkOutTimeLeave`
  - For **Compensatory Off**: `checkInTimeComp`, `checkOutTimeComp`
- If no time is provided for a specific category, the server stores `null` for the missing values.

## **Form Fields**
### **Work Time Fields** (Visible only when "Work" is selected)
- **Check-In Time**: A `time` input for entering the work start time.
- **Check-Out Time**: A `time` input for entering the work end time.

### **Leave Time Fields** (Visible only when "Leave" is selected)
- **Check-In Time**: A `time` input for entering the leave start time.
- **Check-Out Time**: A `time` input for entering the leave end time.

### **Compensatory Off Time Fields** (Visible only when "Comp Off" is selected)
- **Comp Off Check-In Time**: A `time` input for entering the comp off start time.
- **Comp Off Check-Out Time**: A `time` input for entering the comp off end time.

## **Backend Logic**
The backend checks which set of time fields (Work, Leave, or Comp Off) have been provided. The logic is as follows:
- **Work**: If both work check-in and check-out times are provided, those are stored in the database.
- **Leave**: If leave check-in and check-out times are provided, those are stored in the database.
- **Compensatory Off**: If compensatory off check-in and check-out times are provided, those are stored in the database.

### **Null Handling**
If no check-in or check-out time is provided for any category, the corresponding value will be set to `null` in the database.

### **Example Backend Code**:
```php
// Inside the controller method to process the form submission

$checkInTime = null;
$checkOutTime = null;

// Check which set of fields has data
if ($request->has('checkInTimeWork') && $request->has('checkOutTimeWork')) {
    $checkInTime = $request->input('checkInTimeWork');
    $checkOutTime = $request->input('checkOutTimeWork');
} elseif ($request->has('checkInTimeLeave') && $request->has('checkOutTimeLeave')) {
    $checkInTime = $request->input('checkInTimeLeave');
    $checkOutTime = $request->input('checkOutTimeLeave');
} elseif ($request->has('checkInTimeComp') && $request->has('checkOutTimeComp')) {
    $checkInTime = $request->input('checkInTimeComp');
    $checkOutTime = $request->input('checkOutTimeComp');
}

// Save the check-in and check-out times in the database
$entry = new OfficeEntry();
$entry->check_in_time = $checkInTime;
$entry->check_out_time = $checkOutTime;
$entry->save();
```

## **Database Schema**
- **Table: office_entries**
  - **check_in_time**: Stores the check-in time (nullable).
  - **check_out_time**: Stores the check-out time (nullable).

## **Usage**
1. **Frontend**: The frontend will dynamically display the relevant fields based on the selected type (Work, Leave, or Comp Off). The user will fill in the required check-in and check-out times.
2. **Backend**: The controller will process the form and store the correct check-in and check-out values based on the available data.

## **Error Handling**
- If a required field is missing or invalid, an error message will be displayed next to the input field.
- The `@error` directive is used to show validation errors from the server-side.

## **Validation**
- The `required` attribute on the check-in and check-out fields ensures that a value is provided, unless the field is dynamically hidden based on the user’s selection.

## **Conclusion**
This feature provides a dynamic and efficient way to handle different types of time inputs (Work, Leave, and Comp Off) and ensures that only the relevant data is stored in the database, leaving other values as `null`.

---
