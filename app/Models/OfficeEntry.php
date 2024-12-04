<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OfficeEntry extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',         // Foreign key for User model
        'date',            // Date of the entry
        'check_in_time',   // Check-in time
        'check_out_time',  // Check-out time
        'day_type',        // Day type (e.g., leave, work, compOff)
        'leave_type',      // Leave type (e.g., sick, vacation, personal)
        'leave_duration',  // Full day or half day leave
        'comp_off_date',   // If it's a comp-off, store the date
        'comp_duration',   // Full or half comp-off day
    ];

    // Define relationship with User
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
