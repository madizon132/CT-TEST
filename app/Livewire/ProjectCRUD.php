<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Project;
use Illuminate\Support\Facades\{ Log, DB  };

class ProjectCRUD extends Component
{
    public $projects,
        $name,
        $description,
        $projectId,
        $updateProject = false,
        $addProject = false; 
 
    protected $rules = [
        'name' => 'required',
        'description' => 'required',
    ];
        
    public function resetFields()
    {
        $this->name = '';
        $this->description = '';
    }

    public function render()
    {        
        $this->projects = Project::select('id', 'name', 'description')->latest()->get();        
        return view('livewire.project-crud');
    }

  
    public function popAddProject()
    {
        $this->resetFields();
        $this->addProject = true;
        $this->updateProject = false;
    }
    
    public function storeProject()
    {
        $this->validate();

        try {
            DB::beginTransaction();
            Project::create([
                'name' => $this->name,
                'description' => $this->description,
            ]);

            DB::commit();
            session()->flash('success', 'Project Added!');
            
            $this->resetFields();            
            $this->addProject = false;
        } catch (\Exception $ex) {
            Log::debug($ex);
            DB::rollBack();
            session()->flash('error', 'Issue occured. Kindly Try again later.');
        }
    }

    public function popEditProject($id)
    {
        try {
            $project = Project::findOrFail($id);
            if (!$project) {
                session()->flash('error', 'Project not found');
            } else {
                $this->name = $project->name;
                $this->description = $project->description;
                
                $this->projectId = $project->id;
                $this->updateProject = true;
                $this->addProject = false;
            }
        } catch (\Exception $ex) {
            Log::debug($ex);
            session()->flash('error', 'Issue occured. Kindly Try again later.');
        }
    }

    public function updateProjectDetails()
    {       
        $this->validate();

        try {            
            DB::beginTransaction();

            Project::whereId($this->projectId)->update([
                'name' => $this->name,
                'description' => $this->description,
            ]);

            DB::commit();
            session()->flash('success', 'Project Updated!');
            
            $this->resetFields();
            $this->updateProject = false;
        } catch (\Exception $ex) {            
            Log::debug($ex);
            DB::rollBack();
            session()->flash('error', 'Issue occured. Kindly Try again later.');
        }
    }
    
    public function cancel()
    {
        $this->addProject  = false;
        $this->updateProject = false;
        $this->resetFields();
    }

     public function deleteProject($id)
    {
        try {
            DB::beginTransaction();
            
            Project::find($id)->delete();

            DB::commit();
            session()->flash('success', 'Project Deleted!');
            $this->addProject  = false;
            $this->updateProject = false;
        } catch (\Exception $ex) {
            Log::debug($ex);
            DB::rollBack();
            session()->flash('error', 'Issue occured. Kindly Try again later.');
        }
    }   
}