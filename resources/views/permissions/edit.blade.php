<x-splade-modal>
    <h1 class="text-2x1 font-semibold p-4">Update Permission: {{ $permission->title }}</h1>
    <x-splade-form :default="$permission" action="{{ route('permissions.update', $permission) }}" method="PUT" class="p-4 bg-white rounded-md space-y-3">
        <x-splade-input name="title" label="Title" class="mb-5" />

        <x-splade-submit label="Save" class="mt-5" />
    </x-splade-form>
</x-splade-modal>
