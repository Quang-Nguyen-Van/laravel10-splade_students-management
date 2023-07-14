<x-splade-modal action="{{ route('roles.store') }}">
    <h1 class="text-2x1 font-semibold p-4">Create new Role</h1>
    <x-splade-form class="p-4 bg-white rounded-md space-y-3">
        <x-splade-input name="title" label="Title" class="mb-5" />

        <x-splade-select name="permissions[]" label="Permissions" placeholder="Select Permissions" multiple choices>
            @foreach ($permissions as $permission)
                <option value="{{ $permission->id }}">
                    {{ $permission->title }}
                </option>
            @endforeach
        </x-splade-select>

        {{-- <x-splade-select name="permissions[]" :options="$permissions" label="Permissions" placeholder="Select Permissions" multiple choices/> --}}

        <x-splade-submit label="Save" class="mt-5" :spinner="true" />
    </x-splade-form>
</x-splade-modal>
