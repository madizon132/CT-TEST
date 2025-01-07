<div>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">

                    @if (session()->has('success'))
                        <div class="flex justify-center text-green-900 alert alert-success" role="alert">
                            {{ session()->get('success') }}
                        </div>
                    @endif

                    @if (session()->has('error'))
                        <div class="flex justify-center text-red-900 alert alert-danger" role="alert">
                            {{ session()->get('error') }}
                        </div>
                    @endif

                    @if (!$addTask)
                        <button wire:click="popAddTask()" type="button"
                            class="flex justify-end py-3 px-4  items-center gap-x-2 text-sm font-medium rounded-lg border border-gray-200 text-gray-500 hover:border-blue-600 hover:text-blue-600 focus:outline-none focus:border-blue-600 focus:text-blue-600 disabled:opacity-50 disabled:pointer-events-none dark:border-neutral-700 dark:text-neutral-400 dark:hover:text-blue-500 dark:hover:border-blue-600 dark:focus:text-blue-500 dark:focus:border-blue-600">
                            Add Task
                        </button>
                    @endif

                    @if ($addTask)
                        @include('livewire.task.create')
                    @endif

                    @if ($updateTask)
                        @include('livewire.task.update')
                    @endif
                </div>
            </div>
        </div>
    </div>


    <div wire:sortable-group="updateTaskOrder">
        @foreach ($projects as $project)
            @if (count(
                    $project->tasks()->where('user_id', auth()->user()->id)->orderBy('priority')->get()) > 0)
                <div class="py-12">
                    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                        <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                            <div class="p-6 text-gray-900 dark:text-gray-100">


                                <div wire:key="group-{{ $project->id }}" wire:sortable.item="{{ $project->id }}">
                                    <div style="display: flex">
                                        <h4 wire:sortable.handle class="text-blue-700 text-2xl">Project:
                                            {{ $project->name }}
                                        </h4>
                                    </div>
                                    <br>
                                    Task Lists
                                    <ul wire:sortable-group.item-group="{{ $project->id }}" role="list"
                                        class="divide-y divide-gray-100">
                                        @foreach ($project->tasks()->where('user_id', auth()->user()->id)->orderBy('priority')->get() as $task)
                                            <li wire:key="task-{{ $task->id }}"
                                                wire:sortable-group.item="{{ $task->id }}"
                                                wire:sortable-group.handle class="flex justify-between gap-x-6 py-5">



                                                <div class="flex min-w-0 gap-x-4">
                                                    <div class="min-w-0 flex-auto">
                                                        <span
                                                            class="text-sm/6 font-semibold text-gray-900">{{ $task->task_name }}</span>
                                                    </div>
                                                </div>
                                                <div class="hidden shrink-0 sm:flex sm:flex-col sm:items-end">
                                                    <button wire:click="popEditTask({{ $task->id }})"
                                                        class="btn btn-primary btn-sm text-blue-700">Edit</button>
                                                    <button wire:click="deleteTask({{ $task->id }})"
                                                        wire:confirm="Are you sure you want to delete this task: {{ $task->task_name }} on Project {{ $project->name }}?"
                                                        class="btn btn-danger btn-sm text-red-700">Remove</button>
                                                </div>


                                            </li>
                                        @endforeach
                                    </ul>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endif
        @endforeach

    </div>

</div>
