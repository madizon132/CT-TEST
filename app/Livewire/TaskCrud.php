<?php

namespace App\Livewire;

use App\Models\{ Task, Project };
use Livewire\Component;
use Illuminate\Support\Facades\Log;

class TaskCrud extends Component
{   
    
    public $tasks,
        $name,
        $description,
        $postId,
        $updateTask  = false,
        $addTask = false;

    public function updateTaskOrder($groupTasks)
    {
        
        foreach ($groupTasks as $groupTask) {            
            foreach ($groupTask['items'] as $task){             
                Task::whereId($task['value'])->update(['priority' => $task['order']]);
            }            
        }
    }

    public function removeTask($id)
    {
        Task::whereId($id)->delete();
    }

    public function render()
    {        
        $this->tasks =  Task::orderBy('priority')->get();
        return view('livewire.task-crud', ['projects'=> Project::latest()->get()]);
    }
}