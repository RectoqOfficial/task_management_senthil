<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use HasFactory;
    
    protected $fillable = ['task_title', 'description', 'employee_id', 'status', 'deadline', 'task_start_date', 'total_days', 'remarks'];

    public function employee()
    {
        return $this->belongsTo(Employee::class, 'employee_id');
    }
}
