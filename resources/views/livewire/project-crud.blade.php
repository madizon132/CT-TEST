<div>

    {{-- Project Add/Update --}}

    @if ($addProject)
        @include('livewire.project.create')
    @endif

    @if ($updateProject)
        @include('livewire.project.update')
    @endif


    {{-- Project List --}}
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

                    @if (!$addProject)
                        <button wire:click="popAddProject()" type="button"
                            class="flex justify-end py-3 px-4  items-center gap-x-2 text-sm font-medium rounded-lg border border-gray-200 text-gray-500 hover:border-blue-600 hover:text-blue-600 focus:outline-none focus:border-blue-600 focus:text-blue-600 disabled:opacity-50 disabled:pointer-events-none dark:border-neutral-700 dark:text-neutral-400 dark:hover:text-blue-500 dark:hover:border-blue-600 dark:focus:text-blue-500 dark:focus:border-blue-600">
                            Add Project
                        </button>
                    @endif

                    <div class="flex flex-col">
                        <div class="-m-1.5 overflow-x-auto">
                            <div class="p-1.5 min-w-full inline-block align-middle">
                                <div class="overflow-hidden">
                                    <table class="min-w-full divide-y divide-gray-200 dark:divide-neutral-700">
                                        <thead>
                                            <tr>
                                                <th scope="col"
                                                    class="px-6 py-3 text-start text-xs font-medium text-gray-500 uppercase dark:text-neutral-500">
                                                    Name</th>
                                                <th scope="col"
                                                    class="px-6 py-3 text-start text-xs font-medium text-gray-500 uppercase dark:text-neutral-500">
                                                    Description</th>
                                                <th scope="col"
                                                    class="px-6 py-3 text-start text-xs font-medium text-gray-500 uppercase dark:text-neutral-500">
                                                    Action</th>

                                            </tr>
                                        </thead>
                                        <tbody>

                                            @foreach ($projects as $project)
                                                <tr
                                                    class="odd:bg-white even:bg-gray-100 dark:odd:bg-neutral-900 dark:even:bg-neutral-800">
                                                    <td
                                                        class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-800 dark:text-neutral-200">
                                                        {{ $project->name }}</td>
                                                    <td
                                                        class="px-6 py-4 whitespace-nowrap text-sm text-gray-800 dark:text-neutral-200">
                                                        {{ $project->description }}</td>
                                                    <td
                                                        class="px-6 py-4 whitespace-nowrap text-center text-sm font-medium">
                                                        <button wire:click="popEditProject({{ $project->id }})"
                                                            class="btn btn-primary btn-sm text-blue-700">Edit</button> |
                                                        <button wire:click="deleteProject({{ $project->id }})"
                                                            wire:confirm="Are you sure you want to delete this project: {{ $project->name }} ?"
                                                            class="btn btn-danger btn-sm text-red-700">Delete</button>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>


                                    </table>
                                    @if (count($projects) == 0)
                                        <span
                                            class="flex justify-center px-6 py-4 whitespace-nowrap text-sm font-medium">
                                            No
                                            Projects Found.</span>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>
