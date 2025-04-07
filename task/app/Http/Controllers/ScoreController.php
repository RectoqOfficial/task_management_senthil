<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Task;
use App\Models\Score;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class ScoreController extends Controller
{

    // Score View
   public function index()
{
    // Fetch all tasks and join with scores
    $tasks = Task::with('score')->get();

    return view('admin.score.index', compact('tasks'));
}


public function updateScore($task_id)
{
    $task = Task::findOrFail($task_id); // get the task
    $score = Score::firstOrNew(['task_id' => $task->id]); // get or create score

    // Use the task's redo_count from the tasks table
    $score->score = max(100 - ($task->redo_count * 10), 0);
    $score->save();

    return redirect()->route('score.index')->with('success', 'Score updated successfully.');
}



    // Employee Score Page 
        public function showScorePage()
{
    $employeeId = Auth::guard('employee')->id();
    
    // Fetch tasks assigned to the logged-in employee along with their scores
    $tasks = Task::where('employee_id', $employeeId)
                ->with('score')
                ->get();

    return view('admin.score.scores', compact('tasks'));
}

}