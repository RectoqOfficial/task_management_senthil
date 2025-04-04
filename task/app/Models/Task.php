<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Task extends Model
{
    use HasFactory;

    
    protected $fillable = ['task_title', 'description', 'employee_id', 'status', 'task_start_date','deadline', 'total_days','redo_count', 'remarks'];

    protected $appends = ['computed_deadline']; // Ensure computed attribute is included in JSON

    
    
    public function employee()
    {
        return $this->belongsTo(Employee::class, 'employee_id');
    }
    
    public function score()
    {
        return $this->hasOne(Score::class, 'task_id');
    }

 

public function getComputedDeadlineAttribute()
{
    if ($this->task_start_date && $this->total_days) {
        return Carbon::parse($this->task_start_date)->addDays($this->total_days)->format('Y-m-d');
    }
    return null; // If values are missing, return null
}

    
}
