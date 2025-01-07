<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 text-gray-900 dark:text-gray-100">

                <form>
                    <div class="form-group mb-3">
                        <label for="input-label" class="block text-sm font-medium mb-2 dark:text-white">Project
                            Name</label>
                        <input type="text" id="input-label"
                            class="py-3 px-4 block w-full border-gray-200 rounded-lg text-sm focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-400 dark:placeholder-neutral-500 dark:focus:ring-neutral-600"
                            class="form-control @error('name') is-invalid @enderror" id="name"
                            placeholder="Update Project Name" wire:model="name">

                        @error('name')
                            <span class="text-danger  text-red-600">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group mb-3">
                        <label for="input-label" class="block text-sm font-medium mb-2 dark:text-white">Project
                            Description</label>
                        <textarea
                            class="py-3 px-4 block w-full border-gray-200 rounded-lg text-sm focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-400 dark:placeholder-neutral-500 dark:focus:ring-neutral-600"
                            class="form-control @error('description') is-invalid @enderror" id="description" wire:model="description"
                            placeholder="Update Description"></textarea>
                        @error('description')
                            <span class="text-danger text-red-600">{{ $message }}</span>
                        @enderror
                    </div>

                    <button wire:click.prevent="updateProjectDetails()"
                        class="py-3 px-4 inline-flex items-center gap-x-2 text-sm font-medium rounded-lg border border-transparent bg-teal-500 text-white hover:bg-teal-600 focus:outline-none focus:bg-teal-600 disabled:opacity-50 disabled:pointer-events-none">
                        Update
                    </button>
                    <button wire:click.prevent="cancel()"
                        class="py-3 px-4 inline-flex items-center gap-x-2 text-sm font-medium rounded-lg border border-transparent bg-red-500 text-white hover:bg-red-600 focus:outline-none focus:bg-red-600 disabled:opacity-50 disabled:pointer-events-none">
                        Cancel
                    </button>
                </form>

            </div>
        </div>
    </div>
</div>
