<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\{ Project,Task };
use Illuminate\Support\Facades\{ Log, DB, Auth };

class TaskCrud extends Component
{    
    public 
        $projects,
        $name,        
        $taskId,
        $projectId,
        $updateTask = false,
        $addTask = false;
 
    protected $rules = [
        'projectId' => 'required',
        'name' => 'required',
    ];
        
    public function resetFields()
    {
        $this->name = '';       
    }

    public function render()
    {                       
        $this->projects = Project::latest()->get();
        
        return view('livewire.task-crud');
    }

  
    public function popAddTask()
    {
        $this->resetFields();
        $this->addTask = true;
        $this->updateTask = false;
        $this->projects = Project::latest()->get();
    }
    
    public function storeTask()
    {      
        $this->validate();

        try {
            DB::beginTransaction();
            Task::create([
                'user_id' => Auth::user()->id,
                'project_id' => $this->projectId,
                'task_name' => $this->name,                
            ]);

            DB::commit();
            session()->flash('success', 'Task Added!');
            
            $this->resetFields();            
            $this->addTask = false;
        } catch (\Exception $ex) {
            Log::debug($ex);
            DB::rollBack();
            session()->flash('error', 'Issue occured. Kindly Try again later.');
        }
    }

    public function popEditTask($id)
    {
        try {
            $task = Task::findOrFail($id);
            if (!$task) {
                session()->flash('error', 'Task not found');
            } else {
                $this->updateTask = true;
                $this->addTask = false;  

                $this->projects = Project::latest()->get();
                $this->name = $task->task_name;
                $this->projectId = $task->project_id;                
                $this->taskId = $task->id;                   
            }
        } catch (\Exception $ex) {
            Log::debug($ex);
            session()->flash('error', 'Issue occured. Kindly Try again later.');
        }
    }

    public function updateTaskDetails()
    {       
        $this->validate();

        try {            
            DB::beginTransaction();

            Task::whereId($this->taskId)->update([
                'task_name' => $this->name,                
            ]);

            DB::commit();
            session()->flash('success', 'Task Updated!');
            
            $this->resetFields();
            $this->updateTask = false;       
        } catch (\Exception $ex) {            
            Log::debug($ex);
            DB::rollBack();
            session()->flash('error', 'Issue occured. Kindly Try again later.');
        }
    }
    
    public function cancel()
    {
        $this->addTask = false;
        $this->updateTask = false;
        $this->resetFields();
    }

     public function deleteTask($id)
    {
        try {
            DB::beginTransaction();
            
            Task::find($id)->delete();

            DB::commit();
            session()->flash('success', 'Task Deleted!');
            $this->addTask  = false;
            $this->updateTask = false;
        } catch (\Exception $ex) {
            Log::debug($ex);
            DB::rollBack();
            session()->flash('error', 'Issue occured. Kindly Try again later.');
        }
    }   

    public function updateTaskOrder($groupTasks)
    {
        try {
            DB::beginTransaction();
            
            foreach ($groupTasks as $groupTask) {            
                foreach ($groupTask['items'] as $task){             
                    Task::whereId($task['value'])->update(['priority' => $task['order']]);
                }            
            }

            DB::commit();
            session()->flash('success', 'Task Reorganized!');            
        } catch (\Exception $ex) {
            Log::debug($ex);
            DB::rollBack();
            session()->flash('error', 'Issue occured. Kindly Try again later.');
        }       
    } 
}