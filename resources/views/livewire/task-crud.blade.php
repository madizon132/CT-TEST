<div>
    <div class="col-md-8 mb-2">
        @if (session()->has('success'))
            <div class="alert alert-success" role="alert">
                {{ session()->get('success') }}
            </div>
        @endif

        @if (session()->has('error'))
            <div class="alert alert-danger" role="alert">
                {{ session()->get('error') }}
            </div>
        @endif

        @if ($addTask)
            @include('livewire.project.create')
        @endif

        @if ($updateTask)
            @include('livewire.project.update')
        @endif

    </div>
    <div class="col-md-8">
        <div class="card">
            <div class="card-body">
                @if (!$addTask)
                    <button wire:click="addTask()" class="btn btn-primary btn-sm float-right">Add New Task</button>
                @endif
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Description</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if (count($tasks) > 0)
                                @foreach ($tasks as $task)
                                    <tr>
                                        <td>
                                            {{ $task->name }}
                                        </td>
                                        <td>
                                            {{ $task->description }}
                                        </td>
                                        <td>
                                            <button wire:click="editTask({{ $task->id }})"
                                                class="btn btn-primary btn-sm">Edit</button>
                                            <button wire:click="delete"
                                                wire:confirm="Are you sure you want to delete this project: {{ $task->name }} ?"
                                                onclick="deleteTask({{ $task->id }})"
                                                class="btn btn-danger btn-sm">Delete</button>
                                        </td>
                                    </tr>
                                @endforeach
                            @else
                                <tr>
                                    <td colspan="3" align="center">
                                        No Tasks Found.
                                    </td>
                                </tr>
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

</div>

{{-- 
<div wire:sortable-group="updateTaskOrder" style="display: flex">
    @foreach ($groups as $group)
        <div wire:key="group-{{ $group->id }}" wire:sortable.item="{{ $group->id }}">
            <div style="display: flex">
                <h4 wire:sortable.handle>{{ $group->name }}</h4>

                <button wire:click="removeGroup({{ $group->id }})">Remove</button>
            </div>

            <ul wire:sortable-group.item-group="{{ $group->id }}">
                @foreach ($group->tasks()->orderBy('priority')->get() as $task)
                    <li wire:key="task-{{ $task->id }}" wire:sortable-group.item="{{ $task->id }}">
                        <span wire:sortable-group.handle>{{ $task->task_name }}</span>
                        <button wire:click="removeTask({{ $task->id }})">Remove</button>
                    </li>
                @endforeach
            </ul>

        </div>
    @endforeach
</div> --}}
