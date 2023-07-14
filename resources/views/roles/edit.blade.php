<x-splade-modal>
    <h1 class="text-2x1 font-semibold p-4">Update Role: {{ $role->title }}</h1>
    <x-splade-form :default="$role" action="{{ route('roles.update', $role) }}" method="PUT" class="p-4 bg-white rounded-md space-y-3">
        <x-splade-input name="title" label="Title" class="mb-5" />

        <x-splade-select name="permissions[]" label="Permissions" placeholder="Select Permissions" multiple relation choices>
            @foreach ($permissions as $permission)
                <option value="{{ $permission->id }}">
                    {{ $permission->title }}
                </option>
            @endforeach
        </x-splade-select>

        <x-splade-submit label="Save" class="mt-5" />
    </x-splade-form>
</x-splade-modal>
