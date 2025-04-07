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
public function updateScore()
{
    // Find or create the related score record
    $score = \App\Models\Score::firstOrNew(['task_id' => $this->id]);

    // Use the task's own redo_count to calculate the score
    $redoCount = $this->redo_count ?? 0;

    // Simple formula: 100 - (10 * redo_count)
    $score->score = max(100 - ($redoCount * 10), 0);

    // Save the score
    $score->save();
}


protected static function booted()
{
    static::updated(function ($task) {
        if ($task->isDirty('redo_count')) {
            $task->updateScore();
        }
    });
}



    
}
