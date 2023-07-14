<x-splade-modal action="{{ route('permissions.store') }}">
    <h1 class="text-2x1 font-semibold p-4">Create new Permission</h1>
    <x-splade-form class="p-4 bg-white rounded-md space-y-3">
        <x-splade-input name="title" label="Title" class="mb-5" />

        <x-splade-submit label="Save" class="mt-5" />
    </x-splade-form>
</x-splade-modal>
