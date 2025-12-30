<div class="p-4">
    <h3 class="text-lg font-bold mb-4">Academic Sessions</h3>

    @if (session()->has('message'))
        <div class="alert alert-success mb-3">
            {{ session('message') }}
        </div>
    @endif

    <form wire:submit.prevent="save" class="mb-6">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <x-form-input
                label="Session Name"
                name="name"
                placeholder="e.g. 2025-2026"
                type="text"
                wire:model="name"
                class="form-control"
            />

            <div class="flex items-end gap-3">
                <label class="flex items-center gap-2">
                    <input type="checkbox" wire:model="is_active">
                    <span>Active</span>
                </label>

                <flux:button type="submit" variant="primary" wire:loading.attr="disabled">
                    <span wire:loading.remove>Add Session</span>
                    <span wire:loading>Saving...</span>
                </flux:button>
            </div>
        </div>
    </form>

    <h4 class="font-semibold mb-3">Session List</h4>

    <table class="table table-bordered w-full">
        <thead>
            <tr>
                <th>#</th>
                <th>Session</th>
                <th>Status</th>
                <th class="w-32">Action</th>
            </tr>
        </thead>
        <tbody>
            @forelse($sessions as $s)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $s->name }}</td>
                    <td>{{ $s->is_active ? 'Active' : 'Inactive' }}</td>
                    <td>
                        <flux:button
                            variant="danger"
                            size="sm"
                            wire:click="delete({{ $s->id }})"
                            wire:confirm="Are you sure?"
                        >
                            Delete
                        </flux:button>
                    </td>
                </tr>
            @empty
                <tr><td colspan="4" class="text-center py-4">No sessions found.</td></tr>
            @endforelse
        </tbody>
    </table>
</div>
