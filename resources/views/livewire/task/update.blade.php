<form>
    <label for="projects" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Select an
        Project</label>
    <select id="projects" wire:model="projectId"
        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
        disabled>

        <option selected>Choose a project</option>
        @foreach ($projects as $project)
            <option value="{{ $project->id }}">{{ $project->name }}</option>
        @endforeach
    </select>

    @error('projectId')
        <span class="text-danger  text-red-600">{{ $message }}</span>
    @enderror

    <div class="form-group mb-3">
        <label for="input-label" class="block text-sm font-medium mb-2 dark:text-white">Task
            Name</label>
        <input type="text" id="input-label"
            class="py-3 px-4 block w-full border-gray-200 rounded-lg text-sm focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-400 dark:placeholder-neutral-500 dark:focus:ring-neutral-600"
            class="form-control @error('name') is-invalid @enderror" id="name" placeholder="Update Task Name"
            wire:model="name">

        @error('name')
            <span class="text-danger  text-red-600">{{ $message }}</span>
        @enderror
    </div>

    <button wire:click.prevent="updateTaskDetails()"
        class="py-3 px-4 inline-flex items-center gap-x-2 text-sm font-medium rounded-lg border border-transparent bg-teal-500 text-white hover:bg-teal-600 focus:outline-none focus:bg-teal-600 disabled:opacity-50 disabled:pointer-events-none">
        Update
    </button>
    <button wire:click.prevent="cancel()"
        class="py-3 px-4 inline-flex items-center gap-x-2 text-sm font-medium rounded-lg border border-transparent bg-red-500 text-white hover:bg-red-600 focus:outline-none focus:bg-red-600 disabled:opacity-50 disabled:pointer-events-none">
        Cancel
    </button>
</form>
