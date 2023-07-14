<x-splade-modal>
    <h1 class="text-2x1 font-semibold p-4">Update Student: {{ $student->name }}</h1>
    <x-splade-form :default="$student" action="{{ route('students.update', $student) }}" method="PUT" class="p-4 bg-white rounded-md space-y-3">
        <x-splade-input name="name" label="Name" class="mb-5" />
        <x-splade-input name="email" type="email" placeholder="Email Address" label="Email" class="mb-5" />
        <x-splade-input name="phone_number" label="Phone Number" type="text" class="mb-5" />

        <x-splade-select name="section_id" label="Section">
            <option value="" selected>Select a Section</option>
            @foreach ($sections as $section)
                <option value="{{ $section->id }}">
                    {{ $section->class->name }}-{{ $section->name }}
                </option>
            @endforeach
        </x-splade-select>
        <x-splade-file class="mt-5" name="avatar" filepond min-size="50KB" max-size="5MB" preview accept="image/png" />
        <x-splade-submit label="Save" class="mt-5" />
    </x-splade-form>
</x-splade-modal>
