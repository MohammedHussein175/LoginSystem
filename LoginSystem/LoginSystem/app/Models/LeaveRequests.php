<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LeaveRequests extends Model
{
    use HasFactory;

    protected $fillable=['user_id','employee_id','start_date','end_date','reason','updated_at'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
